<?php
	include('../../configs/dbConfig.php');
	if(isset($_POST['id'])){

		$id = $_POST['id'];

		$sql = "SELECT * FROM khachhang WHERE MaKH=' $id'";
		$result = mysqli_query($connect,$sql);
		if(mysqli_num_rows($result)<0){
			echo "0";

		}else{
			while($row =mysqli_fetch_row($result))
            {
				$arr=array($row[0],$row[1],$row[2],$row[3]);
				if($arr==null)
				{
					echo "0";
				}
				else{
					echo json_encode($arr);
				}
            }
		}
	}
?>