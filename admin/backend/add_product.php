<?php
	include('../../configs/dbConfig.php');
    if( isset($_POST['ID']) && isset ($_POST['name'])&& isset($_POST['price'])&& isset($_POST['unit'])&& isset($_POST['cate']))
{
    $ID=$_POST['ID'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $unit=$_POST['unit'];
    $cate=$_POST['cate'];
    $img=$_POST['img'];
    $sql_check="select * from sanpham where maSanPham='$ID' or tenSanPham='$name';";
    $sql_insert="INSERT INTO `webapporder`.`sanpham` (`maSanPham`, `tenSanPham`, `gia`, `donViTinh`, `hinhAnh`, `maLoai`) VALUES ('$ID', '$name', '$price', '$unit', '$img','$cate');";
    $result_check=mysqli_query($connect,$sql_check);
    if(mysqli_num_rows($result_check)>0){
        echo "0";
    }
    else{
        $result_insert=mysqli_query($connect,$sql_insert);
        if(isset($result_insert))
        {
            echo "1";
        }
    }
}
?>