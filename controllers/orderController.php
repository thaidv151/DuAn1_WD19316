<?php

class orderController
{
    public $modelOrder;
    public function __construct()
    {
        $this->modelOrder = new modelOrder;
    }
    function listOrder()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['success'] = 'Bạn cần đăng nhập để xem đơn hàng';
            header('location:' . BASE_URL . '?act=login');
            exit();
        }
        $listNewOrder = $this->modelOrder->getAllNewOrderById($_SESSION['user']['id'], 1, 3);
        $listOrderShipping = $this->modelOrder->getAllNewOrderById($_SESSION['user']['id'], 4, 5);
        $listOrderCompelete = $this->modelOrder->getAllNewOrderById($_SESSION['user']['id'], 6, 6);
        $listOrderCancel = $this->modelOrder->getAllNewOrderById($_SESSION['user']['id'], 7, 8);
        $listOrderNoReview = $this->modelOrder->getAllOrderNoReviewByUserId($_SESSION['user']['id']);
        // debug($listOrderNoReview);
        require_once './views/orders/listOrder.php';
        delteSessionError();
    }
    public function orderDetail()
    {
        $order_id = $_GET['order_id'];

        $orderById = $this->modelOrder->getOrderById($order_id);
        // lấy ra chi tiết đơn hàng
        $orderUser = $this->modelOrder->getUserById($orderById['user_id']); // lấy ra user mua đơn hàng
        $allStatus = $this->modelOrder->getAllStatusOrder(); // lấy ra các trạng thái của đơn hàng
        $listProductByOrderId = $this->modelOrder->getAllProductByOrderId($order_id);
        // Lấy hết cấc sản phẩm trong đơn hàng
        $subTotal = 0;
        foreach ($listProductByOrderId as $key => $product) { // lấy ra tổng giá tất cả các đơn hàng cộng lại
            $subTotal += $product['total_cost'];
        }

        $voucher = $this->modelOrder->getVoucherByOrderId($order_id);

        if (!empty($voucher)) {
            if (($subTotal / 100 * $voucher['disscount_value']) < $voucher['max_disscount_amount']) {
                $disscount = ($subTotal / 100 * $voucher['disscount_value']);
            } else {
                $disscount = $voucher['max_disscount_amount'];
            }
        } else {
            $disscount = 0;
        }
        $shipping = $orderById['shipping'];
        $total = $subTotal - $disscount + $shipping;


        require './views/orders/orderDetail.php';
        delteSessionError();
    }
    public function postAddReview()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rate = $_POST['rate'];
            $content = $_POST['content'];
            $product_id = $_POST['product_id'];
            $variant_id = $_POST['variant_id'];
            $order_detail_id = $_POST['order_detail_id'];
            $addReview = $this->modelOrder->insertReview($product_id, $_SESSION['user']['id'], $rate, $order_detail_id, $content, $variant_id);
            $changeStatus = $this->modelOrder->changeStatusReview($order_detail_id);
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    public function cancelOrder(){
        $order_id = $_GET['order_id'];
        $success = $this->modelOrder->changeStatusOrder($order_id, 7);

        $orderDetail = $this->modelOrder->getOrderDetailByOrderId($order_id);
        foreach ($orderDetail as $key => $item) {
            $this->modelOrder->changeQuantitySize($item['variant_id'], $item['product_quantity'], $item['size_id']);
        }
       
        if($success) {
            $_SESSION['success'] = 'Huỷ đơn hàng thành công';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    public function completeOrder(){
        $order_id = $_GET['order_id'];
        $success = $this->modelOrder->changeStatusOrder($order_id, 6);
        
        if($success) {
            $_SESSION['success'] = 'Hoàn thành đơn hàng thành công';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
