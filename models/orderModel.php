<?php
class modelOrder
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllNewOrderById($id, $from, $to)
    {
        try {
            $sql = "SELECT orders.id, orders.*, os.status FROM orders 
            INNER JOIN order_status as os on os.id = orders.order_status_id
            WHERE user_id = :id AND (order_status_id BETWEEN :from AND :to) 
            ORDER BY orders.created_at desc";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':from' => $from,
                ':to' => $to,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderById($id)
    {
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
    public function getAllStatusOrder()
    {
        try {
            $sql = "SELECT *  FROM order_status";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllProductByOrderId($order_id)
    {
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
    public function getVoucherByOrderId($order_id)
    {
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
    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderByUserId($id)
    {
        try {
            $sql = "SELECT orders.*, os.status FROM orders 
            INNER JOIN order_status as os on os.id = orders.order_status_id
            WHERE user_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllOrderNoReviewByUserId($id)
    {
        try {
            $sql = "SELECT o.id,o.order_code, o.created_at, o.user_id, p.product_name, od.product_id, od.variant_id, od.size, od.id as order_detail_id, v.color, v.thumbnail_variant FROM `orders` as o
                INNER JOIN order_details as od on od.order_id = o.id
                INNER JOIN products as p on p.id = od.product_id
                INNER JOIN variants as v on v.id = od.variant_id
                WHERE o.user_id = :id AND od.status_review = 0 AND o.order_status_id = 6
                ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertReview($product_id, $user_id, $rating_star, $order_detail_id, $content, $variant_id)
    {
        try {
            $sql = "INSERT INTO reviews (product_id, user_id, rating_star, order_detail_id, content, variant_id, created_at) 
            VALUE (:product_id, :user_id, :rating_star,:order_detail_id , :content, :variant_id, now())
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'rating_star' => $rating_star,
                'content' => $content,
                'order_detail_id' => $order_detail_id,
                'variant_id' => $variant_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeStatusReview($id)
    {
        try {
            $sql = "UPDATE order_details SET status_review = 1 WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeStatusOrder($id, $status_id)
    {
        try {
            $sql = "UPDATE orders SET order_status_id = :status_id WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':status_id' => $status_id,
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getOrderDetailByOrderId($order_id)
    {
        try {
            $sql = "SELECT s.id as size_id, product_id, variant_id, product_quantity FROM order_details as od
            INNER JOIN sizes as s on s.size = od.size
            WHERE order_id = :order_id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':order_id' => $order_id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeQuantitySize($variant_id, $quantity, $size_id)
    {
        try {
            $sql = "UPDATE size_details SET quantity_size = quantity_size + :quantity WHERE variant_id = :variant_id AND size_id = :size_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id,
                ':quantity' => $quantity,
                ':size_id' => $size_id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
