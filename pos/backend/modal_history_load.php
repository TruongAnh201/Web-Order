<?php
include_once('../../configs/dbConfig.php');
?>
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
		    <thead  class="table-primary">
			    <tr>
					<th class="width-35"></th>
			      	<th>ID</th>
					<th>Tên bàn bàn</th>
					<th>Trạng thái</th>
					<th>Tổng tiền</th>

			    </tr>
		    </thead>
		    <tbody>
		      	<?php
		      		// include('connection.php');
		      		$sql = " SELECT orderdetail.maorder,tenban,orders.trangThaiThanhToan,sum(orderdetail.tongTien)as'tongTien'
					  	from ban,orders,sanpham,orderdetail
					  	where ban.maban=orders.maban and orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham
						group by(orderdetail.maorder)
						order by orderdetail.maorder desc;";
		      		$result = mysqli_query($connect,$sql);
		      		if(mysqli_num_rows($result)>0){
		      			while ($row = mysqli_fetch_array($result)) {
							  ?>
		      				<tr>
							<td class="width-35" data-toggle="collapse" data-target="#collapse-<?php echo $row['maorder']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['maorder']; ?>">
                        		<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
							</td>
		      					<td><?php echo $row['maorder']; ?></td>
								<td><?php echo $row['tenban']; ?></td>
		      					<td><?php if( $row['trangThaiThanhToan']==0){ echo "Chưa thanh toán";} else{ echo "Đã thanh toán";} ?></td>
		      					<td><?php echo $row['tongTien']; ?></td>
							</tr>
							<tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['maorder']; ?>">
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
											$maOrder= $row['maorder'];
			                        		$selectdetail = "SELECT orderdetail.masanpham,tensanpham,soluong,donvitinh,gia,orders.maKh
                                            from orders,sanpham,orderdetail
                                            where orders.maorder=orderdetail.maorder and orderdetail.masanpham=sanpham.masanpham
                                            and orderdetail.maorder= '$maOrder'";
			                        		$resultdetail = mysqli_query($connect,$selectdetail);
			                        		while ($rowdetail = mysqli_fetch_array($resultdetail)) {
												$gia= $rowdetail['gia'];
												if($rowdetail['maKh']!=0)
												{
													$gia= $rowdetail['gia'] -(( $rowdetail['gia']*20)/100);
												} ?>
			                        			<tr>
			                        				<td><?php echo $rowdetail['masanpham']; ?></td>
			                        				<td><?php echo $rowdetail['tensanpham']; ?></td>
			                        				<td><?php echo $rowdetail['soluong']; ?></td>
			                        				<td><?php echo $rowdetail['donvitinh']; ?></td>
			                        				<td><?php echo $gia; ?></td>
                                                    <td><?php echo $gia*$rowdetail['soluong']; ?></td>
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
		      		}else{
		      			echo '<td colspan="6" class="text-center">Chưa có order</td>';
		      		}
		      	?>
		    </tbody>
		</table>
		</div>