<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<table>
    <h4>登录</h4>
     <form action="/token/appiddo" method="post" >
         @csrf
    <tr>
        <td>appi：</td>
        <td><input type="text" name="appid"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="登录"></td>
    </tr>
</table>
</form>
</body>
</html>

