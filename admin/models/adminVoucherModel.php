<?php
class adminVoucherModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function insertVoucher($title_voucher, $description, $used_count, $end_date, $disscount_value, $max_disscount_amount, $min_order_amount, $quantity_limit)
    {
        try {
            $sql = "INSERT INTO vouchers (
        title_voucher,
        description,
        used_count,
        created_date,
        end_date,
        disscount_value,
        max_disscount_amount,
        min_order_amount,
        quantity_limit ) 
        VALUES 
        (
        :title_voucher,
        :description,
        :used_count,
        now(),
        :end_date,
        :disscount_value,
        :max_disscount_amount,
        :min_order_amount,
        :quantity_limit
        )";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'title_voucher' => $title_voucher,
                'description' => $description,
                'used_count' => $used_count,
                'end_date' => $end_date,
                'disscount_value' => $disscount_value,
                'max_disscount_amount' => $max_disscount_amount,
                'min_order_amount' => $min_order_amount,
                'quantity_limit' => $quantity_limit
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllVoucher()
    {
        try {
            $sql = "SELECT * FROM vouchers";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getVoucherById($id)
    {
        try {
            $sql = "SELECT * FROM vouchers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'id' => $id
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeStatusById($id, $newStatus)
    {
        try {
            $sql = "UPDATE vouchers SET status = :newStatus WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':newStatus' =>$newStatus,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function updateVoucher($voucher_id, $title_voucher, $description, $used_count, $end_date, $disscount_value, $max_disscount_amount, $min_order_amount, $quantity_limit)
    {
        try {
            $sql = "UPDATE vouchers SET 
        title_voucher = :title_voucher,
        description = :description,
        used_count = :used_count,
        end_date = :end_date,
        disscount_value = :disscount_value,
        max_disscount_amount = :max_disscount_amount,
        min_order_amount = :min_order_amount,
        quantity_limit = :quantity_limit
        WHERE id = :voucher_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':voucher_id' => $voucher_id,
                ':title_voucher' => $title_voucher,
                ':description' => $description,
                ':used_count' => $used_count,
                ':end_date' => $end_date,
                ':disscount_value' => $disscount_value,
                ':max_disscount_amount' => $max_disscount_amount,
                ':min_order_amount' => $min_order_amount,
                ':quantity_limit' => $quantity_limit,
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderByVoucherId($id){
        
        try {
            $sql = "SELECT * FROM orders WHERE voucher_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteVoucherById($id){
        
        try {
            $sql = "DELETE FROM vouchers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
