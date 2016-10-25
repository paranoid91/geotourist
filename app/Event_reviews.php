<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_reviews extends Model
{
    protected $fillable = ["event_id", "user_id", "rate", "comment", "time_added"];

    protected $table = 'event_reviews';

    public $timestamps = false;

    public function event()
    {
        return $this->belongsTo('App\Events', "event_id");
    }

    public function users()
    {
        return $this->belongsTo('App\Soc_users', "user_id");
    }

}
