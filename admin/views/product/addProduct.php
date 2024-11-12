<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: Thêm sản phẩm</h3>
<div class="col-12 card">

    <h4 class=" alert title">
        Thêm sản phẩm
    </h4>


    <form action="<?= BASE_URL_ADMIN . '?act=post-add-product' ?>" method="POST" class="form-group row " enctype="multipart/form-data">

        <div class="form-group col-12">
            <label>Tên sản phẩm</label>
            <input class="form-control" type="text" placeholder="Tên sản phẩm" name="product_name">
            <?php if (isset($_SESSION['error']['product_name'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['product_name'] ?> </p>
            <?php } ?>
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
            <input class="form-control" type="number" placeholder="Giá khuyến mãi" name="promotion_price">
            <?php if (isset($_SESSION['error']['promotion_price'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['promotion_price'] ?> </p>
            <?php } ?>
        </div>
        <div class="form-group col-12">
            <label>Hình ảnh đại diện</label>
            <input class="form-control" type="file" placeholder="Hình ảnh đại diện" name="thumbnail">
            <?php if (isset($_SESSION['error']['thumbnail'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['thumbnail'] ?> </p>
            <?php } ?>
        </div>
        <div class="form-group col-12">
            <label>Album hình ảnh sản phẩm</label>
            <input class="form-control" type="file" placeholder="Hình ảnh đại diện" name="albums[]" multiple>
            <?php if (isset($_SESSION['error']['thumbnail'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['thumbnail'] ?> </p>
            <?php } ?>
        </div>

        <div class="form-group col-12">
            <label>Mô tả</label>
            <textarea class="form-control" type="text" placeholder="Mô tả" name="description"></textarea>
            <?php if (isset($_SESSION['error']['description'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['description'] ?> </p>
            <?php } ?>
        </div>


        <div style="margin-top: 10px;" class="form-group col-12 row ms-1">
            <label>
                Danh mục <i style="font-weight: 600;">(chọn danh mục theo đúng sản phẩm)</i>
            </label>
           <div class="form-control">
           <?php foreach ($listCategories as $key => $category): ?>
                <div class="row col-auto ">
                <p>
                    <input type="checkbox" name="categories[]" id="" value="<?= $category['id'] ?>">
                    <?= $category['category_name'] ?>
                    </p>
                </div>
            <?php endforeach ?>
           </div>

        </div>
        <div style="margin-top: 10px;" class="form-group col-12 row">
            <div class="col-11"></div>
            <button class="btn btn-primary col-1" type="submit">Thêm</button>
        </div>

    </form>
</div>



<?php require_once './views/layouts/footer.php'; ?>
<script>
    const checkBox = document.querySelector('input');

    checkBox.addEventListener('onclick', () => {
        console.log(checkBox.value);
    })
</script>