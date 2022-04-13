<?php
session_start();
include('../../configs/dbConfig.php');
if(isset($_POST['user']) && isset($_POST['pass'])){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$sql = "SELECT * FROM taikhoan WHERE TenDangNhap = '$user' AND MatKhau= '$pass'";
	$result = mysqli_query($connect,$sql);
	if(mysqli_num_rows($result)>0){
		$rows=mysqli_fetch_assoc($result);
		if($rows['VaiTro']==1)
		{
			$_SESSION['uid'] = $rows['MaTK'];
			$_SESSION['role']= $rows['VaiTro'];
			echo '1';
			//echo $_SESSION['uid']; // quyền quản lý
			//echo $_SESSION['role']; // quyền quản lý
		}
		else{
			$_SESSION['uid'] = $rows['MaTK'];
			$_SESSION['role']=$rows['VaiTro'];
			echo '2';
			//echo $_SESSION['uid']; // quyền quản lý
			//echo $_SESSION['role']; // quyền quản lý
			//echo '2'; // quyền nhân viên
		}

	}else{
		echo '3'; // không tìm thấy tài khoản
	}
}
else{
	echo '4'; // không nhận được dữ liệu
}
?>