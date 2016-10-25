<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cars;
use App\Car_cat;
use App\Car_cat_trans;
use DB;

class CarsController extends Controller
{

    public function index()
    {
      $categories = Car_cat_trans::orderBy("id", "desc")->get();
      $cats = [];
      $img = DB::table("car_bg")->select("path")->get();
      foreach($categories as $cat)
      {
          if($cat->lang->lang == App::getLocale())
          {
              $cats[] = $cat;
          }
      }
      return view("cars/index", compact("cats", "img"));
    }


    public function show($id)
    {
        //$categories = Car_cat_trans::orderBy("id", "desc")->get();
        $categories = Car_cat::orderBy(DB::raw('RAND()'))->take(4)->get();
        $cats = [];

        foreach($categories as $cat)
        {
            foreach($cat->car_cat_trans as $tr)
            {
                if($tr->lang->lang == App::getLocale())
                {
                    $cats[] = $tr;
                }
            }
        }

        $car = Cars::findOrFail($id);
        return view("cars/show", compact("car", "cats"));
    }

    public function showList($id)
    {
        $current_id = $id;
        $trans = Car_cat::all();
        return view("cars/list", compact("trans", "current_id"));
    }

}
