<?php
    $sql="delete from taikhoan where MaTK =" .$_GET['delete_id_Account'];
    mysqli_query($connect,$sql);
    //  echo "<script>$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');</script>"
?>