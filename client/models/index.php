<?php

session_start();
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require file Common
if ($_SESSION['user']['role_id'] === 1 || $_SESSION['user']['role_id'] === 0|| $_SESSION['user']['role_id'] === 2) {


    // Require toàn bộ file Controllers
    require_once './controllers/clientProductController.php';
    // require_once './controllers/adminProductController.php';
    // require_once './controllers/AdminDanhMucController.php';
    // require_once './controllers/AdminUserController.php';
    // require_once './controllers/AdminOrderController.php';
    // require_once './controllers/AdminVoucherController.php';

    // Require toàn bộ file Models
    require_once './models/clientProductModel.php';
    // require_once './models/adminProductModel.php';
    // require_once './models/AdminDanhMuc.php';
    // require_once './models/AdminUserModel.php';
    // require_once './models/AdminOrderModel.php';
    // require_once './models/AdminVoucherModel.php';
    // Route
    $act = $_GET['act'] ?? '/';

    // Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

    match ($act) {
        // Trang chủ
        '/' => (new adminController())->homeAdmin(),

    };
} else {
    header('location:' . BASE_URL . '?act=login');
    exit();
}
