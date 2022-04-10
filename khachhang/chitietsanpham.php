<!-- php phần lấy sản phẩm -->
<?php 
session_start(); 
require_once ('../db/dbhelp.php');
$id = '';
$hanghoa = '';  
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    $sql = 'select * from hanghoa where hanghoa.id= '.$id;  
    $hanghoa = executeSingleResult($sql); 
}

?>
<?php   
$user = isset($_SESSION['user'])? $_SESSION['user'] : [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=" viewport" content="width=device-width,initial-scale=1.0">
	<title><?php 
         $sql = 'select * from hanghoa where hanghoa.id = '.$id;  
         $sanphamList = executeResult($sql); 
         foreach($sanphamList as $item) {
             echo ' '.$item['TenHH'].'';
         } 
        ?></title>
    <!-- bootstrap 3 --> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- phần code css -->
    <link rel="stylesheet" href="css/tc.css">
    
    <link rel="stylesheet" href="css/sptc.css">
	<!-- phần font awesome -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type = "text/css">
    .button1{ 
        color:white;
        background-color: black;
        width: 200px;
         height:50px;
    }
    .button1:hover{
        background-color: #3ADF00;
    }
    .soluong{ 
        height: 40px;
        width: 80%;
        border: 2px groove;
        margin-bottom: 20px;
    }
    .soluong:hover{ 
        border: 2px solid black;
    }
    
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
                   
                    <li><a href="giohang.php" class="giohang"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Giỏ hàng</a></li>
                    <?php  if(isset($user['hoten'])){?>
                        <li class="dropdown">
                        <a href="dangnhap.php" class="dropdown-toggle" data-toggle="dropdown"> <?php  echo $user['hoten']?><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="dangxuat.php">Đăng xuất </a></li>
                            
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
<!-- phần chi tiết sản phẩm  -->
<div class="container">
    <div class="row">
        <div style="padding-left: 40px;">
        <a href="trangchu.php" style="color: black;" >Trang chủ /</a>
        <a href="sanpham.php" style="color: black" >BOOTS</a>/ <b> <?php 
         $sql = 'select * from hanghoa where hanghoa.id = '.$id;  
         $sanphamList = executeResult($sql); 
         foreach($sanphamList as $item) {
             echo ' '.$item['TenHH'].'';
         } 
        ?></b>
      </div>
        <hr>
        <?php 
        $sql = 'select  hanghoa.id, hanghoa.TenHH,
        hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.QuyCach from hanghoa   
        left join hinhhanghoa on hanghoa.id = hinhhanghoa.id 
        where hanghoa.id ='.$id;
        $sanphamList = executeResult($sql); 
        foreach($sanphamList as $item)?>
                <div class = "row">
                <div class="col-md-6">
                <!-- phần hình ảnh sản phẩm -->
                <img src ="../khachhang/image/<?=$item['dchh']?>" style="width: 80%;height:80%;">
                </div>
                <div class="col-md-6">
                    <!-- phần thông tin sản phẩm -->
                    <h2 ><?=$item['TenHH']?></h2>
                    <h4>Mặt hàng # <?php echo ''.$item['id'].'' ?></h4>
                    <h2 > $ <?=$item['Gia']?></h2>
                    <hr>
                    <small> <?=$item['QuyCach']?></small>
                    <hr>
                    <form action ="giohang.php" method = "POST">
                        <input type="number"  class = "soluong" name ="soluong" min="1" max= "10" value = "1" >
                        <select name="size"  class="soluong">
                            <option value="">Kích thước</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                        </select>
                        <br>
                        <input type="submit"  class="button1" name = "addcart" value="Đặt mua" >
                        <input type="hidden" name="TenHH" value= "<?=$item['TenHH']?>">
                        <input type="hidden" name="Gia" value= "<?=$item['Gia']?>">
                        <input type="hidden" name="dchh" value= "<?=$item['dchh']?>">
                        <input type="hidden" name="id" value= "<?=$item['id']?>">
                    </form>
                </div>
                </div>

            
        
        </div> 
        <hr>
</div>

<!--  lấy sản phẩm ngẫu nhiên sau khi hiện thị thông tin sản phẩm -->
<div class="container">
<h2 class="title"> CHO MỘT NGÀY MỚI</h2>
<!-- phần lấy sản phẩm  -->
<div class="col">
    <!-- phần lấy sản phẩm từ database -->
    <?php
        $sql  = 'select  hanghoa.id, hanghoa.TenHH,
        hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.updated_at, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa 
        left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl
        left join hinhhanghoa on hanghoa.id = hinhhanghoa.id 
        order by hanghoa.id limit 4 ' ; 
        $sanphamList = executeResult($sql);
        # phần lấy sản phẩm từ database 
    foreach ($sanphamList as  $item ){
      ?>    
                    <div class="col-md-3">
						<a href="chitietsanpham.php?id=<?=$item['id']?>"> <img src="../khachhang/image/<?=$item['dchh']?>" style="width: 90%;"></a>
                        <div class="ten">
                        <h3><?=$item['TenHH']?></h3> 
                        </div>
                        <div class="gia">
                        <h3><?=$item['Gia']?> $</h3>
                        </div>
                    </div>     
    <?php
    }
    ?>
        
    </div>
</div>

<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments# <?php echo $item['id'] ?> " data-width="" data-numposts="5"></div>
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
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="KAyFw2oq"></script>
</body>
</html>