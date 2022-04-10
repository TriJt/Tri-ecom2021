<?php 
session_start(); 
require_once ('../db/dbhelp.php');
$id = ''; 
$loaigiay = ''; 
if(isset($_GET['idl'])){ 
    $id = $_GET['idl'];
    $sql = 'select * from loaihanghoa where idl= '.$id;  
    $loaihanghoa = executeSingleResult($sql); 
    if($loaihanghoa != null){ 
        $loaigiay = $loaihanghoa['TenLoaiHang'];
    }

}
?>
<?php  
$user = isset($_SESSION['user'])? $_SESSION['user'] : [];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title> <?=$loaigiay?> - PEACESHOE</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <!-- phần code css -->
	    <link rel="stylesheet" href="css/slideshow.css">
	<!-- phần font awesome -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type= "text/css" >
    .col-lg-12{ 
        padding-left: 300px;
        margin-top: 50px;
    }
    .col-lg-4 h3{ 
        color: black;
                font-size: 14px;
                text-align: center;
                font-weight:normal;
                height : 20px; 
                margin-top: 5px;
                margin-bottom: 10px;
                font-family: Montserrat, Arial, sans-serif
    }
    </style>
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
                    <li><a href="giohang.php" class="giohang" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Giỏ hàng</a></li>
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
			 <!-- Phần chính của sản phẩm theo loại -->
			
<div class="container">
    <div class="col-lg-12">
        <a href="trangchu.php" style="color: black;">Trang chủ</a> / <a href="sanpham.php" style="color: black;">BOOTS</a> / <b><?=$loaigiay?></b> 
        <hr>
        <h2  class="title" style = "font-size: 28px"><?=$loaigiay?></h2>
            <div class="row">
				
<!-- phần lấy sản phẩm  -->
            
<?php
    $sql  = 'select  hanghoa.id, hanghoa.TenHH,
    hanghoa.Gia, hinhhanghoa.dchh,hanghoa.SoLuongHang, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa 
    left join hinhhanghoa on hanghoa.id = hinhhanghoa.id
    left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl  where loaihanghoa.idl = '.$id; 
    $sanphamList = executeResult($sql);
    # phần lấy sản phẩm từ database 
foreach ($sanphamList as  $item ){
    echo'    <div class="col-lg-4">
                <a href="chitietsanpham.php?id='.$item['id'].'"><img src="../khachhang/image/'.$item['dchh'].'" style=" width: 80% " ></a>
                <h3 >'.$item['TenHH'].'</h3> 
                <h3 >'.$item['Gia'].'$</h3>
            </div>';}
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