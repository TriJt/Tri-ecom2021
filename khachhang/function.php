<?php



function taogiohang($tensp,$hinhanh,$dongia,$soluong,$size,$thanhtien,$masodh){ 
    $conn = ketnoidb(); 
    $sql = "INSERT INTO chitietdathang (tensp,hinhanh,dongia,soluong,size,thanhtien,masodh)
    VALUES ('$tensp','$hinhanh','$dongia','$soluong','$size','$thanhtien','$masodh')";
    // use exec() because no results are returned
    $conn->exec($sql);
    $conn = null;
}
$user = isset($_SESSION['user'])? $_SESSION['user'] : [];
function taodonhang($mskh,$msnv,$tong){ 
    $conn = ketnoidb(); 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $trangthai = "Đã đặt hàng"; 
    $ngaydh = date('Y-m-d H:i:s'); 
    $ngaygh = strtotime(date("Y-m-d", strtotime($ngaydh)) . " +1 week");
    $ngaygh = strftime("%Y-%m-%d", $ngaygh);
    // insert vào bảng đặt hàng với các trường nngaydh,ngaygh,trangthai,tongtien
    $sql = "INSERT INTO dathang (mskh,msnv, ngaydh,ngaygh,trangthaidh,tongtien)
    VALUES ('$mskh','$msnv','$ngaydh','$ngaygh','$trangthai','$tong')";
    // use exec() because no results are returned
    $conn->exec($sql);
    $last_id = $conn->lastInsertId(); 
    $conn = null;
    return $last_id; 
}




function ketnoidb(){ 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "baitaplon2";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn; 
    } catch(PDOException $e) {
    echo  $e->getMessage();
    }

    $conn = null;
}

function tongdonhang(){ 
    $tong = 0; 
    if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang'])))
    {
        if(sizeof($_SESSION['giohang'])>0){
       
        for($i=0; $i< sizeof($_SESSION['giohang']);$i++){
            $tt= $_SESSION['giohang'][$i][2]*$_SESSION['giohang'][$i][3];
            $tong+=$tt; 
            }
        } 
    }
    return $tong; 
}



function showgiohang(){ 
    $ttgh = "";
         if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang'])))
         {
             if(sizeof($_SESSION['giohang'])>0){
             $tong = 0; 
             for($i=0; $i< sizeof($_SESSION['giohang']);$i++){
                 $tt= $_SESSION['giohang'][$i][2]*$_SESSION['giohang'][$i][3];
                 $tong+=$tt; 
                 $ttgh.= '<tr>
                         <td><img src = "../khachhang/image/'.$_SESSION['giohang'][$i][0].'" style = "width:150px"></td>
                         <td> <b style ="font-size: 16px">'.$_SESSION['giohang'][$i][1].' </b> <br>
                            
                            <b>Size: </b> '.$_SESSION['giohang'][$i][4].' 
                         </td>
                         <td></td>
                         <td>$'.$_SESSION['giohang'][$i][2].'</td>
                         <td> '.$_SESSION['giohang'][$i][3].' <a href = "giohang.php?delid='.$i.'" style ="padding-left: 30px">Xóa</a> </td>
                         <td> 
                         <div>$'.$tt.' </div>
                         </td>
                         <td> 
                         <div></div>
                         </td>
                     </tr>
              ';
             }
             $ttgh.='  <tr>
             <th></th>
             <th></th>
             <th></th>     
                         <th></th>
                         <th colspan ="0"><div style= "text-align: right">Tổng thành tiền</div></th>
                         <th><div style= "text-align: right">$'.$tong.'</div></th>
                    </tr>
                    
             ';
             }
             else {
                 echo '
                        <div style = " padding-top: 50px; text-align: center; padding-bottom: 40px;color:black"> 
                        <h1> GIỎ HÀNG CỦA BẠN ĐANG RỖNG </h1>
                        </div>
                        
                 ';
             }
         }
         return $ttgh; 
     }

?>


