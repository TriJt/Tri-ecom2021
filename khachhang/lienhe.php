<!-- php phần lấy sản phẩm -->
<?php 
session_start(); 
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
$user = isset($_SESSION['user'])? $_SESSION['user'] : [];
?>
<?php
require_once('../db/config.php');
$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
$err = []; 
if(!empty($_POST)){
      $cauhoi = $msdh = $tinnhan = $ten = $email =$sdt = '';
    if(isset($_POST['cauhoi'])){
        $cauhoi = $_POST['cauhoi'];
        $msdh = $_POST['msdh'];
        $tinnhan  = $_POST['tinnhan'];
        $ten= $_POST['ten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        if(empty($ten)){ 
            $err['ten'] = 'Bạn chưa nhập tên ';
        }  
        if(empty($cauhoi)){ 
            $err['cauhoi'] = 'Bạn chưa nhập câu hỏi';
        }
        if(empty($tinnhan)){ 
            $err['tinnhan'] = 'Bạn chưa nhập phản hồi ';
        }
        if(empty($email)){ 
            $err['email'] = 'Bạn chưa nhập email ';
        }
        if(empty($sdt)){ 
            $err['sdt'] = 'Bạn chưa nhập số điện thoại ';
        }
        if(empty($msdh)){ 
            $err['msdh'] = 'Bạn chưa nhập mã số đơn hàng';
        }
        

        //var_dump(!empty($err));
        if(empty($err)){
        
            $sql = "INSERT INTO lienhe (cauhoi, msdh, tinnhan,ten, email, sdt) VALUES ('$cauhoi', '$msdh', '$tinnhan', '$ten', '$email', '$sdt')";      
            $query  = mysqli_query($con,$sql);
        
        }
        //die();
        
    }  

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Liên hệ - PEACESHOP</title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    <!-- phần code css -->
	    <link rel="stylesheet" href="css/lienhe.css">
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
                                                href="listproduct.php?id='.$item['id'].'">'.$item['TenLoaiHang'].'</a></td>	
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
<!-- phần liên hệ của khách hàng-->
<div class="container">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <h1>LIÊN HỆ VỚI CHÚNG TÔI</h1>
        <h3>HÃY CHO CHÚNG TÔI BIẾT CHÚNG TÔI CÓ THỂ GIÚP GÌ CHO BẠN</h3>
        <p class="p">Vì vấn đề bảo mật, không đưa bất cứ thông tin nào liên quan đến thanh toán </p>
        <form action="" method = "POST" role = "form"> 
        <div class="form-group">
       <input type="text" class="form-control3" id="" name= "msdh" placeholder="SỐ ĐƠN HÀNG*">
            <div class="has-err">
            <font style = "color:red;"><span><?php echo (isset($err['msdh']))?$err['msdh']:'' ?></span></font>
            </div>
        </div>
        <!-- thay đổi thành select-option trong lúc tối ưu code -->
        <div class="form-group">
            <input type="text" class="form-control1"  id="" name= "cauhoi" placeholder="Câu hỏi của bạn"> 
            <div class="has-err">
               <font style = "color:red;"><span><?php echo (isset($err['cauhoi']))?$err['cauhoi']:'' ?></span></font>
            </div>   
        </div>
        <div class="fom-group">
        <textarea type="text" class="form-control2"id="" name= "tinnhan" placeholder="Nhập tin nhắn của bạn*"></textarea>
            <div class="err">
            <font style = "color:red;"><span><?php echo (isset($err['tinnhan']))?$err['tinnhan']:'' ?></span></font>
            </div>
        </div>
        <div class="form-group">
        <input type="text" class="form-control3" id="" name= "ten" placeholder="TÊN*">
            <div class="has-err">
            <font style = "color:red;"><span><?php echo (isset($err['ten']))?$err['ten']:'' ?></span></font>
            </div>
        </div>
        <div class="form-group">
       <input type="text" class="form-control3" id="" name= "email" placeholder="EMAIL*">
            <div class="has-err">
            <font style = "color:red;"><span><?php echo (isset($err['email']))?$err['email']:'' ?></span></font>
            </div>
        </div>
        <div class="form-group">
        <input type="number" class="form-control3" id="" name= "sdt" placeholder="SỐ ĐIỆN THOẠI">
            <div class="has-err">
                <font style = "color:red;"><span><?php echo (isset($err['sdt']))?$err['sdt']:'' ?></span></font>
            </div>
        </div>
        <button type="submit" class="button-form">NỘP</button>
        </form>
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
</body>
</html>