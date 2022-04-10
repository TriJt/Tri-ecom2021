<?php  
session_start();
$user = isset($_SESSION['user'])? $_SESSION['user'] : [];

require_once ('../db/dbhelp.php');
$id = '';
$hanghoa = '';  

// phần select trạng thái đơn hàng thông qua địa chỉ email của khách hàng
$email = $hoten ='';
 if(isset($_POST['bt-trangthai'])){ 
     $email = $_POST['email']; 
     $hoten = $_POST['hoten'];
 }
 // phần tìm kiếm trạng thái
 $sql = " SELECT dathang.ngaygh, dathang.masodh, dathang.trangthaidh from khachhang left join dathang on dathang.mskh = khachhang.mskh where khachhang.email  like '$email' and khachhang.hoten like '$hoten'";
 $query = mysqli_query($con,$sql); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Trạng Thái Đơn Hàng - PEACESHOP</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- phần font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <link rel="stylesheet" href="css/trangthaidonhang.css">
</head>
<body>
<!-- phần header gồm menu -->
<div class="logo">
        <a class="navbar-brand" href="trangchu.php" ><h2> <span class="C">P</span>EACE<span class="H">S</span></span>HOP</h2></a>
        </div>
        
<div class="container">
    <div class="menu">
        <div class="narbar " role="navigation" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
            <button type="button" class="navbar-toggle" style = "color:black" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                    <li><a href="trangchu.php" >Trang chủ</a></li>
                    <li class="dropdown">
                        <a href="sanpham.php" class="dropdown-toggle" data-toggle="dropdown">Sản Phẩm <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="sanpham.php"> <b>BOOTS</b></a></li>
                            <li class="divider"></li>
                            <li>
                                <?php
                                        $sql  = 'select * from loaihanghoa '; 
                                        $quanlyList = executeResult($sql); 
                                        $index = 1; 	
                                        foreach ($quanlyList as $item){
                                        echo	'<tr>
                                                <td> <a 
                                                href="listproduct.php?idl='.$item['idl'].'">'.$item['TenLoaiHang'].'</a></td>	
                                            </tr>';
                                        }
                                ?>
                            </li>
                        </ul>
                    </li>
                    <!-- <li><a href="about.php">Về chúng tôi</a></li>
                    <li><a href="lienhe.php">Liên hệ</a></li> -->
                    <li><a href="giohang.php" class="giohang"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Giỏ hàng</a></li>
                    <?php  if(isset($user['hoten'])){?>
                        <li class="dropdown">
                        <a href="dangnhap.php" class="dropdown-toggle" data-toggle="dropdown"> <?php  echo $user['hoten']?><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangxuat.php">Đăng xuất </a></li>
                            <!-- <li class="divider"></li>
                            <li><a href="dangki.php">Đăng kí</a></li> -->
                        </ul>
                        </li>
                    <?php } else {?>
                        <li class="dropdown">
                        <a href="dangnhap.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Tài khoản <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangnhap.php">Đăng nhập </a></li>
                            <li class="divider"></li>
                            <li><a href="dangki.php">Đăng kí</a></li>
                        </ul>
                        </li>   
                    <?php } ?>
            <li><a href="timkiem.php">Tìm kiếm <i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
            </ul>
                    
            
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->  
        </div>
        <div style=" border-bottom: 1px solid black; margin-bottom:20px;"></div>
    </div>
<!-- Trạng thái đơn hàng -->
<div class="container">
    <div class="dongdau">
    <a href="trangchu.php" >Trang chủ</a> / <a href="trangthaidonhang.php" style="font-weight:bold;">Trạng thái đơn hàng</a>
    </div>
    <div class="row">
        
    <div class="trai">
    <h3 class="tieude">TRẠNG THÁI CỦA ĐƠN HÀNG</h3>
        <small class="doanvan">Tìm kiếm trạng thái của đơn hàng của bạn ngay tại đây. Hãy nhập thông tin của bạn vào các ô trống phía dưới.</small>
    <form action="trangthaidonhang.php" method="post" >
        <div class="hoten">
            <input type="hidden" name = "action" value = "trangthai">
            <input type="text" class="ip-trangthai" name = "hoten" placeholder="Họ tên *" value="<?=$hoten?>"> 
        </div>
        <div class="email">
            <input type="hidden" name = "action" value = "trangthai">
            <input type="text" class="ip-trangthai" name = "email" placeholder="Email *" value="<?=$email?>"> 
        </div>
        <button type="submit" name = "bt-trangthai" value="TRA CỨU" class="button-trangthai">TRA CỨU</button>
            </form>         
    </div>
    <div class="phai">
            <h3 class="tieude"> THÔNG TIN ĐƠN HÀNG </h3>
            <small class="doanvan">Mong quý khách thông cảm cho cửa hàng trong giai đoạn khó khăn do dịch bệnh. Đơn hàng có thể giao trễ hơn so với dự kiến.</small>
            <h3 class="Show">Tổng số đơn hàng của bạn: 
            <?php $sql = " SELECT count(*) as 'tongdonhang' from khachhang left join dathang on dathang.mskh = khachhang.mskh where khachhang.email  like '$email' and khachhang.hoten like '$hoten'";
            $tongdonhang = tongdonhangquanly($sql); 
            ?>    
            </h3>    
            <div class="duongke"></div>
          <?php 
            if($email != null && $hoten !=null){
              while($row =mysqli_fetch_array($query)){
          ?>
            <div class="t1">
            <h4 class="Show">Mã số đơn hàng: </h4> 
            <?=$row['masodh']?>
            <h4 class="Show">Trạng thái đơn hàng: </h4> 
            <?=$row['trangthaidh']?>
            </div>
            <div class="t2">
            <h4 class="Show">Ngày dự kiến giao hàng: </h4>
            <?=$row['ngaygh']?>
            </div>
            <div class="duongke"></div>
        <?php
              }}
        ?>
    </div>
    </div>
</div>




<!---------footer-->
<div style=" border-bottom: 2px solid black; margin-bottom:20px;"></div>
<div class="container">
	<table class="table table-borderless">
		<thead>
			<tr >
			<th scope="col"><a href="trangthaidonhang.php" class="cuoitrang">Trạng thái đơn hàng</a></th>
			<th scope="col"><a href="lienhe.php" class="cuoitrang">Chính sách bảo mật</a></th>
			<th scope="col"><a href="about.php" class="cuoitrang">Về chúng tôi</a></th>
			<th scope="col"><a href="lienhe.php" class="cuoitrang">Điều khoản và điều kiện</a></th>
			<th scope="col"><a href="lienhe.php" class="cuoitrang">Liên hệ </a></th>
			</tr>
		</thead>
	</table>
	<div class="icon-fo">
                <div class="icon-size" style =" margin : auto">
                   <a href="https://www.facebook.com/profile.php?id=100010445416794" target="blank"><img src="image/icon/facebook.png" ></a> 
                   <a href="https://www.instagram.com/jt_1508/" target="blank"> <img src="image/icon/instagram.png" ></a>
                  <a href="">  <img src="image/icon/youtube.png" > </a>
                </div>
            </div>
            <hr>
            <h3 class= "dongcuoi">© 2021 Shoe Peaces Inc. All rights reserved</h3>
	</div>
</body>
</html>