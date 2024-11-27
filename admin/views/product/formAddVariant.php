<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: sản phẩm</h3>
<div class="col-12 card">
    <div class="div m-4">

        <h4 class=" alert title alert-primary">
            Thêm biến thể cho : <?= $product['product_name'] ?>
        </h4>
        <?php if (isset($_SESSION['success'])) { ?>
            <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
        <?php } ?>

        <form action="<?= BASE_URL_ADMIN . '?act=post-add-variant&product_id=' . $product_id ?>" method="POST" class="form-group row " enctype="multipart/form-data">



            <div class="form-group col-12">
                <label>Hình ảnh đại diện</label>
                <?php if (isset($_SESSION['error']['thumbnail'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['thumbnail'] ?> </p>
                <?php } ?>

                <input class="form-control" type="file" name="thumbnail">
            </div>
            <div class="form-group col-12">
                <label>Album hình ảnh biến thể</label>
                <?php if (isset($_SESSION['error']['albums'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['albums'] ?> </p>
                <?php } ?>
                <input class="form-control" type="file" name="albums[]" multiple>
            </div>
            <div class="form-group col-6">
                <label>Giá sản phẩm</label>
                <input class="form-control" type="text" placeholder="Giá sản phẩm" name="price">
                <?php if (isset($_SESSION['error']['price'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['price'] ?> </p>
                <?php } ?>
            </div>
            <div class="form-group col-6">
                <label>Giá khuyến mãi
                    <i style="font-weight: 600;">(Giá khuyến mãi sẽ là giá bán ra)</i>

                </label>
                <input class="form-control" type="text" placeholder="Giá khuyến mãi" name="promotion_price">
                <?php if (isset($_SESSION['error']['promotion_price'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['promotion_price'] ?> </p>
                <?php } ?>
            </div>
            <div class="form-group col-12">
                <label>Màu sắc</label>
                <?php if (isset($_SESSION['error']['color'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['color'] ?> </p>
                <?php } ?>

                <input class="form-control" type="text" placeholder="Màu sắc" name="color">
            </div>

            <div class="form-group col-12 row">
                <label class="col-3">Kích thước và số lượng biến thể</label>
                <?php if (isset($_SESSION['error']['size'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['size'] ?> </p>
                <?php } ?>
                <div class="col-12 row">
                    <?php foreach ($listSize as $key => $size): ?>
                        <label class="col-3">Kích thước <?= $size['size'] ?> : <input min="0" value="0" class="form-control" type="number" name="quantitys[]" placeholder="Số lượng"></label>
                        <input type="hidden" name="size_id[]" value="<?= $size['id'] ?>">
                    <?php endforeach; ?>
                </div>
            </div>

    </div>


    <div style="margin-top: 10px;" class="form-group col-12 row">
        <div class="col-10"></div>
        <button id="submit" class="btn btn-primary col-2" type="submit">Thêm biến thể</button>
    </div>

    </form>
</div>
</div>



<?php require_once './views/layouts/footer.php'; ?>