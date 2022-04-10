<?php
require_once ('../db/dbhelp.php');


if(!empty($_POST)){ 
    if(isset($_POST['action'])){ 
        $action = $_POST['action']; 

        switch($action){ 
            case 'delete':
                if(isset($_POST['idl'])){ 
                    $id = $_POST['idl']; 

                    $sql = 'delete from loaihanghoa where idl ='.$id; 
                    execute($sql);
                }
                break;
        }
    }
}