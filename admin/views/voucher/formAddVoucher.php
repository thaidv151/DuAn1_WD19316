<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: mã giảm giá</h3>
<div class="col-12 card">
    <div class="div m-4">

        <h4 class=" alert title alert-primary">
           Thêm mã giảm giá
        </h4>
        <form action="<?= BASE_URL_ADMIN . '?act=post-add-voucher' ?>" method="POST" class="form-group row " enctype="multipart/form-data">



            <div class="form-group col-12">
                <label>Tiêu đề</label>
                <?php if (isset($_SESSION['error']['title_voucher'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['title_voucher'] ?> </p>
                <?php } ?>
                <input class="form-control" type="text" name="title_voucher" placeholder="Tiêu đề của voucher">
            </div>
            <div class="form-group col-12">
                <label>Mô tả</label>
                <?php if (isset($_SESSION['error']['description'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['description'] ?> </p>
                <?php } ?>
                <textarea class="form-control" type="text" name="description" ></textarea>
            </div>
            <div class="form-group col-12">
                <label>Ngày và giờ hết hạn</label>
                <?php if (isset($_SESSION['error']['end_date'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['end_date'] ?> </p>
                <?php } ?>
                <input class="form-control" type="datetime-local" name="end_date">
            </div>
            <div class="form-group col-12">
                <label>Giảm theo phần trăm ( đơn vị 0% -> 100% )</label>
                <?php if (isset($_SESSION['error']['disscount_value'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['disscount_value'] ?> </p>
                <?php } ?>
                <input class="form-control" type="number" placeholder="Phần trăm giảm giá" name="disscount_value">
            </div>
            <div class="form-group col-12">
                <label>Giới hạn giá trị giảm ( vd: 15000)</label>
                <?php if (isset($_SESSION['error']['max_disscount_amount'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['max_disscount_amount'] ?> </p>
                <?php } ?>
                <input class="form-control" type="text" placeholder="Giới hạn giá trị có thể giảm" name="max_disscount_amount">
            </div>
            <div class="form-group col-12">
                <label>Điều kiện sử dụng ( vd: đơn hàng lớn hơn 400,000 )</label>
                <?php if (isset($_SESSION['error']['min_order_amount'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['min_order_amount'] ?> </p>
                <?php } ?>
                <input class="form-control" type="text" placeholder="Điều kiện để sử dụng" name="min_order_amount">
            </div>
            <div class="form-group col-12">
                <label>Giới hạn số lượng</label>
                <?php if (isset($_SESSION['error']['quantity_limit'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['quantity_limit'] ?> </p>
                <?php } ?>
                <input class="form-control" type="number" placeholder="Số lượng giới hạn" name="quantity_limit">
            </div>

           

    </div>
   

    <div style="margin-top: 10px;" class="form-group col-12 row">
        <div class="col-10"></div>
        <button id="submit" class="btn btn-success col-2" type="submit">Thêm voucher</button>
    </div>

    </form>
</div>
</div>



<?php require_once './views/layouts/footer.php'; ?>
