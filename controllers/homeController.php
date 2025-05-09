<?php

class HomeController
{
    public $modelHome;
    public $modelCart;
    public function __construct()
    {
        $this->modelHome = new modelHome;
        $this->modelCart = new modelCart;
    }
    public function home()
    {
       
        
        $listProductDefault = $this->modelHome->getAllProduct();
        if(isset($_GET['category'])){
            $category_id =  $this->modelHome->getCategoryId($_GET['category'] ?? "");
            $listProductDefault = $this->modelHome->getFilterProductByCategoryId($category_id['id']);
        }
      
        $listProduct = $listProductDefault;
        if(isset($_SESSION['user'])){
            $listCartById = $this->modelCart->getAllCartByUserId($_SESSION['user']['id']);
            $_SESSION['count_cart'] = count($listCartById);
        }
   
        $listProductViewDesc = $this->modelHome->getAllProductViewDesc();
       
        $listProductView = $listProductViewDesc;

        foreach ($listProductViewDesc as $key => $product) {
         
            $variant = $this->modelHome->getAllVariantByProductId($product['id']);
           
            if ($variant[0]['price'] > 0 && $variant[0]['promotion_price'] > 0) {
                $listProductView[$key]['disscount_value'] = round(100 - ($variant[0]['promotion_price'] / $variant[0]['price'] * 100));
            } else {
                $listProductView[$key]['disscount_value'] = 0;
            }
        
            $listProductView[$key]['price'] = $variant[0]['price'];
            $listProductView[$key]['promotion_price'] = $variant[0]['promotion_price'];
            $listProductView[$key]['album_product'] = $variant;
        }




        foreach ($listProduct as $key => $product) {
            $variant = $this->modelHome->getAllVariantByProductId($product['id']);
            $listCategoryById = $this->modelHome->getAllCategoryByProductId($product['id']);
            if ($variant[0]['price'] > 0 && $variant[0]['promotion_price'] > 0) {
                $listProduct[$key]['disscount_value'] = round(100 - ($variant[0]['promotion_price'] / $variant[0]['price'] * 100));
            } else {
                $listProduct[$key]['disscount_value'] = 0;
            }
            $listProduct[$key]['categories'] = $listCategoryById; 
            $listProduct[$key]['price'] = $variant[0]['price'];
            $listProduct[$key]['promotion_price'] = $variant[0]['promotion_price'];
            $listProduct[$key]['album_product'] = $variant;
        }
        
        
        $listBanner = $this->modelHome->getAllBanner();
        $listCategories = $this->modelHome->getAllCategories();
        require './views/products/homeView.php';
        delteSessionError();
    }

