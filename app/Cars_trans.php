<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars_trans extends Model
{
    protected $fillable = ["car_id", "lang_id", "title", "body"];

    protected $table = 'cars_trans';

    public $timestamps = false;

    public function cars()
    {
        return $this->belongsTo('App\Cars', "car_id");
    }

    public function lang()
    {
        return $this->belongsTo('App\Langs', "lang_id");
    }
}
