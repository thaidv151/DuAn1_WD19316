<?php require_once './views/layouts/header.php'; ?>

<div class="container">
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-info"><?= $_SESSION['success'] ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-md-6">
            <div class="tf-product-media-wrap sticky-top">
                <div class="thumbs-slider">
                    <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                        <div class="swiper-wrapper stagger-wrap ">
                            <!-- beige -->
                            <div class="swiper-slide stagger-item" data-color="beige">
                                <div class="item" onclick="thumbnail(0)">
                                    <img class="lazyload newThumbnail" data-src="<?= $variant['thumbnail_variant'] ?>" src="<?= $variant['thumbnail_variant'] ?>" alt="img-product">
                                </div>
                                <?php foreach ($album_variant as $key => $item): ?>
                                    <div class="item" onclick="thumbnail(<?= $key + 1 ?>)">
                                        <img class="mt-2 lazyload newThumbnail" data-src="<?= $item['link_image'] ?>" src="<?= $item['link_image'] ?>" alt="img-product">
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                        <div class="swiper-wrapper">
                            <!-- beige -->
                            <div class="swiper-slide" data-color="beige">
                                <a href="<?= $variant['thumbnail_variant'] ?>" target="_blank" class="item " id="thumbnail_variant" data-pswp-width="770px" data-pswp-height="1075px">
                                    <img class="tf-image-zoom lazyload thumbnail" data-zoom="<?= $variant['thumbnail_variant'] ?>" data-src="<?= $variant['thumbnail_variant'] ?>" src="<?= $variant['thumbnail_variant'] ?>" alt="asda">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tf-product-info-wrap position-relative">
                <div class="tf-zoom-main"></div>
                <form action="<?= BASE_URL . '?act=add-to-cart' ?>" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <input type="hidden" name="variant_id" value="<?= $variant_id ?>">
                    <div class="tf-product-info-list other-image-zoom">
                        <div class="tf-product-info-title">
                            <h5><?= $product['product_name'] ?></h5>

                        </div>
                        <div>
                            <p>Mô tả: </p><em><?= $product['product_description'] ?> </em>
                        </div>
                        <div class="tf-product-info-price">
                            <div class="fs-4 text-danger"><?= number_format($product['promotion_price']) . 'VND' ?></div>
                            <div class="compare-at-price"><?= number_format($product['price']) . 'VND' ?> </div>
                            <div class="badges-on-sale"><span><?= $product['disscount_value'] ?></span>% OFF</div>
                        </div>


                        <div class="tf-product-info-variant-picker">
                            <div class="variant-picker-item">
                                <div class="variant-picker-label">
                                    Color: <span class="fw-6"><?= $product['color'] ?></span>
                                </div>
                                <div class="variant-picker-values">
                                    <?php foreach ($listVariant as $key => $item): ?>
                                        <a href="<?= BASE_URL . '?act=product-detail&id=' . $product['id'] . '&variant_id=' . $item['id'] ?>" class="hover-tooltip radius-60 color-btn active <?= $variant['id'] === $item['id'] ? 'border border-3' : '' ?>">
                                            <span class="">
                                                <img style="width:35px; height:35px; border-radius:50%" src="<?= $item['thumbnail_variant'] ?>" alt="">
                                            </span>
                                            <span class="tooltip"><?= $item['color'] ?></span>
                                        </a>
                                    <?php endforeach ?>

                                </div>
                            </div>
                            <div class="variant-picker-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="variant-picker-label">

                                        Size: <span class="fw-6 variant-picker-label-value">S</span>
                                        <?php if (isset($_SESSION['error']['size_id'])) { ?>
                                            <p class="text-danger fs-5"><?= $_SESSION['error']['size_id'] ?></p>
                                        <?php } ?>
                                    </div>

                                </div>

                                <div class="row text-center">

                                    <?php foreach ($listSize as $key => $item): ?>
                                        <div class="col-1">
                                            <label>
                                                <p><?= $item['size'] ?></p>
                                            </label>
                                            <input <?= $item['quantity_size'] === 0 ? 'disabled' : "" ?> class="form-check-input bg-success" style="width: 25px; height:25px" type="radio" name="size_id" onclick="checkQuantity('<?= $item['size'] ?>')" value="<?= $item['id'] ?>">

                                        </div>
                                    <?php endforeach ?>

                                </div>
                            </div>
                        </div>
                        <div class="tf-product-info-quantity">
                            <div class="quantity-title fw-6">
                                <p>Instock: </p>
                                <p class="quantitySize"></p>
                                <?php if (isset($_SESSION['error']['quantity'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['quantity'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="quantity-title fw-6">Quantity: </div>
                            <div class="wg-quantity">
                                <span class="btn-quantity btn-decrease" onclick="reloadIncrease()">-</span>
                                <input type="number" class="quantity" name="quantity" value="1" min="0" onchange="">
                                <span class="btn-quantity btn-increase" onclick="checkLimitSize()">+</span>
                            </div>
                        </div>
                        <div>
                            <button name="addToCart" type="submit" class="mb-3 tf-btn btn-fill justify-content-center fw-6 fs-16 col-12 flex-grow-1 animate-hover-btn btn-add-to-cart bg-success">Add to cart <i class="bi bi-basket ms-2 fs-4"></i> </button>

                            <button name="redirect" type="submit" class="tf-btn btn-fill justify-content-center fw-6 fs-16 col-12 flex-grow-1 animate-hover-btn btn-add-to-cart bg-warning">Buy now <i class="bi bi-cash-coin ms-4 pt-2 fs-4"></i></button>

                        </div>
                </form>
                <div class="tf-product-info-buy-button">
                </div>
            </div>
        </div>
    </div>
    <section class="flat-spacing-10">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="flat-accordion has-btns">


                        <div class="flat-toggle style-2">
                            <div class="toggle-title">Comments</div>
                            <div class="toggle-content">
                                <div class="tab-reviews write-cancel-review-wrap">

                                    <div class="reply-comment cancel-review-wrap">
                                        <div class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                            <h5 class="">Comments</h5>
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="tab-reviews-heading">
                                                    <div>
                                                        <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-cancel-review">Cancel Review</div>
                                                        <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">Write a review</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-comment-wrap">
                                            <?php foreach ($listComments as $key => $item): ?>
                                                <?php if (isset($_SESSION['user'])) { ?>
                                                    <?php if ($_SESSION['user']['role_id'] === 1 || $_SESSION['user']['role_id'] === 0) { ?>
                                                        <div class="reply-comment-item">
                                                            <div class="user position-relative">
                                                                <div>
                                                                    <a href="<?= BASE_URL . '?act=client-profile&user_id=' . $item['user_id'] ?>">
                                                                        <img style="width:40px; height:40px; border-radius:50%;" src="<?= $item['avatar'] ?>" alt="" onerror="this.onerror=null; this.src='./uploads/logo1.png'">

                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <h6>
                                                                        <p><?= $item['username'] ?></p>
                                                                    </h6>
                                                                    <div class="day text_black-3"><?= $item['created_at'] ?></div>
                                                                </div>
                                                                <?php if (isset($_SESSION['user'])) { ?>
                                                                    <?php if ($_SESSION['user']['id'] === 1 || $_SESSION['user']['id'] === 0) { ?>
                                                                        <div class="d-flex position end-0 position-absolute">

                                                                            <a title="Ẩn/hiện" href="<?= BASE_URL . '?act=change-status-comment&id=' . $item['id'] ?>">
                                                                                <button class="btn border <?= $item['status'] ? 'btn-success' : 'btn-danger' ?>">
                                                                                    <?= $item['status'] === 1 ? '<i class="bi bi-eye-slash-fill"></i>' : '<i class="bi bi-eye-fill"></i>' ?>
                                                                                </button>
                                                                            </a>

                                                                        </div>

                                                                        <?php if ($_SESSION['user']['id'] === $item['user_id']) {  ?>
                                                                            <div class="d-flex position end-0 me-5 position-absolute">
                                                                                <a title="Xoá binh luận" href="<?= BASE_URL . '?act=delete-comment&id=' . $item['id'] ?>">
                                                                                    <button class="btn border btn-danger">
                                                                                        <i class="bi bi-trash3"></i>
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>


                                                                    <?php } ?>
                                                                <?php } ?>

                                                            </div>

                                                            <p class="text_black-3 form-control"><?= $item['content'] ?></p>
                                                        </div>
                                                    <?php } else { ?>
                                                        <?php if ($item['status'] === 1) { ?>
                                                            <div class="reply-comment-item">
                                                                <div class="user position-relative">
                                                                    <div>
                                                                        <img style="width:40px; height:40px; border-radius:50%;" src="<?= $item['avatar'] ?>" alt="" onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                                                    </div>
                                                                    <div>
                                                                        <h6>
                                                                            <p><?= $item['username'] ?></p>
                                                                        </h6>
                                                                        <div class="day text_black-3"><?= $item['created_at'] ?></div>
                                                                    </div>
                                                                    <?php if (isset($_SESSION['user'])) { ?>
                                                                        <?php if ($_SESSION['user']['role_id'] === 2 && $_SESSION['user']['id'] === $item['user_id']) {  ?>
                                                                            <div class="d-flex position end-0 position-absolute">
                                                                                <a title="Xoá binh luận" href="<?= BASE_URL . '?act=delete-comment&id=' . $item['id'] ?>">
                                                                                    <button class="btn border btn-danger">
                                                                                        <i class="bi bi-trash3"></i>
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                    <?php } ?>

                                                                </div>
                                                                <p class="text_black-3 form-control"><?= $item['content'] ?></p>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <?php if ($item['status'] === 1) { ?>
                                                        <div class="reply-comment-item">
                                                            <div class="user position-relative">
                                                                <div>
                                                                    <img style="width:40px; height:40px; border-radius:50%;" src="<?= $item['avatar'] ?>" alt="" onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                                                </div>
                                                                <div>
                                                                    <h6>
                                                                        <p><?= $item['username'] ?></p>
                                                                    </h6>
                                                                    <div class="day text_black-3"><?= $item['created_at'] ?></div>
                                                                </div>


                                                            </div>
                                                            <p class="text_black-3 form-control"><?= $item['content'] ?></p>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>




                                            <?php endforeach ?>


                                        </div>
                                    </div>
                                    <form method="POST" action="<?= BASE_URL . '?act=post-comments' ?>" class="form-write-review write-review-wrap frmComment">
                                        <div class="heading">
                                            <h5>Write a comment:</h5>

                                        </div>
                                        <div class="form-content">
                                            <input type="hidden" name="user_id" value="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <fieldset class="box-field">
                                                <label class="label">Review
                                                    <?php if (isset($_SESSION['error']['content'])) { ?>
                                                        <p class="text-danger"><?= $_SESSION['error']['content'] ?></p>
                                                    <?php } ?>

                                                </label>
                                                <textarea rows="4" name="content" placeholder="Write your comment here" tabindex="2" aria-required="true"></textarea>
                                            </fieldset>


                                        </div>
                                        <div class="button-submit">
                                            <button class="tf-btn btn-fill animate-hover-btn" type="submit">Submit Reviews</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flat-toggle style-2">
                            <div class="toggle-title">Reviews</div>
                            <div class="toggle-content">
                                <div class="tab-reviews write-cancel-review-wrap">
                                    <div class="tab-reviews-heading">
                                        <div class="top">
                                            <div class="text-center">
                                                <h1 class="number fw-6"><?= $avgRatingStar ?></h1>
                                                <div class="list-star">
                                                    <?php for ($i = 0; $i < round($avgRatingStar); $i++): ?>
                                                        <i class="icon icon-star"></i>
                                                    <?php endfor; ?>

                                                </div>
                                            </div>
                                            <div class="rating-score">
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">5</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: <?= $ratingPercentage5 . '%' ?>;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1"><?= $countStar5 ?></div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">4</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: <?= $ratingPercentage4 . '%' ?>;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1"><?= $countStar4 ?></div>
                                                </div>

                                                <div class="item">
                                                    <div class="number-1 text-caption-1">3</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: <?= $ratingPercentage3 . '%' ?>;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1"><?= $countStar3 ?></div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">2</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width:<?= $ratingPercentage2 . '%' ?>;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1"><?= $countStar2 ?></div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">1</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width:<?= $ratingPercentage1 . '%' ?>;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1"><?= $countStar1 ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reply-comment cancel-review-wrap">
                                        <div class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                            <h5 class=""><?= count($listReviews) ?> Reviews</h5>
                                        </div>
                                        <?php foreach ($listReviews as $key => $item): ?>

                                            <div class="reply-comment-item">
                                                <div class="user">

                                                    <?php if (isset($_SESSION['user'])) { ?>
                                                        <?php if ($_SESSION['user']['role_id'] === 1 || $_SESSION['user']['role_id'] === 0) { ?>
                                                            <a href="<?= BASE_URL . '?act=client-profile&user_id=' . $item['user_id'] ?>">
                                                                <div class="image">
                                                                    <img style="width:40px; height:40px; border-radius:50%;" src="<?= $item['avatar'] ?>" alt=""
                                                                        onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                                                </div>
                                                            </a>

                                                        <?php } else { ?>
                                                            <div class="image">
                                                                <img style="width:40px; height:40px; border-radius:50%;" src="<?= $item['avatar'] ?>" alt=""
                                                                    onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                                            </div>
                                                        <?php } ?>
                                                    <?php } else {  ?>
                                                        <div class="image">
                                                            <img style="width:40px; height:40px; border-radius:50%;" src="<?= $item['avatar'] ?>" alt=""
                                                                onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-8 row">
                                                        <div class="col-2">
                                                            <h6>
                                                                <p class="link"><?= $item['username'] ?></p>
                                                            </h6>
                                                            <div class="day text_black-3"><?= $item['created_at'] ?></div>
                                                        </div>
                                                        <div class="col-4 list-star">
                                                            <?php for ($i = 0; $i < $item['rating_star']; $i++): ?>
                                                                <i class="icon icon-star text-warning"></i>
                                                            <?php endfor ?>
                                                            <div>
                                                                <p>
                                                                    <?= $item['color'] ?> : <?= $item['size'] ?>

                                                                </p>
                                                                <div>
                                                                    <img style="width: 30px;" src="<?= $item['thumbnail_variant']  ?>" alt=""
                                                                        onerror="this.onerror=null; this.src='./uploads/logo1.png'" ;>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="form-control text_black-3"><?= $item['content'] ?></p>
                                            </div>
                                        <?php endforeach ?>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
</section>
<section class="flat-spacing-1 pt_0">
    <div class="container">
        <div class="flat-title">
            <span class="title">Sản phẩm tương tự</span>
        </div>
        <div class="hover-sw-nav hover-sw-2">
            <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                <div class="swiper-wrapper">
                    <?php foreach ($lastProductFilter as $key => $product): ?>

                        <div class="swiper-slide" lazy="true">
                            <div class="card-product">
                                <div class="card-product-wrapper">
                                    <a href="<?= BASE_URL . '?act=product-detail&id=' . $product['id'] . '&variant_id=' . $product['variant']['id'] ?>" class="product-img">
                                        <img class="lazyload img-product" data-src="<?= $product['variant']['thumbnail_variant'] ?>" src="<?= $product['variant']['thumbnail_variant'] ?>" alt="image-product">
                                        <img class="lazyload img-hover" data-src="<?= $product['variant']['thumbnail_variant'] ?>" src="<?= $product['variant']['thumbnail_variant'] ?>" alt="image-product">
                                    </a>

                                    <div class="size-list">
                                        <span>S</span>
                                        <span>M</span>
                                        <span>L</span>
                                        <span>XL</span>
                                        <span>2XL</span>
                                    </div>
                                    <div class="on-sale-wrap">
                                        <div class="on-sale-item"><?= $product['disscount_value'] . '%' ?></div>
                                    </div>

                                </div>
                                <div class="card-product-info">
                                    <a href="product-detail.html" class="title link"><?= $product['product_name'] ?></a>
                                    <div class="col-12 row">
                                        <del class="price col-6"><?= number_format($product['variant']['price']) . 'VND' ?></del>
                                        <span class="text-danger price col-6"><?= number_format($product['variant']['promotion_price']) . 'VND' ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
            <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
            <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
        </div>
    </div>
</section>
</div>
<?php require_once './views/layouts/footer.php'; ?>
<script>
    const thumbnail = (order) => {
        const thumbnail = document.querySelector('.thumbnail');
        const thumbnail_variant = document.querySelector('#thumbnail_variant');
        const newThumbnail = document.querySelectorAll('.newThumbnail');
        thumbnail.src = newThumbnail[order].src;
        thumbnail_variant.href = newThumbnail[order].src;
    }

    const variant = <?= json_encode($listSize) ?>;

    const quantitySize = document.querySelector('.quantitySize');

    const quantity = document.querySelector('.quantity');

    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');

    btnIncrease.addEventListener('click', () => {
        let count = quantity.value
        count = Number(count) + Number(1);
        quantity.value = count;
    })
    btnDecrease.addEventListener('click', () => {
        if (!quantity.value > 1) {
            let count = quantity.value
            count = Number(count) - Number(1);
            quantity.value = count;
        } else {
            quantity.value = 1;
        }
    })
    let sizeSelect = null;

    const checkQuantity = (value) => {
        quantity.value = 1;
        btnIncrease.style.pointerEvents = 'auto';
        variant.forEach(element => {
            if (value == element.size) {
                if (element.quantity_size === 1) {
                    btnIncrease.style.pointerEvents = 'none';
                    btnDecrease.style.pointerEvents = 'none';
                } else {
                    btnIncrease.style.pointerEvents = 'auto';
                    btnDecrease.style.pointerEvents = 'auto';
                }
                sizeSelect = element.size;
                quantitySize.innerHTML = element.quantity_size
            }
        });

    }
    const checkLimitSize = () => {


        variant.forEach(element => {
            if (element.size === sizeSelect) {
                if (quantity.value >= element.quantity_size - 1) {
                    btnIncrease.style.pointerEvents = 'none';
                }
            }
        });
    }
    const reloadIncrease = () => {
        btnIncrease.style.pointerEvents = 'auto';
    }
</script>