<?php
	include_once('../../configs/dbConfig.php');
	if (isset($_GET['delete_id'])) {
	include_once('backend/deleteTable.php');
}
?>

<script>
	// function edit_id(id){

	// 	$('button').reload('table.php?edit_id='+id);
	// }
</script>
<div class="row act">
	<div class="col-md-5">
		<h2>Phòng/Bàn</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddTable"><i class="fa fa-plus" aria-hidden="true"></i> Thêm bàn</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddGroup"><i class="fa fa-list" aria-hidden="true"></i> Thêm phòng</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-5 ">
		<input type="text" name="txtTenMaBan" id="txtTenMaBan" placeholder="Nhập mã hoặc tên bàn" class="form-control">
	</div>
	<div class="col-md-2  p-0">
		<select id="tang" class="form-control">
		<?php
		$sql_floor = "SELECT * FROM tang";
		$result_floor = mysqli_query($connect, $sql_floor);
		if (mysqli_num_rows($result_floor) > 0) {
			while ($row = mysqli_fetch_array($result_floor)) { ?>
					<option value="<?php echo $row['matang']; ?>"><?php echo $row['tentang']; ?></option>
		<?php }
		}
		?>
		</select>
	</div>
	<div class="col-md-2 ">
		<select id="trangThai" class="form-control">
			<option value="1">Hoạt động</option>
			<option value="0">Không hoạt động</option>
		</select>
	</div>
	<div class="col-md-3 ">
		<button class="btn btn-primary"  onclick="search_table()" ><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
</div>
<div class="row content-table">
	<div class="col-md-12" id="tables-place">
		<table id="table_sort" class="table table-striped table-bordered">
			<thead class="table-primary">
				<tr>
					<th class="hover-header-table" onclick="sort_0()">Tên bàn</th>
					<th class="hover-header-table" onclick="sort_1()">Tầng</th>
					<th>Ghi chú</th>
					<th>Trạng thái</th>
					<th colspan="2"></th>

				</tr>
			</thead>
			<tbody id="load_pagination_table">
				<?php
				$sql_tables = "SELECT * FROM ban,tang where ban.matang = tang.matang LIMIT 0,7"; // lấy tất cả dữ liệu các bàn.
				$result_tables = mysqli_query($connect, $sql_tables);
				if (mysqli_num_rows($result_tables) > 0) {
					while ($row = mysqli_fetch_array($result_tables)) {
				?>
						<tr>
							<td><?php echo $row['tenban']; ?></td>
							<td><?php echo "Tầng" . " " . $row['matang']; ?></td>
							<td><?php echo $row["ghichu"] ?></td>
							<td style="max-width:320px ;"> <?php if ($row['trangthai'] == 1) {
																echo "Đang hoạt động";
															} else {
																echo "Không hoạt động";
															} ?></td>
							<td style=" max-width:60px; align-items: center; text-align: center;"><button id="id_edit" class="btn btn-warning color-button-white" value="<?php echo $row[0]; ?>"> Chỉnh sửa</button></td>
							<td style=" max-width:60px; align-items: center; text-align: center;"><button class="btn btn-danger color-button-white" onclick="delete_table('<?php echo $row[0]; ?>')">Xóa</button></td>
						</tr>
				<?php
					}
				} else {
					echo '<td colspan="6" class="text-center">Chưa có bàn nào</td>';
				}
				?>
			</tbody>
		</table>
		<!-- tạo ra page -->
		<ul class="pagination">
			<?php
			$limit = 7;
			$sql_count = "select COUNT(*) as pageNumber from ban limit $limit"; // số lượng bàn
			$result_count = mysqli_query($connect, $sql_count); // đếm tổng số bàn
			$resultnum = mysqli_fetch_assoc($result_count); //mysqli_fetch_assoc giống như mysqli_fetch_row nhưng không sử dụng được dạng index.
			$rowcount = $resultnum['pageNumber']; // chọn đích thị trường mà cần lấy  query trả về số lượng bàn
			$totalpage = ceil($rowcount / $limit); // chia tổng số bàn cho limit để xem cần bao nhiêu page để hiển thị.
			for ($i = 1; $i <= $totalpage; $i++) { ?>
				<li class="page-item"><a class="page-link" onclick="pagination(<?php echo $i; ?>)" href="#"> <?php echo $i; /* thứ tự bàn*/  ?> </a></li>
			<?php }
			?>
		</ul>
	</div>
