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
                        <div class="row m-0">
                            <div class="col-xl-6 col-md-6 sign text-center ">
                                <div>
                                    <div class="text-center my-5">
                                        <a href="<?= BASE_URL ?>"><img style="width:200px" src="./uploads/logo1.png" alt=""></a>
                                    </div>
                                    <img src="./uploads/log.png" class="img-fix bitcoin-img sd-shape7"></img>
                                </div>
                            </div>
                            <div style="margin-top: 120px;" class="col-xl-6 col-md-6 card shadow-sm p-3 mb-5 bg-white rounded">
                                <div class="sign-in-your py-4 px-2">
                                    <h4 class="fs-20">Đăng nhập tài khoản của bạn</h4>
                                    <span>Chào mừng bạn đã quay trở lại với Website của chúng tôi<br> Hãy đăng nhập tài khoản của bạn !</span>
                                    <div>
                                        <?php if (isset($_SESSION['success'])) { ?>
                                            <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <form action="<?= BASE_URL . '?act=post-login' ?>" method="POST">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong>
                                                <?php if (isset($_SESSION['error']['email'])): ?>
                                                    <p class="text-danger col-12"><?= $_SESSION['error']['email'] ?></p>
                                                <?php endif ?>
                                            </label>
                                            <input name="email" type="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong>
                                                <?php if (isset($_SESSION['error']['password'])): ?>
                                                    <p class="text-danger col-12"><?= $_SESSION['error']['password'] ?></p>
                                                <?php endif ?>
                                            </label>
                                            <input name="password" type="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <!-- <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                                                </div> -->
                                            </div>
                                            <div class="row col-12">
                                                <div class="mb-3 col-8">
                                                    <a href="page-forgot-password.html">Quên mật khẩu ?</a>
                                                </div>
                                                <div class="mb-3 col-4">
                                                    <a href="<?= BASE_URL . '?act=register' ?>">Đắng ký ?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
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