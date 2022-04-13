<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['id_table'])){
		$idTable= $_POST['id_table'];
		$sqlSelect = "SELECT * FROM orders WHERE maBan ='$idTable' AND trangThaiThanHToan=0";
		$resultSelect=mysqli_query($connect,$sqlSelect); // lấy bản ghi order
		if(mysqli_num_rows($resultSelect)>0){
			$rs = mysqli_fetch_assoc($resultSelect); // lấy bản ghi order
			$maOrder=$rs['maOrder']; // lấy mã order
			$maKH=$rs['maKH'];
			$giamGia=0;
			if($maKH!=0)
			{
				$giamGia=20; // nếu được set thì như này
			}
			$sql_select_detail="select * from orderdetail where maOrder='$maOrder';"; // lấy toàn bộ thông tin order trong bảng order detail
			$result_select_detail=mysqli_query($connect,$sql_select_detail);
			if(mysqli_num_rows($result_select_detail)>0){
				while ($rows = mysqli_fetch_array($result_select_detail)) {
					$maSanPham= $rows['maSanPham']; // từ detail lấy được mã sản phẩm
                    // lấy thông tin của sản phẩm
					$sql_SanPham="select * from sanpham where maSanPham='$maSanPham'";
					$result_SanPham=mysqli_query($connect,$sql_SanPham);
					$rs_sanPham=mysqli_fetch_assoc($result_SanPham);
					$gia= $rs_sanPham['gia']- ($rs_sanPham['gia']*$giamGia)/100;
					?>
					<tr data-id="<?php echo $rs_sanPham['maSanPham'];?>">
						<td><?php echo $rs_sanPham['maSanPham'];?></td>
						<td><?php echo $rs_sanPham['tenSanPham'];?></td>
						<td style="max-width:140px;"><div class="input-group spinner">
								<input type="text" class="form-control quantity-product-oders" name="" value="<?php echo $rows['soLuong']; ?>">
							</div></td>
						<td style="max-width:90px;"><input type="text" class="form-control price-order" disabled="disabled" name="" value="<?php echo $gia;?>"></td>
						<td class="text-center total-money"><?php echo $gia* $rows['soLuong'];?></td>
					</tr>
				<?php
				}
			}
		}
	}
 ?>