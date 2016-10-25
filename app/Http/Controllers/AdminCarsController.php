<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Langs;
use App\Cars;
use App\Cars_trans;
use App\Car_cat;
use App\Cars_gallery;
use App\Car_cat_trans;
use Illuminate\Support\Facades\App;
use Input;
use DB;

class AdminCarsController extends Controller
{

    public function index()
    {
        $car_img = DB::table('car_bg')->select("id", "path")->get();
        $cat = Car_cat::all();
        $cars = Cars::orderBy("id", "desc")->get();
        return view("admin/cars/index", compact("cat", "cars", "car_img"));
    }


    public function create()
    {
        $cat = Car_cat::all();
        return view("admin/cars/add", compact("cat"));
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $event_cat_id = Car_cat::where("title", $data["title"])->get();
        $cat_id = (int)$event_cat_id[0]->id;

        if($request->hasFile("img"))
        {
            $file = $request->file('img');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
        }

        $event = Cars::create([
            "car_cat_id" => $cat_id,
            "price" => $data["price"],
            "img" => (isset($path) ? $path : ""),
        ]);

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
                $img = Cars_gallery::create([
                    "car_id" => $event->id,
                    "path" => $pic
                ]);
            }
        }

        foreach(["ge","en","ru"] as $lang)
        {
            Cars_trans::create([
                "car_id" => $event->id,
                "lang_id" => Langs::where('lang', $lang)->first()->id,
                "title" => $data["" . $lang . "_title"],
                "body" => $data["" . $lang . "_body"],
            ]);
        }
        return redirect()->back()->with("msg", "მანქანა დამატებულია");
    }

    public function edit($id)
    {
        $car = Cars::findOrFail($id);
        $cat = Car_cat::all();
        return view('admin/cars/edit', compact("car", "cat"));
    }

    public function update($id, Request $request)
    {

        $tour = Cars::find($id);
        $data = $request->input();

        if($request->hasFile("img"))
        {
            $file = $request->file('img');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
        }

        $car_cat = Car_cat::where("title", $request->category)->get();

        $tour->fill([
            "car_cat_id" => $car_cat[0]->id,
            "price" => $data["price"],
        ]);

        if(isset($path))
        {
            $tour->fill(["img" => (isset($path) ? $path : "")]);
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
                $img = Cars_gallery::create([
                    "car_id" => $tour->id,
                    "path" => $pic
                ]);
            }
        }

        foreach(["ge","en","ru"] as $lang)
        {
            $lang_id = Langs::where('lang', $lang)->first()->id;

            $trans = Cars_trans::where('car_id', $tour->id)
                ->where('lang_id', $lang_id)->first();

            $trans->fill([
                "car_id" => $tour->id,
                "lang_id" => $lang_id,
                "title" => $data[$lang . "_title"],
                "body" => $data[$lang . "_body"]
            ]);

            $trans->save();
        }

        return redirect()->back()->with("msg", "მონაცემები განახლებულია");
    }


    public function destroy($id)
    {
        $t = Cars::find($id);

        if(isset($t)){

            //remove list image(file)
            if($t->img != '' && $t->img != '0')
            {
                if(file_exists(public_path() . $t->img)){
                    unlink(public_path() . $t->img);
                }
            }

            //remove all gallery images
            if(count($t->car_gallery) > 0)
            {
                foreach($t->car_gallery as $pic)
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
    public function storeImage(Request $request)
    {
        if($request->file('file')->isValid())
        {
            $file = $request->file('file');

            $aliosha = 'tour_image_' . $file->getClientOriginalName();

            $file->move(public_path() . '/img', $aliosha);
        }
        return json_encode(['uploaded_path' => (public_path() . '/img/' . $aliosha)]);
    }

    //remove car image
    public function removeCarImage($id, Request $request)
    {
        $car = Cars::findOrFail($id);

        if(file_exists(public_path() . $car->img))
        {
            unlink(public_path() . $car->img);
        }

        $car->img = "";
        $car->save();

        return response()->json($request->all());
    }

    public function categories()
    {
        $cat = Car_cat::orderBy("id", "desc")->get();
        return view("admin/cars/categories", compact("cat"));
    }

    public function catAdd(Request $request)
    {
        if($request->hasFile("img"))
        {
            $file = $request->file('img');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
        }

        if(isset($path))
        {
            $cat = Car_cat::create(["title" => $request->en_title, "img" => $path]);

        }else{
            $cat = Car_cat::create(["title" => $request->en_title, "img" => ""]);
        }


        foreach(["ge", "en", "ru"] as $lang)
        {
            Car_cat_trans::create([
                "car_cat_id" => $cat->id,
                "lang_id" => Langs::where('lang', $lang)->first()->id,
                "title" => $request[$lang . "_title"],
            ]);
        }

        return redirect()->back()->with("msg", "კატეგორია დამატებულია");
    }

    public function catShow($id)
    {
        $cat = Car_cat::findOrFail($id);
        return view("admin/cars/cat-update", compact("cat"));
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

    public function catUpdate(Request $request, $id)
    {
        $cat = Car_cat::findOrFail($id);

        foreach(["ge","en","ru"] as $lang)
        {
            $lang_id = Langs::where('lang', $lang)->first()->id;

            $trans = Car_cat_trans::where('car_cat_id', $cat->id)
                ->where('lang_id', $lang_id)->first();

            $trans->fill([
                "car_cat_id" => $cat->id,
                "lang_id" => $lang_id,
                "title" => $request[$lang . "_title"],
            ]);

            $trans->save();
        }


        if($request->hasFile("img"))
        {
            $file = $request->file('img');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
            $cat->update(["img" => $path]);
        }

         if(isset($request->en_title) && !empty($request->en_title))
         {
             $cat->update(["title" => $request->en_title]);
         }

        $cat->save();

        return redirect("/{lang}/admin/cars/categories")->with("msg", "კატეგორია განახლებულია");
    }

    public function catDelete($id)
    {
        $cat = Car_cat::findOrFail($id);

        if(file_exists(public_path() . $cat->img) && (is_file(public_path() . $cat->img)))
        {
            unlink( public_path() . $cat->img );
        }

        $cat->delete();

        return response("კატეგორია წაიშალა");
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

    public function removeCatImg($id)
    {
        $cat = Car_cat::findOrFail($id);

        if(file_exists(public_path() . $cat->img))
        {
            unlink(public_path() . $cat->img);
        }
        $cat->img = "";
        $cat->save();

        return Input::all();
    }

    public function removeGalleryPic($id, $pics)
    {
        $car = Cars::findOrFail($id);
        $pics = json_decode($pics, true);

        $tour_whole_gallery = Cars_gallery::where("car_id", $id)->get();
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
                        Cars_gallery::where("id", $pic_id)->delete();
                    }
                }
            }
        }
        return Input::all();
    }

    public function updateBG(Request $request)
    {
        if($request->hasFile("path"))
        {
            $file = $request->file('path');
            $name = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/',$name);
            $path = '/img/' . $name;
            DB::table("car_bg")->insert(["path" => $path]);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function removeBG()
    {
        $img = DB::table('car_bg')->select("id", "path")->get();

        if(file_exists(public_path() . $img[0]->path) && (is_file(public_path() . $img[0]->path)))
        {
            unlink( public_path() . $img[0]->path );
        }

        DB::table('car_bg')->delete();

        return response("სურათი წაიშალა");
    }
}
