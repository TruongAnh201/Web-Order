<?php
session_start();
// echo "<script> confirm('Bạn muốn đăng xuất ?'){alert(".$_SESSION['role'].");</script>";
    session_unset();
    session_destroy();
    echo "1";
   // header('location:login.php');
    
?>