<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable = ["car_cat_id", "img", "price"];

    protected $table = 'cars';

    public $timestamps = false;

    public function car_cat()
    {
        return $this->belongsTo('App\Car_cat', "car_cat_id");
    }

    public function car_trans()
    {
        return $this->hasMany('App\Cars_trans', "car_id");
    }

    public function car_gallery()
    {
        return $this->hasMany('App\Cars_gallery', "car_id");
    }

}
