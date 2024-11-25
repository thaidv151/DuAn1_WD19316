<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>
<h3>Danh sách Banner</h3>
<a href="<?= BASE_URL_ADMIN ?>?act=add-banner" class="btn btn-primary">Thêm mới</a>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Hình ảnh</th>
            <th>Liên kết sản phẩm</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($banners as $banner): ?>
            <tr>
                <td><?= htmlspecialchars($banner['number_order']) ?></td>
                <td><img src="../uploads/<?= htmlspecialchars($banner['image_link']) ?>" width="100"></td>
                <td><?= htmlspecialchars($banner['product_link']) ?></td>
                <td><?= $banner['status'] ? 'Hoạt động' : 'Không hoạt động' ?></td>
                <td>
                    <a href="<?= BASE_URL_ADMIN ?>?act=edit-banner&id=<?= $banner['id'] ?>" class="btn btn-warning">Sửa</a>
                    <a href="<?= BASE_URL_ADMIN ?>?act=delete-banner&id=<?= $banner['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require_once './views/layouts/footer.php'; ?>