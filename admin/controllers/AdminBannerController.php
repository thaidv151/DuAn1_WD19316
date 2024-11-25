<?php

class AdminBannerController
{
    private $modelBanner;

    public function __construct()
    {
        $this->modelBanner = new AdminBanner();
    }

    // Hiển thị danh sách banner
    public function listBanner()
    {
        $banners = $this->modelBanner->getAllBanners();
        require_once './views/banner/listBanner.php';
    }

    // Hiển thị form thêm banner
    public function fromAddBanner()
    {
        require_once './views/banner/addBanner.php';
    }

    // Xử lý thêm banner
    public function postAddBanner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $number_order = $_POST['number_order'] ?? '';
            $product_link = $_POST['product_link'] ?? '';
            $status = $_POST['status'] ?? 1; // Giá trị mặc định là '1' (Hoạt động)
    
            $errors = [];
    
            // Kiểm tra các trường dữ liệu
            if (empty($number_order)) {
                $errors['number_order'] = 'Số thứ tự không được để trống';
            }
            if (empty($product_link)) {
                $errors['product_link'] = 'Liên kết sản phẩm không được để trống';
            }
    
            // Xử lý upload hình ảnh
            $image_link = '';
            if (!empty($_FILES['image_link']['name'])) {
                $image_link = $_FILES['image_link']['name'];
                move_uploaded_file($_FILES['image_link']['tmp_name'], '../uploads/' . $image_link);
            }
    
            // Nếu không có lỗi, thêm banner vào cơ sở dữ liệu
            if (empty($errors)) {
                $success = $this->modelBanner->insertBanner($number_order, $image_link, $product_link, $status);
                if ($success) {
                    header("Location: " . BASE_URL_ADMIN . "?act=list-banner");
                    exit();
                }
            }
    
            // Nếu có lỗi, hiển thị lại form với lỗi
            require_once './views/banner/addBanner.php';
        }
    }
    

    // Hiển thị form sửa banner
    public function fromEditBanner()
    {
        $id = $_GET['id'];
        $banner = $this->modelBanner->getBannerById($id);

        if ($banner) {
            require_once './views/banner/editBanner.php';
        } else {
            header("Location: " . BASE_URL_ADMIN . "?act=list-banner");
            exit();
        }
    }

    // Xử lý sửa banner
    public function postEditBanner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $number_order = $_POST['number_order'];
            $product_link = $_POST['product_link'];
            $status = $_POST['status'];
            $image_link = $_FILES['image_link']['name'] ?? '';

            if ($image_link) {
                move_uploaded_file($_FILES['image_link']['tmp_name'], '../uploads/' . $image_link);
            } else {
                $image_link = $_POST['current_image'];
            }

            $success = $this->modelBanner->updateBanner($id, $number_order, $image_link, $product_link, $status);
            if ($success) {
                header("Location: " . BASE_URL_ADMIN . "?act=list-banner");
                exit();
            }
        }
    }

    // Xóa banner
    public function deleteBanner()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $success = $this->modelBanner->deleteBanner($id);

            header("Location: " . BASE_URL_ADMIN . "?act=list-banner");
            exit();
        }
    }
}

?>
