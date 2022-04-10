<?php
require_once('config.php'); 
$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
function execute($sql){
    // lưu dât vào bảng
    // mở connection đến database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE); 
    //  lệnh insert, update , delete
    mysqli_query($con,$sql); 

    // đóng connection
    mysqli_close($con);
}

function executeResult($sql){ 
    // lưu dât vào bảng
    // mở connection đến database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    //  lệnh insert, update , delete
    $result = mysqli_query($con,$sql); 
    $data = [];
    if($result != null){ 
        while($row = mysqli_fetch_array($result,1)){ 
            $data[] = $row;
    } 
    }
    mysqli_close($con); 
    return $data;

}
function tongsp($sql){ 
    // lưu dât vào bảng
    // mở connection đến database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    //  lệnh insert, update , delete
    $result = mysqli_query($con,$sql); 
    $data = mysqli_fetch_assoc($result);
    mysqli_close($con); 
    echo $data['tongsp'];

}
function tongdonhangquanly($sql){ 
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    $result = mysqli_query($con,$sql); 
    $data = mysqli_fetch_assoc($result);
    mysqli_close($con); 
    echo $data['tongdonhang'];
}
// kết quả chỉ trả về một bảng
function executeSingleResult($sql){ 
    // lưu dât vào bảng
    // mở connection đến database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    //  lệnh insert, update , delete
    $result = mysqli_query($con,$sql); 
    $row = mysqli_fetch_array($result,1);
    
    mysqli_close($con); 
    return $row;

}