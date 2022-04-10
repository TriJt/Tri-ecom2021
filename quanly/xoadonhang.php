<?php
require_once ('../db/dbhelp.php');
// phần xóa dơn hàng
if(!empty($_POST)){ 
    if(isset($_POST['action'])){ 
        $action = $_POST['action']; 

        switch($action){ 
            case 'delete':
                if(isset($_POST['masodh'])){ 
                    $id = $_POST['masodh']; 

                    $sql = 'delete from dathang where masodh ='.$id; 
                    $query = 'delete from chitietdathang where masodh = '.$id; 
                    execute($sql);
                    execute($query);
                }
                break;
        }
    }
}
?>