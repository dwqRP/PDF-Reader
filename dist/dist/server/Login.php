<?php
#获取相应的表单数据，在对应的数据库中进行查询
$account_receive = $_REQUEST['account'];
$password_receive = $_REQUEST['password'];
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
#进行对应账户的查询
$query = 'SELECT Password_hash FROM register_information_secure WHERE Account=\'' . $account_receive . '\'';
$password_correct = mysqli_query($database,$query);
echo 'Login result:';
while ($row = mysqli_fetch_array($password_correct)){
    $password_hash = $row['Password_hash'];
    if(password_verify($password_receive,$password_hash)){
        $path = '/Library/WebServer/Documents/dist/pdf/' . $account_receive ;
        mkdir($path,0777,true);
        echo "Successfully login!";
    }
    else echo "Fail to login,your password is wrong!";
}
?>
