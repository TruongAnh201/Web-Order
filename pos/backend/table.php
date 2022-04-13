<?php
include_once('../../configs/dbConfig.php');
?>
<!-- file này để gọi ra sẽ load mới lại dữ liệu :> -->
<!-- load cate follow by id -->
<div class="row list-filter">
	<div class="col-md list-filter-content">
		<?php
				$area = "SELECT * FROM tang";
				$resultArea = mysqli_query($connect,$area);
				echo "<button style='width:78px' onclick='cate_table_load(0)' class='btn btn-primary'>Tât cả</button>";
				while ($rowArea = mysqli_fetch_array($resultArea)) { ?>
					<button class="btn btn-primary" onclick='cate_table_load(<?php echo $rowArea["matang"]; ?> )'><?php echo $rowArea['tentang']; ?></button>

			<?php }
			?>
	</div>
</div>
<!-- load table -->
<div class="row table-list">
	<div class="col-md table-list-content">
		<ul>
			<?php
				$table = "SELECT * FROM ban";
				$resultTable = mysqli_query($connect,$table);
				while ($rowTable = mysqli_fetch_array($resultTable)) { ?>
					<li id="table-status" <?php if($rowTable['trangthai']==1){echo 'class="tb-active"'; }?> id="<?php echo $rowtTable['maban']; ?>" onclick="order_table_load(<?php echo $rowTable['maban'];?>)"><?php echo $rowTable['tenban']; ?></li>
			<?php }
			?>
		</ul>
	</div>
</div>
