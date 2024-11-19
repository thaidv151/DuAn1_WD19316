<!DOCTYPE html>
<html lang="en" class="h-100">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="FinLab : FinLab Crypto Trading UI Admin  Bootstrap 5 Template" />
    <meta property="og:title" content="FinLab : FinLab Crypto Trading UI Admin  Bootstrap 5 Template" />
    <meta property="og:description" content="FinLab : FinLab Crypto Trading UI Admin  Bootstrap 5 Template" />
    <meta property="og:image" content="../../finlab.dexignlab.com/xhtml/social-image.html" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>TNM Clothes</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="./admin/assets/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="./admin/assets/https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="./admin/assets/css/style.css" rel="stylesheet">

</head>

<body class="body  h-100" style="background-image: url('page-error-404.html'); background-size:cover;">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-contain-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="m-0">
                            <div class="col-xl-12 col-md-12 sign ">

                                <div style="margin-top: 20px;" class="col-xl-12 col-md-12 card shadow-lg p-3 mb-5 bg-white rounded">
                                    <div class="sign-in-your py-4 px-2">
                                        <h4 class="fs-20">Đăng ký tài khoản của bạn</h4>
                                        <span>Chào mừng bạn đến với Website của chúng tôi<br> Hãy đăng ký tài khoản của bạn !</span>

                                        <form class="mt-2" action="<?= BASE_URL . '?act=post-register' ?>" method="POST" enctype="multipart/form-data">
                                            <div class="card shadow-sm">
                                                <div class="m-4 ">
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12">
                                                            <strong class="col-2">Email</strong>
                                                            <?php if (isset($_SESSION['error']['email'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['email'] ?></p>
                                                            <?php endif ?>
                                                        </label>

                                                        <input name="email" type="email" class="form-control" placeholder="hello@gmail.com">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12">
                                                            <strong class="col-2">Mật khẩu</strong>
                                                            <?php if (isset($_SESSION['error']['password'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['password'] ?></p>
                                                            <?php endif ?>
                                                        </label>
                                                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12">
                                                            <strong class="col-2">Tên người dùng</strong>
                                                        <?php if (isset($_SESSION['error']['username'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['username'] ?></p>
                                                            <?php endif ?>
                                                    </label>
                                                        <input name="username" type="text" class="form-control" placeholder="Tên người dùng">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12">
                                                            <strong class="col-2">Số điện thoại</strong>
                                                            <?php if (isset($_SESSION['error']['phone'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['phone'] ?></p>
                                                            <?php endif ?>
                                                    </label>
                                                        <input name="phone" type="text" class="form-control" placeholder="Số điện thoại">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12">
                                                            <strong class="col-2">Ngày sinh</strong>
                                                            <?php if (isset($_SESSION['error']['date_of_birth'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['date_of_birth'] ?></p>
                                                            <?php endif ?>
                                                    </label>
                                                        <input name="date_of_birth" type="date" class="form-control" placeholder="Ngày sinh">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12">
                                                            <strong class="col-2">Giới tính</strong>
                                                            <?php if (isset($_SESSION['error']['gender'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['gender'] ?></p>
                                                            <?php endif ?>
                                                    </label>
                                                        <select class="form-control" name="gender" id="">
                                                            <option selected value="Nam">Nam</option>
                                                            <option value="Nữ">Nữ</option>
                                                            <option value="Khác">Khác</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mb-1 row col-12" for="">
                                                            <strong class="col-2">Ảnh đại diện</strong>
                                                        <?php if (isset($_SESSION['error']['avatar'])): ?>
                                                                <p class="text-danger col-8"><?= $_SESSION['error']['avatar'] ?></p>
                                                            <?php endif ?>
                                                    </label>
                                                        <input type="file" name="avatar" id="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-between mt-4 mb-2">
                                                <div class="mb-3">
                                                    <!-- <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                                                </div> -->
                                                </div>
                                                <div class="row col-12">
                                                    <a class="btn col-3" href="<?= BASE_URL . '?act=login' ?>">Đăng nhập ?</a>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="text-center row col-12">
                                        <div class="col-9"></div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary ">Đăng ký</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./admin/assets/vendor/global/global.min.js"></script>
    <script src="./admin/assets/js/custom.min.js"></script>
    <script src="./admin/assets/js/dlabnav-init.js"></script>
    <script src="./admin/assets/js/styleSwitcher.js"></script>

</body>

<!-- Mirrored from vora.dexignlab.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2024 02:08:47 GMT -->

</html>