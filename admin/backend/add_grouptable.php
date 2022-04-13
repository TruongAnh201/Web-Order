<?php
	include('../../configs/dbConfig.php');
	if(isset($_POST['namegroup'])){
		$namegroup= $_POST['namegroup'];
		$sql = "SELECT * FROM areas WHERE BranchName='$namegroup'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			echo "0";
		}else{
			$insertarea = "INSERT INTO areas(IdArea,BranchName,IdStore) VALUES('','$namegroup',NULL)";
			$resultarea = mysqli_query($conn,$insertarea);
			if(isset($resultarea)){
				echo '1';
			}
		}
	}
?>