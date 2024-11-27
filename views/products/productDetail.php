<?php require_once './views/layouts/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="tf-product-media-wrap sticky-top">
                <div class="thumbs-slider">
                    <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                        <div class="swiper-wrapper stagger-wrap ">
                            <!-- beige -->
                            <div class="swiper-slide stagger-item" data-color="beige">
                                <?php foreach ($album_variant as $key => $item): ?>


                                    <div class="item" onclick="thumbnail(<?= $key ?>)">
                                        <img class="lazyload newThumbnail" data-src="<?= $item['link_image'] ?>" src="<?= $item['link_image'] ?>" alt="img-product">
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
                <form action="<?= BASE_URL . '?act=post-add-cart' ?>" method="POST">
                    <div class="tf-product-info-list other-image-zoom">
                        <div class="tf-product-info-title">
                            <h5><?= $product['product_name'] ?></h5>

                        </div>
                        <div>
                            <em><?= $product['product_description'] ?> </em>
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
                                        <a href="<?= BASE_URL . '?act=product-detail&id=' . $product['id'] . '&variant_id=' . $item['id'] ?>" class="hover-tooltip radius-60 color-btn active">
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
                                    </div>
                                </div>

                                <div class="row text-center">

                                    <?php foreach ($listSize as $key => $item): ?>
                                        <div class="col-1">
                                            <label>
                                                <p><?= $item['size'] ?></p>
                                            </label>
                                            <input <?= $item['quantity_size'] === 0 ? 'disabled' : "" ?>  class="form-check-input bg-success" style="width: 25px; height:25px" type="radio" name="size" onclick="checkQuantity('<?= $item['size'] ?>')" value="<?= $item['size'] ?>">

                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <div class="tf-product-info-quantity">
                            <div class="quantity-title fw-6"><p>Instock: </p><p class="quantitySize"></p></div>
                            <div class="quantity-title fw-6">Quantity: </div>
                            <div class="wg-quantity">
                                <span class="btn-quantity btn-decrease" onclick="reloadIncrease()">-</span>
                                <input type="text" class="quantity-product"  name="quantity" value="1">
                                <span  class="btn-quantity btn-increase" onclick="checkLimitSize()">+</span>
                            </div>
                        </div>
                        <div>
                            <button  name="addToCart" type="submit" class="mb-3 tf-btn btn-fill justify-content-center fw-6 fs-16 col-12 flex-grow-1 animate-hover-btn btn-add-to-cart bg-success">Add to cart <i class="bi bi-basket ms-2 fs-4"></i>  </button>

                            <button name="buyNow" type="submit" class="tf-btn btn-fill justify-content-center fw-6 fs-16 col-12 flex-grow-1 animate-hover-btn btn-add-to-cart bg-warning">Buy now <i class="bi bi-cash-coin ms-4 pt-2 fs-4"></i></button>

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
                                            <h5 class=""><?= count($listComments) ?> Comments</h5>
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
                                                <div class="reply-comment-item">
                                                    <div class="user">
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
                            <div class="toggle-title">Review</div>
                            <div class="toggle-content">
                                <div class="tab-reviews write-cancel-review-wrap">
                                    <div class="tab-reviews-heading">
                                        <div class="top">
                                            <div class="text-center">
                                                <h1 class="number fw-6">4.8</h1>
                                                <div class="list-star">
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                </div>
                                                <p>(168 Ratings)</p>
                                            </div>
                                            <div class="rating-score">
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">5</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: <?= '10%' ?>;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">59</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">4</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">46</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">3</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 0%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">0</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">2</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 0%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">0</div>
                                                </div>
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">1</div>
                                                    <i class="icon icon-star"></i>
                                                    <div class="line-bg">
                                                        <div style="width: 0%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">0</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-cancel-review">Cancel Review</div>
                                            <div class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">Write a review</div>
                                        </div>
                                    </div>
                                    <div class="reply-comment cancel-review-wrap">
                                        <div class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                            <h5 class="">03 Comments</h5>
                                            <div class="d-flex align-items-center gap-12">
                                                <div class="text-caption-1">Sort by:</div>
                                                <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                                                    <div class="btn-select">
                                                        <span class="text-sort-value">Most Recent</span>
                                                        <span class="icon icon-arrow-down"></span>
                                                    </div>
                                                    <div class="dropdown-menu">
                                                        <div class="select-item active">
                                                            <span class="text-value-item">Most Recent</span>
                                                        </div>
                                                        <div class="select-item">
                                                            <span class="text-value-item">Oldest</span>
                                                        </div>
                                                        <div class="select-item">
                                                            <span class="text-value-item">Most Popular</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-comment-wrap">
                                            <div class="reply-comment-item">
                                                <div class="user">
                                                    <div class="image">
                                                        <img src="images/collections/collection-circle-9.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <h6>
                                                            <a href="#" class="link">Superb quality apparel that exceeds expectations</a>
                                                        </h6>
                                                        <div class="day text_black-3">1 days ago</div>
                                                    </div>
                                                </div>
                                                <p class="text_black-3">Great theme - we were looking for a theme with lots of built in features and flexibility and this was perfect. We expected to need to employ a developer to add a few finishing touches. But we actually managed to do everything ourselves. We did have one small query and the support given was swift and helpful.</p>
                                            </div>
                                            <div class="reply-comment-item type-reply">
                                                <div class="user">
                                                    <div class="image">
                                                        <img src="images/collections/collection-circle-10.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <h6>
                                                            <a href="#" class="link">Reply from Modave</a>
                                                        </h6>
                                                        <div class="day text_black-3">1 days ago</div>
                                                    </div>
                                                </div>
                                                <p class="text_black-3">We love to hear it! Part of what we love most about Modave is how much it empowers store owners like yourself to build a beautiful website without having to hire a developer :) Thank you for this fantastic review!</p>
                                            </div>
                                            <div class="reply-comment-item">
                                                <div class="user">
                                                    <div class="image">
                                                        <img src="images/collections/collection-circle-9.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <h6>
                                                            <a href="#" class="link">Superb quality apparel that exceeds expectations</a>
                                                        </h6>
                                                        <div class="day text_black-3">1 days ago </div>
                                                    </div>
                                                </div>
                                                <p class="text_black-3">Great theme - we were looking for a theme with lots of built in features and flexibility and this was perfect. We expected to need to employ a developer to add a few finishing touches. But we actually managed to do everything ourselves. We did have one small query and the support given was swift and helpful.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="form-write-review write-review-wrap">
                                        <div class="heading">
                                            <h5>Write a review:</h5>
                                            <div class="list-rating-check">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" title="text"></label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4" title="text"></label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text"></label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2" title="text"></label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1" title="text"></label>
                                            </div>
                                        </div>
                                        <div class="form-content">
                                            <fieldset class="box-field">
                                                <label class="label">Review Title</label>
                                                <input type="text" placeholder="Give your review a title" name="text" tabindex="2" value="" aria-required="true" required="">
                                            </fieldset>
                                            <fieldset class="box-field">
                                                <label class="label">Review</label>
                                                <textarea rows="4" placeholder="Write your comment here" tabindex="2" aria-required="true" required=""></textarea>
                                            </fieldset>
                                            <div class="box-field group-2">
                                                <fieldset>
                                                    <input type="text" placeholder="You Name (Public)" name="text" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <fieldset>
                                                    <input type="email" placeholder="Your email (private)" name="email" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                            </div>
                                            <div class="box-check">
                                                <input type="checkbox" name="availability" class="tf-check" id="check1">
                                                <label class="text_black-3" for="check1">Save my name, email, and website in this browser for the next time I comment.</label>
                                            </div>
                                        </div>
                                        <div class="button-submit">
                                            <button class="tf-btn btn-fill animate-hover-btn" type="submit">Submit Reviews</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
    
    const variant = <?= json_encode($listSize) ?> ;
    const quantitySize = document.querySelector('.quantitySize');
    const quantity = document.querySelector('.quantity-product');
    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');
    
    let sizeSelect = null;
    
    const checkQuantity = (value) => {
        quantity.value = 1;
        btnIncrease.style.pointerEvents = 'auto';
        variant.forEach(element => {
           if(value == element.size){
            if(element.quantity_size === 1){
                btnIncrease.style.pointerEvents = 'none';
                 btnDecrease.style.pointerEvents = 'none';
            }else{
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
           if(element.size === sizeSelect){
            if(quantity.value >= element.quantity_size-1){
                btnIncrease.style.pointerEvents = 'none';
            }
           }
        });
    }
    const reloadIncrease = () => {
        btnIncrease.style.pointerEvents = 'auto';
    }
</script>