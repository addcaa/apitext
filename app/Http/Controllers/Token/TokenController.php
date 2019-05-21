<?php

namespace App\Http\Controllers\Token;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TokenController extends Controller
{
    public function reg(){
        return view('token/reg');
    }
    public function regdo(Request $request){
        $token=$this->token();
        unset($_POST['_token']);
//        dd($_POST['r_name']);
        $_POST['r_img']=$this->img($request,'r_img');
        $_POST['add_time']=time();
        $url="http://www.week.com/access/reg?token=$token";
        //初始化curl
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,1);
        //把数据传输过去
        curl_setopt($ch,CURLOPT_POSTFIELDS,$_POST);
        //执行会话
        $res=curl_exec($ch);
        //结束一个会话
        curl_close($ch);
        return $res;
    }

    //获取tooken
    public function token(){
        $appid="339639179a769178557";
        $key="4db1c2c309eafe72b252b9dc59f643847724";
        $key="access_token$appid";
        $access_token=Redis::get($key);
        if($access_token){
            return $access_token;
        }else{
            $url="http://www.week.com/access/access_token?appid=$appid&key=$key";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch); //接收返回信息
            $arr=json_decode($result,true);
            curl_close($ch);
            Redis::set($key,$arr['data']);
            Redis::expire($key,3600);
            return  $result;
        }
    }

    //浏览网页的用户ip
    public function ip(){
        $token=$this->token();
//        dd($token);
        $url="http://www.week.com/access/ip?token=$token";
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch); //接收返回信息
        curl_close($ch);
        echo $result;
    }





    //图片
    public function img(Request $request,$file){
        if ($request->hasFile($file) && $request->file($file)->isValid()) {
            $photo = $request->file($file);
            // $extension = $photo->extension();
            //$store_result = $photo->store('photo');
            $store_result = $photo->store('uploads/'.date('Ymd'));
            //返回一个路径
            return $store_result;
        }

    }
    public function state(){
//        dd($_GET['r_name']);
        return view('token/state');
    }
    public function statedo(){
        if(empty($_POST['r_name'])){
            echo "<script>alert('请添加公司名称');location.href='/token/state';</script>";
        }
        $name=$_POST['r_name'];
        $arr=DB::table('reg')->where(['r_name'=>$name])->first();
        if($arr){
            if(!empty($arr->appid)){
                echo "<script>alert('审核通过');location.href='/token/index?r_id=$arr->r_id';</script>";
            }else{
                echo "<script>alert('审核中，请耐心等待');location.href='/token/state';</script>";
            }
        }else{
            echo "<script>alert('没有此公司名，请立刻注册');location.href='/token/reg';</script>";
        }
    }
    //登录
    public function appid(){
        return view('token/appid');
    }
    public function appiddo(){
        if(empty($_POST['appid'])){
            echo "<script>alert('请添加appid');location.href='/token/appid';</script>";
        }
        $name=$_POST['appid'];
        $arr=DB::table('reg')->where(['appid'=>$name])->first();
        if($arr){
            echo "<script>alert('请添加appid');location.href='/token/index?r_id=$arr->r_id';</script>";
        }else{
            echo "<script>alert('没有appid，请立刻注册');location.href='/token/reg';</script>";
        }

    }
    //个人首页
    public function index(){
        if(empty($_GET['r_id'])){
            echo "<script>alert('返回注册页面');location.href='/token/reg';</script>";
        }
        $arr=DB::table('reg')->where(['r_id'=>$_GET['r_id']])->first();
        return view('token/index',['arr'=>$arr]);
    }
}
