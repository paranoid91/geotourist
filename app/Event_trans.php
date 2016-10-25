<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_trans extends Model
{
    protected $fillable = [ "event_id", "lang_id", "title", "body", "short_body" ];

    public $timestamps = false;

    protected $table = "event_trans";


    public function event()
    {
        return $this->belongsTo('App\Events', "event_id");
    }

    public function lang()
    {
        return $this->belongsTo('App\Langs', "lang_id");
    }

    public function reviews()
    {
        return $this->hasMany('App\Tour_reviews', "tour_id");
    }
}
