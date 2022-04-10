<?php  
session_start();
$user = (isset($_SESSION['user']))? $_SESSION['user'] : [];
require_once ('../db/dbhelp.php');
$id = '';
$hanghoa = '';  
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    
}
?>
<?php 

if(isset($_POST['timkiem'])){
    $tukhoa = $_POST['key'];
 }else{
     $tukhoa = '';
 }
// Phần tìm kiếm sản phẩm
$sql = "select hanghoa.id, hanghoa.TenHH,
hanghoa.Gia,hinhhanghoa.dchh from hanghoa
left join hinhhanghoa on hanghoa.id = hinhhanghoa.id  where  TenHH like '%".$tukhoa."%' or hanghoa.Gia like '".$tukhoa."' "; 
$query = mysqli_query($con,$sql);   
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Tìm kiếm - PEACESHOP</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- phần font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- phần code css -->
	
    <link rel="stylesheet" href="css/tc.css">
    <link rel="stylesheet" href="css/timkiem.css">
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
                    <?php  if(isset($user['mskh'])){?>
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
<!-- phần tìm kiếm sản phẩm -->
<div class="container" >
    <div class="dongdau" style = "padding-bottom: 40px">
    <a href="trangchu.php" >Trang chủ</a> / <a href="timkiem.php" style="font-weight:bold;">Tìm kiếm</a>
    </div>
    <div class="col">
            <form action="timkiem.php" method="post" >
            <input type="hidden" name = "action" value = "timkiem">
            <input type="text" class=" timkiem form-timkiem" name = "key" placeholder="Tìm kiếm ... ">
            <button type="submit" name = "timkiem" value="Tìm kiếm" class="button-find">Tìm kiếm</button>
            </form>
    </div>
    <div class="sanpham" >
        <?php
        if($tukhoa != null){
        while($row = mysqli_fetch_array($query)){
            ?>	
                    <div class="product-find">
                   <div class="hinhanh">    
                  <?php   echo  '<a href="chitietsanpham.php?id='.$row['id'].'"><img src="../khachhang/image/'.$row['dchh'].'"  style = "width: 100px"   /></a> '; ?>
                   </div>
                    <div class="thongtin">
                    <?=$row['TenHH']?>
                    <h4>From: $<?=$row['Gia']?></h4>
                    </div>
                    </div>
           <?php  
        }   
            } 
        ?> 
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