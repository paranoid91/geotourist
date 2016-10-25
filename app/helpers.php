<?php

use Illuminate\Contracts\Routing\UrlGenerator;
use App\Tours;
use App\Events;
use App\Tour_reviews;
use App\Event_reviews;

if (! function_exists('lurl')) {

    function lurl($path = null, $parameters = [], $secure = null)
    {
        if ($path[0] !== '/') {
            $path = '/' . $path;
        }

        $path = config('app.locale') . $path;

        $result = app(UrlGenerator::class)->to($path, $parameters, $secure);

        return $result;
    }
}


if (! function_exists('lang_url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string  $path
     * @param  mixed   $parameters
     * @param  bool    $secure
     * @return string
     */
    function lang_url($lang = null)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = substr($uri,3);
        if(isset($lang)){
            return "/" . $lang . $uri;
        }else{
            return "/en" . $uri;
        }

    }
}

if(!function_exists("getMenuTrans"))
{
    function getMenuTrans()
    {
        $categories = App\Event_cat_trans::all();
        $cat = array();
        foreach($categories as $c)
        {
            if($c->lang->lang == App::getLocale())
            {
                $cat[] = $c;
            }
        }
        return $cat;
    }
}

if(!function_exists("removeWS"))
{
    function removeWS($string)
    {
        $string = str_replace(' ', '', $string);
        $string = preg_replace('/\s+/', '', $string);
        return $string;
    }
}

if(!function_exists("printTours"))
{
    function printTours()
    {
        $tr = Tour_trans::where("tour_type", 0)->orderBy("id", "desc")->get();
        $tours = [];

        if(count($tr) > 0)
        {
            foreach($tr as $t)
            {
                if($t->lang->lang == App::getLocale())
                {
                    $tours[] = $t;
                }
            }
        }

        return $tours;
    }
}


if(!function_exists("getTourStarts"))
{
    function getTourStarts($id)
    {
       $reviews = Tour_reviews::where("tour_id", $id)->get();

       if(count($reviews) > 0)
       {
           $mark = 0;
           $inc = 0;

           foreach($reviews as $rew)
           {
               if((int)$rew->rate != 0)
               {
                   $mark += (int)$rew->rate;
                   $inc++;
               }
           }

           $mark = (int)round($mark/$inc, 0, PHP_ROUND_HALF_UP);

           return $mark;
       }
    }
}

if(!function_exists("getEventStarts"))
{
    function getEventStarts($id)
    {
        $reviews = Event_reviews::where("event_id", $id)->get();

        if(count($reviews) > 0)
        {
            $mark = 0;
            $inc = 0;

            foreach($reviews as $rew)
            {
                if((int)$rew->rate != 0)
                {
                    $mark += (int)$rew->rate;
                    $inc++;
                }
            }
            /*foreach($reviews as $rew)
            {
                $mark += (int)$rew->rate;
                $inc++;
            }*/

            $mark = (int)round($mark/$inc, 0, PHP_ROUND_HALF_UP);

            return $mark;
        }
    }
}

if(!function_exists("getToursList"))
{
    function getToursList($type)
    {
        return Tours::where("tour_type", $type)->orderBy("id", "desc")->get();
    }
}
