<?php
	include('../../configs/dbConfig.php');
  if(isset($_POST['MaNV']) && isset($_POST['TenNV']) && isset($_POST['GioiTinh']) && isset($_POST['SDT']) && isset($_POST['Email']) && isset($_POST['DiaChi']) && isset($_POST['MaTK']))
{
    $MaNV = $_POST['MaNV'];
    $TenNV = $_POST['TenNV'];
    $GioiTinh = $_POST['GioiTinh'];
    $SDT = $_POST['SDT'];
    $Email = $_POST['Email'];
    $DiaChi = $_POST['DiaChi'];
    $MaTK = $_POST['MaTK'];
    // $arr=array($MaNV,$TenNV,$GioiTinh,$SDT,$Email,$DiaChi);
    // print_r($arr);
      $sql=" UPDATE webapporder.`nhanvien` SET TenNV = '$TenNV', GioiTinh = '$GioiTinh', SDT = '$SDT', Email = '$Email', DiaChi = '$DiaChi', MaTK = '$MaTK' WHERE (MaNV = '$MaNV');";
    //  $sql2=" UPDATE webapporder.nhanvien SET TenNV = '1a', GioiTinh = '1a', SDT = '1a', Email = '1a', DiaChi = '1a' WHERE (MaNV = '$MaNV'); ";
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