<?php 
require_once ('../db/dbhelp.php');
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Danh Mục</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="css/donhang.css">
	<link rel="stylesheet" href="css/logo.css">
    <link rel="stylesheet" href="css/admin.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	

	
</head>
<body>

<div class="taikhoan">
<ul class="tk">
				  
				  <?php  if(isset($useradmin['msnv'])){?>
                        <li class="dropdown">
                        <a href="dangnhapadmin.php" class="dropdown-toggle" data-toggle="dropdown"><?php  echo $useradmin['hotennv']?></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangxuatadmin.php">Đăng xuất </a></li>
                            
                        </ul>
                        </li>
						<?php } else {?>
                        <li class="dropdown">
                        <a href="dangnhap.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Tài khoản <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangnhapadmin.php">Đăng nhập </a></li>
                            
                        </ul>
                        </li>   
                    <?php } ?>
                        			  				
</ul>
</div>

<div class="container">
<div class="logo">
        <h2 class="logo1"> <span class="C">P</span>EACE<span class="H">S</span>HOP</h2>
</div>
    <h1 class="h">CHÀO MỪNG BẠN ĐẾN VỚI PEACESHOP</h1>    

	<div class="menu">
		<a href= "danhmuc.php"> Quản lý Danh mục  </a>
	</div>
	<div class="menu">
		<a href= "sanpham.php"> Quản lý Sản phẩm  </a>
	</div>
	<div class="menu">
		<a href= "donhang.php"> Quản lý Đơn hàng  </a>
	</div>
	<div class="menu">
		<a href= "khachhang.php"> Quản lý Khách hàng  </a>
	</div>
</body>
</html>