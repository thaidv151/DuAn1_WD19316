<?php

class adminProductController
{
    public $modelProduct;
    public function __construct()
    {
        $this->modelProduct = new adminProductmodel;
    }
    public function addProduct()
    {
        $listCategories = $this->modelProduct->getAllCategories();

        $listSize = $this->modelProduct->getAllSize();
        require './views/product/addProduct.php';
        delteSessionError();
    }
    public function postAddProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $albums = $_FILES['albums'] ?? '';
            debug($albums);
            $product_name = $_POST['product_name'] ?? '';
            $price = $_POST['price'] ?? '';
            $color = $_POST['color'] ?? '';
            $promotion_price = $_POST['promotion_price'] ?? '';
            $product_description = $_POST['product_description'] ?? '';
            $categories = $_POST['categories'] ?? ''; // mảng danh mục của sản phẩm
            $quantitys = $_POST['quantitys']; // mảng kích cỡ input
            $size_id = $_POST['size_id'];

            $arr_size = []; // mảng size sau khi xử lý sẽ đc thêm vào
            foreach ($quantitys as $key => $value) { // thực hiện chuyển hai mảng size_id quantitys về một mảng theo đúng thứ tự
                $arr_size[] = [
                    'size_id' => $size_id[$key],
                    'quantity' => $value
                ];
            };





            $thumbnails = $_FILES['thumbnail'];
            $error = [];

            if (empty($product_name)) {
                $error['product_name'] = 'Tên sản phẩm không để trống !';
            }
            foreach ($color as $key => $value) {

                if ($color[$key] === '') {
                    $error['color'] = 'Màu sản phẩm không để trống !';
                }
            }

            if (empty($price)) {
                $error['price'] = 'Giá sản phẩm không để trống !';
            }
            if (empty($promotion_price)) {
                $error['promotion_price'] = 'Giá khuyến mãi không để trống !';
            }
            if (empty($product_description)) {
                $error['product_description'] = 'Mô tả không để trống !';
            }

            foreach ($thumbnails['name'] as $key => $value) {
                if ($thumbnails['error'][$key] !== 0) {
                    $error['thumbnail'] = 'Không để trống hình ảnh !';
                }
            }

            if (!is_numeric($price)) {
                $error['price'] = 'Giá sản phẩm phải là số !';
            }
            if (!is_numeric($promotion_price)) {
                $error['promotion_price'] = 'Giá khuyến mãi phải là số !';
            }
            foreach ($quantitys as $key => $size) {
                $results = array_filter($size, function ($value) {
                    return $value > 0;
                });
                if (empty($results)) {
                    $error['quantitys'] = 'Không để trống size (phải có 1 nhất 1 size có số lượng)  !';
                    break;
                }
            }
            if (empty($categories)) {
                $error['categories'] = 'Bạn phải chọn ít nhất 1 danh mục !';
            }



            $_SESSION['error'] = $error;
            if (empty($error)) {

                $success = $this->modelProduct->addProduct($product_name, $product_description, $price, $promotion_price);

                // Thực hiện thêm sản phẩm vào lấy id sản phẩm vừa thêm

                if ($success) {

                    foreach ($categories as $key => $value) { // Thực hiện thêm danh mục cho sản phẩm
                        $this->modelProduct->addCategories($success, $value);
                    };


                    foreach ($thumbnails['name'] as $key => $value) {
                        // thêm ảnh đại diện cho từng biến thể
                        $file = [
                            'name' => $thumbnails['name'][$key],
                            'type' => $thumbnails['type'][$key],
                            'tmp_name' => $thumbnails['tmp_name'][$key],
                            'error' => $thumbnails['error'][$key],
                            'size' => $thumbnails['size'][$key]

                        ];
                        $link_image[] = uploadFile($file, './uploads/');

                        $success_variant =  $this->modelProduct->insertVariant($success, $color[$key], $link_image[$key]);
                        // lẩy ra id của variant
                        $arr_variant[] = $success_variant;

                        // thêm album theo biến thể
                        $file_albums = [
                            'name' => $albums['name'][$key],
                            'type' => $albums['type'][$key],
                            'tmp_name' => $albums['tmp_name'][$key],
                            'error' => $albums['error'][$key],
                            'size' => $albums['size'][$key],
                        ];
                        foreach ($file_albums['name'] as $num => $item) {
                            $file_album = [
                                'name' => $file_albums['name'][$num],
                                'type' => $file_albums['type'][$num],
                                'tmp_name' => $file_albums['tmp_name'][$num],
                                'error' => $file_albums['error'][$num],
                                'size' => $file_albums['size'][$num],
                            ];
                            $link_image_album[] = uploadFile($file_album, './uploads/');

                            $this->modelProduct->insertAlbum($success_variant, $link_image_album[$num]);
                        };


                        $count_for_size = count($arr_size[$key]['size_id']);
                        for ($i = 0; $i < $count_for_size; $i++) {
                            $this->modelProduct->insertSize($arr_variant[$key], $arr_size[$key]['quantity'][$i], $arr_size[$key]['size_id'][$i]);
                        }
                    };
                    // đến số biến thể (variant) đc tạo thành
                    header('location:' . BASE_URL_ADMIN . 'listProuduct.php');
                    exit();
                }
            } else {

                $_SESSION['flash'] = true;
                header('location:' . BASE_URL_ADMIN . '?act=add-product');
                exit();
            }
        }
    }
    public function listProduct()
    {
        require './views/product/listProduct.php';
        $listPoduct = $this->modelProduct->getAllProduct();
    }
}
