<?php
#获取用户的输入
$account_receive = $_REQUEST['account'];
$answer_receive = $_REQUEST['answer'];
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
mysqli_select_db( $database,"user_information");
#进行对应账户的查询
$query = 'SELECT answer_hash FROM register_information_secure WHERE Account=\'' . $account_receive . '\'';
$password_correct = mysqli_query($database,$query);
echo 'verify result:';
while ($row = mysqli_fetch_array($password_correct)){
    $answer_hash = $row['answer_hash'];
    if(password_verify($answer_receive,$answer_hash)){
        echo "Successfully verify!";
    }
    else echo "Fail to verify,your answer is wrong!";
}
?>