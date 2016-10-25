<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_cat extends Model
{
    protected $fillable = ["category", "img"];

    protected $table = 'event_cat';

    public $timestamps = false;


    public function event()
    {
        return $this->hasMany('App\Events', "cat_id");
    }

    public function event_cat_trans()
    {
        return $this->hasMany('App\Event_cat_trans', "event_cat_id");
    }
}
