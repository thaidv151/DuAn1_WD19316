<?php require_once './views/layouts/header.php'; ?>
<!-- page-title -->
<?php
if (isset($_SESSION['success'])) { ?>
    <script>
        const alertSuccess = <?= json_encode($_SESSION['success']) ?>;
        alert(alertSuccess);
    </script>
<?php } ?>
<!-- /page-title -->
<div class="tf-slideshow slider-effect-fade position-relative">
    <div dir="ltr" class="swiper tf-sw-slideshow " data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true" data-auto-play="true" data-delay="3000" data-speed="1000">
        <div class="swiper-wrapper">
            <?php foreach ($listBanner as $key => $item): ?>

                <div class="swiper-slide">
                    <div class="wrap-slider">
                        <img src="<?= $item['image_link'] ?>" alt="fashion-slideshow">
                        <div class="box-content">
                            <div class="container">
                                <h1 class="fade-item fs-1 fade-item-1 col-4"><?= $item['title'] ?></h1>
                                <p class="fade-item fade-item-2"><?= $item['content'] ?></p>
                                <a href="<?= $item['product_link'] ?>" class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="wrap-pagination">
        <div class="container">
            <div class="sw-dots sw-pagination-slider justify-content-center"></div>
        </div>
    </div>
</div>
<!-- Section Product -->
<section class="flat-spacing-2">
    <div class="container">
        <div class="tf-shop-control grid-3 align-items-center">
            <div class="tf-control-filter">
                <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filter</span></a>
            </div>
            <ul class="tf-control-layout d-flex justify-content-center">
                <li class="tf-view-layout-switch sw-layout-2" data-value-grid="grid-2">
                    <div class="item"><span class="icon icon-grid-2"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-3" data-value-grid="grid-3">
                    <div class="item"><span class="icon icon-grid-3"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-4 active" data-value-grid="grid-4">
                    <div class="item"><span class="icon icon-grid-4"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-5" data-value-grid="grid-5">
                    <div class="item"><span class="icon icon-grid-5"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-6" data-value-grid="grid-6">
                    <div class="item"><span class="icon icon-grid-6"></span></div>
                </li>
            </ul>

        </div>


        <div class="wrapper-control-shop">
            <div class="meta-filter-shop"></div>
            <div class="grid-layout wrapper-shop" data-grid="grid-4">
                <!-- card product 1 -->

                <!-- card product 2 -->
                <?php foreach ($listProduct as $key => $product): ?>

                    <div class="card-product card-product-style" data-price="18.95" data-size="m l xl" data-color="brown light-purple light-green">
                        <div class="card-product-wrapper">
                            <a href="<?= BASE_URL . '?act=product-detail&id=' . $product['id'] . '&variant_id=' . $product['album_product'][0]['id'] ?>" class="product-img">
                                <?php foreach ($product['album_product'] as $key => $item): ?>


                                    <img class="lazyload" data-src="<?= $item['thumbnail_variant'] ?>" src="<?= $item['thumbnail_variant'] ?>" alt="image-product" onerror="this.onerror=null;this.src='./uploads/logo1.png'">

                                <?php endforeach ?>
                            </a>

                            <div class="size-list">
                                <span>S</span>
                                <span>M</span>
                                <span>L</span>
                                <span>XL</span>
                                <span>2XL</span>
                            </div>

                            <div class="on-sale-wrap text-end">
                                <div class="on-sale-item"><?= $product['disscount_value'] ?>%</div>
                            </div>
                        </div>

                        <div class="card-product-info">
                            <div class="title link fs-5 product_name"><?= $product['product_name'] ?></div>
                            <div class="col-12  row">

                                <del class=" ms-2 price col-7"><?= number_format($product['price']). ' VND' ?></del>
                                <span class="text-danger col-4 price"><?= number_format($product['promotion_price']) . ' VND' ?></span>
                            </div>


                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- card product 3 -->

            </div>
            <!-- pagination -->
        </div>

    </div>
</section>
<div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
    <div class="canvas-wrapper">
        <header class="canvas-header">
            <div class="filter-icon">
                <span class="icon icon-filter"></span>
                <span>Filter</span>
            </div>
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        </header>
        <div class="canvas-body">
            <div class="widget-facet wd-categories">
                <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
                    <span>Product categories</span>
                    <span class="icon icon-arrow-up"></span>
                </div>
                <div id="categories" class="collapse show">
                    <ul class="list-categoris current-scrollbar mb_36">
                        <li class="cate-item current"><a href="shop-default.html"><span>Fashion</span></a></li>
                        <li class="cate-item"><a href="shop-default.html"><span>Men</span></a></li>
                        <li class="cate-item"><a href="shop-default.html"><span>Women</span></a></li>
                        <li class="cate-item"><a href="shop-default.html"><span>Denim</span></a></li>
                        <li class="cate-item"><a href="shop-default.html"><span>Dress</span></a></li>
                    </ul>
                </div>
            </div>
            <form action="#" id="facet-filter-form" class="facet-filter-form">
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                        <span>Price</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="price" class="collapse show">
                        <div class="widget-price filter-price">
                            <div class="tow-bar-block">
                                <div class="progress-price"></div>
                            </div>
                            <div class="range-input">
                                <input class="range-min" type="range" min="0" max="10000000" value="0" />
                                <input class="range-max" type="range" min="0" max="10000000" value="10000000" />
                            </div>
                            <div class="box-title-price">
                                <span class="title-price">Price :</span>
                                <div class="caption-price">
                                    <div>
                                        <span>$</span>
                                        <span class="min-price">0</span>
                                    </div>
                                    <span>-</span>
                                    <div>
                                        <span>$</span>
                                        <span class="max-price">10000000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </form>
        </div>

    </div>
</div>

<?php require_once './views/layouts/footer.php'; ?>