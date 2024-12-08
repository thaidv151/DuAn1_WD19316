<?php

class modelHome
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllProduct()
    {
        try {
            $sql = "SELECT * FROM products 
            WHERE status = 1
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllProductViewDesc()
    {
        try {
            $sql = "SELECT * FROM products 
            WHERE status = 1
            ORDER BY view desc LIMIT 4";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM categories " ;
         
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getVariantById($id, $variant_id)
    {
        try {
            $sql = "SELECT * FROM variants WHERE product_id = :id && id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'id' => $id,
                    ':variant_id' => $variant_id
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllVariantByProductId($id)
    {
        try {
            $sql = "SELECT * FROM variants WHERE product_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'id' => $id,
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getProductById($id)
    {
        try {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllAlbumByVariantId($id)
    {
        try {
            $sql = "SELECT * FROM variant_albums WHERE variant_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllSizeByVariantId($id)
    {
        try {
            $sql = "SELECT * FROM size_details 
            INNER JOIN sizes on size_details.size_id = sizes.id 
            WHERE variant_id = :id
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
    public function getAllCategoryByProductId($id)
    {
        try {
            $sql = "SELECT category_id FROM category_details 
           
            WHERE product_id = :id
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
    public function getAllProductByCategoryId($id)
    {
        try {
            $sql = "SELECT * FROM category_details 
           INNER JOIN products on products.id = category_details.product_id
            WHERE category_id = :id
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
    public function getAllCommentByProductId($id)
    {
        try {
            $sql = "SELECT comments.status,  comments.id as id, comments.created_at, content, username, avatar, users.id as user_id FROM comments 
            INNER JOIN users on users.id = comments.user_id 
            WHERE  comments.product_id = :id
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
    public function insertComment($user_id, $product_id, $content)
    {
        $sql = "INSERT INTO comments (product_id, user_id, content, created_at) VALUES (:product_id, :user_id, :content, now())";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id,
            ':content' => $content
        ]);
        return true;
    }
    public function getAllReviewByProductId($id){
        try {
            $sql = "SELECT  r.id, r.product_id, r.user_id, r.rating_star, r.content, r.variant_id, r.order_detail_id, r.created_at, v.color,v.thumbnail_variant, o.size, u.username, u.avatar FROM reviews as r
           INNER JOIN variants as v on v.id = r.variant_id
           INNER JOIN order_details as o on o.id = r.order_detail_id
           INNER JOIN users as u on u.id = r.user_id
            WHERE r.product_id = :id
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
    public function getAllBanner(){
        try {
            $sql = "SELECT * FROM banners ORDER BY number_order asc ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function countViewProduct($id){
        try {
            $sql = "UPDATE products SET view = view + 1 WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                ['id' => $id]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function changeStatusComment($id){
        try {
            $sql = "UPDATE comments 
            SET status = CASE
            WHEN status = 1 THEN 0 
            ELSE 1 
            END
            WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                ['id' => $id]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteCommentById($id){
        try {
            $sql = "DELETE FROM comments
            WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                ['id' => $id]
            );
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
