<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
function debug($bug){
    echo '<pre>';
    var_dump($bug);die();
}
function uploadFile($file, $folder){
    
    $pathStorage = $folder . time() . $file['name'];
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;
    if(move_uploaded_file($from, $to)){
        return $pathStorage;
    }else{
        return null;
    }
}
function delteSessionError(){
    if(isset($_SESSION['flash'])){
        unset($_SESSION['error']);
        unset($_SESSION['flash']);
    }
    if(isset($_SESSION['success'])){
        unset($_SESSION['success']);
    }

}
function deleteFile($file){
    $path = PATH_ROOT . $file;
    if(file_exists($path)){
        unlink($path);
    }
}
function formatDate ($date){
    echo date_format($date,"d/m/Y");
}
