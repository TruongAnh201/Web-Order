<?php
	include('../../configs/dbConfig.php');
	if(isset($_POST['TenKH'])&& isset($_POST['SDT']) && isset($_POST["DiaChi"])){

		$TenKH= $_POST['TenKH'];
		$SDT = $_POST['SDT'];
        $DiaChi = $_POST["DiaChi"];
			$insertCustomer = "INSERT INTO KhachHang(TenKH,SDT,DiaChi) VALUES('$TenKH','$SDT','$DiaChi')";
			$resultCustomer = mysqli_query($connect,$insertCustomer);
			if(isset($resultCustomer)){
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