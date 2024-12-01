<?php
class modelPayment
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllPaymentMethod()
    {
        try {
            $sql = 'SELECT * FROM payment_methods';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function inserNewOrder(
        $order_code,
        $user_id,
        $customer_name,
        $shipping_address,
        $customer_email,
        $customer_phone,
        $payment_method_id,
        $voucher_id,
        $shipping
    ) {

        try {
            $sql = "INSERT INTO orders 
               (
               created_at,
               order_code,
                user_id,
                customer_name,
                shipping_address,
                customer_email,
                customer_phone,
                payment_method_id,
                order_status_id,
                update_at,
                voucher_id,
                shipping
                ) 
                VALUES (
                now(),
                :order_code,
                :user_id,
                :customer_name,
                :shipping_address,
                :customer_email,
                :customer_phone,
                :payment_method_id,
                1,
                now(),
                :voucher_id,
                :shipping
                )";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_code' => $order_code,
                ':user_id' => $user_id,
                ':customer_name' => $customer_name,
                ':shipping_address' => $shipping_address,
                ':customer_email' => $customer_email,
                ':customer_phone' => $customer_phone,
                ':payment_method_id' => $payment_method_id,
                ':voucher_id' => $voucher_id,
                ':shipping' => $shipping
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertOrderDetail(
        $product_id,
        $order_id,
        $variant_id,
        $product_quantity,
        $size,
        $unit_cost
    ) {
        try {
            $sql = "INSERT INTO order_details 
               (
                product_id,
                order_id,
                variant_id,
                product_quantity,
                size,
                unit_cost,
                created_at,
                update_at
                ) 
                VALUES (
                :product_id,
                :order_id,
                :variant_id,
                :product_quantity,
                :size,
                :unit_cost,
                now(),
                now()
                )";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':product_id' => $product_id,
                ':order_id' => $order_id,
                ':variant_id' => $variant_id,
                ':product_quantity' => $product_quantity,
                ':size' => $size,
                ':unit_cost' => $unit_cost,
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeQuantityById($variant_id, $size_id, $quantity)
    {
        try {
            $sql = "UPDATE size_details SET quantity_size = quantity_size - :quantity WHERE variant_id = :variant_id AND size_id = :size_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id,
                ':size_id' => $size_id,
                ':quantity' => $quantity
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeQuantityVoucher($voucher_id)
    {
        try {
            $sql = "UPDATE vouchers SET used_count = (used_count + 1) WHERE id = :voucher_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':voucher_id' => $voucher_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
