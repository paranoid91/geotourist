<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $fillable = ["img"];

    protected $table = 'places';

    public $timestamps = false;

    public function place_trans()
    {
        return $this->hasMany('App\Places_trans', "place_id");
    }
}
