<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class AccessTokenController extends Controller
{
    //注册接口
    public function reg(){
        $arr=DB::table('reg')->insert($_POST);
        if($arr){
            $arr=[
                'res'=>200,
                'mag'=>"注册成功，等待审核"
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr=[
                'res'=>0000,
                'mag'=>"注册失败，请填写正确信息"
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }


    //接口 access_token
    public function access_token(){
        if(empty($_GET['appid']) || empty($_GET['key'])){
            die("暂无数据");
        }
        $appid=$_GET['appid'];
        $key=$_GET['key'];
        $token="token$appid";
        $access_incr=Redis::incr($token);
        Redis::expire($token,10);
        if($access_incr>=10){
            $arr=[
                'res'=>'40001',
                'msg'=>"超过限制"
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE)) ;
        }else{
            $access_token=(md5(str::random(20)));
            $key="zhong_token";
            Redis::set($key,$access_token);
            $arr=[
                'res'=>'200',
                'data'=>$access_token
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE)) ;
        }

    }


    //ip接口
    public function ip(){
        $ip=$_SERVER["REMOTE_ADDR"];
        $arr=[
            'msg'=>" 浏览网页的用户ip",
            'ip'=>$ip
        ];
        return json_encode($arr,JSON_UNESCAPED_UNICODE);
    }

}
