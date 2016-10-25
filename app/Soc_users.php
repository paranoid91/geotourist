<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soc_users extends Model
{
    protected $table = 'soc_users';

    public $timestamps = false;

    protected $fillable = ["user_id", "name", "password", "email", "avatar"];

    public function tourReviews()
    {
        return $this->hasMany('App\Tour_reviews', "user_id");
    }

    public function eventReviews()
    {
        return $this->hasMany('App\Event_reviews', "user_id");
    }

}
