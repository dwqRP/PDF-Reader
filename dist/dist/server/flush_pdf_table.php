<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
#获取对应的表单数据
$account_receive = $_REQUEST['account'];
#进行数据库服务器的连接
$dbServername = 'localhost:3306';
$dbUsername = 'root';
$dbPassword = 'yifan0708';
$database = mysqli_connect($dbServername,$dbUsername,$dbPassword);
if (!$database) {
    $response_die = "'Could not connect: ' . mysql_error()";
    echo $response_die;
    die();
}
#进行对应数据库的选择
mysqli_select_db($database,"user_information");
#进行对应账户的查询
$query = 'SELECT * FROM pdf_user_information WHERE Account=\'' . $account_receive . '\'';
$result = mysqli_query($database,$query);
echo '<?xml version="1.0" encoding="ISO-8859-1"?>
<result>';
while ($row = mysqli_fetch_array($result)){
    echo "<name>" . $row['name'] ."</name>";
    echo "<tag>" . $row['tag'] ."</tag>";
    echo "<data>" . $row['data'] ."</data>";
    echo "<path>" . $row['path'] ."</path>";
}
echo "</result>";
?>