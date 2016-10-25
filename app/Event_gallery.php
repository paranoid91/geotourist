<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_gallery extends Model
{
    protected $fillable = ["event_id", "path", "put_in_gallery"];

    protected $table = 'event_gallery';

    public $timestamps = false;

    public function event()
    {
        return $this->belongsTo('App\Events', "event_id");
    }
}
