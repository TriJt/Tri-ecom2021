<?php 
require_once ('../db/dbhelp.php');
$id = '';
$hanghoa = '';  
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    $sql = 'select * from hanghoa where id= '.$id;  
    $hanghoa = executeSingleResult($sql); 
}
?>
<?php  
session_start();
$user = isset($_SESSION['user'])? $_SESSION['user'] : [];
?>

<?php
    
    include "function.php"; 
    if(isset($_POST['thanhtoan'])&&($_POST['thanhtoan'])){
        // lấy thông tin khách hàng từ form 
        $hoten= $_POST['hoten']; 
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $mskh  = $user['mskh']; 
        $msnv = "111"; 
        $pttt = 0; 
        $tong= tongdonhang();

        // insert đơn hàng - tạo đơn hàng mới
        $masodh= taodonhang($mskh,$msnv,$tong);
        // lấy thông tin giỏ hàng từ session + id đơn hàng vừa tạo 
        // insert vào bẳng giỏ hàng 
        for ($i=0; $i <sizeof($_SESSION['giohang']); $i++) { 
            $hinhanh = $_SESSION['giohang'][$i][0]; 
            $tensp = $_SESSION['giohang'][$i][1]; 
            $dongia = $_SESSION['giohang'][$i][2]; 
            $soluong= $_SESSION['giohang'][$i][3];  
            $size = $_SESSION['giohang'][$i][4];  
            $thanhtien = $dongia*$soluong; 
            taogiohang($tensp,$hinhanh,$dongia,$soluong,$size,$thanhtien,$masodh);
        }
        
        // show confirm đơn hàng 
        $ttkh =' <h3> <b> Bạn đã đặt hàng thành công!!!!</b></h3><br>
                <h4> <b>Mã đơn hàng của bạn là:'.$masodh.' </b></h4>
                <h3 class="tieude">THÔNG TIN GIAO HÀNG</h3>
            
                <div class="form-group"> 
                <b>Họ tên: </b> '.$hoten.'
				</div>

                <div class="form-group"> 
                <b>Email: </b>'.$email.'
				</div>

                <div class="form-group"> 
                <b>Địa chỉ: </b>'.$diachi.'
				</div>

                <div class="form-group">
				   <b>Số điện thoại: </b>'.$sdt.'
				</div>    
            ';
            $ttgh = showgiohang();

        // unset giỏ hàng session 
        unset($_SESSION['giohang']);
    
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Trang chủ</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <!-- phần code css -->
	<link rel="stylesheet" href="css/slideshow.css">
    <link rel="stylesheet" href="css/giohang.css">
	<!-- phần font awesome -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type ="text/css">
    .thongtinhanhang{
        margin: auto;
        width: 1000px;
    }
    /* phần bản thông tin */

    .tieude{
        color: #F7D358;
    }
    .truong{
        color:black;
        width: 15%;
        font-size: 16px;
        font-weight: bolder;
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
                    <li><a href="giohang.php" class="giohang"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Giỏ hàng</a></li>
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
 <!-- phần giỏ hàng khi đưa sản phẩm vào -->
 <div class="container">
    <div class="row">
        <div class="bangthongtin">
        <?php  echo $ttkh?>
        </div>      
        <div class="thongtinsanpham">
            <h3 class="tieude"> MẶT HÀNG ĐÃ MUA</h3>
            <table class="table">
                <thead>
                    <tr>
                    <th width ="15%">Sản phẩm</th>
                        <th width ="15%"></th>
                        <th width ="15%"></th>
                        <th width ="15%">Giá</th>
                        <th width ="20%">Số lượng</th>
                        <th width ="20%">Thành tiền</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php echo $ttgh; ?>
                </tbody> 
            </table>
            </div>
    </div>
 </div>
<!-- phần footer  -->
<div style=" border-bottom: 2px solid black; margin-bottom:20px;"></div>
<div class="container">
	
	<div class="icon-fo">
                
            <h3 class="dongcuoi">© 2021 Shoe Peaces Inc. All rights reserved</h3>
	</div>
</body>
</html>