<?php
	include('../../configs/dbConfig.php');
    if(isset($_POST['key']) && isset($_POST['maLoai']) ){
        $key=$_POST['key'];
        $maLoai=$_POST['maLoai'];
        if($key!="")
        {
        $sql="select distinct * from sanpham where tenSanPham like '%$key%' or maSanPham like'%$key%' and sanpham.maLoai='$maLoai';";
        $result_pr = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result_pr)>0){
            $stt=1;
            while ($row = mysqli_fetch_array($result_pr)) {
                echo '<tr>
                <td>'.$stt++.'</td>
                <td>'.$row['maSanPham'].'</td>
                <td>'.$row['tenSanPham'].'</td>
                <td>'.number_format($row['gia'],0).' đ</td>
                <td class="align-center-item"><img width="55px"; src="public/images/'.$row['hinhAnh'].'"></td>
                <td>'.$row['donViTinh'].'</td>
                <td style="max-width:60px;"><button  class="btn btn-warning color-button-white" id="edit_product" value="'.$row['maSanPham'].'"> Chỉnh sửa</button></td>
                <td style="max-width:40px;"><button  class="btn btn-danger color-button-white" value="'.$row['maSanPham'].'" onclick="delete_product(\''."  $row[0] ".'\')"> Xóa</button></td>
                </tr>';
            }
        }else{
            echo '<td colspan="7" class="text-center">Không có phẩm nào!</td>';
        }
    }
    else{
        $sql="select  * from sanpham;";
        $result_pr = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result_pr)>0){
            $stt=1;
            while ($row = mysqli_fetch_array($result_pr)) {
                echo '<tr>
                <td>'.$stt++.'</td>
                <td>'.$row['maSanPham'].'</td>
                <td>'.$row['tenSanPham'].'</td>
                <td>'.number_format($row['gia'],0).' đ</td>
                <td class="align-center-item"><img width="55px"; src="public/images/'.$row['hinhAnh'].'"></td>
                <td>'.$row['donViTinh'].'</td>
                <td style="max-width:60px;"><button  class="btn btn-warning color-button-white" id="edit_product" value="'.$row['maSanPham'].'"> Chỉnh sửa</button></td>
                <td style="max-width:40px;"><button  class="btn btn-danger color-button-white" value="'.$row['maSanPham'].'" onclick="delete_product(\''."  $row[0] ".'\')"> Xóa</button></td>
                </tr>';
            }
        }else{
            echo '<td colspan="7" class="text-center">Không có phẩm nào!</td>';
        }
    }
}
               else{
                   echo "0";
               }   ?>