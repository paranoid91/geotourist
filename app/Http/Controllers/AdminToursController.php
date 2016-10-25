<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Tour_reviews;
use App\Tours;
use App\Tour_trans;
use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Input;
use App\Tour_gallery;
use App\Langs;
use App\Tour_videos;
use Auth;
use Carbon\Carbon;
use App\Ads;

class AdminToursController extends Controller
{

    public function index(Request $request)
    {
        $type = (int)$request->input("type");
        $tours = Tours::where("tour_type",$type)->orderBy('id', 'desc')->get();

        return view("admin/tours/index", compact("type", "tours"));
    }

    public function create(Request $request)
    {
        $type = (int)$request->input("type");
        return view("admin/tours/add", compact('type'));
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $st = (int)$data["sticker"];
        $listImgPath = $this->saveListPicture($request);

        $parallaxImgPath = $this->saveParalaxImg($request);

        $tour = Tours::create([
            "tour_type" => $data["type"],
            "price" => $data["price"],
            "paralax_img" => $parallaxImgPath,
            "list_img" => $listImgPath,
            "sp_tour_num" => (isset($data["sp_tour_num"]) ? $data["sp_tour_num" ] : ""),
            "created_at" => Carbon::now(),
            "sticker" => $st,
        ]);

        if(isset($request->add_to_ad))
        {
            $tour->add_to_ad = 1;
            $tour->save();

            Ads::create([
                "tour_id" => $tour->id,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
        }

        if(isset($request->videos) && count($request->videos) > 0)
        {
            for($i = 0; $i < count($request->videos); $i++ )
            {
                Tour_videos::create([
                    "tour_id" => $tour->id,
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
                $img = Tour_gallery::create([
                    "tour_id" => $tour->id,
                    "path" => $pic
                ]);
            }
        }

        foreach(["ge","en","ru"] as $lang)
        {
            Tour_trans::create([
                "tour_id" => $tour->id,
                "lang_id" => Langs::where('lang', $lang)->first()->id,
                "title" => $data["" . $lang . "_title"],
                "location" => $data["" . $lang . "_location"],
                "dept_time" => $data["" . $lang . "_dept_time"],
                "depture_time" => $data["" . $lang . "_dept_time"],
                "return_time" => $data["" . $lang . "_return_time"],
                "body" => $data["" . $lang . "_body"],
                "short_description" => $data["" . $lang . "_short_description"],
                "d3" => (isset($data[$lang . "_d3" ]) ? $data[$lang . "_d3" ] : ""),
                "d7" => (isset($data[$lang . "_d7" ]) ? $data[$lang . "_d7" ] : ""),
                "d10" => (isset($data[$lang . "_d10" ]) ? $data[$lang . "_d10" ] : ""),
                "d3_num" => (isset($data["d3_num"]) ? $data["d3_num"] : ""),
                "d7_num" => (isset($data["d7_num"]) ? $data["d7_num"] : ""),
                "d10_num" => (isset($data["d10_num"]) ? $data["d10_num"] : ""),
            ]);
        }
        return redirect()->back()->with("msg", "ტური დამატებულია");
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

    //save gallery images
    public function storeImages(Request $request)
    {
        if($request->file('file')->isValid())
        {
            $file = $request->file('file');

            $aliosha = $this->randomString() . $file->getClientOriginalName();

            $file->move(public_path() . '/img', $aliosha);
        }
        return json_encode(['uploaded_path' => (public_path() . '/img/' . $aliosha)]);
    }

    public function edit($id)
    {
        $tour = Tours::find($id);

        return view('admin.tours.edit', compact("tour"));
    }

    public function update(Request $request, $id)
    {

        $tour = Tours::find($id);

        $data = $request->input();

        $listImgPath = $this->saveListPicture($request);

        $parallaxImgPath = $this->saveParalaxImg($request);

        if(isset($request->videos) && count($request->videos) > 0)
        {
            for($i = 0; $i < count($request->videos); $i++ )
            {
                Tour_videos::create([
                    "tour_id" => $tour->id,
                    "src" => $request->videos[$i],
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
            "tour_type" => $data["type"],
            "price" => $data["price"],
            "sp_tour_num" => (isset($data["sp_tour_num"]) ? $data["sp_tour_num" ] : ""),
            "updated_at" => Carbon::now(),
            "sticker" => (int)$data["sticker"]
        ]);

        if(isset($request->add_to_ad)){
            $tour->add_to_ad = 1;
            $ad = Ads::where("tour_id", $tour->id)->first();

            if(!is_null($ad)){
                $ad->fill(["updated_at" => Carbon::now()]);
                $ad->save();
            }else{
                Ads::create([
                    "tour_id" => $tour->id,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }

        }else{
            $tour->add_to_ad = 0;
            if(!is_null($ad = Ads::where("tour_id", $tour->id)->first())){
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
                $img = Tour_gallery::create([
                    "tour_id" => $tour->id,
                    "path" => $pic
                ]);
            }
        }

        foreach(["ge","en","ru"] as $lang)
        {
            $lang_id = Langs::where('lang', $lang)->first()->id;

            $trans = Tour_trans::where('tour_id', $tour->id)
                ->where('lang_id', $lang_id)->first();

            $trans->fill([
                "tour_id" => $tour->id,
                "lang_id" => $lang_id,
                "title" => $data[$lang . "_title"],
                "location" => $data[$lang . "_location"],
                "dept_time" => $data[$lang . "_dept_time"],
                "depture_time" => $data[$lang . "_dept_time"],
                "return_time" => $data[$lang . "_return_time"],
                "body" => $data[$lang . "_body"],
                "short_description" => $data[$lang . "_short_description"],
                "d3" => (isset($data[$lang . "_d3" ]) ? $data[$lang . "_d3" ] : ""),
                "d7" => (isset($data[$lang . "_d7" ]) ? $data[$lang . "_d7" ] : ""),
                "d10" => (isset($data[$lang . "_d10" ]) ? $data[$lang . "_d10" ] : ""),
                "d3_num" => (isset($data["d3_num"]) ? $data["d3_num"] : ""),
                "d7_num" => (isset($data["d7_num"]) ? $data["d7_num"] : ""),
                "d10_num" => (isset($data["d10_num"]) ? $data["d10_num"] : ""),
            ]);

            $trans->save();
        }

        return redirect()->back()->with("msg", "ტური განახლებულია");
    }


    public function destroy($id)
    {
        $t = Tours::find($id);

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
        $tour = Tours::findOrFail($id);
        if($img == "paralax"){
            if(file_exists(public_path() . $tour->paralax_img))
            {
                unlink(public_path() . $tour->paralax_img);
            }
            $tour->paralax_img = null;
            $tour->save();
            return response()->json($request->all());
        }elseif($img == "list"){
            if(file_exists(public_path() . $tour->list_img))
            {
                unlink(public_path() . $tour->list_img);
            }
            $tour->list_img = null;
            $tour->save();
            return response()->json($request->all());
        }else{
            //return Response::json(array('fail' => true));
        }
    }

    public function removeGalleryPic($id, $pics)
    {
        $pics = json_decode($pics, true);
        $tour_whole_gallery = Tour_gallery::where("tour_id", $id)->get();
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
                        Tour_gallery::where("id", $pic_id)->delete();
                    }
                }
            }
        }
        return Input::all();
    }

    public function removeVideo($id, $links)
    {
        Tours::findOrFail($id);
        $links = json_decode($links, true);
        if(count($links) > 0)
        {
            foreach($links as $link)
            {
                Tour_videos::where("id", $link)->delete();
            }
        }
        return Input::all();
    }


    //add pictures/vidoes to gallery

    public function addToGallery($id, $gallery, $data_type)
    {
        Tours::findOrFail($id);
        $gallery = json_decode($gallery, true);
        if($gallery && count($gallery) > 0)
        {
            if($data_type == "add-video")
            {
                foreach($gallery as $item)
                {
                   $video = Tour_videos::find($item);
                   $video->put_in_gallery = 1;
                   $video->save();
                }

            }
            elseif($data_type == "add-picture")
            {
                foreach($gallery as $item)
                {
                    $pic = Tour_gallery::find($item);
                    $pic->put_in_gallery = 1;
                    $pic->save();
                }
            }

        }
        return Input::all();
    }


    public function showAllToursFilter()
    {
        $boss_mode = true;

        $lang = Langs::where("lang", App::getLocale())->get();

        $tours = Tours::orderBy("id", "desc")->paginate(10);

        return view("tours/list", compact("tours", "boss_mode", "lang"));
    }

    public function showFilter(Request $request)
    {
        $tour = Tours::findOrFail($request->id);
        $lang = Langs::where("lang", App::getLocale())->get();
        $reviews = Tour_reviews::orderBy("id", "desc")->get();

        $tour_reviews = Tour_reviews::where("tour_id", $tour->id)->orderBy("id", "desc")->get();

        $boss_mode = true;

        return view("tours/show", compact("tour", "lang", "tour_reviews", "boss_mode"));
    }


    public function removeCommment($id)
    {
        $review = App\Tour_reviews::findOrFail($id);
        $review->delete();
    }
}
