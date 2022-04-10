<?php 
    require_once ('../db/dbhelp.php');
$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: []; 
session_start();
$err = []; 
$MSKH = $HotenKH = $DiaChi = $SoDienThoai = $Email = $Password = '';
if(!empty($_POST)){
    
      // phần post sản phẩm lên database
        if(isset($_POST['mskh'])){
            $MSKH = $_POST['mskh'];}

        if(isset($_POST['hoten'])){
            $HotenKH = $_POST['hoten']; }

        if(isset($_POST['diachi'])){
            $DiaChi= $_POST['diachi'];} 
            
        if(isset($_POST['sdt'])){   
            $SoDienThoai = $_POST['sdt'];} 

        if(isset($_POST['email'])){   
            $Email = $_POST['email'];
        }
        if(isset($_POST['Password'])){
            $Password = $_POST['Password'];
        }
        if(isset($_POST['rpass'])){
            $repass = $_POST['rpass'];
        }
        // phần bắt lỗi còn rỗng trường
        if(empty($HotenKH)){
            $err['hoten'] = 'Bạn chưa nhập họ tên.'; 
        }
        if(empty($DiaChi)){
            $err['diachi'] = 'Bạn chưa nhập địa chỉ.'; 
        }
        if(empty(trim($SoDienThoai))){
            $err['sdt'] = 'Bạn chưa nhập số điện thoại.'; 
        }
        if(empty(trim($Email))){
            $err['email'] = 'Bạn chưa nhập email.'; 
        }else{ 
            if(!filter_var(trim($Email),FILTER_VALIDATE_EMAIL)){
            $err['email'] = 'Email không hợp lệ.';
            }
        }
        if(empty(trim($MSKH))){
            $err['mskh'] = 'Bạn chưa nhập username.'; 
        }else{ 
            if(strlen(trim($MSKH)) < 8){ 
                $err['mskh'] = 'Username phải lớn hơn 8 kí tự';
            }
        }
        if(empty(trim($Password))){
            $err['Password'] = 'Bạn chưa nhập mật khẩu'; 
        }else{ 
            if(strlen(trim($Password)) < 8 && strlen(trim($Password)) < 16 ){ 
                $err['Password'] = 'Mật khẩu phải có từ 8 kí tự ';
            }
        }


        if( $Password != $repass){
            $err['rpass'] = 'Mật khẩu không trùng khớp';
        }

        if(empty($err)){
            // $pass = password_hash($Password,PASSWORD_DEFAULT);
            $sql_1 = "SELECT * FROM khachhang WHERE mskh = '$MSKH'";
            if(mysqli_num_rows(mysqli_query($con,$sql_1)) > 0){
                echo " <script>alert('Tài khoản đã tồn tại!! Vui lòng đăng ký lại.') </script>";
            } else{
            // insert vào trong bảng khách hàng
            $sql = "INSERT INTO khachhang (mskh, hoten, sdt, email, Password)
            VALUES ('$MSKH','$HotenKH', '$SoDienThoai', '$Email', '$Password')";  
            execute($sql);
            $query = "INSERT INTO diachikh (diachi,mskh) VALUES ('$DiaChi', '$MSKH')"; 
            execute($query);
            header("Location: dangnhap.php"); 
            echo " <script>alert('Bạn đã đăng kí thành công.') </script>";
            
            }
        }
    }  


mysqli_close($con);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Tạo tài khoản mới   |   PEACESHOP</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <link rel="stylesheet" href="css/dangki.css">
    <link rel="stylesheet" href="css/button.css">
    
	<!-- phần font awesome -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    
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
    <!-- phần đăng kí tài khoản -->
