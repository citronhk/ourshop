<?php

namespace App\Http\Middleware;

use Closure;

class NodesMiddleware
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
        // 获取session  可以操作的 控制器 和 方法
        $nodes = session('admin_user_nodes');
        // dump($nodes);
        // 获取 所有可以操作的控制器
        $controller_all = array_keys($nodes);


        // dump($controller_all);



        // 获取当正在 操作的控制器 和 方法名
        $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
        $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
        $func=explode('@', $actions[count($actions)-1]);
        $controllerName=strtolower($func[0]);
        $actionName=strtolower($func[1]);    

        // dump($controllerName);
        // dump($actionName);

        if(!in_array($controllerName,$controller_all)){
            // echo "没有权限 -- 控制器";
            // exit;
            return redirect('admin/rbac');
            exit;
        }


        // 所有可以操作的 方法名
        $action_all = $nodes[$controllerName];

        if(!in_array($actionName,$action_all)){
            return redirect('admin/rbac');
            exit;
            // echo "没有权限 -- 方法名";
            // exit;
        }


        return $next($request);
    }
}
