<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        Dashboard
                    </div>
                </div>
                <ul class="navbar-nav header-right">


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
            <li><a href="<?= BASE_URL_ADMIN ?>" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Trang chủ</span>
                </a>

            </li>
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
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Banner</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-banner'  ?>">Danh sách banner</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=add-banner' ?>">Thêm Banner</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="bi bi-people"></i>
                    <span class="nav-text">Người dùng</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-user-admin' ?>">Tài khoản quản trị</a></li>
                    <li><a href="<?= BASE_URL_ADMIN . '?act=list-user-client' ?>">Tài khoản người dùng</a></li>
                </ul>
            </li>
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
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="form-element.html">Form Elements</a></li>
                    <li><a href="form-wizard.html">Wizard</a></li>
                    <li><a href="form-editor-ckeditor.html">Form CkEditor</a></li>
                    <li><a href="form-pickers.html">Pickers</a></li>
                    <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-network"></i>
                    <span class="nav-text">Table</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                    <li><a href="table-datatable-basic.html">Datatable</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="page-register.html">Register</a></li>
                    <li><a href="page-login.html">Login</a></li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="page-error-400.html">Error 400</a></li>
                            <li><a href="page-error-403.html">Error 403</a></li>
                            <li><a href="page-error-404.html">Error 404</a></li>
                            <li><a href="page-error-500.html">Error 500</a></li>
                            <li><a href="page-error-503.html">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
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