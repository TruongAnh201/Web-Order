<?php
	if(isset($_POST['customer'])){
		include_once('../../configs/dbConfig.php');
		$customer = $_POST['customer'];
		$sql = "SELECT * FROM khachhang WHERE MaKH LIKE '$customer%' OR TenKH LIKE '$customer%'";
		$result =mysqli_query($connect,$sql);
		$count =mysqli_num_rows($result);
		if($count>0){
			echo '<ul class="list-group">';
			while ($rows= mysqli_fetch_array($result)) { ?>
				<li class="list-group-item list-group-item-action data-cus-<?php echo $rows['MaKH'];?>" onclick="select_customer('<?php echo $rows['MaKH'];?>')"><?php echo $rows['TenKH']; ?></li>
			<?php }
			echo '</ul>';
		}else{
			echo 'Không tìm thấy kết quả';
		}
	}
?>