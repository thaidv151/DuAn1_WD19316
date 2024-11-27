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
        delteSessionError();
    }

    // Xử lý thêm banner
    public function postAddBanner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $number_order = $_POST['number_order'] ?? '';
            $product_link = $_POST['product_link'] ?? '';
            $status = $_POST['status'] ?? 1; // Giá trị mặc định là '1' (Hoạt động)
            $image_link = $_FILES['image_link'];
            $errors = [];

            // Kiểm tra các trường dữ liệu
            if (empty($number_order)) {
                $errors['number_order'] = 'Số thứ tự không được để trống';
            } elseif (!is_numeric($number_order)) {
                $errors['number_order'] = 'Số thứ tự phải là số';
            }
            if (empty($product_link)) {
                $errors['product_link'] = 'Liên kết sản phẩm không được để trống';
            }

            // Xử lý upload hình ảnh

            $arrCheckImage = ['image/png', 'image/jpg', "image/gif", "image/jpg", 'image/webp', 'image/jpeg'];
            if ($image_link['error'] !== 0) {
                $errors['image_link'] = 'Không để trống hình ảnh';
            } elseif (!in_array($image_link['type'], $arrCheckImage)) {
                $errors['image_link'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
            } elseif ($image_link['size'] > 2500000) {
                $errors['image_link'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
            }

            // Nếu không có lỗi, thêm banner vào cơ sở dữ liệu
            if (empty($errors)) {
                $newImage = uploadFile($image_link, './uploads/');
                $success = $this->modelBanner->insertBanner($number_order, $newImage, $product_link, $status);
                if ($success) {
                    $_SESSION['success'] = 'Thêm banner thành công';
                    header("Location: " . BASE_URL_ADMIN . "?act=list-banner");
                    exit();
                }
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . "?act=add-banner");
                exit();
            }
        }
    }

    // Hiển thị form sửa banner
    public function fromEditBanner()
    {
        $id = $_GET['id'];
        $banner = $this->modelBanner->getBannerById($id);
        require_once './views/banner/editBanner.php';
        delteSessionError();
    }

    // Xử lý sửa banner
    public function postEditBanner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $number_order = $_POST['number_order'];
            $product_link = $_POST['product_link'];
            $status = $_POST['status'];
            $image_link = $_FILES['image_link'];
            $old_image = $_POST['old_image'];

            if (isset($image_link) && $image_link['error'] == UPLOAD_ERR_OK) {
                if (!empty($old_image)) {
                    deleteFile($old_image);
                }
                $newImage = uploadFile($image_link, './uploads/');
            } else {
                $newImage = $old_image;
            }

            $errors = [];
            if (empty($number_order)) {
                $errors['number_order'] = 'Không để trống số thứ tự';
            } elseif (!is_numeric($number_order)) {
                $errors['number_order'] = 'Số thứ tự phải là số';
            }
            $arrCheckImage = ['image/png', 'image/jpg', "image/gif", "image/jpg", 'image/webp', 'image/jpeg'];
            if (!empty($image_link['name'])) {
                if (!in_array($image_link['type'], $arrCheckImage)) {
                    $errors['image_link'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                } elseif ($image_link['size'] > 2500000) {
                    $errors['image_link'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                }
            }
            if (empty($product_link)) {
                $errors['product_link'] = 'Link sản phẩm không để trống';
            }




            if (empty($errors)) {
                $success = $this->modelBanner->updateBanner($id, $number_order, $newImage, $product_link, $status);
                if ($success) {
                    header("Location: " . BASE_URL_ADMIN . "?act=list-banner");
                    exit();
                }
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . "?act=edit-banner&id=" . $id);
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
