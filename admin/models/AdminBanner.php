<?php

class AdminBanner
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả các banner
    public function getAllBanners()
    {
        try {
            $sql = "SELECT * FROM banners ORDER BY number_order ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi lấy danh sách banners: " . $e->getMessage());
            return [];
        }
    }

    // Thêm banner
   // Thêm banner mới
   public function insertBanner($number_order, $image_link, $product_link, $status)
   {
       try {
           $sql = "INSERT INTO banners (number_order, image_link, product_link, status) 
                   VALUES (:number_order, :image_link, :product_link, :status)";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute([
               ':number_order' => $number_order,
               ':image_link' => $image_link,
               ':product_link' => $product_link,
               ':status' => $status
           ]);
           return true;
       } catch (PDOException $e) {
           error_log("Lỗi khi thêm banner: " . $e->getMessage());
           return false;
       }
   }

    // Lấy banner theo ID
    public function getBannerById($id)
    {
        try {
            $sql = "SELECT * FROM banners WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi lấy banner theo ID: " . $e->getMessage());
            return null;
        }
    }

    // Cập nhật banner
    public function updateBanner($id, $number_order, $image_link, $product_link, $status)
    {
        try {
            $sql = "UPDATE banners 
                    SET number_order = :number_order, 
                        image_link = :image_link, 
                        product_link = :product_link, 
                        status = :status 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':number_order' => $number_order,
                ':image_link' => $image_link,
                ':product_link' => $product_link,
                ':status' => $status,
                ':id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Lỗi cập nhật banner: " . $e->getMessage());
            return false;
        }
    }

    // Xóa banner
    public function deleteBanner($id)
    {
        try {
            $sql = "DELETE FROM banners WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Lỗi xóa banner: " . $e->getMessage());
            return false;
        }
    }
}

?>
