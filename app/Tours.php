<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    /**
     * tour_type
     * 0 - 'usual' tour
     * 1 - exclusive tour
     **/

    protected $fillable = ["tour_type", "price", "paralax_img", "list_img", "sp_tour_num", "updated_at", "created_at", "sticker"];

    protected $table = 'tours';


    public function tour_trans()
    {
        return $this->hasMany('App\Tour_trans', "tour_id");
    }

    public function tour_gallery()
    {
        return $this->hasMany('App\Tour_gallery', "tour_id");
    }

    public function tour_videos()
    {
        return $this->hasMany('App\Tour_videos', "tour_id");
    }

    public function reviews()
    {
        return $this->hasMany('App\Tour_reviews', "tour_id");
    }

    public function ads()
    {
        return $this->hasMany('App\Ads', "tour_id");
    }


    public function get_trans($lang){
        $ret = null;

        foreach($this->tour_trans as $trans){

            if($trans->lang->lang == $lang){
                $ret = $trans;
            }
        }

        return $ret;
    }
}
