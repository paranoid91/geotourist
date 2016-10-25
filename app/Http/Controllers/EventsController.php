<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events;
use App\Event_cat;
use App\Event_slider;
use App\Event_main_text;
use App\Event_reviews;

class EventsController extends Controller
{
    public function index()
    {
        $upcoming = Events::where("upcoming", 1)->orderBy("id", "desc")->get();
        $cat = Event_cat::all();
        $events = Events::orderBy("id", "desc")->get();
        $pics = Event_slider::orderBy("id", "desc")->get()->toArray();
        $texts = Event_main_text::all();
        return view("events/index", compact("events", "upcoming", "cat", "pics", "texts"));
    }

    public function show($id)
    {
        $event = Events::findOrFail($id);
        $event_reviews = Event_reviews::where("event_id", $event->id)->orderBy("id", "desc")->get();

        return view("events/show", compact("event", "event_reviews"));
    }

    public function showCatgories($id)
    {
        $category = Event_cat::findOrFail($id);
        $cat = [];
        $title = "";
        foreach($category->event_cat_trans as $tr)
        {
            if($tr->lang->lang == App::getLocale())
            {
                $title = $tr->title;
            }
        }
        //event_trans
        foreach($category->event as $event)
        {
            foreach($event->event_trans as $trans)
            {
                if($trans->lang->lang == App::getLocale())
                {
                    $cat[] = $trans;
                }
            }
        }
        $cat = array_reverse($cat);
        return view("events/list", compact("cat", "title"));
    }

}
