<?php
	include('../../configs/dbConfig.php');
    if(isset($_POST['MaKH']) && isset($_POST['TenKH'])  && isset($_POST['SDT'])  && isset($_POST['DiaChi']))
{
    $MaKH = $_POST['MaKH'];
    $TenKH = $_POST['TenKH'];
    $SDT = $_POST['SDT'];
    $DiaChi = $_POST['DiaChi'];
    $arr=array($MaKH,$TenKH,$SDT,$DiaChi);
    // print_r($arr);
      $sql=" update webapporder.khachhang SET TenKH = '$TenKH', SDT = '$SDT',  DiaChi = '$DiaChi' WHERE (MaKH = '$MaKH'); ";
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