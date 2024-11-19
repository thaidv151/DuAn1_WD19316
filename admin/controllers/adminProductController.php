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



                $product_name = $_POST['product_name'] ?? '';
                $price = $_POST['price'] ?? '';
                $color = $_POST['color'] ?? '';
                $promotion_price = $_POST['promotion_price'] ?? '';
                $product_description = $_POST['product_description'] ?? '';
                $categories = $_POST['categories'] ?? ''; // mảng danh mục của sản phẩm
                $quantitys = $_POST['quantitys']; // mảng kích cỡ input
                $size_id = $_POST['size_id'];
                $albums = $_FILES['albums'] ?? '';
                $arr_size = []; // mảng size sau khi xử lý sẽ đc thêm vào
                foreach ($quantitys as $key => $value) { // thực hiện chuyển hai mảng size_id quantitys về một mảng theo đúng thứ tự
                    $arr_size[] = [
                        'size_id' => $size_id[$key],
                        'quantity' => $value
                    ];
                };





                $thumbnails = $_FILES['thumbnail'];
               $errors = [];

                if (empty($product_name)) {
                   $errors['product_name'] = 'Tên sản phẩm không để trống !';
                }
                foreach ($color as $key => $value) {

                    if ($color[$key] === '') {
                       $errors['color'] = 'Màu sản phẩm không để trống !';
                    }
                }

                if (empty($price)) {
                   $errors['price'] = 'Giá sản phẩm không để trống !';
                }
                if (empty($promotion_price)) {
                   $errors['promotion_price'] = 'Giá khuyến mãi không để trống !';
                }
                if (empty($product_description)) {
                   $errors['product_description'] = 'Mô tả không để trống !';
                }

                $arrCheckImage = ['image/png', 'image/jpg', "image/gif", "image/jpeg", 'image/webp'];

                foreach ($thumbnails['name'] as $key => $value) {


                    if ($thumbnails['error'][$key] !== 0) {
                       $errors['thumbnail'] = 'Không để trống hình ảnh !';
                    } elseif (!in_array($thumbnails['type'][$key], $arrCheckImage)) {
                       $errors['thumbnail'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                    } elseif ($thumbnails['size'][$key] > 2500000) {
                       $errors['thumbnail'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                    }
                }

                foreach ($albums['name'] as $key => $value) {
                    $file_albums = [
                        'name' => $albums['name'][$key],
                        'type' => $albums['type'][$key],
                        'tmp_name' => $albums['tmp_name'][$key],
                        'error' => $albums['error'][$key],
                        'size' => $albums['size'][$key],
                    ];

                    foreach ($file_albums['name'] as $num => $item) {

                        if ($file_albums['error'][$num] !== 0) {
                            continue;
                        } else if (!in_array($file_albums['type'][$num], $arrCheckImage)) {
                           $errors['albums'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                        } elseif ($file_albums['size'][$num] > 2500000) {
                           $errors['albums'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                        }
                    };
                }


                if (!is_numeric($price)) {
                   $errors['price'] = 'Giá sản phẩm phải là số !';
                }
                if (!is_numeric($promotion_price)) {
                   $errors['promotion_price'] = 'Giá khuyến mãi phải là số !';
                }
                foreach ($quantitys as $key => $size) {
                    $results = array_filter($size, function ($value) {
                        return $value > 0;
                    });
                    if (empty($results)) {
                       $errors['quantitys'] = 'Không để trống size (phải có 1 nhất 1 size có số lượng)  !';
                        break;
                    }
                }
                if (empty($categories)) {
                   $errors['categories'] = 'Bạn phải chọn ít nhất 1 danh mục !';
                }



                $_SESSION['error'] =$errors;
                if (empty($error)) {

                    $success = $this->modelProduct->addProduct($product_name, $product_description, $price, $promotion_price);

                    // Thực hiện thêm sản phẩm vào lấy id sản phẩm vừa thêm

                    if ($success) {

                        foreach ($categories as $key => $value) { // Thực hiện thêm danh mục cho sản phẩm
                            $this->modelProduct->insertCategory($success, $value);
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
                        header('location:' . BASE_URL_ADMIN . '?act=list-product');
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

            $listProducts = [];
            $products = $this->modelProduct->getAllProduct();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $resultProducts = [];
                foreach ($products as $key => $item) {

                    if (strpos(strtolower($item['product_name']), strtolower($_POST['inpSearch'])) !== false) {

                        $resultProducts[] = $item;
                    }
                }
            } else {
                $products = $this->modelProduct->getAllProduct();
            }


            foreach (isset($resultProducts) ? $resultProducts : $products as $key => $product) {
                $categories = $this->modelProduct->getCategoryById($product['id']);
                $variants = $this->modelProduct->getVariantById($product['id']);
                
                // var_dump($variants);
                $resultQuantityById = [];
                foreach ($variants as $key => $variant) {
                   
                    $resultQuantityById[] = $this->modelProduct->getAllQuantityById($variant['id']);
                }
                $totalQuantity = 0;
                if (!empty($resultQuantityById)) {
                    $totalQuantity = array_reduce($resultQuantityById, function ($total, $num) {
                        return $total + $num['total'];
                    }, 0);
                } else {
                    $totalQuantity = 0;
                }
                
                // debug($totalQuantity);
                $getImageVariant = $this->modelProduct->getImageByProductId($product['id']);

                if ($getImageVariant) {
                    $thumbnail = $getImageVariant['thumbnail_variant'];
                } else {
                    $thumbnail = null;
                }
                $listProducts[] = [
                    'id' => $product['id'],
                    'product_name' => $product['product_name'],
                    'total_quantity' => $totalQuantity,
                    'view' => $product['view'],
                    'promotion_price' => $product['promotion_price'],
                    'categories' => $categories,
                    'status' => $product['status'],
                    'thumbnail_variant' => $thumbnail,
                ];
            }
          

            require './views/product/listProduct.php';
            delteSessionError();
        }
        public function editStatusProduct()
        {
            $id = $_GET['id'];
            $statusProduct = $this->modelProduct->getProductById($id);
            if ($statusProduct['status'] === 1) {
                $changeStatus = 0;
            } else {
                $changeStatus = 1;
            }
            $success = $this->modelProduct->editStatusById($id, $changeStatus);
            if ($success) {
                $_SESSION['success'] = 'Thay đổi trạng thái thành công';
                header('location:' . BASE_URL_ADMIN . '?act=list-product');
                exit();
            } else {
                $_SESSION['success'] = 'Thay đổi trạng thái thất bại';
                header('location:' . BASE_URL_ADMIN . '?act=list-product');
                exit();
            }
        }
        public function formEditProduct()
        {
            $product_id = $_GET['id'];

            $product = $this->modelProduct->getProductById($product_id);

            if (!$product) {
                header('location: ' . BASE_URL_ADMIN . '?act=list-product');
                exit();
            }
            $listCategories = $this->modelProduct->getAllCategories();
            $categories = $this->modelProduct->getCategoryById($product['id']); // lấy ra id danh mục của sản phẩm        

            $listVariantById = $this->modelProduct->getVariantById($product_id);

            $listVariants = [];

            foreach ($listVariantById as $key => $variant) {

                $liseSizeByVariantId[] = $this->modelProduct->getListSizeByVariantId($variant['id']);
                $listAlbumByVariantId[] = $this->modelProduct->getlistAlbumByVariantId($variant['id']);


                $listVariants[] = [
                    'id' => $variant['id'],
                    'product_id' => $variant['product_id'],
                    'color' => $variant['color'],
                    'thumbnail_variant' => $variant['thumbnail_variant'],
                    'variant_album' => $listAlbumByVariantId[$key],
                    'list_size' => $liseSizeByVariantId[$key],
                ];
            }
            require_once './views/product/formEditProduct.php';
            delteSessionError();
        }
        public function postEditProduct()
        {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product_id = $_GET['id'];

                $product_name = $_POST['product_name'] ?? '';

                $price = $_POST['price'] ?? '';

                $promotion_price = $_POST['promotion_price'] ?? '';
                $product_description = $_POST['product_description'] ?? '';
                $categories = $_POST['categories'] ?? ''; // mảng danh mục của sản phẩm


               $errors = [];

                if (empty($product_name)) {
                   $errors['product_name'] = 'Tên sản phẩm không để trống !';
                }


                if (empty($price)) {
                   $errors['price'] = 'Giá sản phẩm không để trống !';
                }
                if (empty($promotion_price)) {
                   $errors['promotion_price'] = 'Giá khuyến mãi không để trống !';
                } else if (!is_numeric($price)) {
                   $errors['price'] = 'Giá sản phẩm phải là số !';
                }
                if (empty($product_description)) {
                   $errors['product_description'] = 'Mô tả không để trống !';
                } else if (!is_numeric($promotion_price)) {
                   $errors['promotion_price'] = 'Giá khuyến mãi phải là số !';
                }



                if (empty($categories)) {
                   $errors['categories'] = 'Bạn phải chọn ít nhất 1 danh mục !';
                }
                $_SESSION['error'] =$errors;
                if (empty($error)) {

                    $this->modelProduct->editProduct($product_id, $product_name, $product_description, $price, $promotion_price);

                    // Thực hiện xoá danh mục cũ
                    $success =  $this->modelProduct->deleteCategoriesById($product_id);
                    if ($success) {
                        foreach ($categories as $key => $category_id) {
                            $this->modelProduct->insertCategory($product_id, $category_id);
                        }
                    }
                    $_SESSION['success'] = 'Cập nhật thành công';
                    header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                    exit();
                } else {

                    $_SESSION['flash'] = true;
                    header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                    exit();
                }
            }
        }
        public function postEditVariant()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                $product_id = $_POST['product_id'] ?? '';

                $variant_id = $_GET['id'] ?? '';
                $color = $_POST['color'] ?? '';
                $quantitys = $_POST['quantitys'] ?? '';
                $size_id = $_POST['size_id'] ?? '';
                $thumbnail_variant = $_FILES['thumbnail_variant'] ?? '';
                $oldImg =  $_POST['oldImg'] ?? '';

                $arrDelete = $_POST['arrDelete'] ?? '';
                $linkArrDelete = $_POST['linkArrDelete'] ?? '';

                $albums  = $_FILES['albums'] ?? '';
               $errors = [];
                // validate dữ liệu hình ảnh nhập vào
                $arrCheckImage = ['image/png', 'image/jpg', "image/gif", "image/jpg", 'image/webp', 'image/jpeg'];
                if ($thumbnail_variant['error'] !== 0) {
                    true;
                } elseif (!in_array($thumbnail_variant['type'], $arrCheckImage)) {
                   $errors['thumbnail'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                } elseif ($thumbnail_variant['size'] > 2500000) {
                   $errors['thumbnail'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                }
                // validate mảng dữ liệu hình ảnh nhập vào
                foreach ($albums['name'] as $num => $value) {

                    if ($albums['error'][$num] !== 0) {
                        continue;
                    } else if (!in_array($albums['type'][$num], $arrCheckImage)) {
                       $errors['albums'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                    } elseif ($albums['size'][$num] > 2500000) {
                       $errors['albums'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                    }
                }


                if (!empty($arrDelete)) {

                    foreach ($arrDelete as $key => $item) {
                        $link_image = $this->modelProduct->getLinkImageById($item);
                        deleteFile($link_image['link_image']);
                        if (is_numeric($item)) {
                            $this->modelProduct->deleteItemAlbums($item);
                        }
                    }
                }



                // Thưccj hiện check người dùng có sửa thumbnail hay k
                if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
                    if (!empty($oldImg)) {
                        deleteFile($oldImg);
                    }
                    $newImg = uploadFile($file, './uploads/');
                } else {

                    $newImg = $oldImg;
                }


                $sum = 0;   // check đảm bảo số lượng nhập vào lớn hơn 1
                foreach ($quantitys as $key =>   $value) {
                    if ($value === '') {
                        $value = 0;
                    }
                    $sum += (int)$value;
                }


                if ($sum <= 0) {
                   $errors['quantitys'] = 'Không để trống size (phải có 1 nhất 1 size có số lượng)  !';
                }

                if ($color === '') {
                   $errors['color'] = 'Màu sản phẩm không để trống !';
                }

                $_SESSION['error'] =$errors;
                if (empty($error)) {

                    $results =  $this->modelProduct->updateVariant($variant_id, $newImg, $color);

                    if (!empty($albums['name'][0])) {
                        foreach ($albums['name'] as $key => $image) {

                            $fileImg = [
                                'name' => $albums['name'][$key],
                                'type' => $albums['type'][$key],
                                'tmp_name' => $albums['tmp_name'][$key],
                                'error' => $albums['error'][$key],
                                'size' => $albums['size'][$key],
                            ];
                            $newItemAlbum = uploadFile($fileImg, './uploads/');
                            $this->modelProduct->insertItemAlbumVariant($variant_id, $newItemAlbum);
                        }
                    }
                    foreach ($size_id as $key => $value) {
                        $this->modelProduct->updateSizeVariant($variant_id, $size_id[$key], $quantitys[$key]);
                    }

                    $_SESSION['success'] = 'Cập nhật thành công';
                    header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                    exit();
                } else {

                    $_SESSION['flash'] = true;
                    header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                    exit();
                }
            }
        }
        public function deleteProduct()
        {
            $product_id = $_GET['id'];
        }
        public function deleteVariant()
        {

            $variant_id = $_GET['variant_id'];
            $product_id = $_GET['product_id'];
            $deleteAlbum = $this->modelProduct->deleteAlbumById($variant_id);
            $deleteSize = $this->modelProduct->deleteAllSizeById($variant_id);
            $deleteVariant = $this->modelProduct->deleteVariantById($variant_id);

            if ($deleteAlbum && $deleteSize && $deleteVariant) {

                $_SESSION['success'] = 'Xoá biến thể thành công';
                header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                exit();
            } else {
                $_SESSION['success'] = 'Xoá biến thể không thành công';
                header('location' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                exit();
            }
        }
        public function formAddVariant()
        {
            $product_id = $_GET['product_id'];
            $product = $this->modelProduct->getProductById($product_id);
            $listSize = $this->modelProduct->getAllSize();
            require_once './views/product/formAddVariant.php';
        }
        public function postAddVariant()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product_id = $_GET['product_id'];
                $color = $_POST['color'];
                $fileUpload = $_FILES['thumbnail'];
                $albums= $_FILES['albums'];
                $arr_size_id = $_POST['size_id'];
                $quantitys = $_POST['quantitys'];

               $errors = [];
                $arr_size = []; // mảng chứa size và số lượng đã qua xử lý
                
                foreach ($arr_size_id as $key => $value) {
                    $arr_size[] = [
                        'size_id' => $arr_size_id[$key],
                        'quantity' => $quantitys[$key],
                    ];
                }
                

                if(empty($color)){
                   $errors['color'] = 'Màu sắc không để trống';
                }
                $arrCheckImage = ['image/png', 'image/jpg', "image/gif", "image/jpeg", 'image/webp'];
                    if ($fileUpload['error'] !== 0) {
                       $errors['thumbnail'] = 'Không để trống hình ảnh !';
                    } elseif (!in_array($fileUpload['type'], $arrCheckImage)) {
                       $errors['thumbnail'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                    } elseif ($fileUpload['size'] > 2500000) {
                       $errors['thumbnail'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                    }
               
                
      
                    foreach ($albums['name'] as $num => $item) {

                        if ($albums['error'][$num] !== 0) {
                           $errors['albums'] = 'Cần có ít nhất 1 hình ảnh mô tả';
                        } else if (!in_array($albums['type'][$num], $arrCheckImage)) {
                           $errors['albums'] = 'File không hợp lệ ( chỉ nhận .png, .jpg, .gif, .webp )';
                        } elseif ($albums['size'][$num] > 2500000) {
                           $errors['albums'] = 'Kích cỡ ảnh không lớn hơn 2.5MB';
                        }
                    };
                  
                   
               
                if(empty($error)){
                    $thumbnail_variant = uploadFile($fileUpload, './uploads/');
                    $newVaiantId = $this->modelProduct->insertVariant($product_id, $color, $thumbnail_variant);
                    foreach ($arr_size as $key => $value) {
                        $addSize = $this->modelProduct->insertSize($newVaiantId, $value['quantity'], $value['size_id']);
                    }
                    
                    foreach ($albums['name'] as $num => $value) {
                        $file = [
                            'name' => $albums['name'][$num],
                            'type' => $albums['type'][$num],
                            'tmp_name' => $albums['tmp_name'][$num],
                            'error' => $albums['error'][$num],
                            'size' => $albums['size'][$num],
                        ];

                        $link_image = uploadFile($file, './uploads/');

                        $this->modelProduct->insertItemAlbumVariant($newVaiantId, $link_image);
                    }
                    $_SESSION['success'] = 'Thêm biến thể thành công';
                    header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                    exit();
                }else{
                    $_SESSION['success'] = 'Thêm biến thể thất bại';
                    header('location:' . BASE_URL_ADMIN . '?act=edit-product&id=' . $product_id);
                    exit();
                }
            }
        }
    }
