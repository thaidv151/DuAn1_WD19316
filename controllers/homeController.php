<?php

class HomeController
{
    public $modelHome;
    public function __construct()
    {
        $this->modelHome = new modelHome;
    }
    public function home()
    {
        $listProduct = $this->modelHome->getAllProduct();


        foreach ($listProduct as $key => $product) {
            $variant = $this->modelHome->getVariantByProductId($product['id']);
            // debug($variant);
            if ($variant[0]['price'] > 0 && $variant[0]['promotion_price'] > 0) {
                $listProduct[$key]['disscount_value'] = round(100 - ($variant[0]['promotion_price'] / ($variant[0]['price'] / 100)));
            } else {
                $listProduct[$key]['disscount_value'] = 0;
            }
            $listProduct[$key]['price'] = $variant[0]['price'];
            $listProduct[$key]['promotion_price'] = $variant[0]['promotion_price'];
            $listProduct[$key]['album_product'] = $variant;
        }
       
        require './views/products/homeView.php';
    }

    public function productDetail()
    {
        $product_id = $_GET['id'];
        $variant_id = $_GET['variant_id'];
        $product = $this->modelHome->getProductById($product_id);

        $variant = $this->modelHome->getVariantById($product_id, $variant_id);

        $listVariant = $this->modelHome->getAllVariantByProductId($product_id);
        $listSize = $this->modelHome->getAllSizeByVariantId($variant_id);
       
        // foreach ($listVariant as $num => $item) {
        //     foreach ($listSize as $key => $size) {
        //         $listVariant[$num]['size'] = $listSize;
        //      }
        // }
     
       
        $album_variant = $this->modelHome->getAllAlbumByVariantId($variant_id);
        $product['price'] = $variant['price'];
        $product['promotion_price'] = $variant['promotion_price'];
        if ($variant['price'] > 0 && $variant['promotion_price'] > 0) {
            $product['disscount_value'] = round( 100 -($variant['promotion_price'] / $variant['price'] * 100));
        }else{
            $product['disscount_value'] = 0;
        }
        $product['color'] = $variant['color'];

        $listComments = $this->modelHome->getAllCommentByProductId($product_id);
        require './views/products/productDetail.php';
        delteSessionError();
    }
    public function postAddCart(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addToCart'])){
            debug($_POST);
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buyNow'])){
            debug(2);
        }
    }
    public function postCommet(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user_id = $_POST['user_id'] ?? '';
            if($user_id === ''){
                $_SESSION['success'] = 'Bạn cần đăng nhập để bình luận';
                header('location:' .BASE_URL . '?act=login');
                exit();
            }
            $product_id = $_POST['product_id'];
            $content = $_POST['content'];
            $errors = [];
            if(empty($content)){
                $errors['content']= 'Không để trống nội dung bình luận';
            }
            if(empty($product_id)){
                $errors['product_id']= 'error';
            }
            if(empty($errors)){
                $success = $this->modelHome->insertComment($user_id, $product_id, $content);
                if($success){
                    header('location:' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }else{
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . $_SERVER['HTTP_REFERER'] );
                exit();
            }

        }
    }
}
