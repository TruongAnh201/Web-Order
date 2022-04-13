<?php
$host="localhost";
$username="root";
$password="";
$dtBase="webapporder";
$connect=mysqli_connect($host,$username,$password,$dtBase);
mysqli_set_charset($connect,"utf8");
if(!$connect)
{
    die("Kết lỗi bị lỗi :" .mysqli_connect_errno());
}

?>
