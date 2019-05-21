<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="/token/regdo" method="post" enctype="multipart/form-data">
    @csrf
    <h2>如果以注册过请<a href="/token/state">点击查看状态</a></h2>
    <h4>请输入<a href="/token/appid">appid登录</a></h4>
    <table>
        <tr>
            <td>公司名称</td>
            <td><input type="text"name="r_name"></td>
        </tr>
        <tr>
            <td>合法人</td>
            <td><input type="text" name="r_legal"></td>
        </tr>
        <tr>
            <td>税务号</td>
            <td><input type="text" name="r_tax"></td>
        </tr>
        <tr>
            <td>对公账号</td>
            <td><input type="text" name="r_account"></td>
        </tr>
        <tr>
            <td>营业执照</td>
            <td><input type="file" name="r_img"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="注册"></td>
        </tr>
    </table>
</form>
</body>
</html>