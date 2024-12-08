<?php require_once './views/layouts/header.php'; ?>
<?php
if (isset($_SESSION['success'])) { ?>
    <script>
        const alertSuccess = <?= json_encode($_SESSION['success']) ?>;
        alert(alertSuccess);
    </script>
<?php } ?>
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Order detail</div>
    </div>
</div>

<section class="flat-spacing-11">
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                <div class="my-account-content account-order">
                    <div class="wrap-account-order">
                        <table>
                            <thead>
                                <tr>
                                    <th class="fw-6">Order</th>
                                    <th class="fw-6">Name</th>
                                    <th class="fw-6">Color</th>
                                    <th class="fw-6">Size</th>
                                    <th class="fw-6">Unit cost</th>
                                    <th class="fw-6">Qty</th>
                                    <th class="fw-6">total</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listProductByOrderId as $key => $product): ?>
                                    <tr>
                                        <td class="center"><?= $key + 1 ?></td>
                                        <td class="left strong"><?= $product['product_name'] ?></td>
                                        <td class="left"><?= $product['color'] ?></td>
                                        <td class="left"><?= $product['size'] ?></td>
                                        <td class="right"><?= number_format($product['unit_cost']) ?></td>
                                        <td class="center"><?= number_format($product['product_quantity']) ?></td>
                                        <td class="right"><?= number_format($product['total_cost']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if ($orderById['order_status_id'] === 1) { ?>
                            <a href="<?= BASE_URL . '?act=cancel-order&order_id=' . $orderById['id'] ?>">
                                <button onclick="return confirm('Bạn có xác nhận huỷ đơn hàng')" class="btn btn-danger mt-3">Huỷ đơn</button>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 bg-light fs-6">
                <div class="badge bg-primary mt-2 col-12 p-3 <?= $orderById['order_status_id'] == 7 ? 'bg-danger' : '' ?>">
                    <p class="fs-5">Status: <?= $orderById['status'] ?></p>
                </div>
                <div class="mt-4 ">
                    <h6>Người đặt</h6>
                    <div> <strong><?= $orderUser['username'] ?></strong> </div>
                    <div><strong>
                            Email;
                        </strong><?= $orderUser['email'] ?></div>
                    <div><strong>Số điện thoại:</strong> <?= $orderUser['phone'] ?></div>
                    <div><strong>Phương thức thanh toán:</strong> <?= $orderById['payment_method_name'] ?></div>

                </div>
                <div class="mt-4">
                    <h6>Người nhận</h6>
                    <div> <strong><?= $orderById['customer_name'] ?></strong> </div>
                    <div><strong>Email:</strong> <?= $orderById['customer_email'] ?></div>
                    <div><strong>Số điện thoại:</strong> <?= $orderById['customer_phone'] ?></div>
                    <div><strong>Địa chỉ:</strong> <?= $orderById['shipping_address'] ?></div>

                </div>
                <div class="mt-4">
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
                                <td class="right"> - <?= number_format($disscount) ?> VND</td>
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
</section>

<?php require_once './views/layouts/footer.php'; ?>