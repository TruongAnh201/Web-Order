<?php
	include('../../configs/dbConfig.php');
	if(isset($_POST['TenNV'])&& isset($_POST['GioiTinh']) && isset($_POST['SDT']) && isset($_POST["Email"]) && isset($_POST["DiaChi"])){

		$TenNV= $_POST['TenNV'];
		$GioiTinh = $_POST['GioiTinh'];
		$SDT = $_POST['SDT'];
		$Email = $_POST["Email"];
        $DiaChi = $_POST["DiaChi"];
			$insertStaff = "INSERT INTO nhanvien(TenNV,GioiTinh,SDT,Email,DiaChi,MaTK) VALUES('$TenNV','$GioiTinh','$SDT','$Email','$DiaChi','0')";
			$resultStaff = mysqli_query($connect,$insertStaff);
			if(isset($resultStaff)){
				echo '1';
			}
            else{
                echo '0';
            }
		}
	else{
		 echo "0";
	}
?>