<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>
<h3 class="alert alert-secondary">Quản lý: Đơn hàng</h3>

<div class="row">
    <div class="col-lg-12">
        <div class="card mt-3">
            <div class="card-header">
                <strong class="col-3">Invoice: <?= $orderById['order_code'] ?> </strong>
                <strong class="col-3">Created Order: <?= $orderById['created_at'] ?></strong>
                <?php if ($orderById['order_status_id'] === 6 || $orderById['order_status_id'] === 7 || $orderById['order_status_id'] === 8 ) { ?>
                    <div class="bg-warning ps-5 pe-5 pt-2 pb-2 border border-radius ">
                        <?= $orderById['status']; ?>
                    </div>
                <?php } else {  ?>
                    <div class="float-right col-6 row">
                        <strong>Status:</strong>
                        <form class="col-12 row" action="<?= BASE_URL_ADMIN . '?act=change-status-order&order_id=' . $orderById['id'] ?>" method="POST">
                            <div class="col-9">
                                <select class="form-select" name="order_status_id" id="">
                                    <?php foreach ($allStatus as $key => $status): ?>
                                        <option
                                            <?php

                                            if (
                                                $orderById['order_status_id'] > $status['id']
                                                || $orderById['order_status_id'] === 6
                                                || $orderById['order_status_id'] === 7
                                                || $orderById['order_status_id'] === 8
                                            ) {
                                                echo 'disabled';
                                            }

                                            ?>
                                            value="<?= $status['id'] ?>" <?= $orderById['order_status_id'] === $status['id'] ? 'selected' : '' ?>><?= $status['status'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <button type="submit" onclick="return confirm('Bạn có xác nhận thay đổi trạng thái đơn hàng')" class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>

            </div>
            <div>
                <?php if (isset($_SESSION['success'])) { ?>
                    <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
                <?php } ?>

            </div>
            <div class="card-body ">

                <div class="row mb-5">
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <h6>Người đặt</h6>
                        <div> <strong><?= $orderUser['username'] ?></strong> </div>
                        <div>Email: <?= $orderUser['email'] ?></div>
                        <div>Số điện thoại: <?= $orderUser['phone'] ?></div>
                        <div>Phương thức thanh toán: <?= $orderById['payment_method_name'] ?></div>

                    </div>
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <h6>Người nhận</h6>
                        <div> <strong><?= $orderById['customer_name'] ?></strong> </div>
                        <div>Email: <?= $orderById['customer_email'] ?></div>
                        <div>Số điện thoại: <?= $orderById['customer_phone'] ?></div>
                        <div>Địa chỉ: <?= $orderById['shipping_address'] ?></div>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listProductByOrderId as $key => $product): ?>
                                <tr>
                                    <td class="center"><?= $key + 1 ?></td>
                                    <td class="left strong"><?= $product['product_name'] ?></td>
                                    <td class="left"><?= $product['product_description'] ?></td>
                                    <td class="left"><?= $product['color'] ?></td>
                                    <td class="left"><?= $product['size'] ?></td>
                                    <td class="right"><?= number_format($product['unit_cost']) ?></td>
                                    <td class="center"><?= number_format($product['product_quantity']) ?></td>
                                    <td class="right"><?= number_format($product['total_cost']) ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5"> </div>
                    <div class="col-lg-4 col-sm-5 ms-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Subtotal</strong></td>
                                    <td class="right"> <?= number_format($subTotal) ?> VND</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Shipping</strong></td>
                                    <td class="right"> <?= number_format($shipping) ?> VND</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Discount (<?php echo isset($voucher['disscount_value']) ? $voucher['disscount_value']  : '0' ?>%)</strong></td>
                                    <td class="right"> <?= number_format($disscount) ?> VND</td>
                                </tr>

                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right"><strong><?= number_format($total) ?> VND</strong>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './views/layouts/footer.php'; ?>