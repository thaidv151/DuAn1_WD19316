<?php

session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/homeController.php';
require_once './controllers/userController.php';
require_once './controllers/cartController.php';
require_once './controllers/paymentController.php';
require_once './controllers/orderController.php';

// Require toàn bộ file Models
require_once './models/homeModel.php';
require_once './models/cartModel.php';
require_once './models/userModel.php';
require_once './models/paymentModel.php';
require_once './models/orderModel.php';

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

    'edit-profile' => (new userController())->formEditProfile(),

    'client-profile' => (new userController())->clientProfile(),

    'post-edit-profile' => (new userController())->postEditProfile(),
  

    'product-detail' => (new HomeController())->productDetail(),


    'post-comments' => (new HomeController())->postComment(),

    
    'thanks' => (new PaymentController())->returnByPayment(),

    'view-cart' => (new cartController())->viewListCart(),

    'delete-cart' => (new cartController())->deleteCart(),

    'add-to-cart' => (new cartController())->addToCart(),

    'form-check-out' => (new paymentController())->formCheckOut(),

    'post-check-out' => (new paymentController())->postCheckOut(),

    'change-status-comment' => (new HomeController())->changeStatusCommentById(),

    'delete-comment' => (new HomeController())->deleteComment(),

    'list-order' => (new orderController())->listOrder(),

    'view-order-detail' => (new orderController())->orderDetail(),

    'cancel-order' => (new orderController())->cancelOrder(),

    'complete-order' => (new orderController())->completeOrder(),

    'post-add-review' => (new orderController())->postAddReview(),

};
