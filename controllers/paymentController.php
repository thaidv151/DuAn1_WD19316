<?php

class paymentController
{
    public $modelPayment;
    public $modelCart;
    public function __construct()
    {
        $this->modelPayment = new modelPayment;
        $this->modelCart = new modelCart;
    }
    public function postCheckOut()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_code = 'DH' . rand(100000000, 100000000000000000);
            $user_id = $_SESSION['user']['id'];
            $shipping_address = $_POST['address'] . ', ' . $_POST['ward'] . ', ' . $_POST['district'] . ', ' . $_POST['city'];

            $customer_email = $_POST['customer_email'];
            $customer_phone = $_POST['customer_phone'];
            $customer_name = $_POST['customer_name'];
            $payment_method_id = $_POST['payment_method_id'];
            $voucher_id = $_POST['voucher_id'] ?? '';
            $shipping = $_SESSION['data_order']['shipping'];


            if ($voucher_id === '') {
                $voucher_id = null;
            }
            $errors = [];
            if (empty($_POST['address'])) {
                $errors['address'] = 'Không để trống địa chỉ';
            }
            if (empty($_POST['ward'])) {
                $errors['ward'] = 'Không để trống phường xã';
            }
            if (empty($_POST['district'])) {
                $errors['district'] = 'Không để trống quận huyện';
            }
            if (empty($_POST['city'])) {
                $errors['city'] = 'Không để trống thành phố';
            }
            $regexEmail = '/^\\S+@\\S+\\.\\S+$/';
            $regexPhone = "/(84|0[3|5|7|8|9])+([0-9]{8})\b/";
            if (empty($customer_email)) {
                $errors['customer_email'] = 'Không để trống email';
            } else if (!preg_match($regexEmail, $customer_email)) {
                $errors['customer_email'] = 'Email không hợp lệ';
            }
            if (empty($customer_phone)) {
                $errors['customer_phone'] = 'Không để trống số điện thoại';
            } else if (!preg_match($regexPhone, $customer_phone)) {
                $errors['customer_phone'] = 'Số điẹn thoại không hợp lệ';
            }
            

            if (!empty($errors)) {

                $_SESSION['error'] = 'Thiếu thông tin thanh toán';
                $_SESSION['flash'] = true;
                header('location:' . BASE_URL . '?act=view-cart');
                exit();
            }
            
            if ($_POST['payment_method_id'] == 1) {
                $listProductAddOrder = $_SESSION['data_order']['list_cart_order'];
                $newOrderId = $this->modelPayment->inserNewOrder($order_code, $user_id, $customer_name, $shipping_address, $customer_email, $customer_phone, $payment_method_id, $voucher_id, $shipping);
                if (!empty($voucher_id)) {
                    $this->modelPayment->changeQuantityVoucher($voucher_id);
                }
                foreach ($listProductAddOrder as $key => $item) {
                    $this->modelPayment->insertOrderDetail($item['product_id'], $newOrderId, $item['variant_id'], $item['quantity'], $item['size'], $item['promotion_price']);
                    $this->modelCart->deleteCartId($item['id']);
                    $this->modelPayment->changeQuantityById($item['variant_id'], $item['size_id'], $item['quantity']);
                }
                $listCartById = $this->modelCart->getAllCartByUserId($_SESSION['user']['id']); // reload lại só lượng sản phẩm trong giỏ hàng của user
                $_SESSION['count_cart'] = count($listCartById);
                $_SESSION['success'] = 'Đặt hàng thành công';
                unset($_SESSION['data_order']);
                header('location:' . BASE_URL . '?act=view-order-detail&order_id=' . $newOrderId);
                exit();
            }

