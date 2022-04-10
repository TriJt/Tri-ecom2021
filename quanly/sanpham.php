<?php 
require_once ('../db/dbhelp.php');
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quản Lý Sản Phẩm - PEACESHOP</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/donhang.css">
	<link rel="stylesheet" href="css/logo.css">
	<link rel="stylesheet" href="css/admin.css">
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

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
    				<a class="nav-link active" href="sanpham.php">Quản lý sản phẩm</a>
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
				<h2 class="text-left">Quản lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">	
						<a href="addsp.php" > <button class="btn btn-success" style="margin-bottom: 15px"> Thêm sản phẩm</button></a>
						<div>
							
							<h5 > <?php
								$sql = "select count(*) as `tongsp` from hanghoa"; 
								$tongsp = tongsp($sql); 
							?> sản phẩm</h5>
						</div>
					</div>					
					<div class="col-lg-6">
					<!-- phần tìm kiếm sản phẩm -->
						<form method = "post" role = "form">
							<div class="form-group" style ="width: 300px; float : right">
								<input type="text" class="timkiem form-control" placeholder="Tìm kiếm....." name = "" value="" >	
							</div>
						</form>
					</div>
				</div>
				<table class= "table table-bordered table-hover">
					<thead>
						<tr>
							<th width = "5%">STT</th>
							<th width = "5%">Mã SP</th>
                            <th width = "15%%">Hình Ảnh</th>
							<th width = "25%">Tên Sản Phẩm </th>
                            <th width = "10%">Giá bán  </th>
                            <th width = "10%">Số lượng </th>
                            <th width = "10%">Danh mục </th>
                            <th width = "14%">Ngày cập nhật </th>
							<th width = "3%"> </th>
							<th width = "3%"></th>
						</tr>
					</thead>
					<tbody class="danhsach">
							<?php
					// lấy danh sách danh mục từ database 
					$sql  = 'select  hanghoa.id, hanghoa.TenHH,
                    hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.updated_at, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa 
					left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl 
					left join hinhhanghoa on hanghoa.id = hinhhanghoa.id 
					order by hanghoa.id
					 ';
					$sanphamList = executeResult($sql); 
					$index =1 ; 
					foreach ($sanphamList as $item){
					echo	'<tr>
							<td>'.($index++).'</td>
							<td>'.$item['id'].'</td>
							<td> <img src="../image/'.$item['dchh'].'" style="max-width: 100px"/></td>
                            <td>'.$item['TenHH'].'</td>
                            <td>'.$item['Gia'].'</td>
                            <td>'.$item['SoLuongHang'].'</td>
                            <td>'.$item['loaihanghoa_TenLoaiHang'].'</td>
                            <td>'.$item['updated_at'].'</td>
							<td>
							<a href="addsp.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
							</td>
							<td>
							<button class="btn btn-danger" onclick = " deleteHH('.$item['id'].')" >Xóa</button>
							</td>

						</tr>';
					}
					?>
						
					</tbody>
				</table>
					
		</div>
	</div>
<!-----hàm xóa loại-------->

<script type = "text/javascript">
	function deleteHH(id){ 
		var option = confirm('Bạn có chắc chắn muốn xóa sản phẩm! ')
		if(!option){ 
			return; 
		}

		console.log(id)
		// ajax - lệnh post
		$.post('ajaxsp.php', { 
			'id': id, 
			'action': 'delete'
		}, function(data){ 
			location.reload()
		})
	}
	$(document).ready(function(){
		$('.timkiem').keyup(function(){
			var txt = $('.timkiem').val(); 
			$.post('ajaxsp.php',{data: txt},function(data){
				$('.danhsach').html(data);
			})
		})	
		})



</script>




</body>
</html>