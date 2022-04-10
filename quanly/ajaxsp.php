<?php
require_once ('../db/dbhelp.php');
// phần xóa sản phẩm
if(!empty($_POST)){ 
    if(isset($_POST['action'])){ 
        $action = $_POST['action']; 

        switch($action){ 
            case 'delete':
                if(isset($_POST['id'])){ 
                    $id = $_POST['id']; 

                    $sql = 'delete from hanghoa where id ='.$id; 
                    $query = 'delete from hinhhanghoa where id = '.$id; 
                    execute($sql);
                    execute($query);
                }
                break;
        }
    }
}
// Phần tìm kiếm sản phẩm
    $a = $_POST['data']; 
    $sql = "select  hanghoa.id, hanghoa.TenHH,
    hanghoa.Gia,hinhhanghoa.dchh,hanghoa.SoLuongHang,hanghoa.updated_at, loaihanghoa.TenLoaiHang loaihanghoa_TenLoaiHang from hanghoa 
    left join loaihanghoa on hanghoa.maloaihang = loaihanghoa.idl 
    left join hinhhanghoa on hanghoa.id = hinhhanghoa.id 
     where  TenHH like '%$a%' or Gia like '$a' or SoLuongHang like '$a' or hanghoa.id like '$a'  "; 
    $query = mysqli_query($con,$sql); 
    $num = mysqli_num_rows($query);
    $index =1 ;  
    if($num > 0){ 
        while($row = mysqli_fetch_array($query)){
					echo	'<tr>
                            <td>'.($index++).'</td>
							<td>'.$row['id'].'</td>
							<td> <img src="../quanly/image/'.$row['dchh'].'" style="max-width: 100px"/></td>
                            <td>'.$row['TenHH'].'</td>
                            <td>'.$row['Gia'].'</td>
                            <td>'.$row['SoLuongHang'].'</td>
                            <td>'.$row['loaihanghoa_TenLoaiHang'].'</td>
                            <td>'.$row['updated_at'].'</td>
							<td>
							<a href="addsp.php?id='.$row['id'].'"><button class="btn btn-warning">Sửa</button></a>
							</td>
							<td>
							<button class="btn btn-danger" onclick = " deleteHH('.$row['id'].')" >Xóa</button>
							</td>
						</tr>';
					}
        }

    

?>