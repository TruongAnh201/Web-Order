<?php
    $sql="delete from nhanvien where MaNV =" .$_GET['delete_id'];
    mysqli_query($connect,$sql);
    //  echo "<script>$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');</script>"
?>