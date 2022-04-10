<!-- php phần lấy sản phẩm -->
<?php 
session_start(); 
require_once ('../db/dbhelp.php');
$id = '';
$hanghoa = '';  



?>
<?php  

$user = isset($_SESSION['user'])? $_SESSION['user'] : [];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Sản phẩm - PEACESHOE</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <link rel="stylesheet" href="css/slideshow.css">
    <!-- phần code css -->
	    <link rel="stylesheet" href="css/sanpham.css">
	<!-- phần font awesome -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    .dautrang{
         float: left;
    }
    .col{ 
        padding: 0 50px 0 50px;
        margin-top: 50px;
    }
    .content2 { 
        padding-top: 20px;
        padding-right:70px;
    }
    .content3{ 
        padding-top: 20px;
        padding-bottom: 70px;
    }
    .content2 h3{ 
        margin-bottom: 20px;
        font-weight: 550;
        color: #151515;
    }
    .col-lg-4{
        padding: 0 20px 0 20px;
    }
    .col-lg-4 h3{
        color: black;
                              font-size: 14px;
                              font-weight: normal; 
                              text-align: center;
                              height : 20px; 
                              margin-top: 5px;
                              margin-bottom: 10px;
                              font-family: Montserrat, Arial, sans-serif;
    }
    .col-lg-4 a img{ 
        width: 100%;
        float: center;
    }
    .timkiem{ 
        border: 1px groove;
        height: 36px;
        width: 250px;
        font-size: 14px;
    }
    .timkiem:hover{
        border: 1px solid black;
        position: relative;
    }
    .danhsach{
        padding-left: 200px;
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
    
<!-- phần đưa sản phẩm vô từ database -->
<div class="container">
    <div class="col">
        <div class="row" style="float: left;">
            <div class="dautrang">
                <a href="trangchu.php" style="color: black;">Trang chủ</a> / <a href="sanpham.php" style="color: black;">BOOTS</a>  
                <h3>DRESS SHOES FOR MEN</h3>
            </div>  
        </div>      
    </div> 
</div> 
<hr>
<div class="container">
    <div class="col">
      <div class="row">
          <div class="danhsach">
          <!-- phần lấy chi tiết sản phẩm từ database -->
          <?php
              $sql  = 'select  hanghoa.id, hanghoa.TenHH,
              hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.updated_at, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa 
              left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl 
              left join hinhhanghoa on hanghoa.id = hinhhanghoa.id  limit 12
              '; 
              $sanphamList = executeResult($sql);
              # phần lấy sản phẩm từ database 
          foreach ($sanphamList as  $item ){
            ?>    
                          <div class="col-lg-4">
                              <a href="chitietsanpham.php?id=<?=$item['id']?>"> <img src="../khachhang/image/<?=$item['dchh']?>"></a>
                              <h3 ><?=$item['TenHH']?></h3> 
                              <h3 ><?=$item['Gia']?> $</h3>
                          </div>     
          <?php         
        }
          ?>
      </div>
      </div>
      <hr>
          <h5>Từ thứ Sáu bình thường đến một buổi tối trên thị trấn, hãy trông thật bảnh bao cho mọi dịp với những đôi giày nam từ Shoe Carnival!</h5>
        <div class="content2">
            <h3>GIÀY CHO DÂN VĂN PHÒNG</h3>
          <h5>Với việc quần jean trở thành đồng phục hàng ngày ở nơi làm việc hiện đại, hãy tạo sự khác biệt với những đôi giày bệt sẽ luôn gây ấn tượng. Các chuyên gia trẻ yêu thích những đôi giày Oxford bình thường của Freeman và Madden . Nếu trời se lạnh, hãy chọn dress boots nam cho ấm áp và phong cách. Chọn giày tây màu xám hoặc nâu cho diện mạo từ văn phòng đến buổi tối.</h5>
        </div>

        <div class="content2">
            <h3>GIÀY THOẢI MÁI CHO NAM</h3>
          <h5>Các cuộc họp cả ngày đòi hỏi phong cách cổ điển với sự thoải mái cao độ. Hãy tạo ấn tượng đầu tiên tuyệt vời khi bạn bước vào phòng họp với giày slip on nam của Dockers hoặc Nunn Bush . Hãy tôn lên vẻ ngoài của bạn với những chiếc váy oxfords cứng cáp , vượt thời gian . Tự tin trình bày với sự thoải mái của giày lười nam từ Florsheim . Ngoài ra, hãy thử giày đen với giày sneaker trắng để có sự kết hợp hoàn hảo giữa phong cách và sự thoải mái. Bất kể nhiệm vụ của bạn là gì, hãy làm cho nó thành công với những đôi giày đầm thoải mái từ Shoe Carnival.</h5>
        </div>

        <div class="content2">
            <h3>CHO MỘT NGÀY QUAN TRỌNG</h3>
          <h5>Tạo một tuyên bố vào ngày trọng đại với giày dép trang trọng hợp thời trang. Ghé qua Stacy Adams để biết những mẫu giày cổ điển hoặc mua sắm Giorgio Brutini để có phong cách khó quên.</h5>
        </div>
        <div class="content3">
        <h5>Bất kể bạn đang phục vụ vẻ ngoài nào, bạn nhất định trông bảnh bao khi mua sắm tại shoecarnival.com hoặc một cửa hàng gần bạn .</h5>
        </div>
    </div>  
</div>
<!-- phần footer  -->
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
<script type = "text/javascript">
	$(document).ready(function(){
		$('.timkiem').keyup(function(){
			var txt = $('.timkiem').val(); 
			$.post('function.php',{data1: txt},function(data1){
				$('.danhsach').html(data1);
			})
		})	
		})
</script>

</body>
</html>