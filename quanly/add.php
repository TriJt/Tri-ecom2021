<?php 
require_once ('../db/dbhelp.php');
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
$id = $name = '';
if(!empty($_POST))
{
    
    if(isset($_POST['TenLoaiHang'])){ 
        $name = $_POST['TenLoaiHang'];
		$name = str_replace('"','\\"',$name);
    }
	if(isset($_POST['idl'])){ 
        $id = $_POST['idl'];
    }
    if(!empty($name)) { 
        
            // lưu vào database
            if($id == ''){
                $sql = 'insert into loaihanghoa(TenLoaiHang) value ("'.$name.'")';
            }else{ 
                $sql = 'update loaihanghoa set TenLoaiHang = "'.$name.'" where idl = '.$id; 
            }
            
        execute($sql);

        header('Location: danhmuc.php'); 
        die(); 
    }
}

if(isset($_GET['idl'])){ 
    $id = $_GET['idl'];
    $sql = 'select * from loaihanghoa where idl= '.$id;  
    $loaihanghoa = executeSingleResult($sql); 
    if($loaihanghoa != null){ 
        $name = $loaihanghoa['TenLoaiHang'];
    }

}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Thêm danh mục - PEACESHOP</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="css/donhang.css">
	<link rel="stylesheet" href = "css/logo.css">
	<link rel="stylesheet" href = "css/admin.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="taikhoan">
<ul class="tk">
				  
				  <?php  if(isset($useradmin['msnv'])){?>
                        <li class="dropdown">
                        <a href="dangnhapadmin.php" class="dropdown-toggle" data-toggle="dropdown"><?php  echo $useradmin['hotennv']?></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangxuatadmin.php">Đăng xuất </a></li>
                            
                        </ul>
                        </li>
						<?php } else {?>
                        <li class="dropdown">
                        <a href="dangnhap.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Tài khoản <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangnhapadmin.php">Đăng nhập </a></li>
                            
                        </ul>
                        </li>   
                    <?php } ?>
                        			  				
</ul>
</div>
<div class="logo">
        <h2 class="logo1"> <span class="C">P</span>EACE<span class="H">S</span>HOP</h2>
        </div>
<ul class="nav nav-tabs">
  				<li class="nav-item">
   					 <a class="nav-link active " href="danhmuc.php">Quản lý Danh mục</a>
  				</li>
  				<li class="nav-item">
    				<a class="nav-link " href="sanpham.php">Quản lý sản phẩm</a>
  				</li>
				  <li class="nav-item">
    				<a class="nav-link " href="donhang.php">Quản lý đơn hàng</a>
  				</li>
				  <li class="nav-item">
    				<a class="nav-link" href="khachhang.php">Quản lý khách hàng</a>
  				</li>
				
</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-left">Thêm/Sửa danh mục sản phẩm</h2>
			</div>
			<div class="panel-body">
                <form method="post">
                
				<div class="form-group1" >
				  <label for="TenLoaiHang">Loại hàng hóa: </label>
				  <input type="text" name="idl"   id="idl" value= "<?=$id?>" hidden = true >
				  <input required="true" type="text" class="form-control" id="TenLoaiHang" name="TenLoaiHang" value ="<?=$name?>">
				</div>
				
				<button class="btn btn-success">Lưu</button>
			    </div>
                </form>
            </div>
		</div>
	</div>
</body>
</html>