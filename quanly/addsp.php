<?php 
require_once ('../db/dbhelp.php');
session_start();
$useradmin = isset($_SESSION['useradmin'])? $_SESSION['useradmin'] : [];
$TenHH = $id  = $Gia = $hinhanh = $QuyCach = $SoluongHang = $maloaihang = '';
if(!empty($_POST))
{
    
    if(isset($_POST['TenHH'])){ 
        $TenHH = $_POST['TenHH'];
        $TenHH = str_replace('"','\\"',$TenHH);
    }
	if(isset($_POST['id'])){ 
        $id = $_POST['id'];
    }
    
    if(isset($_POST['Gia'])){ 
        $Gia = $_POST['Gia'];
        $Gia = str_replace('"','\\"',$Gia);
    }

    if(isset($_POST['dchh'])){ 
        $hinhanh = $_POST['dchh'];
        $hinhanh = str_replace('"','\\"',$hinhanh);
    }

    if(isset($_POST['QuyCach'])){ 
        $QuyCach = $_POST['QuyCach'];
        $QuyCach = str_replace('"','\\"',$QuyCach);
    }

    if(isset($_POST['SoluongHang'])){ 
        $SoluongHang = $_POST['SoluongHang'];
        $SoluongHang = str_replace('"','\\"',$SoluongHang);
    }

    if(isset($_POST['maloaihang'])){ 
        $maloaihang = $_POST['maloaihang'];
    }
    if(!empty($TenHH)) { 
        $created_at = $updated_at = date('Y-m-d H:s:i'); 
            // lưu vào database
           if($id == '') {
               $id = rand(1,100);
                $sql = 'insert into hanghoa(id, TenHH, Gia, QuyCach, SoluongHang, maloaihang, created_at, updated_at) value ("'.$id.'","'.$TenHH.'","'.$Gia.'","'.$QuyCach.'","'.$SoluongHang.'","'.$maloaihang.'","'.$created_at.'","'.$updated_at.'")';
                $sql1= 'insert into hinhhanghoa(dchh,id) value ("'.$hinhanh.'","'.$id.'")'; 
           }else{ 
            $sql = 'update hanghoa set TenHH = "'.$TenHH.'", Gia = "'.$Gia.'",QuyCach = "'.$QuyCach.'",SoluongHang = "'.$SoluongHang.'",maloaihang = "'.$maloaihang.'"
             where id = '.$id; 
             $sql1= 'update hinhhanghoa set dchh = "'.$hinhanh.'" where id ='.$id; 
            }   
        execute($sql);
        execute($sql1);
        header('Location: sanpham.php'); 
        die(); 
    }
}

if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    $sql = 'select  hanghoa.id, hanghoa.TenHH,
    hanghoa.Gia,hinhhanghoa.dchh, hanghoa.SoluongHang, hanghoa.QuyCach, hanghoa.maloaihang  from hanghoa 
    left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl
    left join hinhhanghoa on hanghoa.id = hinhhanghoa.id  where hanghoa.id ='.$id; 
    $hanghoa = executeSingleResult($sql); 
    if($hanghoa != null ){   
        $TenHH = $hanghoa['TenHH'];
        $Gia = $hanghoa['Gia'];
        $QuyCach = $hanghoa['QuyCach'];
        $hinhanh = $hanghoa['dchh'];
        $SoluongHang = $hanghoa['SoluongHang'];
        $maloaihang = $hanghoa['maloaihang'];

    }
    

}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Thêm sản phẩm - PEACESHOP</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/themsp.css">
    <link rel="stylesheet" href="summernote-bs4.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel = "stylesheet" href= "css/logo.css">
    <link rel = "stylesheet" href= "css/admin.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script   script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
				<h2 class="text-left">Thêm/Sửa Sản phẩm</h2>
			</div>
			<div class="panel-body">
                <form method="post">

            <div class="bentrai">
				<div class="form-group">
				  <label for="TenHH">Tên sản phẩm: </label>
				  <input type="text" name="id"  value= "<?=$id?>" hidden = true >
				  <input required="true" type="text" class="form-control1" id="TenHH" name="TenHH" value= "<?=$TenHH?>" >
				</div>

                <div class="form-group"> 
                <label for="maloaihang">Chọn danh mục: </label>
                <select class="form-control1" name="maloaihang" id="maloaihang">
                    <option >--- Lựa chọn Danh mục Giày</option>
<?php
$sql  = 'select * from loaihanghoa '; 
$quanlyList = executeResult($sql); 

foreach ($quanlyList as $item){ 
    if($item['idl'] == $maloaihang){
    echo '<option selected value = "'.$item['idl'].'">'.$item['TenLoaiHang'].'</option>'; 
    }else{ 
        echo '<option value = "'.$item['idl'].'">'.$item['TenLoaiHang'].'</option>';
    }

}

?>
                </select>
                </div> 

                <div class="form-group">
				  <label for="Gia">Giá bán: </label>
				  <input required="true" type="text" class="form-control1" id="Gia" name="Gia" value= "<?=$Gia?>">
				</div>
            
                <div class="form-group">
				  <label for="SoluongHang"> Số Lượng: </label>
				  <input required="true" type="number" class="form-control1" id="SoluongHang" name="SoluongHang" value= "<?=$SoluongHang?>">
				</div>
                </div>

            <div class="benphai">
                <div class="form-group">
				  <label for="dchh">Hình Ảnh: </label>
				  <input required="true" type="file"  class="form-control1" id="dchh" name="dchh" value= "<?=$hinhanh?>" onchang= "updateHinhanh()">
                   <img src="../quanly/image/<?=$hinhanh?>" style="max-width: 200px" id = "img-sanpham">
				</div>
                <div class="form-group">
				  <textarea class="form-control1-text" row="3" id="QuyCach" name="QuyCach" ><?=$QuyCach?></textarea>
				</div>
				<button class="button">Lưu</button>
			    
                </div>
                </form>
                </div>
            </div>
		</div>
        <div style="margin-top: 30px;"></div>
	
    <script type = "text/javascript">
        function updateHinhanh(){ 
            $('#img-sanpham').attr('src', s('#dchh').val())
        }
       $('#QuyCach').summernote(
           { 
               height: 200, 
               codemmirror:{ 
                   theme: 'eclipse'
               }
           }
       );
    </script>


</body>
</html>