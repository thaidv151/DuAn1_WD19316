<?php

class cartController
{
    public $modelCart;
    public function __construct()
    {
        $this->modelCart = new modelCart;
    }
    public function viewListCart()
    {
        if (isset($_SESSION['user'])) {
            $listCartById = $this->modelCart->getAllCartByUserId($_SESSION['user']['id']);
            $_SESSION['count_cart'] = count($listCartById);
            $listVoucher = $this->modelCart->getAllVoucher();

            // debug($listCartById);
            require './views/carts/viewCart.php';
            delteSessionError();
        } else {
            $_SESSION['success'] = 'Bạn cần đăng nhập để đến giỏ hàng';
            header('location:' . BASE_URL . '?act=login');
            exit();
        }
    }
    public function deleteCart()
    {
        $id = $_GET['id'];
        $success = $this->modelCart->deleteCartId($id);

        if ($success) {
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user'])) {
                $_SESSION['success'] = 'Bạn cần đăng nhập để thêm giỏ hàng';
                header('location:' .  BASE_URL . '?act=login');
                exit();
            }

            $product_id = $_POST['product_id'];
            $variant_id = $_POST['variant_id'];
            $size_id = $_POST['size_id'];
            $quantity = $_POST['quantity'];
            $user_id = $_SESSION['user']['id'];
            $errors = [];
            $listCardByUserId = $this->modelCart->getAllCartByUserId($_SESSION['user']['id']);

            if (!empty($listCardByUserId)) {
            }
            foreach ($listCardByUserId as $key => $item) {


                if ($item['size_id'] == $size_id && $item['variant_id'] == $variant_id && $item['product_id'] == $product_id) {
                    $this->modelCart->updateQuantityCart($item['id'], $item['quantity']);
                    if (isset($_POST['redirect'])) {
                        header('location:' . BASE_URL . '?act=view-cart');
                        exit();
                    }
                    header('location:' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }

            $quantitySizeInstock = $this->modelCart->getSizeInstock($variant_id, $size_id);


            if ($quantitySizeInstock['quantity_size'] < $quantity) {
                $errors['quantity'] = 'Số lượng sản phẩm khônng đủ để thêm vào giỏ hàng';
            }
            if (!isset($size_id)) {
                $errors['size_id'] = 'Không để trống size';
            }
            if (empty($errors)) {
                $success = $this->modelCart->insertCart($user_id, $product_id, $variant_id, $size_id, $quantity);
                if ($success) {
                    $listCartById = $this->modelCart->getAllCartByUserId($_SESSION['user']['id']);
                    $_SESSION['count_cart'] = count($listCartById);
                    if (isset($_POST['addToCart'])) {

                        header('location:' . $_SERVER['HTTP_REFERER']);
                        exit();
                    }
                    if (isset($_POST['redirect'])) {
                        header('location:' . BASE_URL . '?act=view-cart');
                        exit();
                    }
                }
            } else {
                $_SESSION['flash'] =  true;
                $_SESSION['error'] = $errors;
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }
}
