<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Ads;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $ads = Ads::orderBy("updated_at", "desc")->get();
        view()->share('ads', $ads);
    }


    public function register()
    {

    }
}
