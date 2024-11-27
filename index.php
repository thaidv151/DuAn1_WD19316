<?php 

session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/homeController.php';
require_once './controllers/userController.php';

// Require toàn bộ file Models
require_once './models/homeModel.php';
require_once './models/userModel.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),

    'login' => (new userController())->login(),

    'post-login' => (new userController())->postLogin(),

    'register' => (new userController())->register(),

    'post-register' => (new userController())->postRegister(),

    'logout' => (new userController())->logout(),


    'product-detail' => (new HomeController())->productDetail(),

    'post-add-cart' => (new HomeController())->postAddCart(),

'post-comments' => (new HomeController())->postComment(),
    
};