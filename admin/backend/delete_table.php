<?php
	include('../../configs/dbConfig.php');
    if(isset($_POST['delete_id']))
{
    $sql="delete from ban where maban =" .$_POST['delete_id'];
    $result=mysqli_query($connect,$sql);
    if(isset($result))
    {
        echo "1";
    }
    else{
        echo"0";
    }
}
else{
    echo "0";
}
?>