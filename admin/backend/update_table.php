<?php
	include('../../configs/dbConfig.php');
    if(isset($_POST['id']) && isset($_POST['tenBan']) && isset($_POST['maTang']) && isset($_POST['trangThai']) && isset($_POST['ghiChu']))
{
    $id=$_POST['id'];
    $tenBan=$_POST['tenBan'];
    $maTang=$_POST['maTang'];
    $trangThai=$_POST['trangThai'];
    $ghiChu=$_POST['ghiChu'];
    $sql_Update="UPDATE webapporder.ban SET tenban = '$tenBan',ghichu = '$ghiChu', trangthai = '$trangThai', matang='$maTang'  WHERE (maban = '$id');"; // sql update
    $sql_check="select * from ban where tenban='$tenBan'"; // check bàn trùng tên

    $result_check=mysqli_query($connect,$sql_check);

    if(mysqli_num_rows($result_check)>0){
        while($fetch_row = mysqli_fetch_array($result_check))
        {
            if($fetch_row['maban'] == $id)
            {
                $result_update=mysqli_query($connect,$sql_Update);
                if(isset($result_update))
                {
                    echo "1";
                }
            }
            else{
                echo "0";
            }

        }


    }
    else{
        $result_update=mysqli_query($connect,$sql_Update);
        if(isset($result_update))
        {
            echo "1";
        }
    }
}
else{
    echo "0";

}
?>