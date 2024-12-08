<?php
class adminVoucherController
{
    public $modelVoucher;
    public function __construct()
    {
        $this->modelVoucher = new adminVoucherModel;
    }
    public function formAddVoucher()
    {
        require_once './views/voucher/formAddVoucher.php';
        delteSessionError();
    }
    public function postAddVoucher()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title_voucher = $_POST['title_voucher'] ?? '';
            $description = $_POST['description'] ?? '';
            $disscount_value = $_POST['disscount_value'] ?? '';
            $max_disscount_amount = $_POST['max_disscount_amount'] ?? '';
            $min_order_amount = $_POST['min_order_amount'] ?? '';
            $quantity_limit = $_POST['quantity_limit'] ?? '';
            $end_date = $_POST['end_date'] ?? '';
            $used_count = 0;
            $errors = [];
            if (empty($title_voucher)) {
                $errors['title_voucher'] = 'Tiêu đề không để trống';
            }
            if (empty($description)) {
                $errors['description'] = 'Mô tả không để trống';
            }
            if (empty($disscount_value)) {
                $errors['disscount_value'] = 'Giảm theo phần trăm  không để trống';
            } elseif (!is_numeric($disscount_value)) {
                $errors['disscount_value'] = 'Giảm theo phần trăm phải là số';
            }
            if (empty($max_disscount_amount)) {
                $errors['max_disscount_amount'] = 'Giới hạn giá trị giảm không để trống';
            } elseif (!is_numeric($max_disscount_amount)) {
                $errors['max_disscount_amount'] = 'Giới hạn giá trị giảm phải là số';
            }
            if (empty($min_order_amount)) {
                $errors['min_order_amount'] = 'Điều kiện sử dụng không để trống';
            } elseif (!is_numeric($min_order_amount)) {
                $errors['min_order_amount'] = 'Điều kiện sử dụng phải là số';
            }
            if (empty($quantity_limit)) {
                $errors['quantity_limit'] = 'Giới hạn số lượng không để trống';
            } elseif (!is_numeric($quantity_limit)) {
                $errors['quantity_limit'] = 'Giới hạn số lượng phải là số';
            }
            if (empty($end_date)) {
                $errors['end_date'] = 'Màu sắc không để trống';
            }

            if (empty($errors)) {


                $success = $this->modelVoucher->insertVoucher($title_voucher, $description, $used_count, $end_date, $disscount_value, $max_disscount_amount, $min_order_amount, $quantity_limit);

                $_SESSION['success'] = 'Thêm mã khuyến mãi thành công';
                header('location:' . BASE_URL_ADMIN . '?act=list-voucher');
                exit();
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . BASE_URL_ADMIN . '?act=form-add-voucher');
                exit();
            }
        }
    }
    public function listVoucher()
    {
        $listVoucher = $this->modelVoucher->getAllVoucher();
        require_once './views/voucher/listVoucher.php';
        delteSessionError();
    }
    public function changeStatusVoucher()
    {
        $voucher_id = $_GET['voucher_id'];
        $voucher = $this->modelVoucher->getVoucherById($voucher_id);
        $newStatus = $voucher['status'] === 1 ? 0 : 1;
        $success = $this->modelVoucher->changeStatusById($voucher_id, $newStatus);
        if ($success) {


            $_SESSION['success'] = 'Sửa mã khuyến mãi thành công';
            header('location:' . BASE_URL_ADMIN . '?act=list-voucher');
            exit();
        } else {
            $_SESSION['success'] = 'Sửa mã khuyến mãi thất bại';
            header('location:' . BASE_URL_ADMIN . '?act=list-voucher');
            exit();
        }
    }
    public function formEditVoucher()
    {
        $voucher_id = $_GET['voucher_id'];
        $voucher = $this->modelVoucher->getVoucherById($voucher_id);
        require_once './views/voucher/formEditVoucher.php';
        delteSessionError();
    }
    public function postEditVoucher()
    {
        $voucher_id = $_POST['voucher_id'];
        $title_voucher = $_POST['title_voucher'] ?? '';
        $description = $_POST['description'] ?? '';
        $disscount_value = $_POST['disscount_value'] ?? '';
        $max_disscount_amount = $_POST['max_disscount_amount'] ?? '';
        $min_order_amount = $_POST['min_order_amount'] ?? '';
        $quantity_limit = $_POST['quantity_limit'] ?? '';
        $end_date = $_POST['end_date'] ?? '';
        $used_count = 0;
        $orderByVoucherId = $this->modelVoucher->getAllOrderByVoucherId($voucher_id);
      
        if (!empty($orderByVoucherId)) {
            $_SESSION['success'] = 'Voucher đã được sử dụng không thể sửa';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $errors = [];
        if (empty($title_voucher)) {
            $errors['title_voucher'] = 'Tiêu đề không để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không để trống';
        }
        if (empty($disscount_value)) {
            $errors['disscount_value'] = 'Giảm theo phần trăm  không để trống';
        } elseif (!is_numeric($disscount_value)) {
            $errors['disscount_value'] = 'Giảm theo phần trăm phải là số';
        }
        if (empty($max_disscount_amount)) {
            $errors['max_disscount_amount'] = 'Giới hạn giá trị giảm không để trống';
        } elseif (!is_numeric($max_disscount_amount)) {
            $errors['max_disscount_amount'] = 'Giới hạn giá trị giảm phải là số';
        }
        if (empty($min_order_amount)) {
            $errors['min_order_amount'] = 'Điều kiện sử dụng không để trống';
        } elseif (!is_numeric($min_order_amount)) {
            $errors['min_order_amount'] = 'Điều kiện sử dụng phải là số';
        }
        if (empty($quantity_limit)) {
            $errors['quantity_limit'] = 'Giới hạn số lượng không để trống';
        } elseif (!is_numeric($quantity_limit)) {
            $errors['quantity_limit'] = 'Giới hạn số lượng phải là số';
        }
        if (empty($end_date)) {
            $errors['end_date'] = 'Màu sắc không để trống';
        }

        if (empty($errors)) {


            $success = $this->modelVoucher->updateVoucher($voucher_id, $title_voucher, $description, $used_count, $end_date, $disscount_value, $max_disscount_amount, $min_order_amount, $quantity_limit);

            $_SESSION['success'] = 'Sửa mã khuyến mãi thành công';
            header('location:' . BASE_URL_ADMIN . '?act=form-edit-voucher&voucher_id=' . $voucher_id);
            exit();
        } else {
            $_SESSION['error'] = $errors;
            $_SESSION['flash'] = true;
            $_SESSION['success'] = 'Sửa mã khuyến mãi thất bại';
            header('location:' . BASE_URL_ADMIN . '?act=form-edit-voucher&voucher_id=' . $voucher_id);
            exit();
        }
    }
    public function deleteVoucher()
    {
        $voucher_id = $_GET['voucher_id'];
        $orderByVoucherId = $this->modelVoucher->getAllOrderByVoucherId($voucher_id);
       
        if (!empty($orderByVoucherId)) {
            $_SESSION['success'] = 'Voucher đã được sử dụng  không thể xoá';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $success = $this->modelVoucher->deleteVoucherById($voucher_id);
        if ($success) {
            $_SESSION['success'] = 'Xoá voucher thành công';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
