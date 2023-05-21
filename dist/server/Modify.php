<?php
$password_receive = $_REQUEST['password'];
$account_receive = $_REQUEST['account'];
#进行对应数据库的连接
$dbServername = 'localhost:3306';
$dbUsername = 'root';
$dbPassword = 'yifan0708';
$database = mysqli_connect($dbServername,$dbUsername,$dbPassword);
if (!$database) {
    $response_die = "'Could not connect: ' . mysql_error()";
    echo $response_die;
    echo "<br>";
    die();
}
#进行对应数据库的选择
mysqli_select_db($database,"user_information");
$password_hash = password_hash($password_receive,PASSWORD_DEFAULT);
$updata = 'UPDATE register_information_secure SET Password_hash = \'' . $password_hash . '\'WHERE Account =\'' . $account_receive . '\'';
mysqli_query($database,$updata);
echo mysqli_error($database);
?>
