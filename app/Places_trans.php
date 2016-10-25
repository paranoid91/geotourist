<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places_trans extends Model
{
    protected $fillable = ["place_id", "lang_id","title", "body"];

    protected $table = 'places_trans';

    public $timestamps = false;

    public function place()
    {
        return $this->belongsTo('App\Places', "place_id");
    }

    public function lang()
    {
        return $this->belongsTo('App\Langs', "lang_id");
    }
}
