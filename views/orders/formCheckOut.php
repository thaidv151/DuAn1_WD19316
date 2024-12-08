<?php require_once './views/layouts/header.php'; ?>
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Check Out</div>
    </div>
</div>
<section class="flat-spacing-11">
    <div class="container">
        <form id="frmCheckOut" class="tf-page-cart-checkout widget-wrap-checkout" action="<?= BASE_URL . '?act=post-check-out' ?>" method="POST">
            <div class="tf-page-cart-wrap layout-2">
                <div class="tf-page-cart-item card p-3">
                    <h5 class="fw-5 mb_20">Thông tin người nhận</h5>


                    <fieldset class="fieldset">
                        <label for="first-name">Họ và tên </label>
                        <p class="text-danger" id="error-first-name"></p>
                        <input name="customer_name" type="text" id="first-name" placeholder="Nguyen Van A" value="<?= $_SESSION['user']['username'] ?>">
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="last-name">Email</label>
                        <p class="text-danger" id="error-email"></p>
                        <input name="customer_email" type="text" id="email" placeholder="Example@gmail.com" value="<?= $_SESSION['user']['email'] ?>">
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="phone">Số điện thoại</label>
                        <p class="text-danger" id="error-phone"></p>
                        
                        <input name="customer_phone" type="text" id="phone" placeholder="***********343" value="<?= $_SESSION['user']['phone'] ?>">
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="">Tỉnh thành</label>
                        <p class="text-danger" id="error-city"></p>
                        <select class="form-control" name="city" id="city">
                            <option value="" selected>Chọn tỉnh thành</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="">Quận huyện</label>
                        <p class="text-danger" id="error-district"></p>
                        <select class="form-control" name="district" id="district">
                            <option value="" selected>Chọn quận huyện</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <label for="">Phường xã</label>
                        <p class="text-danger" id="error-ward"></p>
                        <select class="form-control" name="ward" id="ward">
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="city">Địa chỉ</label>
                        <p class="text-danger" id="error-address"></p>
                        <input name="address" type="text" id="address" placeholder="Số nhà 2, ngõ ...">
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
                        <p id="handleSubmit" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Đặt hàng</p>

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
<script>
    const handleSubmit = document.querySelector('#handleSubmit');
    handleSubmit.addEventListener('click', () => {
        const isValid = true;

        const address = document.querySelector('#address').value;
        const ward = document.querySelector('#ward').value;
        const district = document.querySelector('#district').value;
        const city = document.querySelector('#city').value;
        const email = document.querySelector('#email').value;
        const phone = document.querySelector('#phone').value;
        const firstName = document.querySelector('#first-name').value;
        
        const errorFirstName = document.querySelector('#error-first-name');
        const errorEmail = document.querySelector('#error-email');
        const errorPhone = document.querySelector('#error-phone');
        const errorDistrict = document.querySelector('#error-district');
        const errorWard = document.querySelector('#error-ward');
        const errorCity = document.querySelector('#error-city');
        if(!firstName){
            errorFirstName.innerText = 'Không để trống tên người nhận';
            isValid = false;
        }else{
            errorFirstName.innerText = '';
        }
        const regexEmail = /^[^s@]+@[^s@]+.[^s@]+$/;
        if(!email){
            errorEmail.innerText = 'Không để trống email';
            isValid = false;
        }else if(!regexEmail.test(email)){
            errorEmail.innerText = 'Email không hợp lệ';
            isValid = false;
        }else{
            errorEmail.innerText = '';
        }
        const regexPhone = /^[^1-9]+[0-9]{7,14}$/;
        if(!phone){
            errorPhone.innerText = 'Không để trống số điện thoại';
            isValid =false;
        }else if(!regexPhone.test(phone)){
            errorPhone.innerText = 'Số điện thoại không hợp lệ';
            isValid =false;
        }else{
            errorPhone.innerText = '';
        }
        if(!city){
            errorCity.innerText = 'Không để trống thành phố';
            isValid =false;
        }else{
            errorCity.innerText = '';
        }
        if(!ward){
            errorWard.innerText = 'Không để trống phường xã';
            isValid =false;
        }else{
            errorWard.innerText = '';
        }
        if(!district){
            errorDistrict.innerText = 'Không để trống quận huyện';
            isValid =false;
        }else{
            errorDistrict.innerText = '';
        }
        if(isValid){
            const frmCheckOut = document.querySelector('#frmCheckOut');
            frmCheckOut.submit();
        }
    })
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