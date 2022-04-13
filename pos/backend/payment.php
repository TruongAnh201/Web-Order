<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['id_table']))
    {
        $id_table=$_POST['id_table'];
        //lấy mã bản ghi orders
        $sqlCheck = "select * from orders where maBan='$id_table' and trangThaiThanhToan=0;";
	    $resultCheck = mysqli_query($connect, $sqlCheck);
        if (mysqli_num_rows($resultCheck) > 0) //check có bản ghi nào không
	    {
            $row_order = mysqli_fetch_assoc($resultCheck);
            $maOrder = $row_order['maOrder']; // lấy mã order
            // lấy tổng tiền của mã order trong  bảng orderdetail
            $select_price = "select sum(tongTien)as'tongTien' from orderdetail,orders where orderdetail.maOrder='$maOrder' and orderdetail.maOrder=orders.maOrder; ";
            $result_price = mysqli_query($connect, $select_price);
            if(mysqli_num_rows($result_price) > 0)
            {
                $row_price = mysqli_fetch_assoc($result_price);
                $tongTien = $row_price['tongTien'];
                //$tongTien=0;
                // if($row_order['maKH']!=0)
                // {
                //     $tongTien = $row_price['tongTien']-(($row_price['tongTien']*20)/100); // lấy mã order
                // }
                // else{
                //     $tongTien = $row_price['tongTien']; // lấy mã order
                // }
                $ngayThem = date("Y/m/d"); // ngày thêm
                $gioThem =  date("h:i"); // giờ



                // insert bảng hóa đơn
                $sql_insert_hoaDon="INSERT INTO webapporder.hoadon (gioThanhToan, ngayThanhToan, tongTien) VALUES ('$gioThem', '$ngayThem', '$tongTien');";
                $result_insert_hoaDon=mysqli_query($connect,$sql_insert_hoaDon);
                if(isset($result_insert_hoaDon))// insert thành công
                {
                    //  lấy mã hóa đơn mới nhất để update cho bảng order
                    $sql_newest="select maHoaDon from hoaDon where maHoaDon >= all(select maHoaDon from hoaDon);";
                    $result_newest=mysqli_query($connect,$sql_newest);
                    if(mysqli_num_rows($result_newest)>0)
                    {
                        $row_newest=mysqli_fetch_assoc($result_newest);
                        $id_newest=$row_newest['maHoaDon'];
                        // update trạng thái hóa đơn thành đã thanh toán và update lại mã hóa đơn.


                        // Cần update
                        $sql_update_order="UPDATE webapporder.orders SET trangThaiThanhToan = '1', maHoaDon = '$id_newest' WHERE maOrder = '$maOrder';";


                        $result_update_order=mysqli_query($connect,$sql_update_order);
                        // update trạng thái bàn thành không hoạt động
                        $sql_update_table="UPDATE `webapporder`.`ban` SET `trangthai` = '0' WHERE (`maban` = '$id_table');";
                        $result_update_table=mysqli_query($connect,$sql_update_table);
                        if(isset($result_update_order)&& isset($result_update_table)) // chắc chắn nó đã được update
                        {
                            echo '1';
                        }
                        else{
                            echo '0';
                        }
                    }
                    else{
                        echo '0';
                    }
                }
                else{
                    echo '0';
                }
            }
            else{
                echo '0';
            }
        }
        else{
            echo '0';
        }
    }
    else{
        echo '0';
    }
?>