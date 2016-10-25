<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_slider extends Model
{
    protected $table = 'event_slider';

    public $timestamps = false;

    protected $fillable = ["path"];
}
