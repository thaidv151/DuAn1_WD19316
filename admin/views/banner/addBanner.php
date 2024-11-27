<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>

<form action="<?= BASE_URL_ADMIN . '?act=post-add-banner' ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="number_order">Số thứ tự</label>
        <input type="number" name="number_order" id="number_order" class="form-control" value="<?= isset($number_order) ? $number_order : '' ?>" >
        <?php if (isset($_SESSION['error']['number_order'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['number_order'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="product_link">Liên kết sản phẩm</label>
        <input type="text" name="product_link" id="product_link" class="form-control" >
        <?php if (isset($_SESSION['error']['product_link'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['product_link'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="product_link">Tiêu đề</label>
        <input type="text" name="title" id="product_link" class="form-control" >
        <?php if (isset($_SESSION['error']['title'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['title'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="product_link">Nội dung</label>
        <input type="text" name="content" id="content" class="form-control" >
        <?php if (isset($_SESSION['error']['content'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['content'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" id="status" class="form-control">
            <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Hoạt động</option>
            <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Không hoạt động</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image_link">Hình ảnh</label>
        <?php if (isset($_SESSION['error']['image_link'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['image_link'] ?></div>
        <?php endif; ?>
        <input type="file" name="image_link" id="image_link" class="form-control" >
    </div>

    <button type="submit" class="btn btn-primary">Thêm Banner</button>
    <a href="<?= BASE_URL_ADMIN . '?act=list-banner' ?>" class="btn btn-secondary">Quay lại</a>
</form>


<?php require_once './views/layouts/footer.php'; ?>
