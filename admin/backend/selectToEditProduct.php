<?php
	include('../../configs/dbConfig.php');
	if(isset($_POST['id']))
{
	$sql="select * from sanpham where maSanPham =trim("."'".$_POST['id']."');";
	$result=mysqli_query($connect,$sql);
	while($row =mysqli_fetch_row($result))
	{
		$arr=array($row[0],$row[1],$row[2],$row[3],$row[5]);
		if($arr==null){
			echo "0";
		}
		else{
			echo json_encode($arr);
			}
	}
}
else{
	echo "0";
}
?>