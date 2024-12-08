<?php
class adminModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getOrderByDayNow(){
        try {
            $sql = "SELECT * FROM orders 
            HAVING DAY(created_at) = DAY(CURRENT_TIMESTAMP) AND MONTH(created_at) = MONTH(CURRENT_TIMESTAMP) AND YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderByWeekNow(){
        try {
            $sql = "SELECT *, WEEK(created_at, 1) as week_now FROM orders 
            HAVING WEEK(created_at, 1) = WEEK(CURRENT_TIMESTAMP, 1) AND YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderMonth(){
        try {
            $sql = "SELECT *, (MONTH(created_at)) as month FROM orders ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderByMonthNow($month){
        try {
            $sql = "SELECT *, MONTH(created_at) as week_now FROM orders 
            HAVING MONTH(created_at) = :month AND YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'month' => $month
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderCompleteByMonthNow($month){
        try {
            $sql = "SELECT *, MONTH(created_at) as week_now FROM orders 
            HAVING MONTH(created_at) = :month AND YEAR(created_at) = YEAR(CURRENT_TIMESTAMP) AND orders.order_status_id = 6
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'month' => $month
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderByYearNow(){
        try {
            $sql = "SELECT *, YEAR(created_at) as week_now FROM orders 
            HAVING YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllUser(){
        try {
            $sql = "SELECT * FROM users
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderDetailById($id){
        try {
            $sql = "SELECT * FROM order_details WHERE order_id = :id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'id'=> $id
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getVoucherById($id){
        try {
            $sql = "SELECT * FROM vouchers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'id'=> $id
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderCancelPaidMoney(){
        try {
            $sql = "SELECT * FROM orders WHERE order_status_id = 7 AND payment_method_id != 1 AND update_at >= NOW() - INTERVAL 7 DAY";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderDelivered(){
        try {
            $sql = "SELECT * FROM orders WHERE order_status_id = 5 AND update_at <= NOW() - INTERVAL 3 DAY";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}