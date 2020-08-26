<?php
    header('content-type:text/html;charset="utf-8"');

    //1.链接数据库
    /* 
        参数1:链接数据库的IP/域名
        参数2:用户名
        参数3:密码
    */
    $link=mysql_connect('localhost','root','123456');

    //2.判断是否链接成功
    if(!$link){
        echo "链接失败";
        exit;
    }

    //3.设置字符集
    mysql_set_charset("utf8");

    //4.选择数据库
    mysql_select_db("yyy");

    //5.准备sql语句
    $sql="select * from students";

    //6.发送sql语句
    $res =mysql_query($sql);

    $arr =array();

    //7.处理结果
    while($row=mysql_fetch_assoc($res)){
        array_push($arr,$row);
    }

    echo json_encode($arr);


    //8.关闭数据库
    mysql_close($link);

?>