<div class="container">
    <div >
      <a href="trangchu.php" style="color: black;">Trang chủ</a> / <a href="dangnhap.php" style="color: black;font-weight:bold;">Tài khoản của tui</a>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-8">
        <div class="cauhoi">
                        <div class="content1">
                           <h3>TẠI SAO TẠO MỘT TÀI KHOẢN?</h3>
                           <h5>Việc tạo tài khoản sẽ tự động đăng ký bạn vào Chương trình Phần thưởng Đặc quyền Giày của chúng tôi. Đã là thành viên hay chưa? Nếu bạn đã đăng ký tại cửa hàng, bạn chỉ cần sử dụng cùng một địa chỉ email bạn đã cung cấp cho nhân viên cửa hàng để tạo tài khoản trực tuyến của mình.</h5>
                        </div>
                        <div class="content1">
                           <h3>KỈ NIỆM SINH NHẬT CỦA BẠN</h3>
                           <h5>Chúng tôi yêu giày nhiều như bạn. Trên thực tế, chúng ta không thể nghĩ ra một món quà sinh nhật tuyệt vời hơn một đôi giày mới. Đó là lý do tại sao chúng tôi tặng bạn phần thưởng $ 5 cho tháng sinh nhật của bạn. Và khi nâng cấp lên   , bạn sẽ nhận được đặc quyền sinh nhật $ 10 và thêm 50 điểm!</h5>
                        </div>
                        <div class="content1">
                           <h3>TRẢ HÀNG KHI BẠN KHÔNG HÀI LÒNG</h3>
                           <h5>Đôi khi giày không vừa. Đừng lo lắng! Với việc hoàn trả không phức tạp, các thành viên <b> PEACESHOE </b> không cần biên lai.</h5>
                        </div>
                        <div class="content1">
                           <h3>TRỞ THÀNH KHÁCH CỦA CHÚNG TÔI</h3>
                            <h5>Nhận quyền truy cập độc quyền vào các giao dịch chỉ dành cho thành viên của <b>PEACESHOE</b> và kiếm điểm nhanh hơn nữa với các sự kiện điểm nhân đôi và điểm thưởng. Khi bạn đạt đến trạng thái <b>GOLD</b> , hãy trở thành một trong số ít người mua sắm được lựa chọn của chúng tôi với quyền tham gia đặc biệt vào các giao dịch và sự kiện <b>GIÀY GOLD.</b></h5>
                        </div>
                        <div class="content1">
                            <h5>Hoàn thành biểu mẫu này và nhận 50 điểm thưởng khi tham gia ngay hôm nay! Đã là thành viên hay chưa? Nếu bạn đã đăng ký tại cửa hàng, bạn chỉ cần sử dụng cùng một địa chỉ email bạn đã cung cấp cho nhân viên cửa hàng để tạo tài khoản trực tuyến của mình.</h5>
                        </div>
                    </div>
                    <h3>TẠO TÀI KHOẢN</h3>
                    <div class="duongke"></div>
                     <form action="" method = "POST" name="dangki" role = "form" id="form" >
                    
                     <div class="form-group">
                        <input type="text" class="form-control1" id = "hoten" placeholder="Họ tên*"  name ="hoten" value="<?php echo $HotenKH ?>"> 
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['hoten']))?$err['hoten']:'' ?></span>
                        </div>
                     </div>


                    <div class="form-group">
                        <input type="text" class="form-control1" id = "diachi" placeholder="Địa chỉ *"  name ="diachi" value="<?php echo $DiaChi?>">
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['diachi']))?$err['diachi']:'' ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" maxlength="11" class="form-control1" id = "sdt" placeholder="Số điện thoại*"  name ="sdt" value="<?php echo $SoDienThoai?>">
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['sdt']))?$err['sdt']:'' ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control1" id = "email" placeholder="Email*"  name ="email" value="<?php echo $Email?>">
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['email']))?$err['email']:'' ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control1" id = "mskh"  placeholder="Tên tài khoản*"  name ="mskh" value="<?php echo $MSKH?>">
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['mskh']))?$err['mskh']:'' ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control1" id = "Password"  placeholder="Mật khẩu*" name="Password" require>
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['Password']))?$err['Password']:'' ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control1" id = "rpass" placeholder="Nhập lại mật khẩu*" require name="rpass">
                        <div class="loi">
                            <span style="color: red;"> <?php echo (isset($err['rpass']))?$err['rpass']:'' ?></span>
                        </div>
                    </div>
                    <input type = "submit" class="button-tk"  name = "thongtin" value="TẠO TÀI KHOẢN"></input>
            </form>
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
    <!-- phần javascript -->

</body>
</html>
