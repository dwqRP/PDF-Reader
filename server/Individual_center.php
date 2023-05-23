<<<<<<< HEAD
<?php
#获取对应的表单数据
$account_receive = $_REQUEST['account'];
$name_receive = $_REQUEST['name'];
$path_receive = $_REQUEST['path'];
$tag_receive = $_REQUEST['tag'];
$data_receive = $_REQUEST['data'];
$lang_receive = $_REQUEST['lang'];
#进行数据库服务器的连接
$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = 'yifan0708';
$database = mysqli_connect($dbServername,$dbUsername,$dbPassword);
if (!$database) {
    $response_die = "'Could not connect: ' . mysql_error()";
    echo $response_die;
    die();
}
mysqli_query($database,"set names utf8");
#进行用户信息表的建立
mysqli_select_db( $database,"user_information");
$sql_table = "CREATE TABLE pdf_user_information
(
account varchar(100) NOT NULL ,
path varchar(255) NOT NULL ,
name varchar(255),
tag varchar(100),
data varchar(100),
lang varchar(100),
PRIMARY KEY (account,path,name)
)
";
mysqli_query($database,$sql_table);
#进行用户数据的输入
if(mysqli_query($database,"INSERT INTO pdf_user_information (account,path,name,tag,data,lang)
VALUES ('$account_receive','$path_receive','$name_receive','$tag_receive','$data_receive','$lang_receive')")){
    $response = "上传成功!" ;
}
else {
    $response = mysqli_error($database);
}
echo $response ;
mysqli_close($database);
?>
=======
<?php
#获取对应的表单数据
$account_receive = $_REQUEST['account'];
$name_receive = $_REQUEST['name'];
$path_receive = $_REQUEST['path'];
$tag_receive = $_REQUEST['tag'];
$data_receive = $_REQUEST['data'];
$lang_receive = $_REQUEST['lang'];
#进行数据库服务器的连接
$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = 'yifan0708';
$database = mysqli_connect($dbServername,$dbUsername,$dbPassword);
if (!$database) {
    $response_die = "'Could not connect: ' . mysql_error()";
    echo $response_die;
    die();
}
#进行用户信息表的建立
mysqli_select_db( $database,"user_information");
$sql_table = "CREATE TABLE pdf_user_information
(
account varchar(100) NOT NULL ,
path varchar(255) NOT NULL ,
name varchar(255),
tag varchar(100),
data varchar(100),
lang varchar(100),
PRIMARY KEY (account,path,name)
)
";
mysqli_query($database,$sql_table);
#进行用户数据的输入
if(mysqli_query($database,"INSERT INTO pdf_user_information (account,path,name,tag,data,lang)
VALUES ('$account_receive','$path_receive','$name_receive','$tag_receive','$data_receive','$lang_receive')")){
    $response = "上传成功!" ;
}
else {
    $response = mysqli_error($database);
}
echo $response ;
mysqli_close($database);
?>
>>>>>>> f6e0bd2179548d6ed5a2d729272190564a3bf8f9
