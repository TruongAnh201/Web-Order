<!DOCTYPE html>
			<html>
			<head>
				<title>Login - Phần mềm quản lý bán hàng</title>
				<link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css" href="public/css/style.css">
				<link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css">
				<script type="text/javascript" src="public/js/jquery.min.js"></script>
				<script type="text/javascript" src="public/js/popper.min.js"></script>
				<script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="public/js/login.js"></script>
			</head>
			<body>
				<div class="mainwrap">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-5 login-form">
								<div class="header-login" style="padding-top: 15px; padding-bottom: 10px;">
									<img src="public/images/logo_Small.png" width="230px" height="70px">
								</div>
								<div class="body-login">
									<div class="form-group">
										<label>Tên đăng nhập</label>
										<input type="text" name="txtuser" class="form-control">
									</div>
									<div class="form-group">
										<label>Mật khẩu</label>
										<input type="password" name="txtpass" class="form-control">
									</div>
									<div class="form-group">
										<button class="btn btn-success" id="login">Đăng Nhập</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="alert-login">
					<h3>Thông báo !</h3>
					<p>Đăng nhập thất bại, vui lòng kiểm tra tên đăng nhập hoặc mật khẩu.</p>
				</div>
			</body>
		</html>
