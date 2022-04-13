<?php
	include('../../configs/dbConfig.php');
    $tuNgay=$_POST['tuNgay'];
$denNgay=$_POST['denNgay'];
$sql = "select ngayThanhToan,sum(tongTien)as'tongTien' from hoadon where ngayThanhToan between ('$tuNgay') and('$denNgay') group by ngayThanhToan;";
$result = mysqli_query($connect, $sql);
$arrNgay = array();
$arrTien = array();
$arr_color = array(); // mảng lưu trữ color
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_array($result)) {
        array_push($arrNgay, $rows['ngayThanhToan']);
        array_push($arrTien, $rows['tongTien']);
    }
}
?>
<div id="chart_statistical" style="width:100%;max-width:1500px;max-height:630px;"></div>
<script>
    var xArray = <?php echo json_encode($arrNgay); ?>;
    var yArray = <?php echo json_encode($arrTien); ?>;

var data = [{
  x:xArray,
  y:yArray,
  type:"bar"
}];

var layout = {title:"Biểu đồ thống kê"};

Plotly.newPlot("chart_statistical", data, layout);
</script>