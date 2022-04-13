<?php 	include_once('../../configs/dbConfig.php');

if(isset($_GET['delete_id']))
{
	  include_once ('../backend/delete_staff.php');
	  echo "<script>$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');</script>";
}
?>
<!-- display staff -->
<div class="row">
	<div class="col-md-5">
		<h2>Danh sách nhân viên</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" onclick="" data-toggle="modal" data-target="#AddStaffModal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm nhân viên</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#AddAccountModal"><i class="fa fa-th-list" aria-hidden="true"></i> Thêm tài khoản</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-5 form-group">
		<input type="text" name="txtproductname" placeholder="Nhập mã hoặc tên nhân viên" class="form-control">
	</div>

	<div class="col-md-2 form-group">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
</div>
<div class="row content-product">
	<div class="col-md-12">
		<table class="table table-striped table-bordered" id="table_sort">
		    <thead  class="table-primary">
			    <tr>

			      	<th  onclick="sort_0()"  class="hover-header-table" style="width: 100px;">Mã NV</th>
			        <th onclick="sort_1()"  class="hover-header-table">Tên nhân viên</th>
					<th>Giới tính</th>
					<th>Số điện thoại</th>
					<th style="max-width:180px">Email</th>
			        <th onclick="sort_5()"  class="hover-header-table">Địa chỉ</th>
			        <!-- <th class="align-center-item" >Hình ảnh</th> -->
					<th>Mã tài khoản</th>
			        <th style="min-width:180px" colspan="2"></th>
			    </tr>
		    </thead>
		    <tbody>
		      	<?php


		      		$sql = "SELECT * FROM nhanvien";
		      		$result = mysqli_query($connect,$sql);
		      		if(mysqli_num_rows($result)>0){
		      			while ($row = mysqli_fetch_array($result)) {
							  if($row['MaNV']!=0)
							  {
							  ?>
		      				<tr>
		      				<td><?php echo $row['MaNV']; ?></td>
		      				<td  ><?php echo $row['TenNV']; ?></td>
		      				<td><?php if($row['GioiTinh']==1){echo "Nam";}else{echo "Nữ";} ?></td>
							<td><?php echo $row['SDT']; ?></td>
							<td style="max-width:180px; overflow-x:scroll"><?php echo $row['Email']; ?></td>
							<td ><?php echo $row['DiaChi']; ?></td>
		      				<!-- <td class="align-center-item"><img width="55px";>></td> -->
							<td style="width: 130px;"><?php if($row['MaTK']==0){ echo "Chưa có";}else{ echo $row['MaTK'];}  ?></td>
		      				<td style="min-width:60px; max-width:80px"><button id="editStaff" class="btn btn-warning color-button-white" value="<?php echo $row[0]; ?> " > Chỉnh sửa</button></td>
		      				<td style =" max-width:60px; align-items: center; text-align: center;"><button  class="btn btn-danger color-button-white" onclick="delete_staff_by_id('<?php echo $row[0]; ?>')" >Xóa</button></td>
		      				</tr>
							<?php
							  }
		      			}
		      		}else{
		      			echo '<td colspan="6" class="text-center">Chưa có nhân viên</td>';
		      		}
		      	?>
		    </tbody>
		</table>
	</div>
</div>
<!-- end display staff -->


<!-- Modal add staff -->
<div class="modal fade" id="AddStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Thêm nhân viên</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên nhân viên<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="TenNV" id="TenNV" placeholder="Nhập tên nhân viên" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Giới Tính</label>
	        		</div>
	        		<div class="col-md-8">
						<select name="GioiTinh" class="form-control" id="GioiTinh">
							<option value="0">Nữ</option>
							<option value="1" selected="selected" >Nam</option>
						</select>
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>SDT<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="SDT" id="SDT" placeholder="Nhập SDT" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Email<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="Email" id="Email" placeholder="Nhập Email" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Địa chỉ<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="DiaChi" id="DiaChi" placeholder="Nhập địa chỉ" class="form-control">
	        		</div>
	        	</div>

	      	</div>

	      	<div class="modal-footer">
	        	<button type="button" onclick="add_staff()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end modal staff -->

<!-- Modal edit staff -->
<div class="modal fade" id="EditStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Thêm nhân viên</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
				<!-- set value ẩn :3 -->
				<input type="hidden" name="value_hidden_manv">
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên nhân viên<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="TenNV_edit" id="TenNV_edit" placeholder="Nhập tên nhân viên" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Giới Tính</label>
	        		</div>
	        		<div class="col-md-8">
						<select name="GioiTinh_edit" class="form-control" id="GioiTinh_edit">
							<option value="0">Nữ</option>
							<option value="1" selected="selected" >Nam</option>
						</select>
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>SDT<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="SDT_edit" id="SDT_edit" placeholder="Nhập SDT" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Email<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="Email_edit" id="Email_edit" placeholder="Nhập Email" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Địa chỉ<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="DiaChi_edit" id="DiaChi_edit" placeholder="Nhập địa chỉ" class="form-control">
	        		</div>
	        	</div>
				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Mã tài khoản</label>
	        		</div>

					<!-- sửa -->
	        		<div class="col-md-8">
	        			<select class="form-control" id="maTK" name="maTK">
	        				<option value="0">Chọn mã tài khoản </option>
	        			<?php
						// include("connection.php");
						// include("dbConfig.php");
			        		$selectStaff = "SELECT matk
											from taikhoan
											where matk not in(select matk from nhanvien)";
				      		$resultStaff = mysqli_query($connect,$selectStaff);
				      		if(mysqli_num_rows($resultStaff)>0){
				      			while ($rowStaff = mysqli_fetch_array($resultStaff)) {?>
				      					<option value="<?php echo $rowStaff['matk']; ?>"><?php echo $rowStaff['matk'];?></option>
						<?php }
							}
		      			?>
		      			</select>
	        		</div>
					<!-- đóng -->
	        	</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" onclick="save_edit_staff()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end edit staff -->

<!-- Modal add account -->
<div class="modal fade" id="AddAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Thêm tài khoản</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>


	      	<div class="modal-body">

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên đăng nhập<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="TenDN" id="TenDN" placeholder="Nhập Tên đăng nhập" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Mật khẩu<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="MatKhau" id="MatKhau" placeholder="Nhập mật khẩu" class="form-control">
	        		</div>
	        	</div>


				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Vai trò</label>
	        		</div>
	        		<div class="col-md-8">
						<select name="VaiTro" class="form-control" id="VaiTro">
							<option value="1">Quản lý</option>
							<option value="0" selected="selected" >Nhân Viên</option>
						</select>
	        		</div>
	        	</div>

	      	</div>

	      	<div class="modal-footer">
	        	<button type="button" onclick="add_account()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end modal add account -->