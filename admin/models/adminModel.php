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
    public function getOrderByMonthNow(){
        try {
            $sql = "SELECT *, MONTH(created_at) as week_now FROM orders 
            HAVING MONTH(created_at) = MONTH(CURRENT_TIMESTAMP) AND YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}