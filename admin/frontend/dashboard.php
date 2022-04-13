<?php
	include('../../configs/dbConfig.php');
	$today = date("Y/m/d"); // lấy ngày hiện tại
?>
<div class="row">
	<div class="col-md-12">
		<h3 class="dashboard-title">TỔNG QUAN KẾT QUẢ BÁN HÀNG HÔM NAY</h3>
	</div>
	<div class="col-md-3">
		<div class="resport-box resport-blue">
			<div class="resport-icon">
				<i class="fa fa-usd" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<?php
					// lấy hóa đơn đã thanh toán hôm nay
					$sql_daThanhToanHomNay = "select count(hoadon.maHoaDon) as'soHoaDonThanhToan',sum(hoadon.tongTien) as'tongTien' from hoadon,orders where hoadon.maHoaDon=orders.maHoaDon and ngayThanhToan='$today';";
					$result_daThanhToanHomNay= mysqli_query($connect,$sql_daThanhToanHomNay);
					$row_daThanhToanHomNay =mysqli_fetch_assoc($result_daThanhToanHomNay);
					// lấy hóa đơn chưa thanh toán hôm qua
					$sql_daThanhToanHomQua="select sum(hoadon.tongTien) as'tongTien' from hoadon,orders where hoadon.maHoaDon=orders.maHoaDon and ngayThanhToan= SUBDATE('$today', 1);";
					$result_daThanhToanHomQua= mysqli_query($connect,$sql_daThanhToanHomQua);
					$row_daThanhToanHomQua =mysqli_fetch_assoc($result_daThanhToanHomQua);
				?>
				<p><?php echo $row_daThanhToanHomNay['soHoaDonThanhToan'];?> hóa đơn đã thanh toán</p>
				<h4><?php echo number_format($row_daThanhToanHomNay['tongTien']);?> đ</h4>
				<span>Hôm qua <?php echo number_format($row_daThanhToanHomQua['tongTien']);?> đ</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="resport-box resport-green">
			<div class="resport-icon">
				<i class="fa fa-pencil" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<?php
					// lấy số lượng hóa đơn
					$sql_chuaThanhToanHomNay = "select count(orders.maOrder) as'soHoaDonChuaThanhToan' from orders where orders.trangThaiThanhToan='0'  and ngayThem='$today' ;";
					$result_chuaThanhToanHomNay= mysqli_query($connect,$sql_chuaThanhToanHomNay);
					$row_chuaThanhToanHomNay =mysqli_fetch_array($result_chuaThanhToanHomNay);
					// lấy tổng tiền
					$sql_tongTien="select sum(orderdetail.tongTien) as'tongTien' from orders,orderdetail where orders.maOrder=orderdetail.maOrder  and orders.trangThaiThanhToan='0'  and ngayThem='$today';";
					$result_tongTien= mysqli_query($connect,$sql_tongTien);
					$row_tongTien =mysqli_fetch_array($result_tongTien);
					// tiền chưa thanh toán hôm qua
					$sql_tongTien1="select sum(orderdetail.tongTien) as'tongTien' from orders,orderdetail where orders.maOrder=orderdetail.maOrder  and orders.trangThaiThanhToan='0'  and ngayThem=SUBDATE('$today', 1);";
					$result_tongTien1= mysqli_query($connect,$sql_tongTien1);
					$tongTien=0;
					// nếu có bàn mà chưa thanh toán từ hôm qua thì gán lại giá trị.
					if(mysqli_num_rows($result_tongTien1)>0)
					{
						$row_tongTien1 =mysqli_fetch_array($result_tongTien1);
						$tongTien=$row_tongTien1['tongTien'];
					}
				?>
				<p><?php echo $row_chuaThanhToanHomNay[0]; ?> hóa đơn đang phục vụ</p>
				<h4><?php echo number_format($row_tongTien[0]) ?> đ </h4>
				<span>Hôm qua <?php echo number_format($tongTien);  ?> hóa đơn</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="resport-box resport-red">
			<div class="resport-icon">
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<?php
					// lấy số khách hàng có mã hôm nay
					$sql_quality_today="select count(maKH)as'soLuong' from orders where ngaythem='$today' and maKH !=0;";
					$result_today=mysqli_query($connect,$sql_quality_today);
					// lấy số khách hàng có mã hôm qua
					$sql_quality_yesterday="select count(maKH)as'soLuong' from orders where ngaythem= SUBDATE('$today',1) and maKH !=0;";
					$result_yesterday=mysqli_query($connect,$sql_quality_yesterday);
					// khởi tạo biến lưu và kiểm tra kết quả trả về
					$quality_today=0;
					$quality_yesterday=0;
					if(mysqli_num_rows($result_today)>0)
					{
						$result=mysqli_fetch_assoc($result_today);
						$quality_today=$result['soLuong'];
					}
					if(mysqli_num_rows($result_yesterday)>0)
					{
						$result=mysqli_fetch_assoc($result_yesterday);
						$quality_yesterday=$result['soLuong'];
					}
				?>
				<p>Khách hàng có mã</p>
				<h4><?php echo $quality_today; ?> <span style="font-size: 17px;">khách hàng</span></h4>
				<span>Hôm qua <?php echo $quality_yesterday; ?> khách hàng</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="resport-box resport-red">
			<div class="resport-icon">
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
			<?php
					// lấy số khách hàng có mã hôm nay
					$sql_quality_today="select count(maKH)as'soLuong' from orders where ngaythem='$today' and maKH =0;";
					$result_today=mysqli_query($connect,$sql_quality_today);
					// lấy số khách hàng có mã hôm qua
					$sql_quality_yesterday="select count(maKH)as'soLuong' from orders where ngaythem= SUBDATE('$today',1) and maKH =0;";
					$result_yesterday=mysqli_query($connect,$sql_quality_yesterday);
					// khởi tạo biến lưu và kiểm tra kết quả trả về
					$quality_today=0;
					$quality_yesterday=0;
					if(mysqli_num_rows($result_today)>0)
					{
						$result=mysqli_fetch_assoc($result_today);
						$quality_today=$result['soLuong'];
					}
					if(mysqli_num_rows($result_yesterday)>0)
					{
						$result=mysqli_fetch_assoc($result_yesterday);
						$quality_yesterday=$result['soLuong'];
					}
				?>
				<p>Khách hàng không có mã</p>
				<h4><?php echo $quality_today; ?> <span style="font-size: 17px;">khách hàng</span></h4>
				<span>Hôm qua <?php echo $quality_yesterday; ?> khách hàng</span>
			</div>
		</div>
	</div>
