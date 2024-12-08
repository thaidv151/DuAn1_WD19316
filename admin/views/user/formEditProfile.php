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

<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="clearfix">
            <div class="card card-bx author-profile m-b30">
                <div class="card-body">
                    <div class="p-5">
                        <div class="author-profile">
                            <div class="author-media">
                                <img width="130px" height="130px" src="<?= '.' . $_SESSION['user']['avatar'] ?>" alt=""
                                    onerror="this.onerror=null; this.src= '../uploads/user.png'" ;>

                            </div>
                            <div class="author-info">
                                <h6 class="title"><?= $_SESSION['user']['username'] ?></h6>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="card  card-bx m-b30">
            <div class="card-header ">
                <h6 class="title col-12">Account setup

                    <?php if (isset($_SESSION['success'])) { ?>
                        <p class="alert alert-info col-12">
                            <?= $_SESSION['success']; ?>
                        </p>
                    <?php } ?>
                </h6>



            </div>
            <form class="profile-form" action="<?= BASE_URL_ADMIN . '?act=post-edit-profile' ?>" enctype="multipart/form-data" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 m-b30">
                            <label class="form-label">Tên người dùng
                                <?php if (isset($_SESSION['error']['username'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['username'] ?></p>
                                <?php endif ?>
                            </label>
                            <input name="username" type="text" class="form-control" value="<?= $_SESSION['user']['username'] ?>">
                        </div>
                        <div class="col-sm-6 m-b30">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" value="<?= $_SESSION['user']['email'] ?> " disabled>
                        </div>
                        <div class="col-sm-6 m-b30">
                            <label class="form-label">Ngày sinh
                                <?php if (isset($_SESSION['error']['date_of_birth'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['date_of_birth'] ?></p>
                                <?php endif ?>
                            </label>
                            <input name="date_of_birth" type="date" class="form-control" value="<?= $_SESSION['user']['date_of_birth'] ?>">
                        </div>
                        <div class="col-sm-6 m-b30">
                            <label class="form-label">Số điện thoại
                                <?php if (isset($_SESSION['error']['phone'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['phone'] ?></p>
                                <?php endif ?>
                            </label>
                            <input name="phone" type="text" class="form-control" value="<?= $_SESSION['user']['phone'] ?>">
                        </div>
                        <div class="col-sm-6 m-b30">
                            <label class="form-label">Quyền hạn</label>
                            <input type="text" disabled class="form-control" value="<?= $_SESSION['user']['role_id'] === 0 ? "Super Admin" : "Admin" ?> ">
                        </div>

                        <div class="col-sm-6 m-b30">
                            <label class="form-label">Giới tính</label>
                            <select name="gender" class="selectpicker w-100 mh-auto form-control form-control-lg">
                                <option <?= $_SESSION['user']['gender'] === 'Nam' ? 'selected' : '' ?> value="Nam">Nam</option>
                                <option <?= $_SESSION['user']['gender'] === 'Nữ' ? 'selected' : '' ?> value="Nữ">Nữ</option>
                                <option <?= $_SESSION['user']['gender'] === 'Khác' ? 'selected' : '' ?> value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="col-sm-6 m-b30">
                            <div class="example">
                                <label class="form-label">Ngày tạo tài khoản</label>
                                <input class="form-control " type="text" disabled placeholder="2017-06-04" value="<?= $_SESSION['user']['created_at'] ?>" id="mdate">
                            </div>
                        </div>

                        <div class="upload-link col-sm-6" title="" data-bs-toggle="tooltip" data-placement="right" data-original-title="update">
                            <label class="form-label">Ảnh đại diện
                                <?php if (isset($_SESSION['error']['avatar'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['avatar'] ?></p>
                                <?php endif ?>
                            </label>
                            <input name="avatar" type="file" class="update-flie form-control">
                        </div>
                        <div class="col-sm-12 m-b30 insertForm">
                            <div class="example col-12">
                                <label class="form-label">Mật khẩu cũ
                                    <?php if (isset($_SESSION['error']['oldPassword'])): ?>
                                        <p class="text-danger col-8"><?= $_SESSION['error']['username'] ?></p>
                                    <?php endif ?>
                                </label>
                                <input class="form-control " type="password" name="oldPassword" placeholder="Mật khẩu cũ">
                            </div>
                            <div class="example col-12 row mt-3">
                                <div class="col-6">
                                    <label class="form-label">Mật khẩu mới
                                        <?php if (isset($_SESSION['error']['newPassword'])): ?>
                                            <p class="text-danger col-8"><?= $_SESSION['error']['newPassword'] ?></p>
                                        <?php endif ?>

                                    </label>
                                    <input class="form-control " type="password" name="newPassword" placeholder="Mật khẩu mới">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Xác nhận mật khẩu
                                        <?php if (isset($_SESSION['error']['confirmPass'])): ?>
                                            <p class="text-danger col-8"><?= $_SESSION['error']['confirmPass'] ?></p>
                                        <?php endif ?>
                                    </label>
                                    <input class="form-control " type="password" name="confirmPass" placeholder="Xác nhận mật khẩu mới">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">UPDATE</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>





<?php require_once './views/layouts/footer.php'; ?>
