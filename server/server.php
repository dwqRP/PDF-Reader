<?php
#获取表单数据，其为用户的注册信息
$account_receive = $_REQUEST['account'];
$password_receive = $_REQUEST['password'];
$password_again_receive = $_REQUEST['password_again'];
$question_receive = $_REQUEST['question'];
$answer_receive = $_REQUEST['answer'];
#对用户密码进行hash处理，可以相对安全
#$hash_password = password_hash($password_receive,PASSWORD_DEFAULT);
#$hash_answer = password_hash($answer_receive,PASSWORD_DEFAULT);
$hash_password = md5($password_receive);
$hash_answer = md5($answer_receive);
$hash_password_process = str_replace("\$","\\$",$hash_password);
$hash_answer_process = str_replace("\$","\\$",$hash_answer);
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
#进行用户信息数据库的建立
mysqli_query( $database,"CREATE DATABASE user_information");
#进行用户信息表的建立
mysqli_select_db($database,"user_information");
$sql_table = "CREATE TABLE register_information_secure
(
Account varchar(100),
PRIMARY KEY (Account),
Password_hash varchar(100),
question varchar(100),
answer_hash varchar(100)
)
";
mysqli_query($database,$sql_table);
#进行用户数据的输入
if(mysqli_query($database,"INSERT INTO register_information_secure (Account,Password_hash,question,answer_hash)
VALUES ('$account_receive','$hash_password','$question_receive','$hash_answer')")){
    $response = "Register successfully!" ;
}
else {
    $response = "Fail to register : " . mysqli_error($database) ;
}
echo $response ;

mysqli_close($database);
?>

