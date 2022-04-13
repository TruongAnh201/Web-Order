<table id="tables" class="table table-striped table-bordered">
			<thead class="table-primary">
				<tr>
					<th onclick="sortTable_name()">Tên bàn</th>
					<th onclick="sortTable_floor()">Tầng</th>
					<th>Ghi chú</th>
					<th>Trạng thái</th>
					<th colspan="2"></th>

				</tr>
			</thead>
			<tbody id="load_pagination_table">
<?php
    include('../../configs/dbConfig.php');
    if(isset($_POST['key']) && isset($_POST['tang']) && isset($_POST['trangThai'])){
        $key=$_POST['key'];
        $tang=$_POST['tang'];
        $trangThai=$_POST['trangThai'];
		if($key!="")
		{
        $sql="select distinct ban.maBan,ban.tenBan,ban.ghichu,ban.trangThai,ban.maTang from tang,ban where tang.matang=ban.matang and maBan like '%$key%' or tenBan like '%$key%' and ban.maTang='$tang' and trangThai='$trangThai';";
        $result_tables = mysqli_query($connect, $sql);
				if (mysqli_num_rows($result_tables) > 0) {
					while ($row = mysqli_fetch_array($result_tables)) {
				?>
						<tr>
							<td><?php echo $row['tenBan']; ?></td>
							<td><?php echo "Tầng" . " " . $row['maTang']; ?></td>
							<td><?php echo $row["ghichu"] ?></td>
							<td style="max-width:320px ;"> <?php if ($row['trangThai'] == 1) {
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
					echo '<td colspan="6" class="text-center">Không tìm thấy kết quả phù hợp</td>';
				}
                ?>
			</tbody>
            </table>
            <!-- tạo ra page -->
            <ul class="pagination">
                <?php
                $limit = 7;
                $rowcount=mysqli_num_rows($result_tables);
                $totalpage = ceil($rowcount / $limit); // chia tổng số bàn cho limit để xem cần bao nhiêu page để hiển thị.
                for ($i = 1; $i <= $totalpage; $i++) { ?>
                    <li class="page-item"><a class="page-link" onclick="cms_pagination(<?php echo $i; ?>)" href="#"> <?php echo $i; /* thứ tự bàn*/  ?> </a></li>
                <?php }
                ?>
            </ul>
    <?php
	}
	else{
		$sql="select ban.maBan,ban.tenBan,ban.ghichu,ban.trangThai,ban.maTang from tang,ban where tang.matang=ban.matang ;";
        $result_tables = mysqli_query($connect, $sql);
				if (mysqli_num_rows($result_tables) > 0) {
					while ($row = mysqli_fetch_array($result_tables)) {
				?>
						<tr>
							<td><?php echo $row['tenBan']; ?></td>
							<td><?php echo "Tầng" . " " . $row['maTang']; ?></td>
							<td><?php echo $row["ghichu"] ?></td>
							<td style="max-width:320px ;"> <?php if ($row['trangThai'] == 1) {
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
					echo '<td colspan="6" class="text-center">Không tìm thấy kết quả phù hợp</td>';
				}
                ?>
			</tbody>
            </table>
            <!-- tạo ra page -->
            <ul class="pagination">
                <?php
                $limit = 7;
                $rowcount=mysqli_num_rows($result_tables);
                $totalpage = ceil($rowcount / $limit); // chia tổng số bàn cho limit để xem cần bao nhiêu page để hiển thị.
                for ($i = 1; $i <= $totalpage; $i++) { ?>
                    <li class="page-item"><a class="page-link" onclick="cms_pagination(<?php echo $i; ?>)" href="#"> <?php echo $i; /* thứ tự bàn*/  ?> </a></li>
                <?php }
                ?>
            </ul>
    <?php
	}
}
    else{
        echo "0";
    }
?>