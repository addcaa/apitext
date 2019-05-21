<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class Token
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
        $key="zhong_token";
        $token=Redis::get($key);
        $su=Redis::incr($token);
//        echo $su;echo "<br>";
        Redis::expire($token,10);
        if(20<=$su){
            $arr=[
                'res'=>'5000',
                'msg'=>"每分钟20次,10秒后过期"
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE)) ;
        }
        $k_token=$_GET['token'];
        if($token != $k_token){
            $arr=[
                'res'=>'3000',
                'msg'=>"token过期"
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE)) ;
        }
        return $next($request);
    }
}
