<?php 
require_once ('../db/dbhelp.php');
require_once('../db/config.php');
$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
session_start();
$e = '';
if(!empty($_POST)){
 $e = $_POST['user']; 
 $p = $_POST['Password'];   

$sql = "SELECT * FROM nhanvien WHERE user = '$e' and  Password = '$p'"; 

$query = mysqli_query($con,$sql); 

$data = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) > 0){
 $_SESSION['useradmin'] = $data;
 header('Location: http://localhost:8080/B1809201-LeThanhTri/quanly/trangadmin.php ');
}else{
	header('Location: http://localhost:8080/B1809201-LeThanhTri/quanly/dangnhapadmin.php ');
 echo "<script>alert('Sai mật khẩu.') </script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập - PEACESHOP</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<link rel="stylesheet" href="css/logo.css">
	<link rel="stylesheet" href="css/dangnhap.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!-- Latest compiled Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body> 
<div class="logo">
        <h2 class="logo1"> <span class="C">P</span>EACE<span class="H">S</span>HOP</h2>
</div>
<div class="h1"> 
	<h2> Chào mừng bạn đến với trang Admin </h2>
	<h6> Vui lòng đăng nhập tài khoản</h6>
</div>
<div class="form">
<div class="form-dangnhap">
		<form action="dangnhapadmin.php" method = "POST"  name = "dangnhap" role = "form">
                    <div class="form-group">
                            
                            <input type="text" class="form-control1" id = "user"  name ="user"  placeholder="Tên đăng nhập *"  >
                            <input type="password" class="form-control1" id = "Password"  name="Password" placeholder="Mật khẩu *">
                        </div>

                    <button class="button-1"  type="submit" value="ĐĂNG NHẬP">ĐĂNG NHẬP</button>
                </form>
            </div>
		</div>
</body>
</html>