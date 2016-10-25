<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_reviews extends Model
{
    protected $fillable = ["tour_id", "user_id", "rate", "comment", "time_added"];

    protected $table = 'tour_reviews';

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo('App\Tours', "tour_id");
    }

    public function users()
    {
        return $this->belongsTo('App\Soc_users', "user_id");
    }
}
