<!-- display menu item -->
<?php
	include_once('../../configs/dbConfig.php');
	?>
<div class="row">
	<div class="col-md-5">
		<h2>Danh sách thực đơn</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddProduct"><i class="fa fa-plus" aria-hidden="true"></i> Thêm sản phẩm</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#AddCategoryModal"><i class="fa fa-th-list" aria-hidden="true"></i> Thêm loại sản phẩm</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-5 form-group">
		<input type="text" name="txtproductname" id="tenMaSanPham" placeholder="Nhập mã hoặc tên sản phẩm" class="form-control">
	</div>
	<div class="col-md-2 form-group">
		<select id="maLoai" class="form-control">
			<?php
		$sql_loaiSP = "SELECT * FROM loaisanpham";
		$result_loaiSP = mysqli_query($connect, $sql_loaiSP);
		if (mysqli_num_rows($result_loaiSP) > 0) {
			while ($row = mysqli_fetch_array($result_loaiSP)) { ?>
					<option value="<?php echo $row['maLoai']; ?>"><?php echo $row['tenLoai']; ?></option>
		<?php }
		}
		?>
		</select>
	</div>
	<div class="col-md-2 form-group">
		<button class="btn btn-primary" onclick="search_product()"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
</div>
<div class="row content-product">
	<div class="col-md-12">
		<div class="scroll-table-menu">
		<table id="table_sort" class="table table-striped table-bordered">
		    <thead  class="table-primary">
			    <tr>
			    	<th class="hover-header-table" onclick="sort_0()">STT</th>
			      	<th class="hover-header-table" onclick="sort_1()">Mã</th>
			        <th class="hover-header-table" onclick="sort_2()">Tên sản phẩm</th>
			        <th class="hover-header-table" onclick="sort_3()">Gía bán</th>
			        <th  class="align-center-item" >Hình ảnh</th>
			        <th>ĐVT</th>
			        <th colspan="2"></th>
			    </tr>
		    </thead>
		    <tbody id="result-product">
		      	<?php
					$stt=1;
		      		$sql = "SELECT * FROM sanpham order by maSanPham ASC;";
		      		$result = mysqli_query($connect,$sql);
		      		if(mysqli_num_rows($result)>0){
		      			while ($row = mysqli_fetch_array($result)) {
		      				echo '<tr>
		      				<td>'.$stt++.'</td>
		      				<td>'.$row['maSanPham'].'</td>
		      				<td>'.$row['tenSanPham'].'</td>
		      				<td>'.number_format($row['gia'],0).' đ</td>
		      				<td class="align-center-item"><img width="55px"; src="public/images/'.$row['hinhAnh'].'"></td>
		      				<td>'.$row['donViTinh'].'</td>
		      				<td style="max-width:60px;"><button  class="btn btn-warning color-button-white" id="edit_product" value="'.$row['maSanPham'].'"> Chỉnh sửa</button></td>
		      				<td style="max-width:40px;"><button  class="btn btn-danger color-button-white" value="'.$row['maSanPham'].'" onclick="delete_product(\''."  $row[0] ".'\')"> Xóa</button></td>
		      				</tr>';
		      			}
		      		}else{
		      			echo '<td colspan="7" class="text-center">Chưa có sản phẩm nào!</td>';
		      		}
		      	?>
		    </tbody>
		</table>
		</div>
	</div>
</div>
<!-- end display menu item -->

