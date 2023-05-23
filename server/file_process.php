<<<<<<< HEAD
<?php
$account_receive = $_REQUEST['account'];
$output_dir = '/var/www/html/pdf/' . $account_receive . '/';
$fileName = $_FILES["file"]['name'];
$file = $_FILES['file'];
if(move_uploaded_file($file['tmp_name'],$output_dir.$fileName)){
    echo "Success!";
}
else echo "fail";
?>
=======
<?php
$account_receive = $_REQUEST['account'];
$output_dir = '/var/www/html/pdf/' . $account_receive . '/';
$fileName = $_FILES["file"]['name'];
$file = $_FILES['file'];
if(move_uploaded_file($file['tmp_name'],$output_dir.$fileName)){
    echo "Success!";
}
else echo "fail";
?>
>>>>>>> f6e0bd2179548d6ed5a2d729272190564a3bf8f9
