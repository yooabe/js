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

    //设置表头(php与html混编)
    echo "<table border='1'>";
    echo "<tr><th>学生学号</th><th>学生姓名</th><th>英语成绩</th><th>数学成绩</th><th>语文成绩</th></tr>";
    
    //7.处理结果
    while($row=mysql_fetch_assoc($res)){
        // var_dump($row);
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['english']}</td><td>{$row['math']}</td><td>{$row['chinese']}</td></tr>";
    }
    echo "</table>";

    //8.关闭数据库
    mysql_close($link);

?>