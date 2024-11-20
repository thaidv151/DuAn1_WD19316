<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>
<h3 class="alert alert-secondary">Quản lý: Danh sách danh mục</h3>


<div class="col-12">
    <div class="card">
        <div class="card-header  alert-primary">
            <h4 class="card-title">Danh sách sản phẩm</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display min-w850">
                    <thead>
                        <tr class="text-center">
                            <th class="col-1">Mã đơn hàng</th>
                            <th class="col-1">Số điện thoại</th>
                            <th class="col-1">Ngày đặt</th>
                            <th class="col-2">Trạng thái</th>
                            <th class="col-4">Thanh toán</th>
                            <th class="col-1">Thời gian cập nhật</th>
                            <th class="col-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($listNewOrder)): ?>
                            <?php foreach ($listNewOrder as $key => $newOrder): ?>
                                <tr class="text-center">
                                    <td><?= $newOrder['order_code'] ?></td>
                                    <td><?= $newOrder['customer_phone'] ?></td>
                                    <td><?= $newOrder['created_at'] ?></td>
                                    <td>
                                        <p class="badge bg-primary"><?= $newOrder['status'] ?></p>
                                    </td>
                                    <td><?= $newOrder['payment_method_name'] ?></td>
                                    <td><?= $newOrder['update_at'] ?></td>
                                    <td>
                                        <a href="<?= BASE_URL_ADMIN . '?act=detail-order&order_id=' . $newOrder['id'] ?>">
                                            <button class="btn">
                                            <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </a>
                                    </td>
                                 
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Hiện không có đơn hàng nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <th class="col-1">Mã đơn hàng</th>
                            <th class="col-3">Số điện thoại</th>
                            <th class="col-6">Ngày đặt</th>
                            <th class="col-2">Trạng thái</th>
                            <th class="col-2">Thanh toán</th>
                            <th class="col-2">Thời gian cập nhật</th>
                            <th class="col-2">Hành động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once './views/layouts/footer.php'; ?>