<?php
include_once('../../configs/dbConfig.php');
if(isset($_POST['id_table'])){

    $id_table= $_POST['id_table'];

    $sql = "SELECT * FROM ban WHERE maban='$id_table'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)<0){
        echo "0";

    }else{
       $row=mysqli_fetch_assoc($result);
       echo $row['tenban'];
    }
}


?>