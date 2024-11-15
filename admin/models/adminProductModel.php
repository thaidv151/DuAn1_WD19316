<?php
class adminProductModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getAllSize()
    {
        try {
            $sql = "SELECT * FROM sizes";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return "Error" . $e->getMessage();
        }
    }
    public function addProduct($product_name, $product_description, $price, $promotion_price)
    {
        try {
            $sql = "INSERT INTO products (product_name, product_description, price, promotion_price) 
            VALUES (:product_name, :product_description, :price, :promotion_price)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':product_name' => $product_name,
                ':product_description' => $product_description,
                ':price' => $price,
                ':promotion_price' => $promotion_price
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function addCategories($product_id, $category_id)
    {
        try {
            $sql = "INSERT INTO category_details (product_id, category_id) VALUES (:product_id, :category_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':product_id' => $product_id,
                ':category_id' => $category_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertAlbum($variant_id, $link_image)
    {
        try {
            $sql = "INSERT INTO variant_albums (variant_id, link_image) VALUES (:variant_id, :link_image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id,
                ':link_image' => $link_image
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertSize($variant_id, $quantity_size, $size_id)
    {
        try {
            $sql = "INSERT INTO size_details (variant_id, quantity_size, size_id) VALUES (:variant_id, :quantity_size, :size_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id,
                ':quantity_size' => $quantity_size,
                ':size_id' => $size_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertVariant($product_id, $color, $thumbnail_variant)
    {
        try {
            $sql = "INSERT INTO variants (product_id, color, thumbnail_variant) VALUES (:product_id, :color, :thumbnail_variant)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':product_id' => $product_id,
                ':color' => $color,
                ':thumbnail_variant' => $thumbnail_variant
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllProduct()
    {
        try {
            $sql = "SELECT * FROM products
        INNER JOIN variants on variants.product_id = products.id
        ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
