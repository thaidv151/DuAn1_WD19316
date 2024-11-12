<!-- Sidebar -->
<div class="row flex-nowrap col-md-12 ">
    <div class="col-auto col-xl-3 px-sm-2 px-0 bg-dark">
        <div class="nav nav-sidebar d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="<?= BASE_URL_ADMIN ?>" class=" d-flex align-items-center pb-3 pt-3 text-white text-decoration-none">
                <img src="../uploads/logo.png" alt="" style="width:40px; height:40px; border-radius:50%; margin-right:20px;">
                <span class="fs-4 d-none d-sm-inline">TNM Clothes</span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item ">
                    <a class="nav-link" data-bs-toggle="collapse" href="#submenu1" role="button" aria-expanded="false" aria-controls="submenu1">
                        <i class="bi bi-bag-plus fs-6 text-white"></i>
                        <span class="ms-1 d-none d-sm-inline text-white nav-link d-inline">Danh mục sản phẩm</span>
                        <i class="bi bi-chevron-down fs-6 text-white"></i>
                    </a>
                    </a>
                    <div class="collapse" id="submenu1">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Danh sách danh mục</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Thêm danh mục</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-bs-toggle="collapse" href="#submenu2" role="button" aria-expanded="false" aria-controls="submenu2">
                        <i class="bi bi-basket3 text-white"></i>
                        <span style="font-size:10px" class="ms-1 d-none d-sm-inline text-white nav-link fs-6">Quản lý sản phẩm</span> <i class="bi bi-chevron-down text-white"></i></a>
                    </a>
                    <div class="collapse" id="submenu2">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Danh sách sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= BASE_URL_ADMIN . '?act=add-product' ?>">Thêm sản phẩm</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-bs-toggle="collapse" href="#submenu3" role="button" aria-expanded="false" aria-controls="submenu3">
                        <i class="bi bi-check-square text-white"></i>
                        <span style="font-size:10px" class="ms-1 d-none d-sm-inline text-white nav-link fs-6">Quản lý voucher</span> <i class="bi bi-chevron-down text-white"></i></a>
                    </a>
                    <div class="collapse" id="submenu3">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Danh sách voucher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Thêm voucher</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-bs-toggle="collapse" href="#submenu4" role="button" aria-expanded="false" aria-controls="submenu4">
                        <i class="bi bi-clipboard2 text-white"></i>
                        <span style="font-size:10px" class="ms-1 d-none d-sm-inline text-white nav-link fs-6">Quản lý đơn hàng</span> <i class="bi bi-chevron-down text-white"></i></a>
                    </a>
                    <div class="collapse" id="submenu4">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Danh sách dơn hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Thêm voucher</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
            <hr>
            <div class="dropdown pb-4"  style="position: fixed; z-index: 10000; bottom:10px;">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">loser</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content col-md-11  ps-4">





        <!-- end sidebar -->