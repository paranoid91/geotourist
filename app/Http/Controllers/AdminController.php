<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Tour_videos;
use App\Tour_gallery;
use App\Event_videos;
use App\Event_gallery;
use App\Main_page;
use Input;
use App\Langs;
use App\Places;
use App\Places_trans;
use DB;
use Mail;

class AdminController extends Controller
{
	//main page
    public function index()
    {
    	return view("admin.index");
    }

    //authorize to admin panel
    public function  login()
    {
        return view("login");
    }

    //page editors

    //main page
    public function mainPage()
    {
        $pictures = Slider::orderBy('id', 'desc')->get();
        return view("admin/pages/main", compact("pictures"));
    }

    //remove slider pics
    public function removeSliderPic($id)
    {
        $pic = Slider::find($id);

        if(isset($pic) && $pic->delete()){
            return response("ტური წაიშალა");
        }else{
            return response("ტური ვერ წაიშალა", 400);
        }
    }


    public function addSliderImage(Request $request)
    {
        if($request->hasFile("slider-pic"))
        {
            $file = $request->file('slider-pic');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
            Slider::create(["path" => $path]);
            return redirect()->back()->with("msg", "სურათები დამატებულია");
        }elseif(!$request->hasFile("slider-pic")){
            return redirect()->back()->with("bad_msg", "აირჩიეთ სურათი");
        }
    }

    //gallery page
    public function galleryPage()
    {
        return view("admin/pages/gallery");
    }

    //tours gallery
    public function showToursGallery()
    {
        $pics = Tour_gallery::where("put_in_gallery", 1)->get();
        $videos = Tour_videos::where("put_in_gallery", 1)->get();
        return view("admin/pages/tours-gallery", compact("pics", "videos"));
    }

    //remove from tours gallery
    public function removeFromToursGallery($gallery, $data_type)
    {
        $gallery = json_decode($gallery, true);
        if(count($gallery) > 0)
        {
            if($data_type == "video")
            {
                foreach($gallery as $item)
                {
                    $video = Tour_videos::find($item);
                    $video->put_in_gallery = 0;
                    $video->save();
                }
            }
            elseif($data_type == "picture")
            {
                foreach($gallery as $item)
                {
                    $pic = Tour_gallery::find($item);
                    $pic->put_in_gallery = 0;
                    $pic->save();
                }
            }
        }
        return Input::all();
    }

    public function removeFromEventsGallery($gallery, $data_type)
    {
        $gallery = json_decode($gallery, true);
        if(count($gallery) > 0)
        {
            if($data_type == "video")
            {
                foreach($gallery as $item)
                {
                    $video = Event_videos::find($item);
                    $video->put_in_gallery = 0;
                    $video->save();
                }
            }
            elseif($data_type == "picture")
            {
                foreach($gallery as $item)
                {
                    $pic = Event_gallery::find($item);
                    $pic->put_in_gallery = 0;
                    $pic->save();
                }
            }
        }
        return Input::all();
    }

    public function showEventsGallery()
    {
        $pics = Event_gallery::where("put_in_gallery", 1)->get();
        $videos = Event_videos::where("put_in_gallery", 1)->get();
        return view("admin/pages/events-gallery", compact("pics", "videos"));
    }

    public function mainTexts()
    {
        $texts = Main_page::all();
        return view("admin/pages/texts", compact("texts"));
    }

    public function updateTexts(Request $request)
    {
        $texts = Main_page::findOrFail(1);
        $texts->en_headline = $request->en_headline;
        $texts->ge_headline = $request->ge_headline;
        $texts->ru_headline = $request->ru_headline;
        $texts->en_main_text = $request->en_main_text;
        $texts->ge_main_text = $request->ge_main_text;
        $texts->ru_main_text = $request->ru_main_text;
        $texts->save();
        return redirect()->back()->with("ტექსტები განახლებულია");
    }

   public function placesIndex()
   {
       $places = Places::orderBy("id", "desc")->get();
       return view("admin/places/main", compact("places"));
   }

    public function placesAdd()
    {
        return view("admin/places/add");
    }

