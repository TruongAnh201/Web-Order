<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['productName'])){
		$productName = $_POST['productName'];
		$sql = "SELECT * FROM sanPham WHERE maSanPham LIKE '$productName%' OR tenSanPham LIKE '$productName%'";
		$result =mysqli_query($connect,$sql);
		if(mysqli_num_rows($result)>0){
			echo '<ul class="list-group">';
			while ($rows= mysqli_fetch_array($result)) { ?>
				<li class="list-group-item list-group-item-action data-menu-<?php echo $rows['maSanPham'];?>" onclick="add_order('<?php echo $rows['maSanPham'];?>')">
					<img src="../public/images/<?php echo $rows['hinhAnh']; ?>" width="50px">
					<?php echo $rows['tenSanPham']; ?>
					<span style="color: red;"><?php echo  $rows['gia']; ?>đ</span>
				</li>
			<?php }
			echo '</ul>';
		}else{
			echo 'Không tìm thấy kết quả';
		}
	}
?>