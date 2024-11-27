<?php 

class modelHome 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllProduct(){
        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getVariantById($id, $variant_id){
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
    public function getVariantByProductId($id){
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
    public function getAllVariantByProductId($id){
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
    public function getProductById($id) {
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
    public function getAllAlbumByVariantId($id) {
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
    public function getAllSizeByVariantId($id){
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
    public function getAllCommentByProductId($id){
        try {
            $sql = "SELECT comments.id as id, comments.created_at, content, username, avatar, users.id as user_id FROM comments 
            INNER JOIN users on users.id = comments.user_id 
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
    public function insertComment($user_id, $product_id, $content){
        $sql = "INSERT INTO comments (product_id, user_id, content, created_at) VALUES (:product_id, :user_id, :content, now())";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id,
            ':content' => $content
        ]);
        return true;
    }
}