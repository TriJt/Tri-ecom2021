<?php  
session_start();
require_once ('../db/dbhelp.php');

$user = isset($_SESSION['user'])? $_SESSION['user'] : [];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Trang chủ - PEACESHOP</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- phần font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- phần code css -->
	<link rel="stylesheet" href="css/slideshow.css">
    <link rel="stylesheet" href="css/tc.css">
    <link rel="stylesheet" href="css/sptc.css"> 
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
    </div>
 
<!-- phần làm live show -->
<div class="CSSgal">
  <!-- Don't wrap targets in parent -->
  <s id="s1"></s> 
  <s id="s2"></s>
  <s id="s3"></s>
  <s id="s4"></s>
  <div class="slider">
      
    <div style="background-image: url('images/Backgroud/bg2.jpg');">
    </div>
    <div style="background-image: url('images/Backgroud/bg1.jpg');">
      
    </div>
    <div style="background-image: url('images/Backgroud/bg3.jpg');">
      
    </div>
    <div style="background-image: url('images/Backgroud/bg4.jpg');">
     
    </div>
  </div>
  
  <div class="prevNext">
    <div><a href="#s4"></a><a href="#s2"></a></div>
    <div><a href="#s1"></a><a href="#s3"></a></div>
    <div><a href="#s2"></a><a href="#s4"></a></div>
    <div><a href="#s3"></a><a href="#s1"></a></div>
  </div>

  <div class="bullets">
    <a href="#s1">1</a>
    <a href="#s2">2</a>
    <a href="#s3">3</a>
    <a href="#s4">4</a>
  </div>
</div>

<!-- phần main bên dưới  -->

<!-- phần sản phẩm đầu trang -->
<div class="container">
<h2 class="title"> CHO MỘT NGÀY MỚI</h2>
<!-- phần lấy sản phẩm  -->
<div class="col">
    <!-- phần lấy sản phẩm từ database -->
    <?php
        $sql  = 'select  hanghoa.id, hanghoa.TenHH,
        hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.updated_at, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa 
        left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl
        left join hinhhanghoa on hanghoa.id = hinhhanghoa.id 
        order by hanghoa.id limit 4 ' ; 
        $sanphamList = executeResult($sql);
        # phần lấy sản phẩm từ database 
    foreach ($sanphamList as  $item ){
      ?>    
                    <div class="col-md-3">
						<a href="chitietsanpham.php?id=<?=$item['id']?>"> <img src="../khachhang/image/<?=$item['dchh']?>" style="width: 90%;"></a>
                        <div class="ten">
                        <h3 ><?=$item['TenHH']?></h3> 
                        </div>
                        <div class="gia">
                        <h3><?=$item['Gia']?> $</h3>
                        </div>
                    </div>     
    <?php
    }
    ?>
        
    </div>
</div>
<!------ phần ảnh giới thiệu-->
<div class="container" >
    <div class="categories" >
        <div class="row">
            <div class="col-lg-4">
                <img src="images/gioithieu/gioithieu.jpg" >
            </div>
            <div class="col-lg-4">
                <img src="images/gioithieu/gioithieu5.jpg" >
            </div>
            <div class="col-lg-4">
                <img src="images/gioithieu/gioithieu4.jpg" >
            </div>
        </div>
    </div>
</div>

<!-----------Phần đánh giá ủa khách hàng về sản phẩm -->
<div class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="k1">
                    <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="k2">
                    <p> 
                        Đôi giày rất đỉnh. Nó đem đến một sự thoải mái cho người sử dụng. Rất đáng để bỏ tiền ra mua.
                    </p>
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star-half-o" ></i>
                    </div>
                    <img src="images/people1.jpg" alt="">
                    <h3> Bethany Lopez </h3>
                </div>
                <div class="col-lg-4">
                    <div class="k1">
                    <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="k2">
                    <p> 
                        Những thứ này được mua cho con trai tôi để mặc khi đi xe máy, nhưng nó cũng có thể mặc chúng khi đi dạo phố. Anh ấy nói rằng họ rất thoải mái và yêu thích phong cách của họ!
                    </p>
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                    </div>
                    <img src="images/people2.jpg" alt="">
                    <h3> Aaron Hall</h3>
                </div> 
                <div class="col-lg-4">
                    <div class="k1">
                    <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="k2">
                    <p> 
                        Tôi rất thích đôi giày này. Nó đem đến cho tôi sự thoải mái khi đi gặp đối tác. Tôi sẽ ghé shop vào một ngày khác và mua thêm.
                    </p>
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                    </div>
                    <img src="images/people4.jpg" alt="">
                    <h3> Baldwin Lucas </h3>
                </div>  
            </div>
        </div>
    </div>
<!-- phần sản phẩm cuối  trang -->
<div class="container">
<h2 class="title" >  MẶT HÀNG ĐƯỢC ĐÁNH GIÁ HÀNG ĐẦU </h2>
<!-- phần lấy sản phẩm  -->
<div class="col">
    
    <!-- phần lấy chi tiết sản phẩm từ database -->
    <?php
        $sql  = 'select hanghoa.id, hanghoa.TenHH, hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.updated_at, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl left join hinhhanghoa on hanghoa.id = hinhhanghoa.id where hanghoa.maloaihang = "111" LIMIT 4' ; 
        $sanphamList = executeResult($sql);
        # phần lấy sản phẩm từ database 
    foreach ($sanphamList as  $item ){
      ?>    
                    <div class="col-md-3">
						<a href="chitietsanpham.php?id=<?=$item['id']?>"> <img src="../khachhang/image/<?=$item['dchh']?>" style="width: 80%;"></a>
                        <div class="ten">
                        <h3 ><?=$item['TenHH']?></h3> 
                        </div>
                        <div class="gia">
                        <h3><?=$item['Gia']?> $</h3>
                        </div>
                    </div>     
    <?php
    }
    ?>
    </div>
</div>

<!---------Phần câu nói của thêm -->
<div class="container">
   <h1 class="bieungu" > PEACESHOE: NƠI PHÁI MẠNH NÂNG CẤP BẢN THÂN</h1>
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