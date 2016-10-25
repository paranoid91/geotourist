<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_gallery extends Model
{

    protected $fillable = ["tour_id", "path", "put_in_gallery"];

    protected $table = 'tour_gallery';

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo('App\Tours', "tour_id");
    }

}
