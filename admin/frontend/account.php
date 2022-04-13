<?php
	include_once('../../configs/dbConfig.php');
	if(isset($_GET['delete_id_Account']))
{
	  include_once ('backend/deleteAccount.php');
	  echo "<script>$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');</script>";
}
?>

<!-- display account -->
<div class="row">
	<div class="col-md-5">
		<h2>Danh sách tài khoản</h2>
	</div>

</div>
<div class="row filter-search">
</div>
<div class="row content-product">
	<div class="col-md-12">
		<div class="scroll-table-menu">
		<table class="table table-striped table-bordered">
		    <thead  class="table-primary">
			    <tr>
                    <th style="width: 100px;">Mã TK</th>
			        <th>Tên đăng nhập</th>
					<th>Mật khẩu</th>
					<th>Vai trò</th>
			        <th colspan="2"></th>
			    </tr>
		    </thead>
		    <tbody>
		      	<?php
		      		// include('connection.php');
		      		// include('dbConfig.php');
		      		$sql = "SELECT * FROM taikhoan";
		      		$result = mysqli_query($connect,$sql);
		      		if(mysqli_num_rows($result)>0){
		      			while ($row = mysqli_fetch_array($result)) {
							  if($row['MaTK']!=0)
							  {
							  ?>
		      				<tr>
                            <td><?php echo $row['MaTK']; ?></td>
		      				<td><?php echo $row['TenDangNhap']; ?></td>
		      				<td><?php echo $row['MatKhau']; ?></td>
                              <td><?php if( $row['VaiTro']==1){ echo "Quản lý";}else { echo"Nhân viên";} ?></td>
		      				<td style="max-width:60px;"><button id="editAccount" class="btn btn-warning color-button-white" value="<?php echo $row[0]; ?> " > Chỉnh sửa</button></td>
							<td style =" max-width:60px; align-items: center; text-align: center;"><button  class="btn btn-danger color-button-white" onclick="delete_id_Account('<?php echo $row[0]; ?>')" >Xóa</button></td>
		      				</tr>
							<?php
		      			}
					}
		      		}else{
		      			echo '<td colspan="6" class="text-center">Chưa có tài khoản</td>';
		      		}
		      	?>
		    </tbody>
		</table>
		</div>
	</div>
</div>
<!-- end display account -->

<!-- Modal edit account -->
<div class="modal fade" id="EditAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
				<input type="hidden" name="value_hidden_matk">
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên đăng nhập<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="TenDN_edit" id="TenDN_edit" placeholder="Nhập tên đăng nhập" class="form-control">
	        		</div>
	        	</div>


				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Mật khẩu<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="MK_edit" id="MK_edit" placeholder="Nhập mật khẩu" class="form-control">
	        		</div>
	        	</div>

				<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Vai trò</label>
	        		</div>
	        		<div class="col-md-8">
						<select name="VaiTro_edit" class="form-control" id="VaiTro_edit">
							<option value="0">Nhân viên</option>
							<option value="1" selected="selected" >Quản lý</option>
						</select>
	        		</div>
	        	</div>



	      	</div>

	      	<div class="modal-footer">
	        	<button type="button" onclick="save_edit_account()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end edit account -->