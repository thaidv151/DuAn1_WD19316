<?php require_once './views/layouts/header.php'; ?>
<?php require_once './views/layouts/sidebar.php'; ?>
<h3 class="alert alert-secondary">Quản lý: Danh sách danh mục</h3>


<div class="col-12">
    <div class="card">
        <div class="card-header  alert-primary">
            <h4 class="card-title">Danh sách danh mục</h4>
        </div>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-info"><?= $_SESSION['success'] ?></div>
        <?php endif ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display min-w850">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-3">Tên danh mục</th>
                            <th class="col-6">Mô tả</th>
                            <th class="col-2">Hành động</th>
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
                                        <a class="text-decoration-none" href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id=' . $danhmuc['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                        </a>
                                        <a class="text-decoration-none"  class="text-dark" href="<?= BASE_URL_ADMIN . '?act=form-edit-category&id=' . $danhmuc['id'] ?>">
                                            <button class="btn btn-warning btn-sm" title="Xoá"><i class="bi bi-gear-wide-connected"></i></button>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Không có danh mục nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once './views/layouts/footer.php'; ?>