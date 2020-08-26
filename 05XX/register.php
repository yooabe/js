<?php
header('content-type:text/html;charset="utf-8"');
//统一发送返回格式
$responseData = array('code' => 0, 'message' => '');

$username = $_POST['username'];
$password = $_POST['password'];
$addTime = $_POST['addTime'];

//简单验证
if (!$username) {
    $responseData["code"] = 1;
    $responseData["message"] = "用户名不能为空";
    echo json_encode($responseData);
    exit;
}
if (!$password) {
    $responseData["code"] = 2;
    $responseData["message"] = "密码不能为空";
    echo json_encode($responseData);
    exit;
}

//1.链接数据库
$link = mysql_connect('localhost', 'root', '123456');

//2.判断是否链接成功
if (!$link) {
    $responseData['code'] = 3;
    $responseData['message'] = '数据库链接失败';
    //返回到前台页面
    echo json_encode($responseData);
    exit;
}

//3.设置字符集
mysql_set_charset("utf8");

//4.选择数据库
mysql_select_db("yyy");

//5.准备sql 验证用户名是否重名
$sql1 = "select * from users where username='{$username}'";

//6.发送sql语句
$res = mysql_query($sql1);

//7.取出一行数据
$row = mysql_fetch_assoc($res);
if ($row) {
    $responseData['code'] = 4;
    $responseData['message'] = '用户名已存在';
    echo json_encode($responseData);
    exit;
}
//md5加密
$str = md5(md5(md5($password) . "xxx") . "yyy");
$sql2 = "insert into users(username,password,create_time) values('{$username}','{$str}','{$addTime}')";

$res = mysql_query($sql2);
if (!$res) {
    $responseData['code'] = 5;
    $responseData['message'] = '注册失败';
    echo json_encode($responseData);
} else {
    $responseData['message'] = '注册成功';
    echo json_encode($responseData);
}

//8.关闭数据库
mysql_close($link);

?>
