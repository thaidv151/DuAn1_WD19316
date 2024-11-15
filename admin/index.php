<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/adminController.php';
require_once './controllers/adminProductController.php';

// Require toàn bộ file Models
require_once './models/adminModel.php';
require_once './models/adminProductModel.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new adminController())->homeAdmin(),
    

    // Quản lý sản phẩm
    // route thêm sản phẩm
    'add-product' => (new adminProductController())->addProduct(),
    // Xử lý post thêm sản phẩm
    'post-add-product' => (new adminProductController())->postAddProduct(),
    'list-product' => (new adminProductController())->listProduct(),
};