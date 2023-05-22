<?php
#获取对应的表单数据
$account_receive = $_REQUEST['account'];
$path_receive = $_REQUEST['path'];
$name_receive = $_REQUEST['name'];
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
#进行对应数据库的选择
mysqli_select_db($database,"user_information" );
#进行相应文件的删除
unlink($path_receive);
$query = 'DELETE FROM pdf_user_information WHERE Account=\'' . $account_receive . '\'' .'and path=\'' . $path_receive . '\'' .'and name=\'' . $name_receive . '\'' ;
mysqli_query($database,$query);
?>
