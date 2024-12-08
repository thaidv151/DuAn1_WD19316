<?php
class adminOrderController
{
    public $modelOrder;
    public $modelUser;
    public function __construct()
    {
        $this->modelOrder = new adminOrderModel;
        $this->modelUser = new adminUserModel;
    }
    public function listNewOrder()
    {
        $listNewOrder = $this->modelOrder->getAllOrderByStatusId(1);
    
        require_once './views/order/listNewOrder.php';
    }
    public function detailOrder()
    {
        $order_id = $_GET['order_id'];
        
        $orderById = $this->modelOrder->getOrderById($order_id); // lấy ra chi tiết đơn hàng
        $orderUser = $this->modelUser->getUserById($orderById['user_id']); // lấy ra user mua đơn hàng
        $allStatus = $this->modelOrder->getAllStatusOrder(); // lấy ra các trạng thái của đơn hàng
      
        $listProductByOrderId = $this->modelOrder->getAllProductByOrderId($order_id);
        // debug($listProductByOrderId); // Lấy hết cấc sản phẩm trong đơn hàng
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
        }else{
            $disscount = 0;
        }
        $shipping = $orderById['shipping'];
        $total = $subTotal - $disscount + $shipping;
       // tính ra giá ssau khi áp dụng voucher
        require_once './views/order/detailOrder.php';
        delteSessionError();
    }
    public function changeStatusOrder()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_GET['order_id'];
       
            $order_status_id = $_POST['order_status_id'];
            debug($order_status_id);
            $success = $this->modelOrder->changeStatusOrderById($order_id, $order_status_id);
            if ($success) {
                $_SESSION['success'] = 'Thay đổi trạng thái đơn hàng thành công';
                header('location:' . BASE_URL_ADMIN . '?act=detail-order&order_id=' . $order_id);
                exit();
            } else {
                $_SESSION['success'] = 'Thay đổi trạng thái đơn hàng thất bại';
                header('location:' . BASE_URL_ADMIN . '?act=detail-order&order_id=' . $order_id);
                exit();
            }
        }
    }
    public function listProcessOrder(){
        $listProcessOrder = $this->modelOrder->getAllOrderByStatusIdBetween(2, 5);
        
        require_once './views/order/listProcessOrder.php';
    }
    public function listCompleteOrder(){
        $listCompleteOrder = $this->modelOrder->getAllOrderByStatusId(6);

        require_once './views/order/listCompleteOrder.php';
    }
    public function listCancelOrder(){ 
        $listCancelOrder = $this->modelOrder->getAllOrderByStatusId(7);
        require_once './views/order/listCancelOrder.php';
       
    }
    public function listReturnOrder(){
         $listReturnOrder = $this->modelOrder->getAllOrderByStatusId(8);
         require_once './views/order/listReturnOrder.php';
    }
    

}
