<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car_cat extends Model
{
    protected $fillable = ["title", "img"];

    protected $table = 'car_cat';

    public $timestamps = false;

    public function car_cat_trans()
    {
        return $this->hasMany('App\Car_cat_trans', "car_cat_id");
    }

    public function cars()
    {
        return $this->hasMany('App\Cars', "car_cat_id");
    }
}
