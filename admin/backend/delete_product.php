<?php
	include('../../configs/dbConfig.php');
    $id="'".$_POST['id']."'";
$sql="delete from sanpham where maSanPham=trim(".$id.");";
$result=mysqli_query($connect,$sql);
if(isset($result))
{
   echo "1";

}
else{
    echo "0";
}

;?>