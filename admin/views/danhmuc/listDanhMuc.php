<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>
<h3 class="alert alert-secondary">Quản lý: Danh sách danh mục</h3>

<div class="col-12 card">
    <div class="m-4">
        <h4 class="alert title">Danh sách danh mục</h4>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listDanhMuc)): ?>
                    <?php foreach ($listDanhMuc as $danhmuc): ?>
                        <tr>
                            <td><?= htmlspecialchars($danhmuc['id']) ?></td>
                            <td><?= htmlspecialchars($danhmuc['category_name']) ?></td>
                            <td><?= htmlspecialchars($danhmuc['description']) ?></td>
                            <td>
                                <a href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id=' . $danhmuc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có danh mục nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once './views/layouts/footer.php'; ?>