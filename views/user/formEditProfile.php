<?php require_once './views/layouts/header.php'; ?>
<section class="flat-spacing-11">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <img style="width:350px; height:350px; border-radius:50%" src="<?= $_SESSION['user']['avatar'] ?>" alt="">
            </div>
            <div class="col-lg-9">
                <div class="my-account-content account-edit">
                    <?php if (isset($_SESSION['success'])) { ?>
                        <p class="alert alert-info col-12">
                            <?= $_SESSION['success']; ?>
                        </p>
                    <?php } ?>
                    <div class="">
                        <form class="" id="form-password-change" action="<?= BASE_URL . '?act=post-edit-profile' ?>" method="POST" enctype="multipart/form-data">
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="text" id="property1" name="username" value="<?= $_SESSION['user']['username'] ?>">
                                <label class="tf-field-label fw-4 text_black-2" for="property1">Tên người dùng</label>
                                <?php if (isset($_SESSION['error']['username'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['username'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="date" id="property1" name="date_of_birth" value="<?= $_SESSION['user']['date_of_birth'] ?>">
                                <label class="tf-field-label fw-4 text_black-2" for="property1">Ngày sinh</label>
                                <?php if (isset($_SESSION['error']['date_of_birth'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['date_of_birth'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="text" id="property1" name="phone" value="<?= $_SESSION['user']['phone'] ?>">
                                <label class="tf-field-label fw-4 text_black-2" for="property1">Số điện thoại</label>
                                <?php if (isset($_SESSION['error']['phone'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['phone'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="tf-field style-1 mb_15">

                                <select name="gender" class="selectpicker w-100 mh-auto form-control form-control-lg">
                                    <option <?= $_SESSION['user']['gender'] === 'Nam' ? 'selected' : '' ?> value="Nam">Nam</option>
                                    <option <?= $_SESSION['user']['gender'] === 'Nữ' ? 'selected' : '' ?> value="Nữ">Nữ</option>
                                    <option <?= $_SESSION['user']['gender'] === 'Khác' ? 'selected' : '' ?> value="Khác">Khác</option>
                                </select>

                            </div>
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input form-control" placeholder=" " type="file" id="property1" name="avatar">
                                <label class="tf-field-label fw-4 text_black-2" for="">Chọn ảnh đại diện</label>
                                <?php if (isset($_SESSION['error']['avatar'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['avatar'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="text" id="property1" disabled value="<?= $_SESSION['user']['email'] ?>">
                                <label class="tf-field-label fw-4 text_black-2" for="property1">Email</label>
                            </div>
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="text" id="property2" disabled value="<?= $_SESSION['user']['created_at'] ?>">
                                <label class="tf-field-label fw-4 text_black-2" for="property2">Ngày tạo tài khoản</label>
                            </div>

                            <h6 class="mb_20">Password Change</h6>
                            <div class="tf-field style-1 mb_30">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" id="property4" name="oldPassword">
                                <label class="tf-field-label fw-4 text_black-2" for="property4">Current password</label>
                                <?php if (isset($_SESSION['error']['oldPassword'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['oldPassword'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="tf-field style-1 mb_30">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" id="property5" name="newPassword">
                                <label class="tf-field-label fw-4 text_black-2" for="property5">New password</label>
                                <?php if (isset($_SESSION['error']['newPassword'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['newPassword'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="tf-field style-1 mb_30">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" id="property6" name="confirmPass">
                                <label class="tf-field-label fw-4 text_black-2" for="property6">Confirm password</label>
                                <?php if (isset($_SESSION['error']['confirmPass'])): ?>
                                    <p class="text-danger col-8"><?= $_SESSION['error']['confirmPass'] ?></p>
                                <?php endif ?>
                            </div>
                            <div class="mb_20">
                                <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once './views/layouts/footer.php'; ?>