</div>
<div class="row content-chart-colum">
	<div class="col-md-8">
		<canvas id="chart-colum" style="width:100%;max-width:820px ;min-height:500px;"></canvas>
	</div>
	<div class="col-md-4" style="width:100%;">
			<div class="row ">
				<div class="pie-chart">
					<div id="pieChart" style="width:100%;height:100%;"></div>
				</div>
			</div>
			<div class="row">
				<div class="doughnut-chart">
					<canvas id="doughnutChart" style="width:100%;height:100%"></canvas>
				</div>
			</div>
	</div>
</div>
<!-- chart colum -->
<script >
		<?php
		$sql_chart_colum="select * from hoadon order by maHoaDon DESC limit 9; ";
		$result_chart_colum=mysqli_query($connect,$sql_chart_colum);
		$arr_ngay= array();
		$arr_tongTien=array();
		$arr_color=array(); // mảng lưu trữ color
		while($rows_chart_colum=mysqli_fetch_assoc($result_chart_colum))
		{
			$rand_color = "#".substr(md5(rand()), 0, 6);// random color with md5 function
			array_push($arr_ngay,$rows_chart_colum['ngayThanhToan']);
			array_push($arr_tongTien,$rows_chart_colum['tongTien']);
			array_push($arr_color,$rand_color);
		}
		?>
		var xValues=<?php echo json_encode($arr_ngay); ?>;
		var yValues=<?php echo json_encode($arr_tongTien); ?>;
		var barColors=<?php echo json_encode($arr_color); ?>; // làm như này để gán array php sang javascript nè :)

		new Chart("chart-colum", {
		type: "bar",
		data: {
			labels: xValues,
			datasets: [{
			backgroundColor: barColors,
			data: yValues
			}]
		},
		options: {
			legend: {display: false},
			title: {
			display: true,
			text: "Hóa đơn thanh toán gần đây"
			}
		}
		});
	</script>
<!-- end chart colum -->
<!-- chart pie -->
<script>
	// mảng lưu trữ
	//alert(arr_ten[0]);

	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Tên sản phẩm', 'Đơn giá'],
			<?php
			$sql_chart_pie="select count(orderdetail.maSanPham)as'soLuong', tenSanPham from orderdetail,sanPham where orderdetail.maSanPham=sanPham.maSanPham group by orderdetail.maSanPham order by soLuong desc limit 5 ;";
			$result_chart_pie=mysqli_query($connect,$sql_chart_pie);
			while($rows_chart_pie=mysqli_fetch_assoc($result_chart_pie))
			{
				echo"['".$rows_chart_pie['tenSanPham']."',".$rows_chart_pie['soLuong']."],";
			} ?>
		]);
		var options = {
		title:'Sản phẩm được sử dụng nhiều nhất'
	};

	var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
  	chart.draw(data, options);
}
</script>
<!-- end chart pie-->
<!-- doughnut chart -->
<script>
	<?php
		$sql_chart_doughnut="select count(orders.maBan)as'soLuong' ,ban.tenban from ban,orders where ban.maban=orders.maBan and ngaythem between SUBDATE('$today',1) and '$today' group by orders.maBan order by count(maKH) DESC limit 5;";
		$result_chart_doughnut=mysqli_query($connect,$sql_chart_doughnut);
		$arr_tenBan= array();
		$arr_soLuong=array();
		$arr_color=array(); // mảng lưu trữ color
		while($rows_chart_doughnut=mysqli_fetch_assoc($result_chart_doughnut))
		{
			$rand_color = "#".substr(md5(rand()), 0, 6);// random color with md5 function
			array_push($arr_tenBan,$rows_chart_doughnut['tenban']);
			array_push($arr_soLuong,$rows_chart_doughnut['soLuong']);
			array_push($arr_color,$rand_color);
		}
		?>
		var xValues=<?php echo json_encode($arr_tenBan); ?>;
		var yValues=<?php echo json_encode($arr_soLuong); ?>;
		var barColors=<?php echo json_encode($arr_color); ?>; // làm như này để gán array php sang javascript nè :)
	new Chart("doughnutChart", {
	type: "doughnut",
	data: {
		labels: xValues,
		datasets: [{
		backgroundColor: barColors,
		data: yValues
		}]
	},
	options: {
		title: {
		display: true,
		text: "Phòng được sử dụng nhiều nhất"
		}
	}
	});
</script>
<!-- end doughnut chart -->