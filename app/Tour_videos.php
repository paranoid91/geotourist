<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_videos extends Model
{
    protected $fillable = ["tour_id", "src", "put_in_gallery"];

    protected $table = 'tour_videos';

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo('App\Tours', "tour_id");
    }
}

