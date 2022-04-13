<?php
include('../../configs/dbConfig.php');
if (isset($_POST['key'])&& isset($_POST['tuNgay']) && isset($_POST['denNgay'])) {
    $key = $_POST['key'];
    $tuNgay=$_POST['tuNgay'];
    $denNgay=$_POST['denNgay'];
    if($key!="")
    {
    $sql = "SELECT hoadon.mahoadon,giothanhtoan,hoadon.tongtien,tenban,tennv,tenkh,ngaythanhtoan
    from orders,orderdetail,ban,nhanvien,khachhang,hoadon
    where orders.maorder=orderdetail.maorder and ngayThanhToan between ('$tuNgay') and('$denNgay') and hoadon.maHoaDon like '%7%' and ban.maban=orders.maban and nhanvien.manv=orders.manv and khachhang.makh=orders.makh and hoadon.mahoadon=orders.mahoadon
    group by(hoadon.mahoadon)
    order by hoadon.mahoadon desc;";
    $result = mysqli_query($connect, $sql);
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_array($result)) {
            ?>
             <tr class="not-detail">
                 <td class="width-35" data-toggle="collapse" data-target="#collapse-<?php echo $row['mahoadon']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['mahoadon']; ?>">
                     <i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
                 </td>
                 <td><?php echo 'HD'.$row['mahoadon']; ?></td>
                 <td><?php echo $row['giothanhtoan']." / ".$row['ngaythanhtoan']; ?></td>
                 <td><?php echo $row['tongtien']; ?></td>
                 <td>Đã hoàn thành</td>
             </tr>
             <tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['mahoadon']; ?>">
                 <td colspan="8">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item">
                             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chi tiết</a>
                       </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                       <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row">
                             <div class="col-md-4">
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Mã hóa đơn
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['mahoadon']; ?></strong>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Phòng/Bàn
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['tenban']; ?></strong>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Thời gian
                                     </label>
                                     <div class="col-md-8">
                                         <input type="text" name="" disabled="disabled" class="form-control" value="<?php echo $row['giothanhtoan']; ?>">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Nhân Viên
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['tennv']; ?></strong>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Khách hàng
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['tenkh']; ?></strong>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                     Ngày thanh toán
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['ngaythanhtoan']; ?></strong>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <table class="table table-striped table-bordered">
                             <thead class="table-success">
                                 <tr>
                                   <th>Mã Sản phẩm</th>
                                   <th>Tên sản phẩm</th>
                                   <th>Số lượng</th>
                                   <th>ĐVT</th>
                                   <th>giá bán</th>
                                   <th>Thành tiền</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $mahd= $row['mahoadon'];
                                 $selectdetail = "SELECT orderdetail.masanpham,tensanpham,soluong,donvitinh,gia,hoadon.tongtien
                                 from orders,sanpham,orderdetail,hoadon
                                 where orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham and orders.mahoadon= hoadon.mahoadon
                                 and hoadon.mahoadon= '$mahd'";
                                 $resultdetail = mysqli_query($connect,$selectdetail);
                                 while ($rowdetail = mysqli_fetch_array($resultdetail)) { ?>
                                     <tr>
                                         <td><?php echo $rowdetail['masanpham']; ?></td>
                                         <td><?php echo $rowdetail['tensanpham']; ?></td>
                                         <td><?php echo $rowdetail['soluong']; ?></td>
                                         <td><?php echo $rowdetail['donvitinh']; ?></td>
                                         <td><?php echo $rowdetail['gia']; ?></td>
                                         <td><?php echo $rowdetail['gia']*$rowdetail['soluong']; ?></td>
                                     </tr>
                                 <?php }
                                 ?>
                             </tbody>
                         </table>
                     </div>
                     </div>
                    </td>
             </tr>
         <?php }
     }else{
         echo '<td colspan="6" class="text-center">Chưa có thực đơn nào</td>';
     }
}else{
    $sql = "SELECT hoadon.mahoadon,giothanhtoan,hoadon.tongtien,tenban,tennv,tenkh,ngaythanhtoan
    from orders,orderdetail,ban,nhanvien,khachhang,hoadon
    where orders.maorder=orderdetail.maorder and ngayThanhToan between ('$tuNgay') and('$denNgay') and ban.maban=orders.maban and nhanvien.manv=orders.manv and khachhang.makh=orders.makh and hoadon.mahoadon=orders.mahoadon
    group by(hoadon.mahoadon)
    order by hoadon.mahoadon desc;";
    $result = mysqli_query($connect, $sql);
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_array($result)) {
            ?>
             <tr class="not-detail">
                 <td class="width-35" data-toggle="collapse" data-target="#collapse-<?php echo $row['mahoadon']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['mahoadon']; ?>">
                     <i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
                 </td>
                 <td><?php echo 'HD'.$row['mahoadon']; ?></td>
                 <td><?php echo $row['giothanhtoan']." / ".$row['ngaythanhtoan']; ?></td>
                 <td><?php echo $row['tongtien']; ?></td>
                 <td>Đã hoàn thành</td>
             </tr>
             <tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['mahoadon']; ?>">
                 <td colspan="8">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item">
                             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chi tiết</a>
                       </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                       <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row">
                             <div class="col-md-4">
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Mã hóa đơn
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['mahoadon']; ?></strong>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Phòng/Bàn
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['tenban']; ?></strong>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Thời gian
                                     </label>
                                     <div class="col-md-8">
                                         <input type="text" name="" disabled="disabled" class="form-control" value="<?php echo $row['giothanhtoan']; ?>">
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Nhân Viên
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['tennv']; ?></strong>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                         Khách hàng
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['tenkh']; ?></strong>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="row form-group">
                                     <label class="col-md-4">
                                     Ngày thanh toán
                                     </label>
                                     <div class="col-md-8">
                                         <strong><?php echo $row['ngaythanhtoan']; ?></strong>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <table class="table table-striped table-bordered">
                             <thead class="table-success">
                                 <tr>
                                   <th>Mã Sản phẩm</th>
                                   <th>Tên sản phẩm</th>
                                   <th>Số lượng</th>
                                   <th>ĐVT</th>
                                   <th>giá bán</th>
                                   <th>Thành tiền</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $mahd= $row['mahoadon'];
                                 $selectdetail = "SELECT orderdetail.masanpham,tensanpham,soluong,donvitinh,gia,hoadon.tongtien
                                 from orders,sanpham,orderdetail,hoadon
                                 where orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham and orders.mahoadon= hoadon.mahoadon
                                 and hoadon.mahoadon= '$mahd'";
                                 $resultdetail = mysqli_query($connect,$selectdetail);
                                 while ($rowdetail = mysqli_fetch_array($resultdetail)) { ?>
                                     <tr>
                                         <td><?php echo $rowdetail['masanpham']; ?></td>
                                         <td><?php echo $rowdetail['tensanpham']; ?></td>
                                         <td><?php echo $rowdetail['soluong']; ?></td>
                                         <td><?php echo $rowdetail['donvitinh']; ?></td>
                                         <td><?php echo $rowdetail['gia']; ?></td>
                                         <td><?php echo $rowdetail['gia']*$rowdetail['soluong']; ?></td>
                                     </tr>
                                 <?php }
                                 ?>
                             </tbody>
                         </table>
                     </div>
                     </div>
                    </td>
             </tr>
         <?php }
     }else{
         echo '<td colspan="6" class="text-center">Chưa có thực đơn nào</td>';
     }
}
} else {
    echo "0";
}   ?>