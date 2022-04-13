<?php
	include('../../configs/dbConfig.php');
	if( isset($_POST['TenDN']) && isset($_POST['MatKhau']) && isset($_POST['VaiTro'])){

        $TenDN = $_POST["TenDN"];
        $MatKhau = $_POST["MatKhau"];
        $VaiTro = $_POST["VaiTro"];

			$insertStaff = "INSERT INTO taikhoan(TenDangNhap,MatKhau,VaiTro) VALUES('$TenDN','$MatKhau','$VaiTro')";
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