<?php
	include('../../configs/dbConfig.php');
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['unit']) && isset($_POST['cate']))
{
    $id=$_POST['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $unit=$_POST['unit'];
    $cate=$_POST['cate'];
    $sql_Update="UPDATE webapporder.sanpham SET tenSanPham = '$name', gia = '$price', donViTinh='$unit',maLoai='$cate'  WHERE (maSanPham = '$id');"; // sql update
    $sql_check="select * from sanpham where tenSanPham='$name'"; // check sản phẩm trùng tên
    $result_check=mysqli_query($connect,$sql_check);
    if(mysqli_num_rows($result_check)>0){
        while($fetch_row = mysqli_fetch_array($result_check))
        {
            if($fetch_row['tenSanPham'] == $name)
            {
                $result_update=mysqli_query($connect,$sql_Update);
                if(isset($result_update))
                {
                    echo "1";
                }
            }
            else{
                echo "0";
            }

        }


    }
    else{
        $result_update=mysqli_query($connect,$sql_Update);
        if(isset($result_update))
        {
            echo "1";
        }
    }
}
else{
    echo "0";

}
?>