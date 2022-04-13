<!DOCTYPE html>
<html>
<head>
	<title>Phần mềm quản lý bán hàng</title>
	<link rel="stylesheet" href="public/css/style.css">

	<!-- boostrap local file -->
	<link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="StyleModel.css">

	<!-- js -->
	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/popper.min.js"></script>
	<script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="public/js/admin.js"></script>

	<!-- chart -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

</head>
<body>
	<div class="header-admin" style="margin-bottom:10px">
		<div class="container-fluid">
			<div class="row" style="background-color: #78bcc4;">
				<div class="col-2">
					<img style="margin-top:6px" class="logo-header" src="public/images/logo_Small.png" alt="">
				</div>
				<div class="col-10" style="height:50px">
					<ul class="nav navbar-nav float-right" style="line-height: 32px;" >
						<li class=" dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Xin chào ADMIN </a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item"  href="#"><i class="fa fa-id-card-o" aria-hidden="true" style="margin-right:10px;"></i>Tài khoản</a>
								<a class="dropdown-item" id="DangXuat" href=""><i class="fa fa-sign-out" aria-hidden="true" style="margin-right:10px;"></i>Đăng xuất</a>
							</div>
      					</li>
					</ul>
				</div>
			</div>
		</div>
	</div>