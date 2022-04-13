<?php
	// session_start();
	// require_once('../connection.php');
	include_once('../../configs/dbConfig.php');
	if(isset($_POST['data'])){
		//$user = $_SESSION['uid'];
		$json =$_POST['data']; // lấy data json truyền sang

		$table_id= $json['table_id']; // mã bàn
		$user_id=$json['user_id'];
		$customer_id = $json['customer_id']; // mã kh
		//$customer_pay = $json['customer_pay']; // tổng tiền cần thanh toán của all of order

		$updateTable = "UPDATE ban SET trangthai ='1' WHERE maban ='$table_id'"; // set trạng thái thành đang hoạt động.
		$resultTable = mysqli_query($connect,$updateTable);
		// từ mã tài khoản lấy mã nhân viên.
		$selectNhanVien="select * from NhanVien WHERE MaTK='$user_id';";
		$resultNhanVien=mysqli_query($connect,$selectNhanVien);
		$nhanVien=mysqli_fetch_assoc($resultNhanVien);
		$maNhanVien=$nhanVien['MaNV'];

		// insert order bảng order max bàn, mã kh, tổng tiền , id của bản detail order(số lượng của từng sản phẩm order)
		$ngayThem= date("Y/m/d");
		foreach($json['detail_order'] as $value){
			$product_id = $value['id'];
			$quantity = $value['quantity'];
			$price = $value['price'];
			$insertOrder = "INSERT INTO `webapporder`.`orders` (`maBan`, `maSanPham`, `ngaythem`, `trangThaiThanhToan`, `maKH`, `maNV`, `maHoaDon`) VALUES ('$table_id', '$product_id', '$ngayThem', '0', '0','$maNhanVien', '0');";
			$resultOder = mysqli_query($connect,$insertOrder);
			// lấy mã order vừa insert
			$getNewest="select * from orders where maOrder >= all(select maOrder from orders);";
			$resultGet=mysqli_query($connect,$getNewest);
			$getRow=mysqli_fetch_assoc($resultGet);
			$newID=$getRow['maOrder'];
			//insert bảng detail
			$insertDetail="INSERT INTO `webapporder`.`orderdetail` (`maOrder`, `maSanPham`, `soLuong`, `tongTien`) VALUES ('$newID', '$product_id', '$quantity', '$price');";
			$resultDetail=mysqli_query($connect,$insertDetail);
		}

		echo "<h3>Thông báo !</h3><p>Lưu đơn hàng thành công</p>";
	}
?>