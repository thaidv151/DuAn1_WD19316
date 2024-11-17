<?php
class AdminDanhMucController
{
    public $modelDanhmuc;

    public function __construct()
    {
        $this->modelDanhmuc = new AdminDanhMuc();
    }

    // Hiển thị danh sách danh mục
    public function DanhSachDanhMuc()
    {
        // Lấy tất cả danh mục từ model
        $listDanhMuc = $this->modelDanhmuc->getAllDanhMuc();
        
        // Hiển thị view với danh sách danh mục
        require_once './views/danhmuc/listDanhMuc.php';
    }
    
    // Hiển thị form thêm danh mục mới
    public function fromAddDanhMuc()
    {
        require_once './views/danhmuc/addDanhMuc.php';
    }

    // Xử lý việc thêm danh mục
    public function postAddDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['category_name'];
            $description = $_POST['description'] ?? ''; // Thêm mô tả từ form
            $status = $_POST['status'] ?? 1; // Trạng thái mặc định là 1 (hoặc giá trị bạn muốn)
    
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['category_name'] = 'Tên danh mục không để trống';
            }
    
            if (empty($errors)) {
                $this->modelDanhmuc->inserDanhMuc($ten_danh_muc, $description, $status);
                header("Location:" . BASE_URL_ADMIN . '?act=danh-muc');
            } else {
                require_once './views/danhmuc/addDanhMuc';
             
                exit();
            }
        }
    }
 
 
    // Xử lý xóa danh mục
    public function deleteDanhMuc()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Gọi phương thức deleteDanhMuc từ model để xóa danh mục
            if ($this->modelDanhmuc->deleteDanhMuc($id)) {
                // Xóa thành công, chuyển hướng về trang danh sách
                header("Location: " . BASE_URL_ADMIN . "?act=danh-muc");
                exit;
            } else {
                // Nếu có lỗi trong quá trình xóa
                $_SESSION['error'] = 'Xóa danh mục thất bại, vui lòng thử lại';
                header("Location: " . BASE_URL_ADMIN . "?act=danh-muc");
                exit;
            }
        }
    }
}
?>
