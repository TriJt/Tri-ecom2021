<?php 
require_once ('../db/dbhelp.php');
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Danh Mục</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="css/donhang.css">
	<link rel="stylesheet" href="css/logo.css">
	<link rel="stylesheet" href ="css/admin.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!-- Latest compiled Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

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
   					 <a class="nav-link active" href="danhmuc.php">Quản lý Danh mục</a>
  				</li>
  				<li class="nav-item">
    				<a class="nav-link" href="sanpham.php">Quản lý sản phẩm</a>
  				</li> 
				<li class="nav-item">
    				<a class="nav-link" href="donhang.php">Quản lý đơn hàng</a>
  				</li>
				  <li class="nav-item">
    				<a class="nav-link" href="khachhang.php">Quản lý khách hàng</a>
  				</li>
								  				
</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-left">Quản lý Danh mục</h2>
			</div>
			<div class="panel-body">
				<a href="add.php" > <button class="btn btn-success" style="margin-bottom: 15px"> Thêm danh mục</button></a>
				<table class= "table table-bordered table-hover">
					<thead>
						<tr>
							<th width = "50px">STT</th>
							<th>Tên Danh Mục</th>
							<th width = "50px"> </th>
							<th width = "50px"></th>
						</tr>
					</thead>
					<tbody>
							<?php
					// lấy danh sách danh mục từ database 
					$sql  = 'select * from loaihanghoa '; 
					$quanlyList = executeResult($sql); 

					$index = 1; 	
					foreach ($quanlyList as $item){
					echo	'<tr>
							<td>'. ($index++).'</td>
							<td>'.$item['TenLoaiHang'].'</td>
							<td>
							<a href="add.php?idl='.$item['idl'].'"><button class="btn btn-warning">Sửa</button></a>
							</td>
							<td>
							<button class="btn btn-danger" onclick = " deleteLoai('.$item['idl'].')" >Xóa</button>
							</td>

						</tr>';
					}
					?>
						
					</tbody>
				</table>

		</div>
	</div>
<!--- bootstrap-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<!-----hàm xóa loại-------->

<script type = "text/javascript">
	function deleteLoai(id){ 
		var option = confirm('Bạn có chắc chắn muốn xóa ')
		if(!option){ 
			return; 
		}
		console.log(id)
		// ajax - lệnh post
		$.post('ajax.php', { 
			'idl': id, 
			'action': 'delete'
		}, function(data){ 
			location.reload()
		})



	}



</script>




</body>
</html>