    public function productDetail()
    {
        $product_id = $_GET['id'];
        $variant_id = $_GET['variant_id'];
        $this->modelHome->countViewProduct($product_id);
        $product = $this->modelHome->getProductById($product_id);

        $variant = $this->modelHome->getVariantById($product_id, $variant_id);

        $listVariant = $this->modelHome->getAllVariantByProductId($product_id);
        $listSize = $this->modelHome->getAllSizeByVariantId($variant_id);

     


        $album_variant = $this->modelHome->getAllAlbumByVariantId($variant_id); // lấy rả album ảnh của biến thể

        $product['price'] = $variant['price']; // Giá của biến thể
        $product['promotion_price'] = $variant['promotion_price'];

        if ($variant['price'] > 0 && $variant['promotion_price'] > 0) { // Lâ ra phần trăm giảm giá
            $product['disscount_value'] = round(100 - ($variant['promotion_price'] / $variant['price'] * 100));
        } else {
            $product['disscount_value'] = 0;
        }
        $product['color'] = $variant['color'];

        $listComments = $this->modelHome->getAllCommentByProductId($product_id);

        $listCategoryById = $this->modelHome->getAllCategoryByProductId($product_id);
        $listSuggestedProducts = [];
        foreach ($listCategoryById as $key => $item) {
            $listSuggestedProducts[] =  $this->modelHome->getALlProductByCategoryId($item['category_id'], $product_id);
        }
        $filterSuggestedProducts = [];

        foreach ($listSuggestedProducts as $key => $itemProduct) { // lọc ra các sản phẩm có cùng danh  mục mà không bị lặp lại
            foreach ($itemProduct as $key => $item) {
                if (!in_array($item['product_id'], $filterSuggestedProducts)) {
                    $filterSuggestedProducts[] = $item['product_id'];
                }
            }
        }
        $lastProductFilter = [];
        foreach ($filterSuggestedProducts as $key => $item) {
            $lastProductFilter[] = $this->modelHome->getProductById($item);
            $variantByProductId = $this->modelHome->getAllVariantByProductId($lastProductFilter[$key]['id']);
            $lastProductFilter[$key]['variant'] = $variantByProductId[0];
            if ($variantByProductId[0]['price'] !== 0) {
                $lastProductFilter[$key]['disscount_value'] = round(100 - ($variantByProductId[0]['promotion_price'] / $variantByProductId[0]['price'] * 100));
            } else {
                $lastProductFilter[$key]['disscount_value'] = 0;
            }
        }



        $listReviews = $this->modelHome->getAllReviewByProductId($product_id); // lấy ra danh sách các đánh giá của sản phẩm
        $totalRating = 0;
        $countStar5 = 0;
        $countStar4 = 0;
        $countStar3 = 0;
        $countStar2 = 0;
        $countStar1 = 0;

        if (!empty($listReviews)) {
            for ($i = 0; $i < count($listReviews); $i++) {
                $totalRating += $listReviews[$i]['rating_star'];
                if ($listReviews[$i]['rating_star'] === 5) {
                    $countStar5 += 1;
                } elseif ($listReviews[$i]['rating_star'] === 4) {
                    $countStar4 += 1;
                } elseif ($listReviews[$i]['rating_star'] === 3) {
                    $countStar3 += 1;
                } elseif ($listReviews[$i]['rating_star'] === 2) {
                    $countStar2 += 1;
                } elseif ($listReviews[$i]['rating_star'] === 1) {
                    $countStar1 += 1;
                }
            }

            $ratingPercentage1 = $countStar1 / count($listReviews) * 100;
            $ratingPercentage2 = $countStar2 / count($listReviews) * 100;
            $ratingPercentage3 = $countStar3 / count($listReviews) * 100;
            $ratingPercentage4 = $countStar4 / count($listReviews) * 100;
            $ratingPercentage5 = $countStar5 / count($listReviews) * 100;

            $avgRatingStar = round($totalRating / count($listReviews) * 100) / 100; // lấy ra hai dấu phẩy 
        } else {
            $ratingPercentage1 = 0;
            $ratingPercentage2 = 0;
            $ratingPercentage3 = 0;
            $ratingPercentage4 = 0;
            $ratingPercentage5 = 0;
            $avgRatingStar = 0;
        }






        require './views/products/productDetail.php';
        delteSessionError();
    }
 
    public function postComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'] ?? '';
            if ($user_id === '') {
                $_SESSION['success'] = 'Bạn cần đăng nhập để bình luận';
                header('location:' . BASE_URL . '?act=login');
                exit();
            }
            $product_id = $_POST['product_id'];
            $content = $_POST['content'];
            $errors = [];
            if (empty($content)) {
                $errors['content'] = 'Không để trống nội dung bình luận';
            }
            if (empty($product_id)) {
                $errors['product_id'] = 'error';
            }
            if (empty($errors)) {
                $success = $this->modelHome->insertComment($user_id, $product_id, $content);
                if ($success) {
                    header('location:' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $_SESSION['error'] = $errors;
                $_SESSION['flash'] = true;
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function changeStatusCommentById()
    {
        $comment_id = $_GET['id'];
        $success = $this->modelHome->changeStatusComment($comment_id);
        if ($success) {
            $_SESSION['success'] = 'Cập nhật bình luận thành công';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    public function deleteComment()
    {
        $comment_id = $_GET['id'];
        $success = $this->modelHome->deleteCommentById($comment_id);
        if ($success) {
            $_SESSION['success'] = 'Xoá thành công bình luận thành công';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
