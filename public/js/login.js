$(document).ready(function(){
	$('#login').click(function(){

		var user = $('input[name="txtuser"]').val();
		var pass = $('input[name="txtpass"]').val();
		if(user =='' || pass ==''){
			$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng điền đầy đủ thông tin đăng nhập</p>').fadeIn().delay(500).fadeOut('slow');
		}else{
			$.ajax({
            type:'POST',
            url:'admin/backend/check_login.php',
            data:{
            	'user':user,
            	'pass':pass
            },
            dataType:'html'
	    	}).done(function(result){

				//$('.alert-login').html('<h3>Thông báo !</h3><p>'+result+'</p>').fadeIn().delay(1000).fadeOut('slow');
	    		if(result=='1'){
	    			window.location.replace("index.php");
					$('.alert-login').html('<h3>Thông báo !</h3><p>Quản lý</p>').fadeIn().delay(1000).fadeOut('slow');
	    		}else{
					if(result=='2')
					{
						 window.location.replace("pos/index.php");
						$('.alert-login').html('<h3>Thông báo !</h3><p>Nhân viên</p>').fadeIn().delay(1000).fadeOut('slow');
					}
					else{
						$('.alert-login').html('<h3>Thông báo !</h3><p>Tên đăng nhập hoặc mật khẩu không chính xác</p>').fadeIn().delay(1000).fadeOut('slow');
					}
				}

	    	});
		}
	});
});