    public function placesStore(Request $request)
    {

        $data = $request->input();

        if($request->hasFile("img"))
        {
            $file = $request->file('img');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
        }
        $place = Places::create(["img" => (isset($path) ? $path : "")]);

        foreach(["ge","en","ru"] as $lang)
        {
            Places_trans::create([
                "place_id" => $place->id,
                "lang_id" => Langs::where('lang', $lang)->first()->id,
                "title" => $data[$lang . "_title"],
                "body" => $data[$lang . "_body"],
            ]);
        }
        return redirect()->back()->with("msg", "ადგილი დამატებულია");
    }

    public function placesDestroy($id)
    {
        $t = Places::findOrFail($id);

        if(isset($t)){
            if($t->img != '' && $t->img != '0')
            {
                if(file_exists(public_path() . $t->img) && is_file(public_path() . $t->img)){
                    unlink( public_path() . $t->img );
                }
            }

            $t->delete();
            return response("ადგილი წაიშალა");
        }

        else{
            return response("ადგილი ვერ წაიშალა", 400);
        }
    }

    public function placesEdit($id)
    {
        $place = Places::findOrFail($id);
        return view("admin/places/edit", compact("place"));
    }

    public function placesRemoveImg($id, Request $request)
    {
        $place = Places::findOrFail($id);

        if(isset($place->img))
        {
            if(file_exists(public_path() . $place->img) && is_file(public_path() . $place->img))
            {
                unlink(public_path() . $place->img);
                $place->fill(["img" => ""]);
                $place->save();
            }
        }
        return response()->json(["data" => $request->input()]);
    }

    public function placesUpdate($id, Request $request)
    {
        $place = Places::findOrFail($id);
        $data = $request->input();

        if($request->hasFile("img"))
        {
            $file = $request->file('img');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
        }


        if(isset($path))
        {
            $place->fill(["img" => $path]);
            $place->save();
        }

        foreach(["ge","en","ru"] as $lang)
        {
            $lang_id = Langs::where('lang', $lang)->first()->id;

            $trans = Places_trans::where('place_id', $place->id)
                ->where('lang_id', $lang_id)->first();

            $trans->fill([
                "place_id" => $place->id,
                "lang_id" => $lang_id,
                "title" => $data[$lang . "_title"],
                "body" => $data[$lang . "_body"]
            ]);

            $trans->save();
        }

        return redirect()->back()->with("msg", "მონაცემები განახლებულია");
    }

    public function aboutPage()
    {
        $texts = DB::table("about_us")->select("ge_body", "en_body", "ru_body")->get();
        return view("admin/pages/about", compact("texts"));
    }

    public function updateAboutText(Request $request)
    {
        DB::table("about_us")->where('id', 1)->update([
            "ge_body" => (isset($request->ge_body) ? $request->ge_body : ""),
            "en_body" => (isset($request->en_body) ? $request->en_body : ""),
            "ru_body" => (isset($request->ru_body) ? $request->ru_body : "")
        ]);

        return redirect()->back()->with("msg", "მონაცემები განახლებულია");
    }

    public function showMails()
    {
        $mails = DB::table("emails")->select("id", "email")->orderBy('id', 'desc')->get();
        return view("admin/pages/mails", compact("mails"));
    }

    public function removeMail($id)
    {
        DB::table('emails')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function sendMail()
    {
        return view("admin/pages/mails_send");
    }

    public function sendMessage(Request $request)
    {
        $data["subject"] = $request->subject;
        $data["mail_text"] = $request->mail_text;

        $mails = DB::table("emails")->select("email")->get();

        if(!is_null($mails) && count($mails) > 0)
        {
            foreach($mails as $email)
            {
                $data["email"] = $email->email;
                Mail::send('emails/send_all', ["data" => $data], function ($mail) use ($data){
                    $mail->to($data["email"])->from("infogeotourist@gmail.com")->subject($data["subject"]);

                 });
            }

            return redirect()->back()->with("msg", "მეილი წარმატებით გაიგზავნა");
        }

    }
}
