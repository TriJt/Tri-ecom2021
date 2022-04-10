<?php 
require_once ('../db/dbhelp.php');
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Đơn Hàng - PEACESHOP</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="css/donhang.css">
	<link rel="stylesheet" href="css/logo.css">
	<link rel="stylesheet" href="css/admin.css">
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
   					 <a class="nav-link " href="danhmuc.php">Quản lý Danh mục</a>
  				</li>
  				<li class="nav-item">
    				<a class="nav-link " href="sanpham.php">Quản lý sản phẩm</a>
  				</li> 
                <li class="nav-item">
    				<a class="nav-link active" href="donhang.php">Quản lý đơn hàng</a>
  				</li>
				<li class="nav-item">
    				<a class="nav-link" href="khachhang.php">Quản lý khách hàng</a>
  				</li>

			
</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-left">Quản lý Đơn hàng</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6" >
					<!-- phần tìm kiếm sản phẩm -->
						<form method = "post" role="form">
							<div class="form-group" style ="width: 300px; float : left">
								<input type="text" class="timkiem form-control" placeholder="Tìm kiếm....." id="" name = "">
							</div>
							</form>
					</div>
				</div>
			
			
				<table class= "table table-bordered table-hover">
					<thead>
						<tr>
							<th width = "5%">STT</th>
                            <th width = "10%">Mã số ĐH</th>
							<th width = "10%">Mã số KH</th>
							<th width = "10%">Mã số NV</th>
                            <th width = "15%">Ngày đặt hàng</th>
							<th width = "15%">Ngày giao hàng</th>
							<th width = "10%"> Trạng thái</th>
							<th width = "10%"></th>
							<th width = "10%"></th>
							<th width = "5%"></th>
						</tr>
					</thead>
					<tbody class="danhsach">
							<?php
					// tìm kiếm sản phẩm  
					



					// lấy danh sách danh mục từ database 
					$sql  = 'select *  from dathang '; 
					$sanphamList = executeResult($sql); 
					$index = 1; 	
					foreach ($sanphamList as $item){
					echo	'<tr>
							<td>'. ($index++).'</td>
							<td>'.$item['masodh'].' </td>
							<td>'.$item['mskh'].' </td>
							<td>'.$item['msnv'].' </td>
                            <td>'.$item['ngaydh'].'</td>
							<td>'.$item['ngaygh'].'</td>
							<td>'.$item['trangthaidh'].'</td>
							<td>
							<a href="chitietdonhang.php?masodh='.$item['masodh'].'"><button class="btn btn-success">Chi tiết</button></a>
							</td>
							<td>
							<a href="capnhattt.php?masodh='.$item['masodh'].'"><button class="btn btn-warning">Cập nhật TT</button></a>
							</td>
							<td>
							<button class="btn btn-danger" onclick = " deleteDH('.$item['masodh'].')" >Xóa</button>
							</td>
						</tr>';
					}
					?>
					</tbody>
				</table>
		</div>
	</div>
	<script type="text/javascript">
			$(document).ready(function(){
		$('.timkiem').keyup(function(){
			var txt = $('.timkiem').val(); 
			$.post('ajaxdonhang.php',{data: txt},function(data){
				$('.danhsach').html(data);
			})
		})	
		})
	</script>
	<!-----hàm xóa Đơn hàng-------->

<script type = "text/javascript">
	function deleteDH(id){ 
		var option = confirm('Bạn có chắc chắn muốn xóa sản phẩm! ')
		if(!option){ 
			return; 
		}

		console.log(id)
		// ajax - lệnh post
		$.post('xoadonhang.php', { 
			'masodh': id, 
			'action': 'delete'
		}, function(data){ 
			location.reload()
		})
	}
	


</script>
</body>
</html>