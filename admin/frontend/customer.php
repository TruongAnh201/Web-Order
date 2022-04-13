<?php
	include_once('../../configs/dbConfig.php');
	if(isset($_GET['delete_id']))
{
	  include_once ('../backend/delete_customer.php');
	  echo "<script>$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');</script>";
}
?>

<!-- display customer -->
<div class="row">
	<div class="col-md-5">
		<h2>Danh sách khách hàng</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" onclick="" data-toggle="modal" data-target="#AddCustomerModal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm khách hàng</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-5 form-group">
		<input type="text" name="txtCustomer" id="key" placeholder="Nhập mã hoặc tên khách hàng" class="form-control">
	</div>

	<div class="col-md-2 form-group">
		<button class="btn btn-primary" onclick="search_customer()"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
</div>
<div class="row content-product">
	<div class="col-md-12">
		<div class="scroll-table-menu">
		<table class="table table-striped table-bordered" id="table_sort">
		    <thead  class="table-primary">
			    <tr>

			      	<th onclick="sort_0()"  class="hover-header-table" style="width: 100px;">Mã KH</th>
			        <th onclick="sort_1()"  class="hover-header-table" >Tên khách hàng</th>
					<th>Số điện thoại</th>
			        <th onclick="sort_3()"  class="hover-header-table">Địa chỉ</th>
			        <th colspan="2"></th>
			    </tr>
		    </thead>
		    <tbody id="tbody-cus">
		      	<?php
		      		// include('connection.php');

					$name = "";
					$sql = "";
					if(!empty($_REQUEST['name'])){
						$name = $_REQUEST['name'];
					}
					if(!empty($name)){
						$sql="select * from webapporder.khachhang where TenKH like '%$name%'";
					}
					else{
						$sql = "SELECT * FROM khachhang";
					}
		      		$result = mysqli_query($connect,$sql);
		      		if(mysqli_num_rows($result)>0){
		      			while ($row = mysqli_fetch_array($result)) {
							  if($row['MaKH']!=0)
							  {
							  ?>
		      				<tr>
		      				<td><?php echo $row['MaKH']; ?></td>
		      				<td><?php echo $row['TenKH']; ?></td>
							<td><?php echo $row['SDT']; ?></td>
							<td><?php echo $row['DiaChi']; ?></td>
		      				<td style="max-width:60px;"><button id="editCustomer" class="btn btn-warning color-button-white" value="<?php echo $row[0]; ?> " > Chỉnh sửa</button></td>
							<td style =" max-width:60px; align-items: center; text-align: center;"><button  class="btn btn-danger color-button-white" onclick="delete_id_Customer('<?php echo $row[0]; ?>')" >Xóa</button></td>
		      				</tr>
							<?php
		      			}
					}
		      		}else{
		      			echo '<td colspan="5" class="text-center">Chưa có khách hàng</td>';
		      		}
		      	?>
		    </tbody>
		</table>
		</div>
	</div>
</div>
<!-- end display customer -->


<!-- Modal add customer -->
<div class="modal fade" id="AddCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Thêm khách hàng</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên khách hàng<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="TenKH" id="TenKH" placeholder="Nhập tên khách hàng" class="form-control">
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
	        			<label>Địa chỉ<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="DiaChi" id="DiaChi" placeholder="Nhập địa chỉ" class="form-control">
	        		</div>
	        	</div>

	      	</div>

	      	<div class="modal-footer">
	        	<button type="button" onclick="add_customer()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end modal customer -->

<!-- Modal edit customer -->
<div class="modal fade" id="EditCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Thêm khách hàng</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
				<!-- set value ẩn :3 -->
				<input type="hidden" name="value_hidden_makh">

	        	<div class="row form-group">
	        		<div class="col-md-4">
	        			<label>Tên khách hàng<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="TenKH_edit" id="TenKH_edit" placeholder="Nhập tên khách hàng" class="form-control">
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
	        			<label>Địa chỉ<span style="color:red;">(*)</span></label>
	        		</div>
	        		<div class="col-md-8">
	        			<input type="text" name="DiaChi_edit" id="DiaChi_edit" placeholder="Nhập địa chỉ" class="form-control">
	        		</div>
	        	</div>


	      	</div>

	      	<div class="modal-footer">
	        	<button type="button" onclick="save_edit_customer()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
	    </div>
  	</div>
</div>
<!-- end edit customer -->