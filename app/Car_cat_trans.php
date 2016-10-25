<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car_cat_trans extends Model
{
    protected $fillable = ["car_cat_id", "lang_id", "title"];

    protected $table = 'car_cat_trans';

    public $timestamps = false;

    public function car_cat()
    {
        return $this->belongsTo('App\Car_cat', "car_cat_id");
    }

    public function lang()
    {
        return $this->belongsTo('App\Langs', "lang_id");
    }
}