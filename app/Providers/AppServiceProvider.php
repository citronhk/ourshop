<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\Home\DetailController;
use Illuminate\Support\Facades\Redis;
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
        //设置redis缓存
        if(Redis::exists('cates_data_redis')){
            $cates_data = json_decode(Redis::get('cates_data_redis'));
        }else{
            $cates_data = IndexController::getPidCatesData();
            Redis::setex('cates_data_redis',600,json_encode($cates_data));
        }

        if(Redis::exists('guess_goods_datas_redis')){
            $guess_goods_datas = json_decode(Redis::get('guess_goods_datas_redis'));
        }else{
            $guess_goods_datas = IndexController::getGoodsByRecord(10);
            Redis::setex('guess_goods_datas_redis',600,json_encode($guess_goods_datas));
        }
        
        View::share(['cates_data'=>IndexController::getPidCatesData(),
                    'guess_goods_datas' => IndexController::getGoodsByRecord(10),
                    ]);


        View::share(['cates_data'=>$cates_data,
                     'guess_goods_datas' => $guess_goods_datas,
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