<!-- add product item -->
<div class="modal fade" id="ModalAddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Thêm sản phẩm</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Mã sản phẩm <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="productID" id="productID" placeholder="Nhập mã sản phẩm" class="form-control">
	        		</div>
	        	</div>
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên sản phẩm <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="productName" id="productName" placeholder="Nhập tên sản phẩm" class="form-control">
	        		</div>
	        	</div>
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Giá <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="productPrice" id="productPrice" placeholder="Nhập giá sản phẩm" class="form-control">
	        		</div>
	        	</div>
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Đơn vị tính <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<select class="form-control" id="productUnit" name="productUnit">
	        				<option value="">Chọn đơn vị tính</option>
	        			<?php
						// include("connection.php");

			        		$selectarea = "select donViTinh from sanpham group by donViTinh";
				      		$resultarea = mysqli_query($connect,$selectarea);
				      		if(mysqli_num_rows($resultarea)>0){
				      			while ($rowarea = mysqli_fetch_array($resultarea)) {?>
				      				<option value="<?php echo $rowarea['donViTinh']; ?>"><?php echo $rowarea['donViTinh'];?></option>
						<?php }
							}
		      			?>
		      			</select>
	        		</div>
	        	</div>
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Loại sản phẩm</label>
	        		</div>
	        		<div class="col-md-8">
	        			<select class="form-control" id="productCate" name="productCate">
	        				<option value="">Chọn loại sản phẩm</option>
	        			<?php

			        		$selectarea = "SELECT * FROM loaisanpham";
				      		$resultarea = mysqli_query($connect,$selectarea);
				      		if(mysqli_num_rows($resultarea)>0){
				      			while ($rowarea = mysqli_fetch_array($resultarea)) {?>
				      				<option value="<?php echo $rowarea['maLoai']; ?>"><?php echo $rowarea['tenLoai'];?></option>
						<?php }
							}
		      			?>
		      			</select>
	        		</div>
	        	</div>
				<div class="row form-group">
                    <div class="col-md-12 text-center">
                        <div class="jumbotron">
                            <h3>Upload hình ảnh sản phẩm</h3>
                            <p>(Để tải và hiện thị nhanh, mỗi ảnh lên có dung lượng tối đa 5MB.)</p>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="productImg" >
                        </div>
                    </div>
                </div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" onclick="add_product()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Thêm</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end modal add -->
<!-- modal edit -->
<div class="modal fade" id="ModalEditProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Cập nhật phẩm</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
			    <input type="hidden" name="productID_edit" id="productID_edit" placeholder="Nhập mã sản phẩm" class="form-control">
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên sản phẩm <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="productName_edit" id="productName_edit" placeholder="Nhập tên sản phẩm" class="form-control">
	        		</div>
	        	</div>
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Giá <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="productPrice_edit" id="productPrice_edit" placeholder="Nhập giá sản phẩm" class="form-control">
	        		</div>
	        	</div>
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Đơn vị tính <span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<select class="form-control" id="productUnit_edit" name="productUnit_edit">
	        				<option value="">Chọn đơn vị tính</option>
	        			<?php
						// include("connection.php");

			        		$selectarea = "select donViTinh from sanpham group by donViTinh";
				      		$resultarea = mysqli_query($connect,$selectarea);
				      		if(mysqli_num_rows($resultarea)>0){
				      			while ($rowarea = mysqli_fetch_array($resultarea)) {?>
				      				<option value="<?php echo $rowarea['donViTinh']; ?>"><?php echo $rowarea['donViTinh'];?></option>
						<?php }
							}
		      			?>
		      			</select>
	        		</div>
	        	</div>
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Loại sản phẩm</label>
	        		</div>
	        		<div class="col-md-8">
	        			<select class="form-control" id="productCate_edit" name="productCate_edit">
	        				<option value="">Chọn loại sản phẩm</option>
	        			<?php

			        		$selectarea = "SELECT * FROM loaisanpham";
				      		$resultarea = mysqli_query($connect,$selectarea);
				      		if(mysqli_num_rows($resultarea)>0){
				      			while ($rowarea = mysqli_fetch_array($resultarea)) {?>
				      				<option value="<?php echo $rowarea['maLoai']; ?>"><?php echo $rowarea['tenLoai'];?></option>
						<?php }
							}
		      			?>
		      			</select>
	        		</div>
	        	</div>
				<div class="row form-group">
                    <div class="col-md-12 text-center">
                        <div class="jumbotron">
                            <h3>Upload hình ảnh sản phẩm</h3>
                            <p>(Để tải và hiện thị nhanh, mỗi ảnh lên có dung lượng tối đa 5MB.)</p>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="productImg" >
                        </div>
                    </div>
                </div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" onclick="save_edit_product()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Thêm</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>

<!-- end moadl edit -->
