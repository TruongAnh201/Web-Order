<?php
	 session_start();
	 if(isset($_SESSION['uid'])&& isset($_SESSION['role'])){
	include_once('../configs/dbConfig.php');
	require_once('frontend/header.php');
	?>
	<div class="container-fluid">
		<div class="row content">
			<!-- load tables -->
			<div class="col-md-6 content-table" id="table-list" style="padding-right: 30px;" >
				<div class="row list-filter">
					<div class="col-md list-filter-content">
						<?php
								$area = "SELECT * FROM tang";
								$resultarea = mysqli_query($connect,$area);
								?><button style="width:78px" class="btn btn-primary" onclick="cate_table_load(0)">Tât cả</button><?php
								while ($rowarea = mysqli_fetch_array($resultarea)) { ?>
									<button class="btn btn-primary" onclick="cate_table_load(<?php echo $rowarea['matang']; ?>)" ><?php echo $rowarea['tentang']; ?></button>

							<?php }
							?>
					</div>
				</div>
				<div class="row table-list">
					<div class="col-md table-list-content">
						<ul>
							<?php
								$table = "SELECT * FROM ban";
								$resultTable = mysqli_query($connect,$table);
								while ($rowtable = mysqli_fetch_array($resultTable)) { ?>
									<li <?php if($rowtable['trangthai']==1){echo 'class="tb-active"';}?> id="<?php echo $rowtable['maban']; ?>" onclick="order_table_load(<?php echo $rowtable['maban'];?>)"><?php echo $rowtable['tenban']; ?></li>
							<?php }
							?>
						</ul>
					</div>
				</div>
			</div>
			<!-- load product -->
			<div class="col-md-6" id="pos" hidden="true">
				<div class="row list-filter">
					<div class="col-md list-filter-content">
						<button class="btn btn-primary active" onclick="cate_product_load(0);">Tất Cả</button>
						<?php
							$cateMenu = "SELECT * FROM loaiSanPham";
							$resultCate = mysqli_query($connect,$cateMenu);
							while ($rowCate = mysqli_fetch_array($resultCate)) { ?>
								<button class="btn btn-primary active" onclick="cate_product_load(<?php echo $rowCate['maLoai'];?>)">
									<?php echo $rowCate['tenLoai']; ?>
								</button>
							<?php }
						?>
					</div>
				</div>
				<div class="row product-list">
					<div class="col-md product-list-content">
						<ul>
							<?php
								$sqlMenu = "SELECT * FROM sanpham order by maSanPham ASC;";
								$resultMenu = mysqli_query($connect,$sqlMenu);
								while ($rowMenu = mysqli_fetch_array($resultMenu)) { ?>
									<li><a href="#" onclick="add_order('<?php echo $rowMenu['maSanPham'];?>')" title="<?php echo $rowMenu['tenSanPham'];?>">
									<div class="img-product">
										<img src="../public/images/<?php echo $rowMenu['hinhAnh']; ?>">
									</div>
									<div class="product-info">
										<span class="product-name"><?php echo $rowMenu['tenSanPham'];?></span><br>
										<strong><?php echo number_format($rowMenu['gia'],0);?></strong>
									</div>
									</a>
									</li>
							<?php }
							?>

						</ul>
					</div>
				</div>
			</div>
			<!-- load table order -->
			<div class="col-md-6 content-listmenu" id="content-listmenu">
				<div  class="row bill-detail">
					<div class="col-md-12 bill-detail-content">
						<table class="table table-bordered">
						  <thead class="thead-light">
						    <tr>
						      <th scope="col">Mã</th>
						      <th scope="col">Tên sản phẩm</th>
						      <th  style="max-width:130px;" scope="col">Số lượng</th>
						      <th style="max-width:90px;" scope="col">Gía bán</th>
						      <th scope="col">Thành Tiền</th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody id="pro_search_append">

						  </tbody>
						</table>
					</div>
				</div>
				<!-- control -->
				<div class="row" id="bill-info">
					<div class="col-md-2 table-infor">

					</div>
					<div class="col-md-5">
						<div class="col-md-12 p-0 input-group">
							<input type="text" id="customer-infor" placeholder="Nhập mã khách hàng(nếu có)" class="form-control">
							<div class="input-group-append">
    							<button class="btn btn-primary" data-toggle="modal" data-target="#ModelAddcustomer"><i class="fa fa-plus" aria-hidden="true"></i></button>
  							</div>
							<div id="result-customer"></div>
							<span class="del-customer"></span>
						</div>
					</div>
					<div class="col-md-5">
						<select class="form-control">
							<option value="1">Bảng giá chung</option>
						</select>
					</div>
				</div>
				<div class="row bill-action">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12 p-1">
								<textarea class="form-control" id="note-order" placeholder="Nhập ghi chú hóa đơn" rows="3"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-xs-6 p-1">
								<button type="button" class="btn-print" onclick="btn_back()"><i class="fa fa-credit-card" aria-hidden="true"></i> Trở lại (F1)</button>
							</div>
							<div class="col-md-6 col-xs-6 p-1">
								<button type="button" class="btn-pay" onclick="detail_payment_load()" data-toggle="modal" data-target="#ModalPayment" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Thanh toán (F2)</button>
							</div>
						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="row form-group">
							<label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
							<div class="col-md-8">
								<input type="text" value="0" class="form-control total-pay" disabled="disabled">
							</div>
						</div>
						<div class="row form-group">
							<label class="col-form-label col-md-4"><b>Khách Đưa</b></label>
							<div class="col-md-8">
								<input type="text" class="form-control customer-pay" value="0" placeholder="Nhập số điền khách đưa">
							</div>
						</div>
						<div class="row form-group">
							<label class="col-form-label col-md-4"><b>Tiền thừa</b></label>
							<div class="col-md-8 excess-cash">
								0
							</div>
						</div>
 					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- chỗ hiển thị thông báo -->
<div class="alert-login">
</div>
<!-- modal xác nhận thanh toán -->
<div  class="modal fade bd-example-modal-lg" id="ModalPayment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content" id="content_payment" >
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLongTitle">Tổng hóa đơn</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div  class="modal-body">
			  <div  class="row bill-detail-payment">
					<div class="col-md-12 bill-detail-content-payment">
						<table class="table table-bordered">
						  <thead class="thead-light">
						    <tr>
						      <th scope="col">Mã</th>
						      <th scope="col">Tên sản phẩm</th>
						      <th  style="max-width:140px;" scope="col">Số lượng</th>
						      <th style="max-width:90px;" scope="col">Gía bán</th>
						      <th scope="col">Thành Tiền</th>
						    </tr>
						  </thead>
						  <tbody id="pro_search_append_payment">

						  </tbody>
						</table>
					</div>
				</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" onclick="payment()" class="btn btn-success" data-dismiss="modal"><i class="fa fa-floppy-o" aria-hidden="true"></i> Xác nhận</button>
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Trở lại</button>
	      	</div>
	    </div>
  	</div>
</div>
</body>
</html>
<?php
	 }
	 else{
		 header('location:../login.php');
	 }
?>
