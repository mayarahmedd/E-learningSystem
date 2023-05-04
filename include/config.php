<?php
$sname= 'localhost';
$uname= 'root';
$password = '';
$db_name = `e-learning system`;
$conn = mysqli_connect('localhost', 'root', '', 'e-learning system');
if (!$conn) {

    echo "Connection failed!";

}
?>