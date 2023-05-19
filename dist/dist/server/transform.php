<?php
$path = $_REQUEST['path'];
unlink('/Library/WebServer/Documents/dist/2304.pdf');
copy($path,'/Library/WebServer/Documents/dist/2304.pdf');
?>