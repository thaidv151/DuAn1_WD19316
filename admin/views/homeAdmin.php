<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>


<div class="modal fade" id="addOrderModalside">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-black font-w500">Project Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Deadline</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Client Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary">CREATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= count($orderInDay) ?></h2>
                                <span class="fs-14">Tổng đơn trong ngày</span>
                            </div>
                            <i class="bi bi-clipboard2-data-fill fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= count($orderInWeek) ?></h2>
                                <span class="fs-14">Tổng đơn trong tuần</span>
                            </div>
                            <i class="bi bi-clipboard2-data-fill fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= count($orderInMonth) ?></h2>
                                <span class="fs-14">Tổng đơn trong tháng <?= $month ?></span>
                            </div>
                            <i class="bi bi-calendar2-check-fill fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= count($orderCompleteInMonth) ?></h2>
                                <span class="fs-14">Tổng đơn hoàn thành trong tháng <?= $month ?></span>
                            </div>
                            <i class="bi bi-calendar2-check-fill fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= count($orderInYear) ?></h2>
                                <span class="fs-14">Tổng đơn trong năm</span>
                            </div>
                            <i class="bi bi-bag-check btn bg-light fs-1 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= count($allUser) ?></h2>
                                <span class="fs-14">Tổng người dùng đã đăng ký</span>
                            </div>
                            <i class="bi bi-people-fill fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= number_format($totalIncomeFromMonth) . ' VND' ?></h2>
                                <span class="fs-14">Tổng doanh thu trong tháng <?= $month ?></span>
                            </div>
                            <form action="<?= BASE_URL_ADMIN  ?> " id="frmSelectMonth" method="POST">
                                <div class="form-group">
                                    <select class="form-control ps-3 text-center" name="month" id="selectMonth">
                                        <option <?= $month == 1 ?'selected' : '' ?> value="1">1</option>
                                        <option <?= $month == 2 ?'selected' : '' ?> value="2">2</option>
                                        <option <?= $month == 3 ?'selected' : '' ?> value="3">3</option>
                                        <option <?= $month == 4 ?'selected' : '' ?> value="4">4</option>
                                        <option <?= $month == 5 ?'selected' : '' ?> value="5">5</option>
                                        <option <?= $month == 6 ?'selected' : '' ?> value="6">6</option>
                                        <option <?= $month == 7 ?'selected' : '' ?> value="7">7</option>
                                        <option <?= $month == 8 ?'selected' : '' ?> value="8">8</option>
                                        <option <?= $month == 9 ?'selected' : '' ?> value="9">9</option>
                                        <option <?= $month == 10 ?'selected' : '' ?> value="10">10</option>
                                        <option <?= $month == 11 ?'selected' : '' ?> value="11">11</option>
                                        <option <?= $month == 12 ?'selected' : '' ?> value="12">12</option>
                                    </select>
                                </div>
                            </form>
                        <script>
                            const selectMonth = document.querySelector('#selectMonth');
                            const frmSelectMonth = document.querySelector('#frmSelectMonth');
                            selectMonth.addEventListener('change', ()=> {
                                frmSelectMonth.submit();
                            })
                        </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card fun">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w600"><?= number_format($totalIncome) . ' VND' ?></h2>
                                <span class="fs-14">Tổng doanh thu website</span>
                            </div>
                            <i class="bi bi-cash-coin fs-1 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>


</div>

<?php require_once './views/layouts/footer.php'; ?>