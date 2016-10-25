<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_main_text extends Model
{
    protected $fillable = ["en_main_text", "ge_main_text", "ru_main_text", "id"];

    protected $table = 'event_main_text';

    public $timestamps = false;
}
