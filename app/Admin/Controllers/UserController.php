<?php

namespace App\Admin\Controllers;

use App\Model\User\RegModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserController extends Controller
{


    protected function list(Content $Content){
       $arr=RegModel::all();
        return $Content ->header('认证')->body(view('admin/user',['arr'=>$arr]));
    }
    public function addo(){
        $id=$_POST['r_id'];
        if(empty($_POST['r_id'])){
            $arr=[
                'fon'=>"请选择一个审核"
            ];
            return $arr ;die;
        }
        $domain = strpos($id,',');
        if($domain  !== false){
            $arr=[
                'fon'=>"请单独选择"
            ];
            return $arr ;die;
        }

        $r_id=$_POST['r_id'];
        $arr=DB::table("reg")->where(['r_id'=>$r_id])->first();
        if(empty($arr->appid) && empty($arr->key)){
            $appid=substr(md5(Str::random(10)),5,15).rand(1111,9999);
            $key=md5(str::random(10)).rand(1111,9999);
            $data=[
                'appid'=>$appid,
                'key'=>$key,
                'state'=>2
            ];
            $r_id=$arr->r_id;
            $res=DB::table('reg')->where(['r_id'=>$r_id])->update($data);
            if($res){
                $arr=[
                    'res'=>1,
                    'fon'=>"审核通过"
                ];
                return $arr ;die;
            }else{
                $arr=[
                    'fon'=>"审核失败"
                ];
                return $arr ;die;
            }
        }else{
            $arr=[
                'fon'=>"已审核过"
            ];
            return $arr ;die;
        }

    }
}
