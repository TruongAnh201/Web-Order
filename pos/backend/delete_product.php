<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['maSanPham']) && isset($_POST['table_id']))
{
    $maSanPham=$_POST['maSanPham'];
    $maBan=$_POST['table_id'];
    //  lấy mã order theo mã bàn
    $sqlCheck = "select * from orders where maBan='$maBan' and trangThaiThanhToan=0;";
	$resultCheck = mysqli_query($connect, $sqlCheck);
    if(mysqli_num_rows($resultCheck)>0){ // đảm bảo là bàn đó chưa thanh toán
        $orders=mysqli_fetch_assoc($resultCheck);
        $maOrder=$orders['maOrder']; // lấy được mã order
        //echo $maSanPham;
        //check xem có bản ghi orderdetail nào k không
        $sql_check_detail="select * from orderdetail where maOrder='$maOrder';";
        $result_check_detail=mysqli_query($connect,$sql_check_detail);
        $soLuong=mysqli_num_rows($result_check_detail);
        if($soLuong==0)
        {
            echo '0';
        }
        else{ // đảm bảo là có bản ghi orderdetail của mã order đó
            if($soLuong==1)
            {
                // xóa detail order cuối cùng
                $sql_del="delete from orderdetail where maSanPham='$maSanPham' and maOrder='$maOrder';";
                $result_del=mysqli_query($connect,$sql_del);
                // xóa nốt cả bản order
                $sql_del_orders="delete from orders where maOrder='$maOrder';";
                $result_del_orders=mysqli_query($connect,$sql_del_orders);
                // đảm bảo đã được thực thi
                if(isset($result_del) && isset($result_del_orders))
                {
                    echo '1';
                }

            }
            $sql_del="delete from orderdetail where maSanPham='$maSanPham' and maOrder='$maOrder';";
            $result_del=mysqli_query($connect,$sql_del);
            if(isset($result_del)) // đảm bảo đã được thực thi
            {
                echo '1';
            }
        }
    }
}
else{
    echo "0";
}

?>