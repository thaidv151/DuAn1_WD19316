<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">

                </div>
                <ul class="navbar-nav header-right">

                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell-fill text-danger"></i>
                            <span class="badge badge-primary rounded-circle"><?= count($_SESSION['order_cancel']) ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div id="dlab_W_Notification1" class="widget-media dlab-scroll p-3  height380">
                                <div>
                                    <p class="bg-danger p-2 text-white">Đơn hàng huỷ (đã thanh toán) </p>
                                </div>
                                <ul class="timeline">
                                    <?php if (isset($_SESSION['order_cancel'])) { ?>
                                        <?php foreach ($_SESSION['order_cancel'] as $key => $item): ?>
                                            <li>
                                              
                                                <a style="text-decoration: none;" href="<?= BASE_URL_ADMIN . '?act=detail-order&order_id=' . $item['id'] ?>" class="card p-1">
                                                    <h6 class="mb-1"><?= $item['order_code'] ?></h6>
                                                    <small class="d-block"><?= $item['update_at'] ?></small>
                                                </a>
                                            </li>
                                        <?php endforeach ?>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                            <img src="<?= '.' . $_SESSION['user']['avatar'] ?>" width="20" alt="" ;
                                onerror="this.onerror=null; this.src= '../uploads/user.png'" ; />
                            <div class="header-info">
                                <span class="text-black"><?= $_SESSION['user']['username'] ?></span>
                                <p class="fs-12 mb-0">
                                    <?= $_SESSION['user']['role_id'] === 0 ? 'Super Admin' : 'Admin' ?>
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= BASE_URL_ADMIN . '?act=edit-profile' ?>" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ms-2">Profile </span>
                            </a>
                            <a href="<?= BASE_URL ?>" class="dropdown-item ai-icon">
                                <i class="bi bi-eye text-warning"></i>
                                <span class="ms-2">View client </span>
                            </a>

                            <a href="<?= BASE_URL . '?act=logout' ?> " class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ms-2">Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] === 0) { ?>
                <li><a href="<?= BASE_URL_ADMIN ?>" href="javascript:void(0);" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Trang chủ</span>
                    </a>

                </li>
            <?php } ?>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Sản phẩm</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-product' ?>">Danh sách sản phẩm</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=add-product' ?>">Thêm sản phẩm</a></li>

                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Danh mục</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL_ADMIN . '?act=danh-muc' ?>">Danh sách danh mục</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=form-them-danh-muc' ?>">Thêm danh mục</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-images"></i>
                    <span class="nav-text">Banner</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-banner'  ?>">Danh sách banner</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=add-banner' ?>">Thêm Banner</a></li>
                </ul>
            </li>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] === 0) { ?>
                <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-people"></i>
                        <span class="nav-text">Người dùng</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="<?= BASE_URL_ADMIN . '?act=list-user-admin' ?>">Tài khoản quản trị</a></li>
                        <li><a href="<?= BASE_URL_ADMIN . '?act=list-user-client' ?>">Tài khoản người dùng</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-cart4"></i>
                    <span class="nav-text">Đơn hàng</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-new-order' ?>">Đơn hàng mới</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-process-order' ?>">Đơn hàng đang xử lý</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-complete-order' ?>">Đơn hàn hoàn thành</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-cancel-order' ?>">Đơn hàng huỷ</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-return-order' ?>">Đơn hàng hoàn</a></li>

                </ul>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-ticket-perforated"></i>
                    <span class="nav-text">Phiếu giảm giá</span>
                </a>
                <ul aria-expanded="false">

                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-voucher' ?>">Danh sách voucher</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=form-add-voucher' ?>">Thêm voucher</a></li>
                </ul>
            </li>



        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->

<!--**********************************
            Content body end
        ***********************************-->


<div class="content-body">

    <div class="container-fluid">