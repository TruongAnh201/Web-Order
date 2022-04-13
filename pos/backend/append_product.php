<?php
// bảng orders lưu thông tin , ngày tạo order | bảng detail order dẽ dùng mã orders(1 mã duy nhất cho nhiều sản phẩm) để check tất cả detail đó trong cùng 1 bàn
session_start();
include_once('../../configs/dbConfig.php');
if (isset($_POST['maSanPham']) && isset($_POST['table_id'])) {
	$id = $_POST['maSanPham']; // mã sản phẩm
	$table_id = $_POST['table_id']; // mã bàn
	$uid = $_SESSION['uid']; // mã tài khoản
	$ngayThem = date("Y/m/d");
	$flag = false;
	// lấy thông tin sản phẩm theo id
	$sql = "SELECT * FROM sanpham WHERE maSanPham= '$id';";
	$result = mysqli_query($connect, $sql);
	$rows_SP = mysqli_fetch_assoc($result);
	$gia = $rows_SP['gia']; // giá của sản phẩm
	// lấy thông tin nhân viên theo mã tài khoản ở session
	$selectNhanVien = "select * from NhanVien WHERE MaTK='$uid';";  // từ mã tài khoản lấy mã nhân viên
	$resultNhanVien = mysqli_query($connect, $selectNhanVien);
	$nhanVien = mysqli_fetch_assoc($resultNhanVien);
	$maNhanVien = $nhanVien['MaNV'];
	$sqlCheck = "select * from orders where maBan='$table_id' and trangThaiThanhToan=0;"; // lấy thông tin orders xem bàn đó có tồn tại mã nào chưa thanh toán k
	$resultCheck = mysqli_query($connect, $sqlCheck);
	if (mysqli_num_rows($resultCheck) == 0) // không tìm thấy mã order nào chưa được thanh toán của bàn đó (bàn chưa được order )
	{
		$sql_insert_order = "INSERT INTO webapporder.orders (maBan, ngaythem, trangThaiThanhToan, maKH, maNV, maHoaDon) VALUES ('$table_id', '$ngayThem', '0', '0', '$maNhanVien', '0');";
		$result_insert_order = mysqli_query($connect, $sql_insert_order);
		if (isset($result_insert_order)) // insert thành công
		{
			// udpate trạng thái bàn
			$sql_update_table="UPDATE `webapporder`.`ban` SET `trangthai` = '1' WHERE (`maban` = '$table_id');";
            $result_update_table=mysqli_query($connect,$sql_update_table);
			// lấy ra mã order mới nhất
			$getNewest = "select * from orders where maOrder >= all(select maOrder from orders);";
			$resultGet = mysqli_query($connect, $getNewest);
			$getRow = mysqli_fetch_assoc($resultGet);
			$newID = $getRow['maOrder'];

			if ($newID != null && isset($result_update_table)) // kiểm tra newID không được rỗng và dùng mã order đó thêm vào các detailorrder(các mặt hàng cần order) và kiểm tra bàn đã được update chưa
			{
				// $gia=$rows['gia'];
				//echo "gia".$gia ;
				$sql_insert_orderDetail = "INSERT INTO webapporder.orderdetail (maOrder,maSanPham, soLuong, tongTien) VALUES ('$newID', '$id', '1', '$gia');";
				$result_insert_detail = mysqli_query($connect, $sql_insert_orderDetail);
				if (isset($result_insert_detail)) {
					$flag = true;
				}
			}
		}
	} else {
		$row = mysqli_fetch_assoc($resultCheck); // nếu bàn đó đã order thì lấy thông tin của bàn đó tại bảng orders
		$maOrder = $row['maOrder']; // lấy mã order
		if($row['maKH']!=0) // nếu mã khách hàng khác default thì định nghĩa lại giá tiền
		{
			$gia= $gia-(($gia*20)/100);
		}
		$select_detail = "select * from orderdetail where maOrder='$maOrder'"; // lấy toàn bộ thông tin có mã order trên trong bảng detail order
		$result_select_detail = mysqli_query($connect, $select_detail);
		$check = false;
		if (mysqli_num_rows($result_select_detail) > 0) {
			while ($rows_tb_Detail = mysqli_fetch_array($result_select_detail)) {
				if ($id == $rows_tb_Detail['maSanPham']) { // check xem cái sản phầm cần order đó đã tồn tại chưa . nếu rồi thì tăng số lượng và cộng thêm tiền
					$check = true;
					$id_detail = $rows_tb_Detail['ID'];
					$soLuong = $rows_tb_Detail['soLuong'] + 1;
					$tongTien = $rows_tb_Detail['tongTien'] + $gia;
					$sql_update_quality = "UPDATE webapporder.orderdetail SET soLuong = '$soLuong', tongTien = '$tongTien' WHERE ID = '$id_detail';";
					$result_update = mysqli_query($connect, $sql_update_quality);
					// if (isset($result_update)) { ở đây update là được k. k cần insert thêm k sẽ bị lỗi :>
					// 	$flag = true;
					// }
				}
			}
			if ($check == false) {
				$sql_insert_detail = "INSERT INTO webapporder.orderdetail (maOrder, maSanPham, soLuong, tongTien) VALUES ('$maOrder', '$id', '1', '$gia');";
				$result_insert_detail_2 = mysqli_query($connect, $sql_insert_detail);
				if (isset($result_insert_detail_2)) {
					$flag = true;
				}
			}
		}
	}
}
if ($flag == true) { ?>
	<tr data-id="<?php echo $rows_SP['maSanPham']; ?>">
		<td><?php echo $rows_SP['maSanPham']; ?></td>
		<td><?php echo $rows_SP['tenSanPham']; ?></td>
		<td style="max-width:130px;">
			<div class="input-group spinner">
				<button class="input-group-prepend btn btn-default"><i class="fa fas fa-minus"></i></button>
				<!-- value của số lượng mặc định bằng 1  sẽ được sửa lại khi click sản phầm -->
				<input type="text" class="form-control quantity-product-oders" name="" value="1">
				<button class="input-group-prepend btn btn-default"><i class="fa fas fa-plus"></i></button>
			</div>
		</td>
		<td style="max-width:90px;"><input type="text" class="form-control price-order" disabled="disabled" value="<?php echo $gia; ?>"></td>
		<!--  mặc định ban đầu là giá sản phẩm! sẽ được sửa lại bởi hàm load khi click sản phẩm -->
		<td class="text-center total-money"><?php echo number_format($rows_SP['gia'], 0); ?></td>
		<!-- nút delele order -->
		<td class="text-center">
			<i class="fa fa-times-circle delete-product-order"></i>
		</td>
	</tr>

<?php }
?>