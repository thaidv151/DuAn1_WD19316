<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>

<h3 class="alert alert-secondary">Quản lý: Sửa Banner</h3>

<form action="<?= BASE_URL_ADMIN . '?act=post-sua-banner' ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($banner['id']) ?>">

    <div class="form-group">
        <label for="number_order">Số thứ tự</label>
        <input type="number" name="number_order" id="number_order" class="form-control"
               value="<?= htmlspecialchars($banner['number_order']) ?>" >
        <?php if (isset($_SESSION['error']['number_order'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['number_order'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="current_image">Hình ảnh hiện tại</label>
        <div>
            <img src="<?= '.' . htmlspecialchars($banner['image_link']) ?>" alt="Banner" width="200">
            <input type="text" value="<?= $banner['image_link'] ?>" name="old_image" hidden>
        </div>
    </div>

    <div class="form-group">
        <label for="image_link">Hình ảnh mới (nếu cần thay đổi)</label>
        <?php if (isset($_SESSION['error']['image_link'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['image_link'] ?></div>
        <?php endif; ?>
        <input type="file" name="image_link" id="image_link" class="form-control">
    </div>

    <div class="form-group">
        <label for="product_link">Liên kết sản phẩm</label>
        <input type="text" name="product_link" id="product_link" class="form-control"
               value="<?= htmlspecialchars($banner['product_link']) ?>" >
        <?php if (isset($_SESSION['error']['product_link'])): ?>
            <div class="text-danger"><?= $_SESSION['error']['product_link'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" id="status" class="form-control">
            <option value="1" <?= $banner['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
            <option value="0" <?= $banner['status'] == 0 ? 'selected' : '' ?>>Không hoạt động</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?= BASE_URL_ADMIN . '?act=list-banner' ?>" class="btn btn-secondary">Hủy</a>
</form>

<?php require_once './views/layouts/footer.php'; ?>
