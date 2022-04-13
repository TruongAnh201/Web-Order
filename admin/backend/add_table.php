<?php
	include('../../configs/dbConfig.php');
	if(isset($_POST['tablename'])&& isset($_POST['idarea']) && isset($_POST['statusTable']) && isset($_POST["note"])){
		// echo "<script> alert('tao đã vào đây!');</script>";
		$name= $_POST['tablename'];
		$idarea = $_POST['idarea'];
		$status = $_POST['statusTable'];
		$note = $_POST["note"];

		$sql = "SELECT * FROM ban WHERE tenban='$name'"; // cehck tên bàn trùng
		$result = mysqli_query($connect,$sql);
		if(mysqli_num_rows($result)>0){
			echo "0";

		}else{
			$inserttb = "INSERT INTO ban(tenban,ghichu,trangthai,matang) VALUES('$name','$note','$status','$idarea')";
			$resulttb = mysqli_query($connect,$inserttb);
			if(isset($resulttb)){
				echo '1';
			}
		}
	}
	// else{
	// 	 echo "<script> alert('tao đã vào đây!');</script>";
	// }
?>