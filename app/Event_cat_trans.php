<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_cat_trans extends Model
{
    protected $fillable = ["event_cat_id", "lang_id", "title"];

    protected $table = 'event_cat_trans';

    public $timestamps = false;

    public function event_cat()
    {
        return $this->belongsTo('App\Event_cat', "event_cat_id");
    }

    public function lang()
    {
        return $this->belongsTo('App\Langs', "lang_id");
    }
}
