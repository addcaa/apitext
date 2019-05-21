<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<table>
     <form action="/token/statedo" method="post" >
         @csrf
    <tr>
        <td>请输入公司名：</td>
        <td><input type="text" name="r_name"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="查看"></td>
    </tr>
</table>
</form>
</body>
</html>

