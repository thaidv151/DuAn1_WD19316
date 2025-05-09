<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>

<h3 class="alert alert-secondary">Quản lý: Sửa danh mục</h3>
<div class="col-12 card">
    <div class="m-4">
        <h4 class="alert title">Sửa danh mục : <?= $danhMucById['category_name'] ?></h4>

        <form action="<?= BASE_URL_ADMIN . '?act=post-sua-danh-muc' ?>" method="POST" class="form-group row">

            <div class="form-group col-12">
                <label>Tên danh mục</label>
                <input type="hidden" name="category_id" value="<?= $danhMucById['id'] ?>">
                <input class="form-control" type="text" placeholder="Tên danh mục" name="category_name" value="<?= $danhMucById['category_name'] ?>">
                <?php if (isset($_SESSION['error']['category_name'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['category_name'] ?> </p>
                <?php } ?>
            </div>

            <div class="form-group col-12">
                <label>Mô tả</label>
                <textarea class="form-control" placeholder="Mô tả danh mục" name="description"><?= $danhMucById['description'] ?></textarea>
                <?php if (isset($_SESSION['error']['description'])) { ?>
                    <p class="text-danger"> <?= $_SESSION['error']['description'] ?> </p>
                <?php } ?>
            </div>

            <div class="form-group col-12 row mt-3">
                <div class="col-11"></div>
                <button class="btn btn-primary col-1" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>

</div>


<?php require_once './views/layouts/footer.php'; ?>