<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../public/css/style.css">
	<link rel="stylesheet" type="text/css" href="../public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/font-awesome/css/font-awesome.min.css">
	<script type="text/javascript" src="../public/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="../public/js/clickevent.js"></script> -->
	<script type="text/javascript" src="../public/js/pos.js"></script>
</head>

<body>
	<div class="header-cashier">
		<div class="container-fluid">
			<div class="row ft-tabs">
				<div class="col-md-3">
					<ul class="tabs-list">
						<li><a style="height: 48px;" href="#" class="active" data="listtable">Phòng Bàn</a></li>
						<li><a style="height: 48px;" href="#" data="pos">Thực đơn</a></li>
					</ul>
				</div>
				<div class="col-md-4 cashier-search">
					<input type="text" name="txtnamemenu" id="search-product" placeholder="Nhập tên mặt hàng" class="form-control">
					<div id="result-product-drop">

					</div>
				</div>
				<div class="col-md-5">
					<ul class="nav navbar-nav float-right" style="line-height: 32px;">
						<li class=" dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Xin chào NHÂN VIÊN</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Tài khoản</a>
								<!-- <button type="button" class="btn-load" data-toggle="modal" data-target="#ModalOrder" style="border-style:none;background-color:#fff;padding-left: 20px">Lịch sử orders</button> -->
								<a class="dropdown-item" id="history_order" href="" data-toggle="modal" data-target="#ModalOrders">Lịch sử orders</a>
								<?php if ($_SESSION['role'] == 1) {
									echo " <a class='dropdown-item' href='../index.php'>Trang quản lý</a>";
								} ?>
								<a class="dropdown-item" id="DangXuat" href="">Đăng xuất</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bd-example-modal-lg" id="ModalOrders" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content" id="content_history">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLongTitle" style="color: #307ECC;">Lịch sử order</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="row content-product">
					<div class="col-md-12">
						<div class="scroll-table-menu">
							<table class="table table-striped table-bordered">
								<thead class="table-primary">
									<tr>
										<th class="width-35"></th>
										<th>ID</th>
										<th>Tên bàn bàn</th>
										<th>Trạng thái</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// include('connection.php');
									$sql = "SELECT orderdetail.maorder,tenban,orders.trangThaiThanhToan
					  	from ban,orders,sanpham,orderdetail
					  	where ban.maban=orders.maban and orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham
						group by(orderdetail.maorder)
						order by orderdetail.maorder desc;";
									$result = mysqli_query($connect, $sql);
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_array($result)) {
									?>
											<tr>
												<td class="width-35" data-toggle="collapse" data-target="#collapse-<?php echo $row['maorder']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['maorder']; ?>">
													<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
												</td>
												<td><?php echo $row['maorder']; ?></td>
												<td><?php echo $row['tenban']; ?></td>
												<td><?php if ($row['trangThaiThanhToan'] == 0) {
														echo "Chưa thanh toán";
													} else {
														echo "Đã thanh toán";
													} ?></td>
											</tr>
											<tr class="collapse tr-detail td-detail " id="collapse-<?php echo $row['maorder']; ?>">
												<td colspan="8">
													<ul class="nav nav-tabs" id="myTab" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chi tiết</a>
														</li>
													</ul>
													<table class="table table-striped table-bordered">
														<thead class="table-success">
															<tr>
																<th>Mã Sản phẩm</th>
																<th>Tên sản phẩm</th>
																<th>Số lượng</th>
																<th>ĐVT</th>
																<th>giá bán</th>
																<th>Thành tiền</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$maOrder = $row['maorder'];
															$selectdetail = "SELECT orderdetail.masanpham,tensanpham,soluong,donvitinh,gia
                                            from orders,sanpham,orderdetail
                                            where orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham
                                            and orderdetail.maorder= '$maOrder'";
															$resultdetail = mysqli_query($connect, $selectdetail);
															while ($rowdetail = mysqli_fetch_array($resultdetail)) { ?>
																<tr>
																	<td><?php echo $rowdetail['masanpham']; ?></td>
																	<td><?php echo $rowdetail['tensanpham']; ?></td>
																	<td><?php echo $rowdetail['soluong']; ?></td>
																	<td><?php echo $rowdetail['donvitinh']; ?></td>
																	<td><?php echo $rowdetail['gia']; ?></td>
																	<td><?php echo $rowdetail['gia'] * $rowdetail['soluong']; ?></td>
																</tr>
															<?php }
															?>
														</tbody>
													</table>
						</div>
					</div>
					</td>
					</tr>
			<?php
										}
									} else {
										echo '<td colspan="6" class="text-center">Chưa có order</td>';
									}
			?>
			</tbody>
			</table>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>



	<!--  -->