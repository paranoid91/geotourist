<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events;
use App\Event_trans;
use App\Event_gallery;
use App\Event_videos;
use App\Event_cat;
use App\Event_cat_trans;
use App\Event_slider;
use App\Langs;
use App;
use Illuminate\Support\Facades\Event;
use Input;
use App\Event_main_text;
use App\Event_reviews;
use Carbon\Carbon;
use App\Ads;

class AdminEventsController extends Controller
{

    public function index()
    {
        $events = Events::orderBy("id", 'desc')->get();
        return view("admin/events/index", compact("events"));
    }

    public function create()
    {
        $cat = Event_cat::all();
        return view("admin/events/add", compact("cat"));
    }


    public function store(Request $request)
    {
        $data = $request->input();
         $st = (int)$data["sticker"];
        $event_cat_id = Event_cat::where("category", $data["category"])->get();
        $cat_id = (int)$event_cat_id[0]->id;

        $listImgPath = $this->saveListPicture($request);

        $parallaxImgPath = $this->saveParalaxImg($request);

        $event = Events::create([
            "cat_id" => $cat_id,
            "paralax_img" => $parallaxImgPath,
            "list_img" => $listImgPath,
            "google_map" => $data["google_map"],
            "price" => $data["price"],
            "upcoming" => (isset($data["upcoming"]) ? (int)$data["upcoming"] : 0),
            "created_at" => Carbon::now(),
            "sticker" => $st,
        ]);

        if(isset($request->add_to_ad))
        {
            $event->add_to_ad = 1;
            $event->save();

            Ads::create([
                "event_id" => $event->id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
        }

        if($request->videos && count($request->videos) > 0)
        {
            for($i = 0; $i < count($request->videos); $i++)
            {
                Event_videos::create([
                    "event_id" => $event->id,
                    "src" => $request->videos[$i],
                ]);
            }

        }

        //add images to Images table
        $gallery_img = [];
        if(isset($data["gallery-img-1"]))
        {
            //how many images uploaded
            $i = 1;
            while(isset($data["gallery-img-" . $i . ""])){
                $path =  $data["gallery-img-" . $i . ''];
                $gallery_img[] =  strstr($path, "/img/");
                $i++;
            }

            //store images in images table
            foreach($gallery_img as $pic) {
                $img = Event_gallery::create([
                    "event_id" => $event->id,
                    "path" => $pic
                ]);
            }
        }

        foreach(["ge","en","ru"] as $lang)
        {
            Event_trans::create([
                "event_id" => $event->id,
                "lang_id" => Langs::where('lang', $lang)->first()->id,
                "title" => $data["" . $lang . "_title"],
                "body" => $data["" . $lang . "_body"],
                "short_body" => $data["" . $lang . "_short_body"],
            ]);
        }
        return redirect()->back()->with("msg", "ივენთი დამატებულია");
    }

    public function edit($id)
    {
        $event = Events::find($id);
        $cat = Event_cat::all();
        return view('admin/events/edit', compact("event", "cat"));
    }


    public function update(Request $request, $id)
    {
        $cat = Event_cat::where("category", $request->category)->first();

        $tour = Events::findOrFail($id);

        $data = $request->input();

        $listImgPath = $this->saveListPicture($request);

        $parallaxImgPath = $this->saveParalaxImg($request);

        if(isset($data["videos"]) && count($data["videos"]) > 0)
        {
            for($i = 0; $i < count($data["videos"]); $i++)
            {
                Event_videos::create([
                    "event_id" => $tour->id,
                    "src" => $data["videos"][$i],
                ]);
            }
        }

        if($listImgPath){
            $tour->list_img = $listImgPath;
        }

        if($parallaxImgPath){
            $tour->paralax_img = $parallaxImgPath;
        }

        $tour->fill([
            "cat_id" => $cat->id,
            "google_map" => $data["google_map"],
            "price" => $data["price"],
            "upcoming" => (isset($data["upcoming"]) ? (int)$data["upcoming"] : 0),
            "updated_at" => Carbon::now(),
            "sticker" => (int)$data["sticker"]
        ]);

        if(isset($request->add_to_ad)){
            $tour->add_to_ad = 1;

            $ad = Ads::where("event_id", $tour->id)->first();

            if(!is_null($ad)){
                $ad->fill(["updated_at" => Carbon::now()]);
                $ad->save();
            }else{
                Ads::create([
                    "event_id" => $tour->id,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }

        }else{
            $tour->add_to_ad = 0;
            if(!is_null($ad = Ads::where("event_id", $tour->id)->first())){
                $ad->delete();
            }
        }

        $tour->save();

        //add images to Images table
        $gallery_img = [];
        if(isset($data["gallery-img-1"]))
        {
            //how many images uploaded
            $i = 1;
            while(isset($data["gallery-img-" . $i . ""])){
                $path =  $data["gallery-img-" . $i . ''];
                $gallery_img[] =  strstr($path, "/img/");
                $i++;
            }

            //store images in images table
            foreach($gallery_img as $pic) {
                $img = Event_gallery::create([
                    "event_id" => $tour->id,
                    "path" => $pic
                ]);
            }
        }

        foreach(["ge","en","ru"] as $lang)
        {
            $lang_id = Langs::where('lang', $lang)->first()->id;

            $trans = Event_trans::where('event_id', $tour->id)
                ->where('lang_id', $lang_id)->first();

            $trans->fill([
                "event_id" => $tour->id,
                "lang_id" => $lang_id,
                "title" => $data["" . $lang . "_title"],
                "body" => $data["" . $lang . "_body"],
                "short_body" => $data["" . $lang . "_short_body"],
            ]);

            $trans->save();
        }

        return redirect()->back()->with("msg", "ივენთი განახლებულია");
    }


    public function destroy($id)
    {
        $t = Events::find($id);
        if(isset($t)){

            //remove paralax image(file)
            if($t->paralax_img != '' && $t->paralax_img != '0')
            {
                if(file_exists(public_path() . $t->paralax_img))
                {
                    unlink(public_path() . $t->paralax_img);
                }
            }

            //remove list image(file)
            if($t->list_img != '' && $t->list_img != '0')
            {
                if(file_exists(public_path() . $t->list_img)){
                    unlink(public_path() . $t->list_img);
                }
            }

            //remove all gallery images
            if(count($t->tour_gallery) > 0)
            {
                foreach($t->tour_gallery as $pic)
                {
                    if(file_exists(public_path() . $pic->path))
                    {
                        unlink(public_path() . $pic->path);
                    }
                }
            }
            $t->delete();
            return response("ტური წაიშალა");
        }

        else{
            return response("ტური ვერ წაიშალა", 400);
        }
    }



    //save gallery images
    public function storeImagez(Request $request)
    {
        if($request->file('file')->isValid())
        {
            $file = $request->file('file');

            $aliosha = md5(uniqid()) . $file->getClientOriginalName();

            $file->move(public_path() . '/img', $aliosha);
        }
        return json_encode(['uploaded_path' => (public_path() . '/img/' . $aliosha)]);
    }

    //save paralx image
    public function saveParalaxImg($request)
    {
        if($request->hasFile("paralax_img"))
        {
            $file = $request->file('paralax_img');
            $name = $this->randomString() . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
            return (string)$path;
        }else{
            return false;
        }
    }

    //save list image
    protected function saveListPicture($req){

        $b64 = $req->input("list_img");

        if(isset($b64) && !empty($b64)){
            return $this->base64_to_jpeg($b64, public_path()
                . "/img/" . $this->randomString() . ".jpeg");
        }else{
            return false;
        }
    }

    //decode base64 image
    protected function base64_to_jpeg($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        $path = strstr($output_file, "/img/");
        return $path;
    }

    //random string generator
    public function randomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //remove tour picture
    public function removeTourImage($id, $img)
    {
        $tour = Events::findOrFail($id);
        if($img == "paralax"){
            if(file_exists(public_path() . $tour->paralax_img))
            {
                unlink(public_path() . $tour->paralax_img);
            }
            $tour->paralax_img = null;
            $tour->save();
            return Input::all();
        }elseif($img == "list"){
            if(file_exists(public_path() . $tour->list_img))
            {
                unlink(public_path() . $tour->list_img);
            }
            $tour->list_img = null;
            $tour->save();
            return Input::all();
        }else{
            //return Response::json(array('fail' => true));
        }
    }

    public function removeGalleryPic($id, $pics)
    {
        $pics = json_decode($pics, true);
        $tour_whole_gallery = Event_gallery::where("event_id", $id)->get();
        if(count($tour_whole_gallery) > 0)
        {
            foreach($tour_whole_gallery as $gallery)
            {
                foreach($pics as $pic_id)
                {
                    if($gallery->id == $pic_id)
                    {
                        if(file_exists(public_path() . $gallery->path)){
                            unlink(public_path() . $gallery->path);
                        }
                        Event_gallery::where("id", $pic_id)->delete();
                    }
                }
            }
        }
        return Input::all();
    }

    //add pictures/vidoes to gallery

    public function addToGallery($id, $gallery, $data_type)
    {
        Events::findOrFail($id);
        $gallery = json_decode($gallery, true);
        if($gallery && count($gallery) > 0)
        {
            if($data_type == "add-video")
            {
                foreach($gallery as $item)
                {
                    $video = Event_videos::find($item);
                    $video->put_in_gallery = 1;
                    $video->save();
                }
            }
            elseif($data_type == "add-picture")
            {
                foreach($gallery as $item)
                {
                    $pic = Event_gallery::find($item);
                    $pic->put_in_gallery = 1;
                    $pic->save();
                }
            }
        }
        return Input::all();
    }

    public function removeVideo($id, $links)
    {
        Events::findOrFail($id);
        $links = json_decode($links, true);
        if(count($links) > 0)
        {
            foreach($links as $link)
            {
                Event_videos::where("id", $link)->delete();
            }
        }
        return Input::all();
    }

    public function categories()
    {
        $cat = Event_cat::orderBy("id", "desc")->get();
        return view("admin/events/cat", compact("cat"));
    }

    public function catAdd(Request $request)
    {
        $img = $this->saveListPicture($request);
        $event_cat = Event_cat::create(["category" => $request->en_title, "img" => $img]);
        foreach(["ge", "en", "ru"] as $lang)
        {
            Event_cat_trans::create([
               "event_cat_id" => $event_cat->id,
               "lang_id" => Langs::where('lang', $lang)->first()->id,
                "title" => $request[$lang . "_title"],
            ]);
        }

        return redirect()->back()->with("msg", "კატეგორია დამატებულია");
    }

    public function catShow($id)
    {
        $cat = Event_cat::findOrFail($id);
        return view("admin/events/cat-update", compact("cat"));
    }

    public function catUpdate($id, Request $request)
    {
        $cat = Event_cat::findOrFail($id);

        foreach(["ge","en","ru"] as $lang)
        {
            $lang_id = Langs::where('lang', $lang)->first()->id;

            $trans = Event_cat_trans::where('event_cat_id', $cat->id)
                ->where('lang_id', $lang_id)->first();

            $trans->fill([
                "event_cat_id" => $cat->id,
                "lang_id" => $lang_id,
                "title" => $request[$lang . "_title"],
            ]);

            $trans->save();
        }

        if(isset($request->list_img) && !empty($request->list_img))
        {
            $img = $this->saveListPicture($request);
            $cat->img = $img;
        }

        $cat->update(["category" => $request->en_title]);
        $cat->save();

        return redirect("/{lang}/admin/events/categories")->with("msg", "კატეგორია განახლებულია");
    }

    public function catDelete($id)
    {
        $cat = Event_cat::findOrFail($id);
        $cat->delete();
        return response("კატეგორია წაიშალა");
    }

    public function removeCatImage($id)
    {
        $cat = Event_cat::findOrFail($id);

        if(file_exists(public_path() . $cat->img))
        {
            unlink(public_path() . $cat->img);
        }
        $cat->img = null;
        $cat->save();

        return Input::all();
    }

    public function showEventsSlider()
    {
        $pictures = Event_slider::orderBy('id', 'desc')->get();
        return view("admin/events/slider", compact("pictures"));
    }

    public function addSliderImg(Request $request)
    {
        if($request->hasFile("slider-pic"))
        {
            $file = $request->file('slider-pic');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
            Event_slider::create(["path" => $path]);
            return redirect()->back()->with("msg", "სურათი დამატებულია");
        }elseif(!$request->hasFile("slider-pic")){
            return redirect()->back()->with("bad_msg", "აირჩიეთ სურათი");
        }
    }

    //remove slider pics
    public function removeSliderImg($id)
    {
        $pic = Event_slider::find($id);

        if(isset($pic) && $pic->delete()){
            if(file_exists(public_path() . $pic->path)){
                unlink(public_path() . $pic->path);
            }
            return response("ტური წაიშალა");
        }else{
            return response("ტური ვერ წაიშალა", 400);
        }
    }

    public function mainText()
    {
        $texts = Event_main_text::all();
        return view("admin/events/texts", compact("texts"));
    }

    public function saveText(Request $requests)
    {
        if(($texts = Event_main_text::find(1)) !== null)
        {
            $texts->en_main_text = $requests->en_main_text;
            $texts->ge_main_text = $requests->ge_main_text;
            $texts->ru_main_text = $requests->ru_main_text;
            $texts->save();
        }
        else
        {
            Event_main_text::create([
                "id" => 1,
                "en_main_text" => $requests->en_main_text,
                "ge_main_text" => $requests->ge_main_text,
                "ru_main_text" => $requests->ru_main_text,
            ]);
        }

        return redirect()->back()->with("ტექსტი განახლებულია");
    }

    public function showAllToursFilter()
    {
        $boss_mode = true;
        $lang = Langs::where("lang", App::getLocale())->get();
        $events = Events::orderBy("id", "desc")->get();
        return view("admin/events/list", compact("events", "boss_mode", "lang"));
    }

    public function showFilter(Request $request)
    {
        $event = Events::findOrFail($request->id);
        $lang = Langs::where("lang", App::getLocale())->get();
        $event_reviews = Event_reviews::where("event_id", $event->id)->orderBy("id", "desc")->get();
        $boss_mode = true;
        return view("events/show", compact("event", "event_reviews", "boss_mode", "lang"));
    }


    public function removeCommment($id)
    {
        $review = App\Event_reviews::findOrFail($id);
        $review->delete();
    }
}
