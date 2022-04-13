<?php

include('../../configs/dbConfig.php');
if(isset($_POST['MaTK']) && isset($_POST['TenDN']) && isset($_POST['MatKhau']) && isset($_POST['VaiTro']))
{
    $MaTK = $_POST['MaTK'];
    $TenDN = $_POST['TenDN'];
    $MatKhau = $_POST['MatKhau'];
    $VaiTro = $_POST['VaiTro'];
      $sql=" update webapporder.taikhoan SET TenDangNhap = '$TenDN',  MatKhau = '$MatKhau', VaiTro = '$VaiTro' WHERE (MaTK = '$MaTK');";
      $result_Update = mysqli_query($connect,$sql);
    if(isset($result_Update)){
        echo "1";
    }
    else{
        echo "0";
    }
}
else{
    echo "0";

}
?>
