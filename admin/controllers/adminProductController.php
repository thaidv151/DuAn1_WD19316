<?php

class adminProductController
{
    public $model;
    public function __construct()
    {
        $this->model = new adminProductModel;
    }
    public function addProduct()
    {
        $listCategories = $this->model->getAllCategories();
        require './views/product/addProduct.php';
        delteSessionError();
    }
    public function postAddProduct()
    {
        $product_name = $_POST['product_name'] ?? '';
        $price = $_POST['price'] ?? '';
        $promotion_price = $_POST['promotion_price'] ?? '';
        $description = $_POST['description'] ?? '';
        $categories = $_POST['categories'] ?? ''; // mảng danh mục của sản phẩm



        $albums = $_FILES['albums'] ?? '';
       
        if(!empty($albums)){
          foreach($albums['name'] as $key => $value){
            
            $file = [
                'name' => $albums['name'][$key],
                'type' => $albums['type'][$key],
                'tmp_name' => $albums['tmp_name'][$key],
                'error' => $albums['error'][$key],
                'size' => $albums['size'][$key]
            ];
            $arr[] = $link_image = uploadFile($file, './uploads/');
          }
          debug($arr);
        }

        
        
        $file = $_FILES['thumbnail'];
        $thumbnail = uploadFile($file, './uploads/');
        debug($thumbnail);
        $error = [];

        if (empty($product_name)) {
            $error['product_name'] = 'Tên sản phẩm không để trống !';
        }
        if (empty($price)) {
            $error['price'] = 'Giá sản phẩm không để trống !';
        }
        if (empty($promotion_price)) {
            $error['promotion_price'] = 'Giá khuyến mãi không để trống !';
        }
        if (empty($description)) {
            $error['description'] = 'Mô tả không để trống !';
        }
        if ($file['error'] !== 0) {
            $error['thumbnail'] = 'Không để trống hình ảnh !';
        }
        if (!is_numeric($price)) {
            $error['price'] = 'Giá sản phẩm phải là số !';
        }
        if (!is_numeric($promotion_price)) {
            $error['promotion_price'] = 'Giá khuyến mãi phải là số !';
        }
        $_SESSION['error'] = $error;
        if (empty($error)) {
            echo 'OK';
        } else {

            $_SESSION['flash'] = true;
            header('location:' . BASE_URL_ADMIN . '?act=add-product');
            exit();
        }
    }
}

