<ul>
<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['id_cate'])){
		$idCate= $_POST['id_cate'];
		if($idCate==0){ // click on tất cả!
			$sql = "SELECT * FROM sanPham";
			$result=mysqli_query($connect,$sql);
			while ($rowMenu= mysqli_fetch_array($result)) { ?>
				<li>
					<a href="#" onclick="add_order('<?php echo $rowMenu['maSanPham'];?>')" title="<?php echo $rowMenu['tenSanPham'];?>">
						<div class="img-product">
							<img src="../public/images/<?php echo $rowMenu['hinhAnh']; ?>">
						</div>
						<div class="product-info">
							<span class="product-name"><?php echo $rowMenu['tenSanPham'];?></span><br>
							<strong><?php echo number_format($rowMenu['gia'],0);?></strong>
						</div>
					</a>
				</li>
		<?php }
			}else { // load theo mã
			$sql = "SELECT * FROM sanPham WHERE maLoai ='$idCate'";
			$result=mysqli_query($connect,$sql);
			while ($rowMenu= mysqli_fetch_array($result)) { ?>
				<li>
					<a href="#" onclick="add_order('<?php echo $rowMenu['maSanPham'];?>')" title="<?php echo $rowMenu['tenSanPham'];?>">
						<div class="img-product">
							<img src="../public/images/<?php echo $rowMenu['hinhAnh']; ?>">
						</div>
						<div class="product-info">
							<span class="product-name"><?php echo $rowMenu['tenSanPham'];?></span><br>
							<strong><?php echo number_format($rowMenu['gia'],0);?></strong>
						</div>
					</a>
				</li>
		<?php }
		}
	}
?>
</ul>