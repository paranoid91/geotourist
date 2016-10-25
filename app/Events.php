<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = ["cat_id", "paralax_img", "list_img", "google_map", "price", "upcoming", "updated_at", "created_at", "sticker"];

    protected $table = 'events';

    public function cat()
    {
        return $this->belongsTo('App\Event_cat', "cat_id");
    }

    public function event_trans()
    {
        return $this->hasMany('App\Event_trans', "event_id");
    }

    public function event_gallery()
    {
        return $this->hasMany('App\Event_gallery', "event_id");
    }

    public function event_videos()
    {
        return $this->hasMany('App\Event_videos', "event_id");
    }

    public function reviews()
    {
        return $this->hasMany('App\Event_reviews', "event_id");
    }

    public function ads()
    {
        return $this->hasMany('App\Ads', "event_id");
    }
}