            if ($_POST['payment_method_id'] == 2) {
                $listOrder = $_SESSION['data_order']['list_cart_order'];
                $sumPriceInOrder = 0;
                foreach ($listOrder as $key => $item) {
                    $sumPriceInOrder += $item['quantity'] * $item['promotion_price'];
                }
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = BASE_URL . '?act=thanks';
                $vnp_TmnCode = "CGXZLS0Z"; //Mã website tại VNPAY 
                $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; //Chuỗi bí mật

                $vnp_TxnRef = 'DH' . rand(1000000000, 10000000000000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
                // sang VNPAY
                $vnp_OrderInfo = 'Noi dung thanh toan'; // Nội dung thanh toán
                $vnp_OrderType = 'billpayment'; //kiểu thanh toán
                $vnp_Amount = ($sumPriceInOrder + $_SESSION['data_order']['shipping'])  * 100; // Giá của hoá đơn * 100 để trả về giá cần thanh toán
                $vnp_Locale = 'vn'; // ngôn ngữ mặc định là vn
                $vnp_BankCode = 'NCB'; //phương thức thanh toán với ngân hàng NCB
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // địa chỉ ip của website

                $_SESSION['data_order']['data_customer_check_out'] = $_POST;
                $_SESSION['data_order']['data_customer_check_out']['order_code'] = $vnp_TxnRef;

                //Add Params of 2.0.1 Version
                // $vnp_ExpireDate = $_POST['txtexpire'];
                //Billing
                // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
                // $vnp_Bill_Email = $_POST['txt_billing_email'];
                // $fullName = trim($_POST['txt_billing_fullname']);
                // if (isset($fullName) && trim($fullName) != '') {
                //     $name = explode(' ', $fullName);
                //     $vnp_Bill_FirstName = array_shift($name);
                //     $vnp_Bill_LastName = array_pop($name);
                // }
                // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
                // $vnp_Bill_City = $_POST['txt_bill_city'];
                // $vnp_Bill_Country = $_POST['txt_bill_country'];
                // $vnp_Bill_State = $_POST['txt_bill_state'];
                // // Invoice
                // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
                // $vnp_Inv_Email = $_POST['txt_inv_email'];
                // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
                // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
                // $vnp_Inv_Company = $_POST['txt_inv_company'];
                // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
                // $vnp_Inv_Type = $_POST['cbo_inv_type'];
                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,

                    // "vnp_ExpireDate" => $vnp_ExpireDate,
                    // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
                    // "vnp_Bill_Email" => $vnp_Bill_Email,
                    // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
                    // "vnp_Bill_LastName" => $vnp_Bill_LastName,
                    // "vnp_Bill_Address" => $vnp_Bill_Address,
                    // "vnp_Bill_City" => $vnp_Bill_City,
                    // "vnp_Bill_Country" => $vnp_Bill_Country,
                    // "vnp_Inv_Phone" => $vnp_Inv_Phone,
                    // "vnp_Inv_Email" => $vnp_Inv_Email,
                    // "vnp_Inv_Customer" => $vnp_Inv_Customer,
                    // "vnp_Inv_Address" => $vnp_Inv_Address,
                    // "vnp_Inv_Company" => $vnp_Inv_Company,
                    // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
                    // "vnp_Inv_Type" => $vnp_Inv_Type
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                // }

                //var_dump($inputData);
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $returnData = array(
                    'code' => '00',
                    'message' => 'success',
                    'data' => $vnp_Url
                );
                if (isset($_POST['payment_method_id'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
                // vui lòng tham khảo thêm tại code demo
            }
        }
    }
    public function returnByPayment()
    {
        if ($_GET['vnp_ResponseCode'] == 0) {

            $infoOrder = $_SESSION['data_order']['data_customer_check_out'];
            $listProductAddOrder = $_SESSION['data_order']['list_cart_order'];

            $shipping_address = $infoOrder['address'] . ', ' . $infoOrder['ward'] . ', ' . $infoOrder['district'] . ', ' . $infoOrder['city'];
            if (isset($infoOrder['voucher_id'])) {
                $voucher_id = $infoOrder['voucher_id'];
            } else {
                $voucher_id = null;
            }
            $newOrderId = $this->modelPayment->inserNewOrder($infoOrder['order_code'], $_SESSION['user']['id'], $infoOrder['customer_name'], $shipping_address, $infoOrder['customer_email'], $infoOrder['customer_phone'], $infoOrder['payment_method_id'], $voucher_id, $_SESSION['data_order']['shipping']);
            // debug($listProductAddOrder);  
            if (!empty($voucher_id)) {
                $this->modelPayment->changeQuantityVoucher($voucher_id);
            }
            foreach ($listProductAddOrder as $key => $item) {
                $this->modelPayment->insertOrderDetail($item['product_id'], $newOrderId, $item['variant_id'], $item['quantity'], $item['size'], $item['promotion_price']);
                $this->modelCart->deleteCartId($item['id']);
                $this->modelPayment->changeQuantityById($item['variant_id'], $item['size_id'], $item['quantity']);
            }
            $listCartById = $this->modelCart->getAllCartByUserId($_SESSION['user']['id']); // reload lại só lượng sản phẩm trong giỏ hàng của user
            $_SESSION['count_cart'] = count($listCartById);
            $_SESSION['success'] = 'Đặt hàng thành công';
            unset($_SESSION['data_order']);
            header('location:' . BASE_URL . '?act=view-order-detail&order_id=' . $newOrderId);
            exit();
        } else {
            header('location:' . BASE_URL . '?act=view-cart');
            exit();
        }
    }
    public function formCheckOut()
    {

        if ($_SERVER['REQUEST_METHOD']) {

            if (!isset($_POST['checkCartId'])) {
                $_SESSION['error'] = 'Bạn cần chọn 1 sản phẩm để thanh toán';
            }

            $listCartId = $_POST['checkCartId'];
            $shipingOrder = $_POST['shippingOrder'];

            $listCartById = [];
            foreach ($listCartId as $key => $item) {
                $listCartById[] = $this->modelCart->getCartById($item);
            }
            if ($listCartById[0] === false) {
                header('location:' . BASE_URL);
                exit();
            }
            $totalPriceOrder = 0;
            foreach ($listCartById as $key => $item) {
                $totalPriceOrder += $item['promotion_price'] * $item['quantity'];
            }

            foreach ($listCartById as $key => $item) {
                $quantitySizeInstock = $this->modelCart->getSizeInstock($item['variant_id'], $item['size_id']);
                if ($quantitySizeInstock['quantity_size'] < $item['quantity']) {
                    $_SESSION['error'] = 'Số lượng sản phẩm trong kho hàng không đủ để thực hiện thanh toán';
                }
            }
            if (isset($_SESSION['error'])) {
                $_SESSION['flash'] = true;
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $totalPriceOrder = $totalPriceOrder + $shipingOrder;
            $listVoucher = $this->modelCart->getAllVoucher();
            $listPaymentMethod = $this->modelPayment->getAllPaymentMethod();
            $_SESSION['data_order'] = [];
            $_SESSION['data_order']['shipping'] = $shipingOrder;
            $_SESSION['data_order']['list_cart_order'] = $listCartById;
            require './views/orders/formCheckOut.php';
        }
    }
}
