<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main_page extends Model
{
    protected $table = 'main_page';

    public $timestamps = false;

    protected $fillable = [
        "en_headline", "ge_headline", "ru_headline", "en_main_text", "ge_main_text", "ru_main_text"
    ];
}
