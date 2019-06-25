<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\Home\CarController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        
        View::share(['cates_data'=>IndexController::getPidCatesData(),
                    'guess_goods_datas' => IndexController::getGoodsByRecord(10),
                    ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
