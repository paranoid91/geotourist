<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars_gallery extends Model
{
    protected $fillable = ["car_id", "path"];

    protected $table = 'cars_gallery';

    public $timestamps = false;

    public function cars()
    {
        return $this->belongsTo('App\Cars', "car_id");
    }
}
