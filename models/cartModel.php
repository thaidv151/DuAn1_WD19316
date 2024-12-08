<?php
class modelCart
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllCartByUserId($id)
    {
        try {
            $sql = "SELECT c.id, c.size_id, c.quantity, s.size, p.product_name, v.color, v.promotion_price, v.thumbnail_variant, c.product_id, c.variant_id FROM cart_details as c
            INNER JOIN variants as v on v.id = c.variant_id
            INNER JOIN products as p on p.id = c.product_id
            INNER JOIN sizes as s on s.id = c.size_id
            WHERE user_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                ['id' => $id]
            );
            return $stmt->fetchAll();
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
    public function deleteCartId($id)
    {
        try {
            $sql = "DELETE FROM cart_details WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                ['id' => $id]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getCartById($id)
    {
        try {
            $sql = "SELECT c.id, c.quantity, s.size, p.product_name, v.color, v.promotion_price, v.thumbnail_variant, c.product_id, c.variant_id, c.size_id
            FROM cart_details as c
            INNER JOIN variants as v on v.id = c.variant_id
            INNER JOIN products as p on p.id = c.product_id
            INNER JOIN sizes as s on s.id = c.size_id
             WHERE c.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                ['id' => $id]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getSizeInstock($variant_id, $size_id)
    {
        try {
            $sql = "SELECT * FROM size_details WHERE variant_id = :variant_id AND size_id = :size_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'variant_id' => $variant_id,
                    'size_id' => $size_id
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertCart($user_id, $product_id, $variant_id, $size_id, $quantity)
    {
        try {
            $sql = "INSERT INTO cart_details (user_id, product_id, variant_id, quantity, size_id)
            VALUES (:user_id, :product_id, :variant_id, :quantity , :size_id )";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':user_id' => $user_id,
                    ':product_id' => $product_id,
                    ':variant_id' => $variant_id,
                    ':size_id' => $size_id,
                    ':quantity' => $quantity,
                ]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function updateQuantityCart($id, $quantity){
        try {
            $sql = "UPDATE cart_details SET quantity = quantity + :quantity WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id,
                    ':quantity' => $quantity
                ]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
