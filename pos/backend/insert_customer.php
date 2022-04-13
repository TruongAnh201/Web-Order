<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['id']) && isset($_POST['id_table']))
    {
        $customer_id= $_POST['id'];
        $table_id=$_POST['id_table'];
        // lấy mã order của bàn đó
        //echo $table_id;
        $sqlCheck = "select * from orders where maBan='$table_id' and trangThaiThanhToan=0;";
        $resultCheck = mysqli_query($connect, $sqlCheck);
        if (mysqli_num_rows($resultCheck) > 0) // check là có tồn tại
        {
           // echo "1";
            $row_order=mysqli_fetch_assoc($resultCheck);
            $maOrder=$row_order['maOrder']; // lấy ra mã order
             $sql_udpate="UPDATE `webapporder`.`orders` SET `maKH` = '$customer_id' WHERE (`maOrder` = '$maOrder');";
             $result_update=mysqli_query($connect,$sql_udpate);
             if(isset($result_update))
             {
                // echo "1";
                //  khi đã insert mã khách hàng thì cần thay đổi lại giá của các detail order đã thêm trước đó nếu không trong bảng hóa đơn sẽ hiển thị tổng
                // đã giảm 20% mà ở trong detail thì vẫn giá cũ
                $sql_select_detail="select * from orderdetail where maOrder='$maOrder';";
                $result_select_detail=mysqli_query($connect,$sql_select_detail);
                if(mysqli_num_rows($result_select_detail)>0)// nếu lớn hơn 0 tức là có các bản trước đó. và bây giờ cần update lại giá
                {

                    while($rows_detail=mysqli_fetch_array($result_select_detail))
                    {
                        $tongTien=$rows_detail['tongTien']-(($rows_detail['tongTien']*20)/100);
                        $ID=$rows_detail['ID'];
                        $sql_update_detail="UPDATE `webapporder`.`orderdetail` SET `tongTien` = '$tongTien' WHERE (`ID` = '$ID');"; // set lại tổng tiền
                        $result_update_detail=mysqli_query($connect,$sql_update_detail);
                    }
                    echo '1';
                }
                else{
                    echo "1";
                }
             }
             else{
                 echo "0";
             }
        }
        else{
            echo "0";
        }
    }
    else{
        echo "0";
    }
?>