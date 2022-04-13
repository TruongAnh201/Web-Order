<?php
	include('../../configs/dbConfig.php');
    if (isset($_POST['key'])) {
    $key = $_POST['key'];
    if($key!="")
    {
    $sql = "select distinct * from khachhang where MaKH like '%$key' or TenKH like '%$key';";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['MaKH'] != 0) {
?>
                <tr>
                    <td><?php echo $row['MaKH']; ?></td>
                    <td><?php echo $row['TenKH']; ?></td>
                    <td><?php echo $row['SDT']; ?></td>
                    <td><?php echo $row['DiaChi']; ?></td>
                    <td style="max-width:60px;"><button id="editCustomer" class="btn btn-warning color-button-white" value="<?php echo $row[0]; ?> "> Chỉnh sửa</button></td>
                    <td style=" max-width:60px; align-items: center; text-align: center;"><button class="btn btn-danger color-button-white" onclick="delete_id_Customer('<?php echo $row[0]; ?>')">Xóa</button></td>
                </tr>
<?php
            }
        }
    } else {
        echo '<td colspan="5" class="text-center">Chưa có khách hàng</td>';
    }
}else{
    $sql = "select * from khachhang;";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['MaKH'] != 0) {
?>
                <tr>
                    <td><?php echo $row['MaKH']; ?></td>
                    <td><?php echo $row['TenKH']; ?></td>
                    <td><?php echo $row['SDT']; ?></td>
                    <td><?php echo $row['DiaChi']; ?></td>
                    <td style="max-width:60px;"><button id="editCustomer" class="btn btn-warning color-button-white" value="<?php echo $row[0]; ?> "> Chỉnh sửa</button></td>
                    <td style=" max-width:60px; align-items: center; text-align: center;"><button class="btn btn-danger color-button-white" onclick="delete_id_Customer('<?php echo $row[0]; ?>')">Xóa</button></td>
                </tr>
<?php
            }
        }
    } else {
        echo '<td colspan="5" class="text-center">Chưa có khách hàng</td>';
    }
}
} else {
    echo "0";
}   ?>