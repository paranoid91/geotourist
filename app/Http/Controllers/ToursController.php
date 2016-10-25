<?php

namespace App\Http\Controllers;

use App\Tour_gallery;
use Illuminate\Http\Request;
use App\Tours;
use App\Http\Requests;
use App\Langs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Tour_reviews;

class ToursController extends Controller
{

    //show all usual tours
    public function showTours(Request $request)
    {
        $tour_type = 0;
        $lang = Langs::where("lang", App::getLocale())->get();
        $tours = Tours::where("tour_type", $tour_type)->orderBy('id', 'desc')->paginate(10);
        return view("tours/index", compact("tour_type", "tours", "lang"));
    }

    //show all exclusive tours
    public function showExTours(Request $request)
    {
        $tour_type = 1;
        $lang = Langs::where("lang", App::getLocale())->get();
        $tours = Tours::where("tour_type", $tour_type)->orderBy('id', 'desc')->paginate(10);
        return view("tours/index", compact("tour_type", "tours", "lang"));
    }

    public function show(Request $request, $id)
    {
        $tour = Tours::findOrFail($id);
        $lang = Langs::where("lang", App::getLocale())->get();
        $reviews = Tour_reviews::orderBy("id", "desc")->get();
        $tour_reviews = Tour_reviews::where("tour_id", $tour->id)->orderBy("id", "desc")->get();

        return view("tours/show", compact("tour", "lang", "tour_reviews"));
    }

    public function exTours()
    {
        return view("tours/exTours");
    }

    public function showAllTours()
    {
         $lang = Langs::where("lang", App::getLocale())->get();
        $tours = Tours::orderBy("id", "desc")->paginate(10);
        return view("tours/list", compact("tours", "lang"));
    }

    public function showToursFilter()
    {

    }

}
