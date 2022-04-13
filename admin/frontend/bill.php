<div class="row customer-act act">
	<div class="col-md-5">
		<h2>Danh sách hóa đơn</h2>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-4 form-group">
		<input type="text" id="search-hoaDon" class="form-control" placeholder="Nhập mã hóa đơn để tìm kiếm">
		<div id="result-order-drop">
		</div>
	</div>
	<div class="col-md-4 p-0">
		<div class="input-group">
			<input type="date" id="tuNgay" class="form-control">
	        <div class="input-group-prepend">
	          <span class="input-group-text" id="inputGroupPrepend">Đến</span>
	        </div>
        	<input type="date" id="denNgay" class="form-control" aria-describedby="inputGroupPrepend">
      	</div>
	</div>
	<div class="col-md-1 form-group">
		<button class="btn btn-primary" onclick="search_hoaDon()"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<table class="table table-bordered" id="table_sort">
		<!-- table-child-event -->
            <thead class="table-primary">
                <tr>
                	<th class="width-35"></th>
                  	<th onclick="sort_1()"  class="hover-header-table">Mã Hóa Đơn</th>
					<th onclick="sort_2()"  class="hover-header-table">Thời gian</th>
                  	<th onclick="sort_3()"  class="hover-header-table">Tổng tiền</th>
                  	<th>Trạng thái</th>
                </tr>
            </thead>
            <tbody id="tbody-hoaDon">
            <?php
	include('../../configs/dbConfig.php');

                $sql = "SELECT hoadon.mahoadon,giothanhtoan,hoadon.tongtien,tenban,tennv,tenkh,ngaythanhtoan
                from orders,orderdetail,ban,nhanvien,khachhang,hoadon
                where orders.maorder=orderdetail.maorder and ban.maban=orders.maban and nhanvien.manv=orders.manv and khachhang.makh=orders.makh and hoadon.mahoadon=orders.mahoadon
				group by(hoadon.mahoadon)
				order by hoadon.mahoadon desc";
               $result = mysqli_query($connect,$sql);

               if(mysqli_num_rows($result)>0){
                   while ($row = mysqli_fetch_array($result)) {
                       ?>
                        <tr class="not-detail">
                        	<td class="width-35" data-toggle="collapse" data-target="#collapse-<?php echo $row['mahoadon']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['mahoadon']; ?>">
                        		<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
                        	</td>
	                        <td><?php echo 'HD'.$row['mahoadon']; ?></td>
	                        <td><?php echo $row['giothanhtoan']." / ".$row['ngaythanhtoan']; ?></td>
							<td><?php echo $row['tongtien']; ?></td>
	                        <td>Đã hoàn thành</td>
                        </tr>
                        <tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['mahoadon']; ?>">
                        	<td colspan="8">
                        		<ul class="nav nav-tabs" id="myTab" role="tablist">
								  	<li class="nav-item">
								    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chi tiết</a>
								  </li>
								</ul>
								<div class="tab-content" id="myTabContent">
								  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								  	<div class="row">
	                        			<div class="col-md-4">
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Mã hóa đơn
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['mahoadon']; ?></strong>
	                        					</div>
	                        				</div>
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Phòng/Bàn
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['tenban']; ?></strong>
	                        					</div>
	                        				</div>
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Thời gian
	                        					</label>
	                        					<div class="col-md-8">
	                        						<input type="text" name="" disabled="disabled" class="form-control" value="<?php echo $row['giothanhtoan']; ?>">
	                        					</div>
	                        				</div>
	                        			</div>
	                        			<div class="col-md-4">
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Nhân Viên
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['tennv']; ?></strong>
	                        					</div>
	                        				</div>
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Khách hàng
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['tenkh']; ?></strong>
	                        					</div>
	                        				</div>
	                        			</div>
										<div class="col-md-4">
											<div class="row form-group">
	                        					<label class="col-md-4">
												Ngày thanh toán
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['ngaythanhtoan']; ?></strong>
	                        					</div>
	                        				</div>
	                        			</div>
                        			</div>
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
											$mahd= $row['mahoadon'];
			                        		$selectdetail = "SELECT orderdetail.masanpham,tensanpham,soluong,donvitinh,gia,hoadon.tongtien
                                            from orders,sanpham,orderdetail,hoadon
                                            where orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham and orders.mahoadon= hoadon.mahoadon
                                            and hoadon.mahoadon= '$mahd'";
			                        		$resultdetail = mysqli_query($connect,$selectdetail);
			                        		while ($rowdetail = mysqli_fetch_array($resultdetail)) { ?>
			                        			<tr>
			                        				<td><?php echo $rowdetail['masanpham']; ?></td>
			                        				<td><?php echo $rowdetail['tensanpham']; ?></td>
			                        				<td><?php echo $rowdetail['soluong']; ?></td>
			                        				<td><?php echo $rowdetail['donvitinh']; ?></td>
			                        				<td><?php echo $rowdetail['gia']; ?></td>
                                                    <td><?php echo $rowdetail['gia']*$rowdetail['soluong']; ?></td>
			                        			</tr>
			                        		<?php }
			                        		?>
							            </tbody>
							        </table>
								</div>
								</div>
	                       	</td>
	                    </tr>
                    <?php }
                }else{
                    echo '<td colspan="6" class="text-center">Chưa có thực đơn nào</td>';
                }
            ?>
            </tbody>
        </table>
	</div>
</div>