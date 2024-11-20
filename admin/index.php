<?php

session_start();
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require file Common
if ($_SESSION['user']['role_id'] === 1 || $_SESSION['user']['role_id'] === 0) {


    // Require toàn bộ file Controllers
    require_once './controllers/adminController.php';
    require_once './controllers/adminProductController.php';
    require_once './controllers/AdminDanhMucController.php';
    require_once './controllers/AdminUserController.php';
    require_once './controllers/AdminOrderController.php';

    // Require toàn bộ file Models
    require_once './models/adminModel.php';
    require_once './models/adminProductModel.php';
    require_once './models/AdminDanhMuc.php';
    require_once './models/AdminUserModel.php';
    require_once './models/AdminOrderModel.php';
    // Route
    $act = $_GET['act'] ?? '/';

    // Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

    match ($act) {
        // Trang chủ
        '/' => (new adminController())->homeAdmin(),

        //danh mục
        'danh-muc' => (new adminDanhMucController())->DanhSachDanhMuc(),
        'form-them-danh-muc' => (new adminDanhMucController())->formThemDanhMuc(),
        'them-danh-muc' => (new adminDanhMucController())->postAddDanhMuc(),
        'xoa-danh-muc' => (new adminDanhMucController())->deleteDanhMuc(),


        // Quản lý sản phẩm
        // route thêm sản phẩm
        'add-product' => (new adminProductController())->addProduct(),
        // Xử lý post thêm sản phẩm
        'post-add-product' => (new adminProductController())->postAddProduct(),
        // Danh sách sản phẩm
        'list-product' => (new adminProductController())->listProduct(),
        // Sửa trạng thái của sản phẩm
        'edit-status' => (new adminProductController())->editStatusProduct(),
        // form Sửa sản phẩm
        'edit-product' => (new adminProductController())->formEditProduct(),
        // Sửa lý dữ liệu sửa sản phẩm
        'post-edit-product' => (new adminProductController())->postEditProduct(),
        // Xử lý dữ liệu sửa biến thế
        'post-edit-variant' => (new adminProductController())->postEditVariant(),
        // Xoá Sản phẩm
        'delete-product' => (new adminProductController())->deleteProduct(),
        // /Xoá biến thể
        'delete-variant' => (new adminProductController())->deleteVariant(),
        // form thêm biến thể
        'form-add-variant' => (new adminProductController())->formAddVariant(),
        // Xử lý dữ liệu thêm biến thể
        'post-add-variant' => (new adminProductController())->postAddVariant(),
        //  Sửa thông tin của quản trị viên
        'edit-profile' => (new adminUserController())->formEditProfile(),
        // Xử lý dữ liệu sửa thông tin
        'post-edit-profile' => (new adminUserController())->postEditProfile(),

        //Quản trị danh sách người dùng

        // Danh sách quản trị viên 
        'list-user-admin' => (new adminUserController())->listUserAdmin(),

        'change-role' => (new adminUserController())->changeRole(),

        'change-status-user' => (new adminUserController())->changeStatusUser(),

        'list-user-client' => (new adminUserController())->listUserClient(),


        // Xử lý đơn hàng
        'detail-order' => (new adminOrderController())->detailOrder(),

        'change-status-order' => (new adminOrderController())->changeStatusOrder(),

        'list-new-order' => (new adminOrderController())->listNewOrder(),

        'list-process-order' => (new adminOrderController())->listProcessOrder(), // Danh sách đơn hàng đã xác nhận
        'list-complete-order' => (new adminOrderController())->listCompleteOrder(), // Danh sách đơn hàng đã Hoàn thành
        'list-cancel-order' => (new adminOrderController())->listCancelOrder(), // Danh sách đơn hàng hoàn đã huỷ
        'list-return-order' => (new adminOrderController())->listReturnOrder(), // Danh sách đơn hàng đã Hoàn lại
    };
} else {
    header('location:' . BASE_URL . '?act=login');
    exit();
}
