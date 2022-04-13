<?php
	include('../../configs/dbConfig.php');
	if (isset($_POST['current_page'])) {
	$current_page = $_POST['current_page'];
	$limit = 7;
	$start = ($current_page - 1) * $limit;
	$sql = "SELECT * FROM ban,tang where ban.matang = tang.matang LIMIT $start,$limit";
	$result = mysqli_query($connect, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			?>
			<tr>
								<td><?php echo $row['tenban']; ?></td>
								<td><?php echo "Tầng"." ".$row['matang']; ?></td>
								<td><?php echo $row["ghichu"] ?></td>
								<td style="max-width:320px ;"> <?php if($row['trangthai']==1){echo "Đang hoạt động";} else{ echo "Không hoạt động";} ?></td>
								<td style =" max-width:60px; align-items: center; text-align: center;"><button id="id_edit"   class="btn btn-warning color-button-white" onclick="edit_id('<?php echo $row[0]; ?>')" value="<?php echo $row[0]; ?>"> Chỉnh sửa</button></td>
								<td style =" max-width:60px; align-items: center; text-align: center;"><button  class="btn btn-danger color-button-white" onclick="delete_table('<?php echo $row[0]; ?>')" >Xóa</button></td>
							</tr>
		<?php
		}
	} else {
		echo 'Hãy đảm bảo page trước đã đủ 10 bàn!';
	}
}
?>