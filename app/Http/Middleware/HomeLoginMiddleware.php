<?php

namespace App\Http\Middleware;

use Closure;

class HomeLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('home_login')){
            return $next($request);
        }else{
            return redirect('home/login')->with('success','请先登录在进入管理中心');
        }
    }
}
