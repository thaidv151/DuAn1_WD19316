<?php require_once './views/layouts/header.php'; ?>
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">My Orders</div>
    </div>
</div>
<!-- /page-title -->
<?php if (isset($_SESSION['success'])) { ?>
    <script>
        const alertSuccess = <?= json_encode($_SESSION['success']) ?>;
        alert(alertSuccess);
    </script>
<?php } ?>
<!-- page-cart -->
<section class="flat-spacing-11">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="wd-form-order">


                    <div class="widget-tabs style-has-border widget-order-tab">
                        <ul class="widget-menu-tab">
                            <li class="item-title active">
                                <span class="inner">Đơn hàng mới</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Đơn hàng đang giao</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Đơn hàng hoàn thành</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Đơn hàng huỷ</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Sản phẩm chưa đánh giá</span>
                            </li>
                        </ul>
                        <div class="widget-content-tab">
                            <div class="widget-content-inner active">
                                <div class="widget-timeline">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="my-account-content account-order">
                                                <div class="wrap-account-order">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fw-6">Mã đơn hàng</th>
                                                                <th class="fw-6">Ngày đặt</th>
                                                                <th class="fw-6">Trạng thái thái</th>
                                                                <th class="fw-6">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($listNewOrder as $key => $item): ?>

                                                                <tr class="tf-order-item">
                                                                    <td>
                                                                        <?= $item['order_code'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['created_at'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <p class="badge <?= $item['order_status_id'] === 1 ? 'bg-primary' : 'bg-success' ?>">
                                                                            <?= $item['status'] ?>
                                                                        </p>
                                                                    </td>

                                                                    <td>
                                                                        <a href="<?= BASE_URL . '?act=view-order-detail&order_id=' . $item['id'] ?>" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                                            <span>View</span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="widget-timeline">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="my-account-content account-order">
                                                <div class="wrap-account-order">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fw-6">Mã đơn hàng</th>
                                                                <th class="fw-6">Ngày đặt</th>
                                                                <th class="fw-6">Trạng thái thái</th>
                                                                <th class="fw-6">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($listOrderShipping as $key => $item): ?>

                                                                <tr class="tf-order-item">
                                                                    <td>
                                                                        <?= $item['order_code'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['created_at'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <p class="badge bg-success">
                                                                            <?= $item['status'] ?>
                                                                        </p>
                                                                    </td>

                                                                    <td>
                                                                        <a href="<?= BASE_URL . '?act=view-order-detail&order_id=' . $item['id'] ?>" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                                            <span>View</span>
                                                                            
                                                                        </a>
                                                                        <a href="<?= BASE_URL . '?act=complete-order&order_id='. $item['id'] ?>" class="tf-btn btn-fill animate-hover-btn bg-warning rounded-0 justify-content-center">
                                                                        <span>Hoàn thành</span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="widget-timeline">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="my-account-content account-order">
                                                <div class="wrap-account-order">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fw-6">Mã đơn hàng</th>
                                                                <th class="fw-6">Ngày đặt</th>
                                                                <th class="fw-6">Trạng thái thái</th>
                                                                <th class="fw-6">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($listOrderCompelete as $key => $item): ?>

                                                                <tr class="tf-order-item">
                                                                    <td>
                                                                        <?= $item['order_code'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['created_at'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <p class="badge bg-success">
                                                                            <?= $item['status'] ?>
                                                                        </p>
                                                                    </td>

                                                                    <td>
                                                                        <a href="<?= BASE_URL . '?act=view-order-detail&order_id=' . $item['id'] ?>" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                                            <span>View</span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="widget-timeline">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="my-account-content account-order">
                                                <div class="wrap-account-order">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fw-6">Mã đơn hàng</th>
                                                                <th class="fw-6">Ngày đặt</th>
                                                                <th class="fw-6">Trạng thái thái</th>
                                                                <th class="fw-6">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($listOrderCancel as $key => $item): ?>

                                                                <tr class="tf-order-item">
                                                                    <td>
                                                                        <?= $item['order_code'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['created_at'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <p class="badge <?= $item['order_status_id'] === 7 ? 'bg-danger' : 'bg-warning' ?>">
                                                                            <?= $item['status'] ?>
                                                                        </p>
                                                                    </td>

                                                                    <td>
                                                                        <a href="<?= BASE_URL . '?act=view-order-detail&order_id=' . $item['id'] ?>" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                                            <span>View</span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="widget-timeline">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="my-account-content account-order">
                                                <div class="wrap-account-order">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fw-6">Mã đơn hàng</th>
                                                                <th class="fw-6">Ngày đặt</th>
                                                                <th class="fw-6">Tên sản phẩm</th>
                                                                <th class="fw-6">Màu sắc / size</th>
                                                                <th class="fw-6">Hình ảnh</th>
                                                                <th class="fw-6">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($listOrderNoReview as $key => $item): ?>
                                                         
                                                                <tr class="tf-order-item">
                                                                    <td>
                                                                        <?= $item['order_code'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['created_at'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['product_name'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $item['color'] ?> / <?= $item['size'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <img width="50px" height="50px" src="<?= $item['thumbnail_variant'] ?>" alt="" onerror="this.onerror=null;this.src='./uploads/logo1.png'">
                                                                    </td>


                                                                    <td>
                                                                        <button onclick="inpReview(<?= $item['product_id']?>, <?= $item['variant_id'] ?>, <?= $item['order_detail_id'] ?>) " type="button" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                            Review
                                                                        </button>
                                                                    </td>
                                                                </tr>

                                                            <?php endforeach ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <form action="<?= BASE_URL . '?act=post-add-review' ?>" class="form-write-review write-review-wrap" method="POST">
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
                            <label class="label">Review</label>
                            <textarea name="content" rows="4" placeholder="Write your comment here" tabindex="2" aria-required="true" required=""></textarea>
                        </fieldset>
                    </div>

                    <input type="hidden" name="product_id" id='product_id'>
                    <input type="hidden" name="variant_id" id='variant_id'>
                    <input type="hidden" name="order_detail_id" id='order_detail_id'>

                    <div class="button-submit">
                        <button class="tf-btn btn-fill animate-hover-btn" type="submit">Submit Reviews</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
<?php require_once './views/layouts/footer.php'; ?>
<script>
    const inpReview = (inpProductId, inpVariantId, inpOrderDetailId) => {
  
     
        const product_id = document.querySelector('#product_id');
        const variant_id = document.querySelector('#variant_id');
        const order_detail_id = document.querySelector('#order_detail_id');
        product_id.value = inpProductId;
        variant_id.value = inpVariantId;
        order_detail_id.value = inpOrderDetailId;
    }
</script>