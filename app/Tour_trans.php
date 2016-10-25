<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_trans extends Model
{
    protected $fillable = [
        "tour_id",
        "lang_id",
        "title",
        "location",
        "depture_time",
        "return_time",
        "body",
        "short_description",
        "d3",
        "d7",
        "d10",
        "sp_tour_num",
        "d3_num",
        "d7_num",
        "d10_num",
    ];

    public $timestamps = false;

    protected $table = "tour_trans";


    public function tour()
    {
        return $this->belongsTo('App\Tours', "tour_id");
    }

    public function lang()
    {
        return $this->belongsTo('App\Langs', "lang_id");
    }
}
