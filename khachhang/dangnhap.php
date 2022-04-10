
<?php 
require_once ('../db/dbhelp.php');
require_once('../db/config.php');
$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
session_start();
$e = '';
$er = [];
if(!empty($_POST)){
    if(isset($_POST['mskh'])){
        $e = $_POST['mskh']; 
    }
    if(isset($_POST['Password'])){
        $p = $_POST['Password'];  
    }
    if(empty($e)){ 
        $er['mskh']= 'Bạn chưa nhập tên đăng nhập';
    }
   if(empty($er)){
$sql = "SELECT * FROM khachhang WHERE mskh = '$e' and  Password = '$p'"; 

$query = mysqli_query($con,$sql); 

$data = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) > 0){
 $_SESSION['user'] = $data;
 header('Location: http://localhost:8080/B1809201-LeThanhTri/khachhang/trangchu.php ');
}else{
    header('Location: http://localhost:8080/B1809201-LeThanhTri/khachhang/dangnhap.php ');
   echo " <script type = 'text/javascript'>alert('Sai tên đăng nhập hoặc mật khẩu.')</script>";
}
}

}
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Đăng nhập - PEACESHOE</title>
   
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <link rel="stylesheet" href="css/dangnhap.css">

	<!-- phần font awesome -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
<!-- phần đăng nhập tài khoản -->
<div class="container">
    <div >
      <a href="trangchu.php" style="color: black;">Trang chủ</a>/<a href="dangnhap.php" style="color: black; font-weight:bold;"> <b >Tài khoản của tui</b></a>
    </div>
    <hr>
    <div class="col"> 
        <div class="row">
            <div class="col-2"  >
                <h3>ĐĂNG NHẬP TÀI KHOẢN CỦA TÔI</h3>
            </div>
            <div class="col-lg-6"></div>
        </div>
            <div class="col-2" >
                <div class="col-lg-6">
                <form action="dangnhap.php" method = "POST"  name = "dangnhap" role = "form">
                    <h3>KHÁCH HÀNG CŨ</h3>
                    <h5>Nếu bạn là người dùng đã đăng kí, vui lòng nhặp tên đăng nhập và mật khẩu của bạn.</h5>
                    <div class="form-group">
                            <label for="">Tên đăng nhập * </label> <br>
                            <input type="text" class="form-control1" id = "mskh"  name ="mskh" placeholder="Tên đăng nhập *" value="<?php echo $e ?>">
                            <div class="loi">
                            <span style="color: red;"> <?php echo (isset($er['mskh']))?$er['mskh']:'' ?></span>
                        </div>
                        </div>
                    <div class="form-group">
                            <label for="">Mật khẩu * </label> <br>
                            <input type="password" class="form-control1" id = "Password"  name="Password" placeholder="Mật khẩu *">
                            <div class="loi">
                            <span style="color: red;"> <?php echo (isset($er['Password']))?$er['Password']:'' ?></span>
                        </div>
                        </div>
                    
                    <input class="button-1"  type="submit" value="ĐĂNG NHẬP"></input>
                </form>
            </div>
    
                <div class="col-lg-6">
                    <h3>NHỮNG KHÁCH HÀNG MỚI </h3>
                    <h5>Tạo một tài khoản rất dễ dàng. Chỉ cần điền vào biểu mẫu dưới đây và tận hưởng những lợi ích của việc trở thành khách hàng đã đăng ký.</h5>
                   <a href="dangki.php"> <button class="button-1" type = "submit" >TẠO TÀI KHOẢN NGAY BÂY GIỜ</button></a>
                    <div >
                    <h2 class= "them">TẠI SAO PHẢI THAM GIA PEACESHOP</h2>
                        <div class="content1">
                           <h3>KỈ NIỆM SINH NHẬT CỦA BẠN</h3>
                           <h5>Chúng tôi yêu giày nhiều như bạn. Trên thực tế, chúng ta không thể nghĩ ra một món quà sinh nhật tuyệt vời hơn một đôi giày mới. Đó là lý do tại sao chúng tôi tặng bạn phần thưởng $ 5 cho tháng sinh nhật của bạn. Và khi nâng cấp lên   , bạn sẽ nhận được đặc quyền sinh nhật $ 10 và thêm 50 điểm!</h5>
                        </div>
                        <div class="content1">
                           <h3>TRẢ HÀNG KHI BẠN KHÔNG HÀI LÒNG</h3>
                           <h5>Đôi khi giày không vừa. Đừng lo lắng! Với việc hoàn trả không phức tạp, các thành viên <b class = "invang"> PEACESHOE </b> không cần biên lai.</h5>
                        </div>
                        <div class="content1">
                           <h3>TRỞ THÀNH KHÁCH CỦA CHÚNG TÔI</h3>
                            <h5>Nhận quyền truy cập độc quyền vào các giao dịch chỉ dành cho thành viên của <b class = "invang">PEACESHOE</b> và kiếm điểm nhanh hơn nữa với các sự kiện điểm nhân đôi và điểm thưởng. Khi bạn đạt đến trạng thái <b style="color: #DBA901;">GOLD</b> , hãy trở thành một trong số ít người mua sắm được lựa chọn của chúng tôi với quyền tham gia đặc biệt vào các giao dịch và sự kiện <b class = "invang">GIÀY GOLD.</b></h5>
                        </div>
                        
                    </div>
                </div>
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


   
