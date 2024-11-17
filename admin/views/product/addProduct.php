<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: Sản phẩm</h3>
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
            <input class="form-control" type="text" placeholder="Giá khuyến mãi" name="promotion_price">
            <?php if (isset($_SESSION['error']['promotion_price'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['promotion_price'] ?> </p>
            <?php } ?>
        </div>
        <div class="form-group col-12">
            <label>Hình ảnh đại diện ( chỉ nhận file .png, .jpg, .webp, .gif )</label>
            <input class="form-control" type="file" placeholder="Hình ảnh đại diện" name="thumbnail[]">
            <?php if (isset($_SESSION['error']['thumbnail'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['thumbnail'] ?> </p>
            <?php } ?>
        </div>
        <div class="form-group col-6">
            <label>Album hình ảnh sản phẩm ( chỉ nhận file .png, .jpg, .webp, .gif )</label>
            <?php if (isset($_SESSION['error']['albums'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['albums'] ?> </p>
            <?php } ?>
            <input class="form-control" type="file" placeholder="Hình ảnh đại diện" name="albums[0][]" multiple>
        </div>
        <div class="form-group col-6">
            <label>Màu sắc</label>
            <input class="form-control" type="text" placeholder="Màu sắc" name="color[0]">
            <?php if (isset($_SESSION['error']['color'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['color'] ?> </p>
            <?php } ?>
        </div>

        <div class="form-group col-12">
            <label>Mô tả</label>
            <textarea class="form-control" type="text" placeholder="Mô tả" name="product_description"></textarea>
            <?php if (isset($_SESSION['error']['product_description'])) { ?>
                <p class="text-danger"> <?= $_SESSION['error']['product_description'] ?> </p>
            <?php } ?>
        </div>


        <div style="margin-top: 10px;" class="form-group col-12 row ms-1">
            <label>
                Danh mục <i style="font-weight: 600;">(chọn danh mục theo đúng sản phẩm)</i>
                <?php if (isset($_SESSION['error']['categories'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['categories'] ?> </p>
                <?php } ?>
            </label>
            <div class="row">
                <?php foreach ($listCategories as $key => $category): ?>
                    <div class="col-2">
                        <p>
                            <input type="checkbox" name="categories[]" id="" value="<?= $category['id'] ?>">
                            <?= $category['category_name'] ?>
                        </p>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
        <div class="form-group col-12 row">
            <label class="col-3">Kích thước và số lượng sản phẩm</label>
            <div class="col-6"><?php if (isset($_SESSION['error']['quantitys'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['quantitys'] ?> </p>
                <?php } ?>
            </div>
            <div class="col-12 row">
                <?php foreach ($listSize as $key => $size): ?>
                    <label class="col-3">Kích thước <?= $size['size'] ?> : <input min="0" value="0" class="form-control" type="number" name="quantitys[0][]" placeholder="Số lượng"></label>
                    <input type="hidden" name="size_id[0][]" value="<?= $size['id'] ?>">
                <?php endforeach; ?>
            </div>
        </div>
        <div id="insertForm">

        </div>


        <div style="margin-top: 10px;" class="form-group col-12 row">
            <p class=" ms-3 btn btn-success col-2" id="insertFormVariant">Thêm biến thể</p>
        </div>
        <div style="margin-top: 10px;" class="form-group col-12 row">
            <div class="col-10"></div>
            <button id="submit" class="btn btn-primary col-2" type="submit">Thêm</button>
        </div>

    </form>
</div>



<?php require_once './views/layouts/footer.php'; ?>
<script>
    const insertFormVariant = document.querySelector('#insertFormVariant');
    let count = 0;
    insertFormVariant.addEventListener('click', (e) => {

        const insertForm = document.querySelector('#insertForm')

        const div = document.createElement('div');

        count = count + 1;
        div.innerHTML = `
         <h4 class=" alert title">
        Biến thể sản phẩm thứ ${count}
         </h4>
        <div class="form-group col-12">
            <label>Hình ảnh đại diện</label>
            <input class="form-control" type="file"  name="thumbnail[]">
        </div>
        <div class="form-group col-6">
            <label>Album hình ảnh biến thể</label>
            <input class="form-control" type="file"  name="albums[${count}][]" multiple>
        </div>
        <div class="form-group col-6">
            <label>Màu sắc</label>
            <input class="form-control" type="text" placeholder="Màu sắc" name="color[${count}]">
        </div>
        <div class="form-group col-12 row">
            <label class="col-3">Kích thước và số lượng biến thể</label>
            <div class="col-12 row">
                <?php foreach ($listSize as $key => $size): ?>
                    <label class="col-3">Kích thước <?= $size['size'] ?> : <input min="0" value="0" class="form-control" type="number" name="quantitys[${count}][]" placeholder="Số lượng"></label>
                    <input type="hidden" name="size_id[${count}][]" value="<?= $size['id'] ?>">
                <?php endforeach; ?>
            </div>
        </div>
    
            `
        insertForm.append(div);




    })
</script>