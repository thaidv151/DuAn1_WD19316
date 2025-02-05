<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">


<!-- Mirrored from themesflat.co/html/ecomus/shop-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Nov 2024 14:30:03 GMT -->

<head>
    <meta charset="utf-8">
    <title>TNM Clothes</title>


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- font -->
    <link rel="stylesheet" href="assets/fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="assets/fonts/font-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="./uploads/logo1.png">
    <link rel="apple-touch-icon-precomposed" href="./uploads/logo1.png">


    <!-- Icons -->
    <link rel="stylesheet" href="assets/css/drift-basic.min.css">
    <link rel="stylesheet" href="assets/css/photoswipe.css">
    <link rel="stylesheet" href="assets/css/homeView.css">

    <!-- Icons -->

</head>

<body class="preload-wrapper">

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <!-- header -->
        <header id="header" class="header-default">
            <div class="px_15 lg-px_40">
                <div class="row wrapper-header align-items-center">

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?= BASE_URL ?>" class="logo-header">
                            <img src="./uploads/logo1.png" alt="abc" style="width: 100px;"
                                onerror="this.onerror=null; this.src= './uploads/user.png'" ;>

                        </a>
                    </div>
                    <div class="col-xl-6 tf-md-hidden">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">
                                <li class="menu-item">
                                    <a href="<?= BASE_URL ?>" class="item-link">Trang chủ</i></a>
                                </li>
                                <li class="menu-item">
                                    <a class="item-link" id="viewProduct">Sản phẩm</a>

                                </li>
                                <li class="menu-item">
                                    <a class="item-link" id="viewHotsearch">Sản phẩm xem nhiều nhất</a>

                                </li>

                                
                                <li class="menu-item position-relative">
                                    <a href="<?= BASE_URL . '?act=list-order' ?>" class="item-link">Đơn hàng</a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center gap-20">
                            <li class="nav-search">
                                <div data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="nav-icon-item">


                                    <form action="<?= BASE_URL  ?>" method="POST" id="formSearch" class="form-group">
                                        <input style="height: 30px;" class="form-control" type="text" name="inpSearch" id="inpSearch" placeholder="search....">
                                    </form>

                                    <p>
                                        <button class="btn btn-submit-form" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="icon icon-search"></i>
                                        </button>
                                    </p>

                                </div>
                            </li>
                            <li class="nav-account">

                                <?php if (isset($_SESSION['user']['avatar'])) { ?>
                                    <img style="width: 30px; height:30px; border-radius:50%;" src="<?= $_SESSION['user']['avatar'] ?>" alt="">
                                <?php  } else { ?>
                                    <i class="icon icon-account"></i>
                                    <a href="<?= BASE_URL . '?act=login' ?>" class="nav-icon-item">
                                        <span class="account-text">Login</span>
                                    </a>
                                <?php  } ?>

                                <?php if (isset($_SESSION['user'])) { ?>
                                    <ul class="dropdown-menu">

                                        <li><a href="<?= $_SESSION['user']['role_id'] === 2 ? BASE_URL . '?act=edit-profile' : BASE_URL_ADMIN . '?act=edit-profile' ?>">Hồ sơ</a></li><br>


                                        <?php if ($_SESSION['user']['role_id'] === 1 || $_SESSION['user']['role_id'] === 0) { ?>
                                            <li><a href="<?= BASE_URL_ADMIN ?>">Trang quản lý</a></li><br>
                                        <?php } ?>



                                        <li><a href="<?= BASE_URL . '?act=logout' ?>">Đăng xuất</a></li>

                                    </ul>
                                <?php } ?>
                            </li>

                            <li class="nav-cart">
                                <a href="<?= BASE_URL . '?act=view-cart' ?>" class="nav-icon-item">
                                    <i class="icon icon-bag"></i><span class="count-box"><?= isset($_SESSION['count_cart']) ? $_SESSION['count_cart'] : '0' ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>


        <!-- /header -->