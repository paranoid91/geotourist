<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use Validator;
use DB;
use Mail;

class PagesController extends Controller
{

    public function sendEmailReminder(Request $request, $id)
    {
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->subject('Blog Contact Form: '.$data['name'])
                ->to(config('blog.contact_email'))
                ->replyTo($data['email']);
        });

    }
    
    public function index()
    {
       $slider = \App\Slider::select("path")->get();
       $places = \App\Places_trans::orderBy("id", "desc")->get();
       $usual_tours = \App\Tours::where('tour_type', 0)->orderBy(DB::raw('RAND()'))->take(6)->get();
       $ex_tours = \App\Tours::where('tour_type', 1)->orderBy('id', 'desc')->get();
       $lang = \App\Langs::where("lang", App::getLocale())->get();
       $events = \App\Events::orderBy("id", "desc")->get();
       $texts = \App\Main_page::all();
       $reviews = \App\Tour_reviews::orderBy(DB::raw('RAND()'))->take(12)->get();
       return view("index", compact("slider", "usual_tours", "ex_tours", "lang", "events", "texts", "places", "reviews"));
    }

    public function contact()
    {
        return view("contact");
    }

    public function toursGallery()
    {
        $pics = \App\Tour_gallery::where("put_in_gallery", 1)->get();
        $videos = \App\Tour_videos::where("put_in_gallery", 1)->get();
        return view("gallery", compact("pics", "videos"));
    }

    public function eventsGallery()
    {
        $pics = \App\Event_gallery::where("put_in_gallery", 1)->get();
        $videos = \App\Event_videos::where("put_in_gallery", 1)->get();
        return view("gallery", compact("pics", "videos"));
    }

    public function showWholeGallery()
    {
        $pics = \App\Tour_gallery::where("put_in_gallery", 1)->get();
        $videos = \App\Tour_videos::where("put_in_gallery", 1)->get();
        $pics1 = \App\Event_gallery::where("put_in_gallery", 1)->get();
        $videos1 = \App\Event_videos::where("put_in_gallery", 1)->get();
        return view("gallery-all", compact("pics", "videos", "pics1", "videos1"));
    }

    public function about()
    {
       $texts = DB::table("about_us")->select("ge_body", "en_body", "ru_body")->get();
       return view("about", compact("texts"));
    }

    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'mail_text' => 'required',
        ], [
            "username.required" => trans('errors.req-name'),
            "email.required" => trans('errors.req-mail'),
            "email.email" => trans('errors.mail-mail'),
            "subject.required" => trans('errors.req-sub'),
            "mail_text.required" => trans('errors.req-text'),

        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data["username"] = $request->username;
        $data["email"] = $request->email;
        $data["subject"] = $request->subject;
        $data["mail_text"] = $request->mail_text;

        Mail::send('emails/contact_form', ["data" => $data], function ($mail) use ($data){

            $mail->to("infogeotourist@gmail.com")->from($data["email"])->subject($data["subject"]);

        });

        return redirect()->back()->with("msg", true);
    }

    public function saveMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ],[
            "email.required" => trans('errors.req-mail'),
            "email.email" => trans('errors.mail-mail'),
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        DB::table("emails")->insert([
            "email" => $request->email
        ]);

        return redirect()->back()->with("msg", true);
    }

}
