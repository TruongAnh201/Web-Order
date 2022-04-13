<?php
    $sql="delete from khachhang where MaKH =" .$_GET['delete_id'];
    mysqli_query($connect,$sql);
?>