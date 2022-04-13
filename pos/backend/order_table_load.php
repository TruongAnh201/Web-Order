<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['id_table'])){
		$idTable= $_POST['id_table'];
		$sqlSelect = "SELECT * FROM orders WHERE maBan ='$idTable' AND trangThaiThanHToan=0";
		$resultSelect=mysqli_query($connect,$sqlSelect); // lấy bản ghi order
		if(mysqli_num_rows($resultSelect)>0){
			$rs = mysqli_fetch_assoc($resultSelect); // lấy bản ghi order
			$giamGia=1;
			if($rs['maKH']!=0)
			{
				$giamGia=20;
			}
			$maOrder=$rs['maOrder'];
			$sql_select_detail="select * from orderdetail where maOrder='$maOrder';"; // lấy toàn bộ thông tin order trong bảng order detail
			$result_select_detail=mysqli_query($connect,$sql_select_detail);
			if(mysqli_num_rows($result_select_detail)>0){
				while ($rows = mysqli_fetch_array($result_select_detail)) {
					$maSanPham= $rows['maSanPham'];
					$sql_SanPham="select * from sanpham where maSanPham='$maSanPham'";
					$result_SanPham=mysqli_query($connect,$sql_SanPham);
					$rs_sanPham=mysqli_fetch_assoc($result_SanPham);
					?>
					<tr data-id="<?php echo $rs_sanPham['maSanPham'];?>">
						<td><?php echo $rs_sanPham['maSanPham'];?></td>
						<td><?php echo $rs_sanPham['tenSanPham'];?></td>
						<td style="max-width:130px;"><div class="input-group spinner">
								<button class="input-group-prepend btn btn-default"><i class="fa fas fa-minus"></i></button>
								<input type="text" class="form-control quantity-product-oders" name="" value="<?php echo $rows['soLuong']; ?>">
								<button class="input-group-prepend btn btn-default"><i class="fa fas fa-plus"></i></button>
							</div></td>
						<td style="max-width:90px;"><input type="text" class="form-control price-order" disabled="disabled" value="<?php if($giamGia != 1){echo ($rs_sanPham['gia'])-(($rs_sanPham['gia']* $giamGia)/100);} else{echo $rs_sanPham['gia'];} ?>"></td>
						<td class="text-center total-money"></td>
						<td class="text-center">
							<i class="fa fa-times-circle delete-product-order"></i>
						</td>
					</tr>

				<?php
				}
			}
		}
	}
 ?>