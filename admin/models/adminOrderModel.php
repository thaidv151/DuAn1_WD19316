<?php
class adminOrderModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllOrderByStatusId($status_id){
        try {
            $sql = "SELECT orders.* ,status, payment_method_name FROM orders 
            INNER JOIN order_status on order_status.id = orders.order_status_id
            INNER JOIN payment_methods on payment_methods.id = orders.payment_method_id
            WHERE order_status_id = :status_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'status_id' => $status_id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderByStatusIdBetween($from, $to){
        try {
            $sql = "SELECT orders.* ,status, payment_method_name FROM orders 
            INNER JOIN order_status on order_status.id = orders.order_status_id
            INNER JOIN payment_methods on payment_methods.id = orders.payment_method_id
            WHERE order_status_id BETWEEN :from AND :to";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'from' => $from,
                'to' => $to,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderById($id){
        try {
            $sql = "SELECT orders.* ,status, payment_method_name FROM orders 
            INNER JOIN order_status on order_status.id = orders.order_status_id
            INNER JOIN payment_methods on payment_methods.id = orders.payment_method_id
           
            WHERE orders.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllStatusOrder(){
        try {
            $sql = "SELECT *  FROM order_status";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeStatusOrderById($order_id, $order_status_id){
        try {
            $sql = "UPDATE orders SET order_status_id = :order_status_id WHERE id = :order_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':order_id' => $order_id,
                    ':order_status_id' => $order_status_id,
                ]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllProductByOrderId($order_id){
        try {
            $sql = "SELECT product_name, product_description, color, thumbnail_variant, product_quantity, size, unit_cost, product_quantity * unit_cost as total_cost FROM order_details
            INNER JOIN products on products.id = order_details.product_id
            INNER JOIN variants on variants.id = order_details.variant_id
            WHERE order_details.order_id = :order_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_id' => $order_id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getVoucherByOrderId($order_id){
        try {
            $sql = "SELECT vouchers.*  FROM orders 
            INNER JOIN vouchers on vouchers.id = orders.voucher_id
            WHERE orders.id = :order_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_id' => $order_id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
}