<?php


class AdminDanhMuc
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Hàm lấy tất cả danh mục
    public function getAllDanhMuc()
{
    try {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi lấy danh sách danh mục: " . $e->getMessage());
        return [];
    }
}

    

    // Hàm thêm danh mục mới
    public function inserDanhMuc($ten_danh_muc, $description, $status) {
        try {
            $sql = 'INSERT INTO categories (category_name, description, status) VALUES (:category_name, :description, :status)';
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':category_name' => $ten_danh_muc,
                ':description' => $description,
                ':status' => $status
            ]);
            return true;
        } catch (Exception $e) {
            echo 'lỗi: ' . $e->getMessage();
        }
    }

    


    // Hàm lấy thông tin danh mục theo ID
    public function getDanhMucById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Hàm cập nhật danh mục
    public function updateDanhMuc($id, $category_name, $description)
    {
        $sql = "UPDATE categories SET category_name = :category_name, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);
        
        return $stmt->execute();
    }

    // Hàm xóa danh mục
    public function deleteDanhMuc($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}

?>
