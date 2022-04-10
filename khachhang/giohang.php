<!-- php phần lấy sản phẩm -->
<?php 
require_once ('../db/dbhelp.php');
$id = '';

?>
<?php  session_start();
    $user = isset($_SESSION['user'])? $_SESSION['user'] : [];
    $MSKH = $HotenKH = $DiaChi = $SoDienThoai = $Email = '';
    if(!isset($_SESSION['user'])){
        header("location: dangnhap.php"); 
    }
    if(isset($user['mskh'])){
        $MSKH = $user['mskh'];
        $sql = "SELECT khachhang.hoten, khachhang.sdt, khachhang.email, diachikh.diachi diachikh_diachi FROM khachhang LEFT JOIN diachikh 
		ON khachhang.mskh = diachikh.mskh WHERE khachhang.mskh = '$MSKH'";
        $khachhang = executeSingleResult($sql);
        if($khachhang != null){
        $HotenKH = $khachhang['hoten'];
        $DiaChi = $khachhang['diachikh_diachi'];
        $SoDienThoai = $khachhang['sdt'];
        $Email = $khachhang['email'];
        }else{
            $MSKH = '';
        }
    }
    if(!empty($_POST['diachi'])){
        $DiaChi = $MSKH = '';
        if(isset($_POST['diachi'])){
            $DiaChi = $_POST['diachi'];      
        }
        if(isset($_POST['mskh'])){
            $MSKH = $_POST['mskh'];      
        }

        $sql = "INSERT INTO diachikh(diachi, mskh)
         VALUES ( '$DiaChi', '$MSKH')";
        if(mysqli_query($con, $sql)){
            
        }
    }
    
    

?>




<?php
include ('function.php');
if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = []; 
// xóa tất cả sản phẩm có trong giỏ hàng 
if(isset($_GET['delcart'])&&($_GET['delcart']==1)) unset($_SESSION['giohang']);
// xóa một sản phẩm có trong giỏ hàng
if(isset($_GET['delid'])&&($_GET['delid']>=0))
    {
        // hàm dùng để xóa trong giỏ hàng
        array_splice($_SESSION['giohang'],$_GET['delid'],1);
    }
// lấy dữ liệu từ sản phẩm  
    if(isset($_POST['addcart'])&&($_POST['addcart']))
    {
        
        $hinhanh= $_POST['dchh'];
        $tensp = $_POST['TenHH'];
        $gia = $_POST['Gia'];
        $soluong = $_POST['soluong'];
        $size = $_POST['size']; 
        
         // kiểm tra sản phẩm có trong giỏ hàng hay không? 
        $fl = 0; // biến dùng để kiểm tra các sản phẩm trong giỏ hàng có bị trùng hay không?


         for($i=0; $i< sizeof($_SESSION['giohang']);$i++)   
         {
             if($_SESSION['giohang'][$i][1]==$tensp && $_SESSION['giohang'][$i][4] ==$size){ 
                 $fl =1; 
                 $soluongnew = $soluong+$_SESSION['giohang'][$i][3]; 
                 $_SESSION['giohang'][$i][3] = $soluongnew ; 
                 break; 
             }
         }
         // nếu không trùng sản phẩm trong giỏ hàng thì thêm vào giỏ hàng
         if($fl==0){
            $sp = [$hinhanh,$tensp,$gia,$soluong,$size]; 
            $_SESSION['giohang'][]= $sp; 
            // dùng dòng này để in ra kết quả của array từ session
            //var_dump($_SESSION['giohang']);
         }
    }
    // function showgiohang lưu trong function.php
    
?>
        


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title>Giỏ hàng - PEACESHOE</title>
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
        <div class="thongbaovanchyen">
            <h1 class="td">THÔNG BÁO VẬN CHUYỂN</h1>
            <small class="thongbao">Chúng tôi biết cảm giác thú vị khi có được đôi giày mới và đang nỗ lực để đưa chúng đến tay bạn nhanh nhất có thể! Vui lòng đợi thêm thời gian để nhận đơn đặt hàng của bạn do sự chậm trễ của nhà cung cấp dịch vụ trên toàn quốc cùng với khó khăn trong quá trình vận chuyển bới dịch bệnh COVID-19. Cảm ơn bạn đã kiên nhẫn và hiểu biết của bạn.</small>
        </div>
        <form action="donhang.php" method = "POST">
        <div class="bangthongtin">
            <h3 class="ttkh">THÔNG TIN KHÁCH HÀNG</h3>
                <div class="form-group"> 
				  <input required="true" type="text" class="form-control1" id="email" name="email" value= "<?=$Email?>" placeholder="Email *" >
				</div>

                <div class="form-group"> 
				  <input required="true" type="text" class="form-control1" id="" name="hoten" value= "<?=$HotenKH?>" placeholder="Họ tên *" >
				</div>

                <div class="form-group"> 
				  <input required="true" type="text" class="form-control1" id="" name="diachi" value= "<?=$DiaChi?>" placeholder="Số nhà/ Đường/ Phường/ Quận/ Tỉnh *" >
				</div>

                <div class="form-group">
				  <input required="true" type="text" class="form-control1" id="" name="sdt" value= "(+84)<?=$SoDienThoai?>"  placeholder="Số điện thoại" >
				</div>
                
        </div>      
        <div class="thongtinsanpham">
            <h1 class="gh" >GIỎ HÀNG</h1>
            <table class="table">
                <thead>
                    <tr>
                        
                        <th width ="15%">Sản phẩm</th>
                        <th width ="20%"></th>
                        <th width ="10%"></th>
                        <th width ="15%">Giá</th>
                        <th width ="20%">Số lượng</th>
                        <th width ="20%">Thành tiền</th>
                        
                    </tr>
                </thead>
                <tbody>
                <a href="sanpham.php" ><h5 class="ttdh">< TIẾP TỤC ĐẶT HÀNG</h5></a>
                <?php echo showgiohang(); ?>
                </tbody> 
            </table>
            <div class="thanhtoan">
                <input type="submit" class="bt2" name="thanhtoan" value="Thanh toán">
            </div>
            <div class="xoagiohang">
                <a href="giohang.php?delcart=1" class="xgh">Xóa giỏ hàng</a>
            </div>
            </div>
        </form>
    </div>
 </div>
 <!-- phần thông tin nhận hàng -->
<!-- phần footer  -->
<div style=" border-bottom: 2px solid black; ;"></div>
<div class="container">
	<div class="icon-fo"> 
            <h3 class= "dongcuoi">© 2021 Shoe Peaces Inc. All rights reserved</h3>
	</div>
</body>
</html>