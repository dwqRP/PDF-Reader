<?php
#获取相应的表单数据
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
mysqli_select_db($database,"user_information" );
#进行对应账户的查询
$query = 'SELECT question FROM register_information_secure WHERE Account=\'' . $account_receive . '\'';
$password_correct = mysqli_query($database,$query);
echo 'question:';
while ($row = mysqli_fetch_array($password_correct)){
    $question_show = $row['question'];
    echo $question_show;
}
?>
