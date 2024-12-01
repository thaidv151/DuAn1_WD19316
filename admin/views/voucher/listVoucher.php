<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: mã giảm giá</h3>
<div class="col-12 card">





    <?php if (isset($_SESSION['success'])) { ?>
        <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
    <?php } ?>

</div>

<div class="m-3 card">
    <div class="col-12">
        <div class="card">
            <div class="card-header  alert-primary">
                <h4 class="card-title">Danh sách mã giảm giá</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display min-w850 ">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Lượt sử dụng</th>
                                <th>Ngày hết hạn</th>
                                <th>Giá trị giảm (%)</th>
                                <th>Giới hạn giảm</th>
                                <th>Điều kiền</th>
                                <th>Số lượng giới hạn</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($listVoucher  as $key => $voucher): ?>
                                <tr class="text-center">
                                    <td>
                                        <?= $key + 1 ?>
                                    </td>

                                    <td>
                                        <?= $voucher['title_voucher'] ?>
                                    </td>
                                    <td>
                                        <?= $voucher['description'] ?>
                                    </td>
                                    <td>
                                        <?= number_format($voucher['used_count']) ?>
                                    </td>
                                    <td>
                                        <?= $voucher['end_date'] ?>
                                    </td>
                                    <td>
                                        <?= $voucher['disscount_value'] . '%' ?>
                                    </td>
                                    <td>
                                        <?= number_format($voucher['max_disscount_amount']) ?>
                                    </td>
                                    <td>
                                        <?= number_format($voucher['min_order_amount']) ?>
                                    </td>
                                    <td>
                                        <?= number_format($voucher['quantity_limit']) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $countVoucher = $voucher['quantity_limit'] - $voucher['used_count'];
                                        if($countVoucher == 0){ ?>
                                        <p class="pe-3 ps-3 badge bg-danger">
                                            Hết lượt
                                        </p>
                                        <?php } else{ ?> 
                                            <p class="pe-3 ps-3 badge <?= $voucher['status'] === 1 ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $voucher['status'] === 1 ? 'Hiện' : 'Ẩn' ?>
                                        </p>
                                        <?php } ?>
                                    </td>
                                    <td>

                                        <a style="text-decoration: none;" onclick="return confirm('Bạn có xác nhận xoá sản phẩm')" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=change-status-voucher&voucher_id=' . $voucher['id'] ?>">
                                            <button class="btn border btn-sm" title="Ẩn/hiển">
                                                <?php echo $voucher['status'] === 1 ? '<i class="bi bi-eye-slash-fill"></i>' : '<i class="bi bi-eye-fill"></i>' ?>
                                            </button> </a>
                                        <a style="text-decoration: none;" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=form-edit-voucher&voucher_id=' . $voucher['id'] ?>">
                                            <button class="btn btn-warning btn-sm" title="Sửa">
                                                <i class="bi bi-gear-wide-connected"></i>
                                            </button>
                                        </a>
                                        <a style="text-decoration: none;" onclick="return confirm('Bạn có xác nhận xoá sản phẩm')" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=delete-voucher&voucher_id=' . $voucher['id'] ?>">
                                            <button class="btn btn-danger btn-sm" title="Xoá"><i class="bi bi-trash3"></i></button>
                                        </a>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="col-1">STT</th>

                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Lượt sử dụng</th>
                                <th>Ngày hết hạn</th>
                                <th>Giá trị giảm (%)</th>
                                <th>Giới hạn giảm</th>
                                <th>Điều kiền</th>
                                <th>Số lượng còn</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

</div>


</div>



<?php require_once './views/layouts/footer.php'; ?>