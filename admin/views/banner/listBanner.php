<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>
<h3>Danh sách Banner</h3>
<?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-info"><?= $_SESSION['success'] ?></div>
        <?php endif ?>
<a href="<?= BASE_URL_ADMIN ?>?act=add-banner" class="btn btn-primary">Thêm mới</a>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Hình ảnh</th>
            <th class="col-3">Liên kết sản phẩm</th>
            <th>Trạng thái</th>
            <th class="col-2">Tiêu đề</th>
            <th class="col-2">Nội dung</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($banners as $banner): ?>
            <tr>
                <td><?= htmlspecialchars($banner['number_order']) ?></td>
                <td>
                <a href="<?= $banner['product_link'] ?>">
                <img src="<?='.' . htmlspecialchars($banner['image_link']) ?>" width="100">
                </a>    
               </td>
                <td><?= htmlspecialchars($banner['product_link']) ?></td>
                <td><?= $banner['title'] !== null ? htmlspecialchars($banner['title']) : '' ?></td>
                <td><?= $banner['content'] !== null ? htmlspecialchars($banner['content']) : '' ?></td>
                <td><?= $banner['status'] ? 'Hoạt động' : 'Không hoạt động' ?></td>
                <td>
                    <a class="text-decoration-none" href="<?= BASE_URL_ADMIN ?>?act=edit-banner&id=<?= $banner['id'] ?>">
                        <button class="btn btn-warning btn-sm" title="Sửa"><i class="bi bi-gear-wide-connected"></i></button>
                    </a>
                    <a class="text-decoration-none" href="<?= BASE_URL_ADMIN ?>?act=delete-banner&id=<?= $banner['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>

                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require_once './views/layouts/footer.php'; ?>