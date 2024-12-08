<?php require_once './views/layouts/header.php'; ?>
<section class="flat-spacing-11">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <img style="width:350px; height:350px; border-radius:50%" src="<?= $user['avatar'] ?>" alt="" onerror="this.onerror=null;this.src='./uploads/logo1.png'">
            </div>
            <div class="col-lg-9">
                <div class="my-account-content account-edit">
                    <?php if (isset($_SESSION['success'])) { ?>
                        <p class="alert alert-info col-12">
                            <?= $_SESSION['success']; ?>
                        </p>
                    <?php } ?>
                    <div class="">

                        <div class="tf-field style-1 mb_15">
                            <input disabled class="tf-field-input tf-input" placeholder=" " type="text" id="property1" name="username" value="<?= $user['username'] ?>">
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Tên người dùng</label>
                            <?php if (isset($_SESSION['error']['username'])): ?>
                                <p class="text-danger col-8"><?= $_SESSION['error']['username'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="tf-field style-1 mb_15">
                            <input disabled class="tf-field-input tf-input" placeholder=" " type="date" id="property1" name="date_of_birth" value="<?= $user['date_of_birth'] ?>">
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Ngày sinh</label>
                            <?php if (isset($_SESSION['error']['date_of_birth'])): ?>
                                <p class="text-danger col-8"><?= $_SESSION['error']['date_of_birth'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="tf-field style-1 mb_15">
                            <input disabled class="tf-field-input tf-input" placeholder=" " type="text" id="property1" name="phone" value="<?= $user['phone'] ?>">
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Số điện thoại</label>
                            <?php if (isset($_SESSION['error']['phone'])): ?>
                                <p class="text-danger col-8"><?= $_SESSION['error']['phone'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="tf-field style-1 mb_15">

                            <select disabled name="gender" class="selectpicker w-100 mh-auto form-control form-control-lg">
                                <option <?= $user['gender'] === 'Nam' ? 'selected' : '' ?> value="Nam">Nam</option>
                                <option <?= $user['gender'] === 'Nữ' ? 'selected' : '' ?> value="Nữ">Nữ</option>
                                <option <?= $user['gender'] === 'Khác' ? 'selected' : '' ?> value="Khác">Khác</option>
                            </select>

                        </div>

                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" placeholder=" " type="text" id="property1" disabled value="<?= $user['email'] ?>">
                            <label class="tf-field-label fw-4 text_black-2" for="property1">Email</label>
                        </div>
                        <div class="tf-field style-1 mb_15">
                            <input class="tf-field-input tf-input" placeholder=" " type="text" id="property2" disabled value="<?= $user['created_at'] ?>">
                            <label class="tf-field-label fw-4 text_black-2" for="property2">Ngày tạo tài khoản</label>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="wd-form-order">


            <div class="widget-tabs style-has-border widget-order-tab">
              
                <div class="widget-content-tab">
                    <div class="widget-content-inner active">
                        <div class="widget-timeline">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="my-account-content account-order">
                                        <div class="wrap-account-order">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="fw-6">Mã đơn hàng</th>
                                                        <th class="fw-6">Ngày đặt</th>
                                                        <th class="fw-6">Trạng thái</th>
                                                        <th class="fw-6">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($listOrder as $key => $item): ?>

                                                        <tr class="tf-order-item">
                                                            <td>
                                                                <?= $item['order_code'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $item['created_at'] ?>
                                                            </td>
                                                            <td>
                                                                <p class="badge bg-success">
                                                                    <?= $item['status'] ?>
                                                                </p>
                                                            </td>

                                                            <td>
                                                                <a href="<?= BASE_URL . '?act=view-order-detail&order_id=' . $item['id'] ?>" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                                    <span>View</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once './views/layouts/footer.php'; ?>