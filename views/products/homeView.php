<?php require_once './views/layouts/header.php'; ?>
<!-- page-title -->

<!-- /page-title -->

<div class="tf-slideshow slider-effect-fade position-relative <?= isset($_GET['category']) ? "fade d-none" : "" ?>">
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
<div class=" flat-spacing-2 bg-white py-5 <?= isset($_GET['category']) ? "fade d-none" : "" ?>">
            <div class="container <?= isset($_GET['category']) ? "fade d-none" : "" ?>">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center">
                        <img src="uploads/5e55e1bf325bdc93c5ade4088e3dfdfa.webp" alt="Placeholder" class="img-fluid rounded" style="max-width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <h3>PEACEFUL SUMMER</h3>
                        <p>Đa dạng mẫu mã áo khoác cho bạn thoả sức lựa chọn dựa trên nhiều tiêu chí, giá cả phù hợp, chất lượng đảm bảo cho người dùng trải nghiệm tốt nhất !!</p>
                        <a href="<?= BASE_URL . "?category=Áo khoác" ?>" class="mt-3 tf-btn btn-fill animate-hover-btn btn-sm radius-3"><span>Explore Now</span></a>
                    </div>
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
        <div id="listProductViewDesc">
            <div class="wrapper-control-shop <?= isset($_GET['category']) ? "fade d-none" : "" ?>">
                <h5 class=" m-4 text-decoration-underline" id="view-hot-search">
                    Sản phẩm mới nhất
                </h5>
                <div class="meta-filter-shop"></div>
                <div class="grid-layout wrapper-shop" data-grid="grid-4">
                    <section class="flat-spacing-1 pt_0">
                        <div class="container">
                            <section class="flat-spacing-1 pt_0">
                                <div class="container">

                                    <div class="hover-sw-nav hover-sw-2">
                                        <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($listProductView as $key => $product): ?>
                                                    <div class="swiper-slide" lazy="true">
                                                        <div class="card-product data-price=" 18.95" data-size="m l xl" data-color="brown light-purple light-green">
                                                            <div class="card-product-wrapper">
                                                                <a href="<?= BASE_URL . '?act=product-detail&id=' . $product['id'] . '&variant_id=' . $product['album_product'][0]['id'] ?>" class="product-img">
                                                                    <?php foreach ($product['album_product'] as $key => $item): ?>
                                                                        <img class="lazyload" data-src="<?= $item['thumbnail_variant'] ?>" src="<?= $item['thumbnail_variant'] ?>" alt="image-product" onerror="this.onerror=null;this.src='./Uploads/logo1.png'">
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
                                                                    <div class="on-sale-item"><?= '-' . $product['disscount_value'] ?>%</div>
                                                                </div>
                                                            </div>
                                                            <div class="card-product-info">
                                                                <div class="title link fs-5 product_name"><?= $product['product_name'] ?></div>
                                                                <div class="col-12 row">
                                                                    <del class="price col-sm-7"><?= number_format($product['price']) . ' VND' ?></del>
                                                                    <span class="text-danger col-5 price"><?= number_format($product['promotion_price']) . ' VND' ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                                        <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                                        <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class=" flat-spacing-2 bg-white py-5 <?= isset($_GET['category']) ? "fade d-none" : "" ?>">
            <div class="container <?= isset($_GET['category']) ? "fade d-none" : "" ?>">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>PEACEFUL SUMMER</h3>
                        <p>Mang đến cho bạn mùa hề rực rỡ với nhiều lựa chọn ưu đãi để chiều lòng khách hàng khó tính nhất</p>
                        <a href="<?= BASE_URL . "?category=Áo phông" ?>" class="mt-3 tf-btn btn-fill animate-hover-btn btn-sm absolute end-0 radius-3"><span>Explore Now</span></a>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="uploads/6bb2ca067fbba28f4aecb5c7ebafd712.webp" alt="Placeholder" class="img-fluid rounded" style="max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-control-shop mt-4">
            <h5 class="m-4 text-decoration-underline" id="view-all-product">
                <?= isset($_GET['category']) ? "Danh mục: " . $_GET['category'] : "Sản phẩm" ?>
            </h5>
            <div class="meta-filter-shop fs-3 m-4"></div>
            <div class="grid-layout wrapper-shop" data-grid="grid-4" id="productContainer">
                <?php
                $initialDisplay = 8;
                $productCount = 0;
                foreach ($listProduct as $key => $product):
                    if ($productCount >= $initialDisplay) {
                        $displayStyle = 'style="display: none;"';
                    } else {
                        $displayStyle = '';
                    }
                    $productCount++;
                ?>
                    <div class="card-product card-product-style" data-price="18.95" data-size="m l xl" data-color="brown light-purple light-green" <?= $displayStyle ?>>
                        <div class="card-product-wrapper">
                            <a href="<?= BASE_URL . '?act=product-detail&id=' . $product['id'] . '&variant_id=' . $product['album_product'][0]['id'] ?>" class="product-img">
                                <?php foreach ($product['album_product'] as $key => $item): ?>
                                    <img class="lazyload" data-src="<?= $item['thumbnail_variant'] ?>" src="<?= $item['thumbnail_variant'] ?>" alt="image-product" onerror="this.onerror=null;this.src='./Uploads/logo1.png'">
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
                                <div class="on-sale-item"><?= '-' . $product['disscount_value'] ?>%</div>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <div class="title link fs-5 product_name"><?= $product['product_name'] ?></div>
                            <div class="col-12 row">
                                <del class="price col-sm-7"><?= number_format($product['price']) . ' VND' ?></del>
                                <span class="text-danger col-5 price"><?= number_format($product['promotion_price']) . ' VND' ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($listProduct) > $initialDisplay): ?>
                <div class="text-center mt-4">
                    <button id="viewMoreBtn" class="tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Xem thêm</span></button>
                </div>
            <?php endif; ?>
            <?php if (count($listProduct) == 0): ?>
                <div class="text-center mt-4 fs-6">
                    <div class="fs-6 badge bg-warning p-3">Không có sản phẩm nào thuộc danh mục này</div>
                </div>
            <?php endif; ?>

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
                        <?php foreach ($listCategories as $key => $item): ?>
                            <li class="cate-item current">
                                <a href="<?= BASE_URL . "?category=" . $item['category_name'] ?>"><?= $item['category_name'] ?></a>
                            </li>
                        <?php endforeach; ?>
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
                                <div>
                                    <input id="range-min" type="range" min="0" max="5000000" value="0" />
                                    <input id="range-max" type="range" min="0" max="5000000" value="5000000" />
                                </div>
                                <div class="d-flex">
                                    <p class="position-absolute pt-2 start-0" id="viewMinPrice">0</p>
                                    <p class="position-absolute pt-2 end-0" id="viewMaxPrice">5.000.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const product_name = document.querySelectorAll('.product_name');
    const cardProduct = document.querySelectorAll('.card-product-style');
    const dataProduct = <?= json_encode($listProduct) ?>;

    inpSearch.addEventListener('input', () => {
        const listProductViewDesc = document.querySelector('#listProductViewDesc');
        listProductViewDesc.style.display = 'none';
        const inpSearch = document.querySelector('#inpSearch').value;
        const productSearch = dataProduct.filter((item, index) => {
            if (item.product_name.toUpperCase().indexOf(inpSearch.toUpperCase()) === -1) {
                cardProduct[index].style.display = 'none';
            } else {
                cardProduct[index].style.display = 'block';
            }
        });
    });

    const rangeMin = document.querySelector('#range-min');
    const rangeMax = document.querySelector('#range-max');

    rangeMin.addEventListener('change', () => {
        filterPrice();
        const viewMinPrice = document.querySelector('#viewMinPrice');
        viewMinPrice.innerHTML = new Intl.NumberFormat('vi', {
            style: 'currency',
            currency: 'VND'
        }).format(rangeMin.value);
    });

    rangeMax.addEventListener('change', () => {
        const viewMaxPrice = document.querySelector('#viewMaxPrice');
        viewMaxPrice.innerHTML = new Intl.NumberFormat('vi', {
            style: 'currency',
            currency: 'VND'
        }).format(rangeMax.value);
        filterPrice();
    });
    const filterPrice = () => {
        console.log(dataProduct);
        const listProductViewDesc = document.querySelector('#listProductViewDesc');
        listProductViewDesc.style.display = 'none';
        dataProduct.forEach((element, index) => {
            if (element.promotion_price >= rangeMin.value && element.promotion_price <= rangeMax.value) {
                cardProduct[index].style.display = 'block';
            } else {
                cardProduct[index].style.display = 'none';
            }
        });
    };

    // View More Functionality
    const viewMoreBtn = document.querySelector('#viewMoreBtn');
    const productContainer = document.querySelector('#productContainer');
    let visibleProducts = <?= $initialDisplay ?>;

    if (viewMoreBtn) {
        viewMoreBtn.addEventListener('click', () => {
            const allProducts = productContainer.querySelectorAll('.card-product-style');
            const totalProducts = allProducts.length;
            const nextProducts = visibleProducts + 10;

            for (let i = visibleProducts; i < nextProducts && i < totalProducts; i++) {
                allProducts[i].style.display = 'block';
            }

            visibleProducts = nextProducts;

            if (visibleProducts >= totalProducts) {
                viewMoreBtn.style.display = 'none';
            }
        });
    }
</script>
<script>
    const viewProduct = document.querySelector('#viewProduct');
    viewProduct.addEventListener('click', () => {
        const positionView = document.querySelector('#view-all-product');
        positionView.scrollIntoView({
            behavior: "smooth"
        });
    });

    const viewHotsearch = document.querySelector('#viewHotsearch');
    const positionViewHotSearh = document.querySelector('#view-hot-search');

    viewHotsearch.addEventListener('click', () => {
        positionViewHotSearh.scrollIntoView({
            behavior: "smooth"
        });
    });
</script>
<?php require_once './views/layouts/footer.php'; ?>