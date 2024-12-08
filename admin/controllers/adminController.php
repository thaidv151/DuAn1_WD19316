<?php

class adminController
{
    public $modelHomeAdmin;
    public $adminOrderModel;
    public function __construct()
    {
        $this->modelHomeAdmin = new adminModel;
        $this->adminOrderModel = new adminOrderModel;
    }
    public function homeAdmin()
    {

        // Lây ra đơn huỷ đã thanh toán để xử lý
        $listOrderCancelPaidMoney = $this->modelHomeAdmin->getAllOrderCancelPaidMoney();
        $_SESSION['order_cancel'] = $listOrderCancelPaidMoney;
        $listOrderDelivered = $this->modelHomeAdmin->getAllOrderDelivered(); // lấy ra danh sách đơn hàng đã giao đc hơn 7 ngày
        if (!empty($listOrderDelivered)) {
            foreach ($listOrderDelivered as $key => $item) {
                $this->adminOrderModel->changeStatusOrderById($item['id'], 6);
            }
        }
        if ($_SESSION['user']['role_id'] === 1) { // chuyển hướng trang nếu tài khoản ko phải super admin
            header('location:' . BASE_URL_ADMIN . '?act=list-product');
            exit();
        }
        if (isset($_POST['month'])) {
            $month = $_POST['month'];
        } else {
            $currentDate =  date('d-m-Y');
            // Chuỗi ngày tháng
            $month = date('m', strtotime($currentDate));
            // Lấy tháng (01-12)
        }
        $orderInDay = $this->modelHomeAdmin->getOrderByDayNow();
        $orderInWeek = $this->modelHomeAdmin->getOrderByWeekNow();
        $orderInMonth = $this->modelHomeAdmin->getOrderByMonthNow($month);
        $orderCompleteInMonth = $this->modelHomeAdmin->getOrderCompleteByMonthNow($month);
        $orderInYear = $this->modelHomeAdmin->getOrderByYearNow();
        $allUser = $this->modelHomeAdmin->getAllUser();


        $listOrder = $this->modelHomeAdmin->getAllOrderMonth(); // lấy ra toàn bộ đơn hàng trong db


        if (isset($_POST['month'])) {
            $month = $_POST['month'];
        } else {
            $currentDate =  date('d-m-Y');
            // Chuỗi ngày tháng
            $month = date('m', strtotime($currentDate));
            // Lấy tháng (01-12)
        }

        $totalIncomeFromMonth = 0;

        foreach ($listOrder as $key => $item) {

            if ($item['order_status_id'] !== 7 && $item['order_status_id'] === 6) {
                if ($item['month'] == $month) {
                    $voucher = '';
                    $listOrderDetail = $this->modelHomeAdmin->getOrderDetailById($item['id']);
                    if ($item['voucher_id'] !== null) {
                        $voucher = $this->modelHomeAdmin->getVoucherById(2);
                    };
                    $totalSubPrice = 0;
                    foreach ($listOrderDetail as $key => $value) {
                        if (!empty($voucher)) {
                            $max_disscount_amount = $voucher['max_disscount_amount'];
                            $disscount_value = $voucher['disscount_value'];
                            $originPrice = ($value['product_quantity'] * $value['unit_cost']); //giá ban đầu chưa tính toán
                            $subPriceVoucher = $originPrice / 100 * $disscount_value; // lấy ra giá trị được giảm
                            if ($subPriceVoucher > $max_disscount_amount) {
                                $subPrice = $originPrice - $max_disscount_amount;
                            } else {
                                $subPrice = $originPrice - $subPriceVoucher;
                            }
                        } else {
                            $subPrice = ($value['product_quantity'] * $value['unit_cost']);
                        }
                        $totalSubPrice += $subPrice;
                    }

                    $totalIncomeFromMonth += $totalSubPrice;
                }
            }
        }
        $totalIncome = 0; // tính tổng doannh thu trong website
        foreach ($listOrder as $key => $item) {
            if ($item['order_status_id'] !== 7) {

                if ($item['order_status_id'] === 6) {
                    $voucher = '';
                    $listOrderDetail = $this->modelHomeAdmin->getOrderDetailById($item['id']);

                    if ($item['voucher_id'] !== null) {
                        $voucher = $this->modelHomeAdmin->getVoucherById(2);
                    };

                    $totalSubPrice = 0;
                    foreach ($listOrderDetail as $key => $value) {
                        if (!empty($voucher)) {
                            $max_disscount_amount = $voucher['max_disscount_amount'];
                            $disscount_value = $voucher['disscount_value'];
                            $originPrice = ($value['product_quantity'] * $value['unit_cost']); //giá ban đầu chưa tính toán
                            $subPriceVoucher = $originPrice / 100 * $disscount_value; // lấy ra giá trị được giảm
                            if ($subPriceVoucher > $max_disscount_amount) {
                                $subPrice = $originPrice - $max_disscount_amount;
                            } else {
                                $subPrice = $originPrice - $subPriceVoucher;
                            }
                        } else {
                            $subPrice = ($value['product_quantity'] * $value['unit_cost']);
                        }
                        $totalSubPrice += $subPrice;
                    }

                    $totalIncome += $totalSubPrice;
                }
            }
        }
        require './views/homeAdmin.php';
    }
}
