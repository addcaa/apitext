<style>
    no-padding {
        padding: 0 !important;
    }
    .box-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        padding: 10px;
        background-color:#fff;
    }
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    div {
        display: block;
    }
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
        font-weight: 400;
        overflow-x: hidden;
        overflow-y: auto;
    }
    body {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff;
    }
    html {
        font-size: 10px;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }
    html {
        font-family: sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    .box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
        content: " ";
        display: table;
    }
    :after, :before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .box-header:after, .box-body:after, .box-footer:after {
        clear: both;
    }
    .box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
        content: " ";
        display: table;
    }
    :after, :before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>群发</title>
</head>
<body>
<div class="box-body table-responsive no-padding content">
    <table class="table table-hover">
        <thead>
        <tr>
            <th><input type="checkbox"></th>
            <th>ID</th>
            <th>公司名称</th>
            <th>合法人</th>
            <th>税务号</th>
            <th>对公账号</th>
            <th>审核状态</th>
            <th>营业执照</th>
        </tr>
        </thead>
        <tbody>
        @foreach($arr as $v)
            <tr class="openid" >
                <td><input type="checkbox" class="box" r_id="{{$v->r_id}}" ></td>
                <td>{{$v->r_id}}</td>
                <td>{{$v->r_name}}</td>
                <td>{{$v->r_legal}}</td>
                <td>{{$v->r_tax}}</td>
                <td>{{$v->r_account}}</td>
                <td>
                    @if($v->state==1)
                        未审核
                    @else
                        审核通过
                    @endif
                </td>
                <td><img src="{{$v->r_img}}" alt="暂无图片"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <input type="button" id="sub"  class="btn btn-primary"value="审核通过">
</div>
</body>
</html>
<script>
    $(function(){
        $("#sub").click(function(){
            var box=$(this).parents('div').find("input[class='box']");
            var r_id="";
            box.each(function(index){
                if($(this).prop("checked")==true){
                    r_id+=$(this).attr("r_id")+',';
                }
            })
            r_id=r_id.substr(0,r_id.length-1);
            $.post(
                'addo',
                {r_id:r_id},
                function(res){
                    if(res.res==1){
                        alert('审核通过');
                    }else{
                        alert(res.fon);
                    }
                }
            )
        })
    })
</script>