<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_videos extends Model
{
    protected $fillable = ["event_id", "src", "put_in_gallery"];

    protected $table = 'event_videos';

    public $timestamps = false;

    public function event()
    {
        return $this->belongsTo('App\Events', "event_id");
    }
}
