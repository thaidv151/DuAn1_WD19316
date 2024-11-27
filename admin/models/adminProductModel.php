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
    public function addProduct($product_name, $product_description)
    {
        try {
            $sql = "INSERT INTO products (product_name, product_description, created_at) 
            VALUES (:product_name, :product_description, now())";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':product_name' => $product_name,
                ':product_description' => $product_description,

            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertCategory($product_id, $category_id)
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
    public function insertVariant($product_id, $color, $thumbnail_variant, $price, $promotion_price)
    {
        try {
            $sql = "INSERT INTO variants (product_id, color, thumbnail_variant, price, promotion_price) VALUES (:product_id, :color, :thumbnail_variant, :price, :promotion_price)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':product_id' => $product_id,
                ':color' => $color,
                ':thumbnail_variant' => $thumbnail_variant,
                ':price' => $price,
                ':promotion_price' => $promotion_price,
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllProduct()
    {
        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getCategoryById($id)
    {
        try {
            $sql = "SELECT category_name, category_id FROM category_details
            INNER JOIN categories on categories.id = category_details.category_id
             WHERE product_id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getAllQuantityById($id)
    {
        try {
            $sql = "SELECT SUM(quantity_size) as total FROM size_details
             WHERE variant_id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getImageByProductId($id)
    {
        try {
            $sql = "SELECT thumbnail_variant FROM variants 
             WHERE product_id = '$id' LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function editStatusById($id, $changeStatus)
    {
        try {
            $sql = "UPDATE products SET status = :changeStatus WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'id' => $id,
                'changeStatus' => $changeStatus

            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getProductById($id)
    {
        try {
            $sql = "SELECT * FROM products 
             WHERE id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function editProduct($product_id, $product_name, $product_description)
    {
        try {
            $sql = "UPDATE products SET product_name = :product_name, product_description =:product_description, update_at = now() WHERE id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':product_id' => $product_id,
                ':product_name' => $product_name,
                ':product_description' => $product_description,
            
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteCategoriesById($product_id)
    {
        try {
            $sql = "DELETE FROM category_details WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':product_id' => $product_id,
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getVariantById($product_id)
    {
        try {
            $sql = "SELECT * FROM variants 
            WHERE product_id = '$product_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getListSizeByVariantId($variant_id)
    {
        try {
            $sql = "SELECT variant_id, quantity_size, size as name_size , size_id  FROM size_details
            INNER JOIN sizes on sizes.id = size_details.size_id
            WHERE variant_id = '$variant_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getlistAlbumByVariantId($variant_id)
    {
        try {
            $sql = "SELECT * FROM variant_albums 
            WHERE variant_id = '$variant_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getLinkImageById($id)
    {
        try {
            $sql = "SELECT link_image FROM variant_albums 
            WHERE id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function updateVariant($variant_id, $thumbnail_variant, $color, $price, $promotion_price)
    {
        try {
            $sql = "UPDATE variants SET thumbnail_variant =:thumbnail_variant, color = :color, price = :price, promotion_price = :promotion_price WHERE id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':variant_id' => $variant_id,
                ':thumbnail_variant' => $thumbnail_variant,
                ':color' => $color,
                ':price' => $price,
                ':promotion_price' => $promotion_price,
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function updateSizeVariant($variant_id, $size_id, $quantity_size)
    {
        try {
            $sql = "UPDATE size_details SET quantity_size =:quantity_size WHERE variant_id = :variant_id AND size_id = :size_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id,
                ':size_id' => $size_id,
                ':quantity_size' => $quantity_size
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteItemAlbums($id)
    {
        try {
            $sql = "DELETE FROM variant_albums WHERE variant_albums.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':id' => $id,

            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insertItemAlbumVariant($variant_id, $link_image)
    {
        try {
            $sql = "INSERT INTO variant_albums (variant_id, link_image) VALUES (:variant_id, :link_image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([

                ':variant_id' => $variant_id,
                ':link_image' => $link_image,

            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteAlbumById($variant_id)
    {
        try {
            $sql = "DELETE FROM variant_albums WHERE variant_id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteAllSizeById($variant_id)
    {
        try {
            $sql = "DELETE FROM size_details WHERE variant_id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteVariantById($variant_id)
    {
        try {
            $sql = "DELETE FROM variants WHERE id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':variant_id' => $variant_id
            ]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