</div>

<!-- Modal add group -->
<div class="modal fade" id="ModalAddGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Thêm nhóm/phòng bàn</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<div class="col-md-4">
						<label>Tên tầng</label>
					</div>
					<div class="col-md-8">
						<input type="text" name="namgrouptable" placeholder="Nhập tên nhóm" class="form-control">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Ghi chú</label>
					</div>
					<div class="col-md-8">
						<textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="cms_add_grouptable()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal add table -->
<div class="modal fade" id="ModalAddTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Thêm Bàn</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<div class="col-md-4">
						<label>Tên bàn <span style="color:red;">(*)</span></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="tablename" id="tenBan" placeholder="Nhập tên bàn" class="form-control">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Tầng</label>
					</div>
					<div class="col-md-8">
						<select class="form-control" id="tenTang" name="areas-id">
							<option value="">Chọn tầng</option>
							<?php
							// include("connection.php");
							// include("dbConfig.php");
							$selectarea = "SELECT * FROM tang";
							$resultarea = mysqli_query($connect, $selectarea);
							if (mysqli_num_rows($resultarea) > 0) {
								while ($rowarea = mysqli_fetch_array($resultarea)) { ?>
									<option value="<?php echo $rowarea['matang']; ?>"><?php echo $rowarea['tentang']; ?></option>
							<?php }
							}
							?>
						</select>
					</div>
				</div>
				<!-- <div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Trạng thái</label>
	        		</div>
	        		<div class="col-md-8">
	        			<textarea class="form-control" rows="3" name="statusTable" placeholder="Đang hoạt động/ không hoạt động"></textarea>
	        		</div>
	        	</div> -->

				<div class="row form-group">
					<div class="col-md-4">
						<label>Trạng thái</label>
					</div>
					<div class="col-md-8">
						<select name="statusTable" class="form-control" id="">
							<option value="0">Tạm dừng hoạt động</option>
							<option value="1" selected="selected">Đang hoạt động</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Ghi chú</label>
					</div>
					<div class="col-md-8">
						<textarea name="ghichu_add" class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="add_table()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
			</div>
		</div>
	</div>
</div>
<!-- end modal add -->

<!-- modal edit table -->
<div class="modal fade" id="ModalEditTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Chỉnh sửa bàn</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- set value ẩn :3 -->
				<input type="hidden" name="value_hidden">
				<div class="row form-group">
					<div class="col-md-4">
						<label>Tên bàn <span style="color:red;">(*)</span></label>
					</div>
					<div class="col-md-8">
						<input type="text" name="tablename_edit" id="tenBan_edit" placeholder="Tên bàn" class="form-control">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Tầng</label>
					</div>
					<div class="col-md-8">
						<select class="form-control" id="tenTang_edit" name="maTang_edit">
							<option value="">Chọn tầng</option>
							<?php
							// include("connection.php");
							// include("dbConfig.php");
							$selectarea = "SELECT * FROM tang";
							$resultarea = mysqli_query($connect, $selectarea);
							if (mysqli_num_rows($resultarea) > 0) {
								while ($rowarea = mysqli_fetch_array($resultarea)) { ?>
									<option value="<?php echo $rowarea['matang']; ?>"><?php echo $rowarea['tentang']; ?></option>
							<?php }
							}
							?>
						</select>
					</div>
				</div>
				<!-- <div class="row form-group">


	        	</div> -->
				<div class="row form-group">
					<div class="col-md-4">
						<label>Trạng thái</label>
					</div>
					<div class="col-md-8">
						<select name="status_edit" class="form-control" id="">
							<option value="0">Không hoạt động</option>
							<option value="1">Đang hoạt động</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Ghi chú</label>
					</div>
					<div class="col-md-8">
						<textarea name="ghichu_edit" class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="save_edit()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Hủy</button>
			</div>
		</div>
	</div>
</div>
<!-- end modal edit table -->
<!-- <script>
	// function edit_id(id)
	// {
	// 	aler(id);
	// }
</script> -->