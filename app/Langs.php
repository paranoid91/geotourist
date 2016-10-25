<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Langs extends Model
{
    protected $fillable = ["lang"];

    protected $table = 'langs';

    public $timestamps = false;
}
