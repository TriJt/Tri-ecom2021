<?php 
require_once ('../db/dbhelp.php');
$madh = '';
$donhang = '';  
if(isset($_GET['masodh'])){ 
    $madh = $_GET['masodh'];
    $sql = 'select * from dathang where dathang.masodh= '.$madh;  
    $donhang = executeSingleResult($sql); 
}
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Đơn Hàng</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/donhang.css">
	<link rel="stylesheet" href="css/logo.css">
	<link rel="stylesheet" href="css/admin.css">
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
<div class="logo">
        <h2 class="logo1"> <span class="C">P</span>EACE<span class="H">S</span>HOP</h2>
        </div>
<ul class="nav nav-tabs">
  				<li class="nav-item">
   					 <a class="nav-link " href="danhmuc.php">Quản lý Danh mục</a>
  				</li>
  				<li class="nav-item">
    				<a class="nav-link " href="sanpham.php">Quản lý sản phẩm</a>
  				</li> 
                <li class="nav-item">
    				<a class="nav-link active" href="donhang.php">Quản lý đơn hàng</a>
  				</li>
                  <li class="nav-item">
    				<a class="nav-link " href="khachhang.php">Quản lý khách hàng</a>
  				</li>
</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-left">Chi tiết đơn hàng </h2>
			</div>
			<div class="panel-body">
            <div class="thongtinnguoimua">
				<table class= "table table-bordered table-hover">
					<thead>
						<tr>
							<th width = "5%">STT</th>
                            <th width = "10%">Mã số ĐH</th>
							<th width = "20%">Họ tên KH</th>
                            <th width = "20%">Địa chỉ</th>
                            <th width = "20%">Email</th>
                            <th width = "15%">Số điện THoại</th>
							<th width = "10%">Tổng tiền</th>
						</tr>
					</thead>
					<tbody>
							<?php
					// lấy danh sách danh mục từ database 
					$sql = 'SELECT dathang.masodh,dathang.tongtien, khachhang.hoten, khachhang.sdt, khachhang.email, diachikh.diachi from khachhang left join dathang on khachhang.mskh = dathang.mskh left join diachikh on khachhang.mskh = diachikh.mskh where dathang.masodh= '.$madh;  
                    $donhang = executeResult($sql);
					$index = 1; 	
					foreach ($donhang as $item){
					echo	'<tr>
							<td>'. ($index++).'</td>
							<td>'.$item['masodh'].' </td>
                            <td>'.$item['hoten'].'</td>
                            <td>'.$item['diachi'].'</td>
                            <td>'.$item['email'].'</td>
                            <td>'.$item['sdt'].'</td>
							<td>'.$item['tongtien'].' $</td>
						</tr>';
					}
					?>
					</tbody>
				</table>
            </div>
            <div class="sanpham">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Hình ảnh</th>
                        <th>Tên Sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        
                    </tr>
                </thead>
                <tbody>
                        <?php 
                        $sql = 'select chitietdathang.masodh,chitietdathang.hinhanh,chitietdathang.tensp,chitietdathang.dongia,chitietdathang.soluong,chitietdathang.thanhtien from chitietdathang 
                        left join dathang on chitietdathang.masodh = dathang.masodh where dathang.masodh= '.$madh;  
                        $donhang = executeResult($sql);
                        $index = 1; 	
                        foreach ($donhang as $item){
                        echo	'<tr>
                                <td>'. ($index++).'</td>
                                <td>'.$item['masodh'].' </td>
                                <td><img src="../quanly/image/'.$item['hinhanh'].'" style="width: 150px;"></td>
                                <td>'.$item['tensp'].'</td>
                                <td>'.$item['dongia'].' $</td>
                                <td>'.$item['soluong'].'</td>
                                <td>'.$item['thanhtien'].' $</td>
                            </tr>';
                        }
                        ?>
                </tbody>
            </table>
            </div>


		</div>
	</div>
</body>
</html>