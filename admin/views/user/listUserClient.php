<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<!--*******************
        Preloader end
    ********************-->


<!--**********************************
        Main wrapper start
    ***********************************-->

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Basic Datatable</h4>
        </div>
        <div>
            <?php if (isset($_SESSION['success'])) { ?>
                <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
            <?php } ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display min-w850">
                    <thead>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Quyền hạng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listUserAdmin as $key => $user): ?>
                            <tr>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['phone'] ?></td>
                                <td><?= $user['role_id'] === 2 ? 'Client' : 'Admin' ?></td>
                                <td>
                                    <p class="badge <?= $user['status'] === 1 ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $user['status'] === 1 ? 'Hoạt động' : 'Bị cấm' ?>
                                    </p>
                                </td>
                                <td>
                              
                                        <a style="text-decoration: none;" onclick="return confirm('Bạn có muốn thay đổi trạng thái của người này ?')" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=change-status-user&from=list-user-client&user_id=' . $user['id'] ?>">
                                            <button class="btn border" title="Ẩn/hiển">
                                                <?php echo $user['status'] === 1 ? '<i class="bi bi-eye-slash-fill"></i>' : '<i class="bi bi-eye-fill"></i>' ?>
                                            </button>
                                        </a>

                                        <a href="<?= BASE_URL_ADMIN . '?act=change-role&user_id=' . $user['id'] ?>">
                                            <button onclick="return confirm('Bạn có chắc thay đổi chức vụ của người này chứ')" class="btn btn-warning">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </a>
                                  
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Quyền hạng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>





<?php require_once './views/layouts/footer.php'; ?>
<!-- <script>
    const insertFormResetPass = () => {
        const buttonResetPass = document.querySelector('#buttonResetPass');
        buttonResetPass.style.display = 'none';
        const insertForm = document.querySelector('.insertForm');
        const div = document.createElement('div');
        div.innerHTML = `
           
        `;
        insertForm.append(div);
    }
</script> -->