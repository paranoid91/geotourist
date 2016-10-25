<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = ["tour_id", "event_id", "created_at" , "updated_at"];

    protected $table = 'ads';

    public function tour()
    {
        return $this->belongsTo('App\Tours', "tour_id");
    }

    public function event()
    {
        return $this->belongsTo('App\Events', "event_id");
    }
}
