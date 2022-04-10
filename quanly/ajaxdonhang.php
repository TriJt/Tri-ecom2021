<?php
require_once ('../db/dbhelp.php');
// phần tìm kiếm đơn hàng 
$a = $_POST['data']; 
$sql = "select *  from dathang where mskh like '%$a%' or  masodh like '%$a%' or trangthaidh like '%$a%' or ngaydh like '%$a%'  "; 
$query = mysqli_query($con,$sql); 
$num = mysqli_num_rows($query);
$index =1 ; 
if($num > 0){ 
    while($row = mysqli_fetch_array($query)){
        echo	'<tr>
        <td>'. ($index++).'</td>
        <td>'.$row['masodh'].' </td>
        <td>'.$row['mskh'].' </td>
        <td>'.$row['msnv'].' </td>
        <td>'.$row['ngaydh'].'</td>
        <td>'.$row['ngaygh'].'</td>
        <td>'.$row['trangthaidh'].'</td>
        <td>
        <a href="chitietdonhang.php?masodh='.$row['masodh'].'"><button class="btn btn-success">Chi tiết</button></a>
        </td>
        <td>
        <a href="capnhattt.php?masodh='.$row['masodh'].'"><button class="btn btn-warning">Cập nhật TT</button></a>
        </td>
    </tr>';
}
    }
?>