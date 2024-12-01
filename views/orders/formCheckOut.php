<?php require_once './views/layouts/header.php'; ?>
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Check Out</div>
    </div>
</div>
<section class="flat-spacing-11">
    <div class="container">
        <form class="tf-page-cart-checkout widget-wrap-checkout" action="<?= BASE_URL . '?act=post-check-out' ?>" method="POST">
            <div class="tf-page-cart-wrap layout-2">
                <div class="tf-page-cart-item card p-3">
                    <h5 class="fw-5 mb_20">Thông tin người nhận</h5>


                    <fieldset class="fieldset">
                        <label for="first-name">Họ và tên </label>
                        <input name="customer_name" type="text" id="first-name" placeholder="Nguyen Van A">
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="last-name">Email</label>
                        <input name="customer_email" type="text" id="last-name" placeholder="Example@gmail.com">
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="phone">Số điện thoại</label>
                        <input name="customer_phone" type="text" id="last-name" placeholder="***********343">
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="">Tỉnh thành</label>
                        <select class="form-control" name="city" id="city">
                            <option value="" selected>Chọn tỉnh thành</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="">Quận huyện</label>

                        <select class="form-control" name="district" id="district">
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label for="">Phường xã</label>

                        <select class="form-control" name="ward" id="ward">
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="city">Địa chỉ</label>
                        <input name="address" type="text" placeholder="Số nhà 2, ngõ ...">
                    </fieldset>
                </div>
                <div class="tf-page-cart-footer">
                    <div class="tf-cart-footer-inner">
                        <h5 class="fw-5 mb_20">Your order</h5>

                        <ul class="wrap-checkout-product">
                            <?php foreach ($listCartById as $key => $item): ?>

                                <li class="checkout-product-item">
                                    <figure class="img-product">
                                        <img src="<?= $item['thumbnail_variant'] ?>" alt="" onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                        <span class="quantity"><?= $item['quantity'] ?></span>
                                    </figure>
                                    <div class="content">
                                        <div class="info">
                                            <p class="name"><?= $item['product_name'] ?></p>
                                            <span class="variant"><?= $item['color'] ?> / <?= $item['size'] ?></span>
                                        </div>
                                        <span><?= number_format($item['promotion_price']) . 'VND' ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="coupon-box">
                            <div class="shipping-calculator">
                                <summary class="accordion-shipping-header d-flex justify-content-between align-items-center collapsed" data-bs-target="#shipping" data-bs-toggle="collapse" aria-controls="shipping">
                                    <h3 class="shipping-calculator-title">Voucher</h3>
                                    <span class="shipping-calculator_accordion-icon"></span>
                                </summary>
                                <div class="collapse" id="shipping">
                                    <div id="scrollableBox" style=" width: 500px;height: 220px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">

                                        <?php foreach ($listVoucher as $key => $item): ?>
                                            <?php
                                            $countLimit = ($item['quantity_limit'] - $item['used_count']);

                                            if ($countLimit > 0) { ?>
                                                <?php if ($item['status'] === 1) { ?>
                                                    <div class="border btn-warning mt-2" style="background-color: #FFCC33; border-radius: 5px; ">
                                                        <input onchange="changeVoucherId(<?= $key ?>)" type="radio" name="voucher_id" id="voucher_id" value="<?= $item['id'] ?>">
                                                        <p> <?= $item['title_voucher'] ?></p>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>

                                        <?php endforeach ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between line pb_20">
                            <h6 class="fw-5">Phí vận chuyển</h6>
                            <h6 class="total fw-5"><?= number_format($shipingOrder) . 'VND' ?></h6>
                        </div>
                        <div class="d-flex justify-content-between line pb_20">
                            <h6 class="fw-5">Tổng thanh toán</h6>
                            <h6 class="total fw-5" id="totalPriceOrder"></h6>
                        </div>
                        <div>
                            <select class="form-control" name="payment_method_id" id="">
                                <?php foreach ($listPaymentMethod as $key => $value) : ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['payment_method_name'] ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                        <button type="submit" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Đặt hàng</button>

                    </div>
                </div>
        </form>
    </div>

    </div>
</section>
<?php require_once './views/layouts/footer.php'; ?>
<script>
    const totalPriceOrder = document.querySelector('#totalPriceOrder');
    let dataTotalPrice = <?= json_encode($totalPriceOrder) ?>;
    console.log(dataTotalPrice);
    totalPriceOrder.innerText = dataTotalPrice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
    const dataVoucher = <?= json_encode($listVoucher) ?>;
    const changeVoucherId = (id) => {
        dataTotalPrice = <?= json_encode($totalPriceOrder) ?>;
        if (dataVoucher[id].min_order_amount < dataTotalPrice) {

            dissCountValue = dataVoucher[id].disscount_value / 100 * dataTotalPrice;

            if (dissCountValue > dataVoucher[id].max_disscount_amount) {
                dissCountValue = dataVoucher[id].max_disscount_amount;
            } else {
                dissCountValue = dataVoucher[id].disscount_value / 100 * dataTotalPrice;
            }
            dataTotalPrice = dataTotalPrice - dissCountValue;

            totalPriceOrder.innerText = dataTotalPrice.toLocaleString('it-IT', {
                style: 'currency',
                currency: 'VND'
            });
        } else {
            const voucher_id = document.querySelector('#voucher_id');
            voucher_id.value = null;
            alert('Đơn hàng của bạn không đủ điều kiện sử dụng');

        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            var opt = document.createElement('option');
            opt.value = x.Name;
            opt.text = x.Name;
            opt.setAttribute('data-id', x.Id);
            citis.options.add(opt);
        }
        citis.onchange = function() {
            district.length = 1;
            ward.length = 1;
            if (this.options[this.selectedIndex].dataset.id != "") {
                const result = data.filter(n => n.Id === this.options[this.selectedIndex].dataset.id);

                for (const k of result[0].Districts) {
                    var opt = document.createElement('option');
                    opt.value = k.Name;
                    opt.text = k.Name;
                    opt.setAttribute('data-id', k.Id);
                    district.options.add(opt);
                }
            }
        };
        district.onchange = function() {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.options[citis.selectedIndex].dataset.id);
            if (this.options[this.selectedIndex].dataset.id != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.options[this.selectedIndex].dataset.id)[0].Wards;

                for (const w of dataWards) {
                    var opt = document.createElement('option');
                    opt.value = w.Name;
                    opt.text = w.Name;
                    opt.setAttribute('data-id', w.Id);
                    wards.options.add(opt);
                }
            }
        };
    }
</script>