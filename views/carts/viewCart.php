<?php require_once './views/layouts/header.php'; ?>
<!-- page-title -->
<div class="container">
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">Shopping Cart</div>
        </div>
    </div>
    <section class="flat-spacing-11">
    <?php
    
     if(isset($_SESSION['error'])) {?>
        <p class="text-danger f-1"> <?= $_SESSION['error'] ?></p>
    <?php } ?>
        <div class="tf-page-cart-wrap">
            <div class="tf-page-cart-item">

                <table class="tf-table-page-cart">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <form action="<?= BASE_URL . '?act=form-check-out' ?>" id="formCheckOutCart" method="POST">
                        <input type="text" id="shippingOrder" name="shippingOrder" value="0" hidden>
                            <?php foreach ($listCartById as $key => $item): ?>

                                <tr class="tf-cart-item file-delete text-center">
                                    <td>

                                       
                                        <input style="width: 20px; height:20px;" onchange="changeCheckCart(<?= $key ?>)" type="checkbox" name="checkCartId[]" class="checkCartId" value="<?= $item['id'] ?>">

                                    </td>
                                    <td class="tf-cart-item_product">
                                        <a href="product-detail.html" class="img-box">
                                            <img src="<?= $item['thumbnail_variant'] ?>" alt="" onerror="this.onerror=null; this.src='./uploads/logo1.png'">
                                        </a>
                                        <div class="cart-info">
                                            <a href="<?= BASE_URL . '?act=product-detail&id=' . $item['product_id'] . '&variant_id=' . $item['variant_id'] ?>" class="cart-title link"><?= $item['product_name'] ?></a>
                                            <div class="cart-meta-variant"><?= $item['color'] ?> / <?= $item['size'] ?></div>
                                            <a href="<?= BASE_URL . '?act=delete-cart&id=' . $item['id'] ?>"> <span class="remove-cart link  btn btn-light btn-sm">Remove</span></a>
                                        </div>
                                    </td>
                                    <td class="tf-cart-item_total" cart-data-title="Total">

                                        <p class="text">
                                            <?= number_format($item['promotion_price']) . 'VND' ?>
                                        </p>

                                    </td>
                                    <td class="tf-cart-item_quantity">
                                        <div class="cart-quantity">

                                            <!-- <span onclick="decreaseQuantiy( <?= $key ?>)" class="btn-quantity minus-btn">-</span> -->
                                            <!-- <input type="text" class="quantity " name="quantity" value="<?= $item['quantity'] ?>">
                                                  -->
                                            <p><?= $item['quantity'] ?></p>
                                            <!-- <span onclick="increaseQuantiy( <?= $key ?>)" class="btn-quantity plus-btn">+</span> -->

                                        </div>
                                    </td>
                                    <td class="tf-cart-item_total" cart-data-title="Total">
                                        <div class="cart-total">
                                            <p class="text-danger totalPrice"></p>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </form>

                    </tbody>
                </table>

            </div>
            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <div class="tf-page-cart-checkout">
                        <div class="tf-page-cart-checkout">
                            <div class="row">
                                <div class="tf-cart-totals-discounts">
                                    <h3>Đơn giá:</h3>
                                    <span class="text-danger total-value" id="subTotal">0</span>
                                </div>
                                <div class="tf-cart-totals-discounts">
                                    <h3>Phí vận chuyển:</h3>
                                    <span id="outShipping" class="text-danger total-value">0</span>
                                </div>
                                <div class="tf-cart-totals-discounts">
                                    <h3>Giảm: </h3>
                                    <span class="text-danger total-value"><del id="outDisscount">0</del></span>
                                </div>
                                <div class="tf-cart-totals-discounts">
                                    <h3>Tổng:</h3>
                                    <span id="outTotalPriceCheckOut" class="text-danger total-value">0</span>
                                </div>



                            </div>

                            <div class="cart-checkout-btn">
                                <button class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center" id="buutonSubmit">
                                    Đặt hàng
                                </button>
                            </div>

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<script>
    const data = <?= json_encode($listCartById) ?>;

    const totalPrice = document.querySelectorAll('.totalPrice');



    data.forEach((item, index) => {
        totalPrice[index].innerHTML = new Intl.NumberFormat('vi', {
            style: 'currency',
            currency: 'VND'
        }).format(
            data[index].quantity * item.promotion_price,
        );
    });
    // const increaseQuantiy = (id) => {
    //     const quantiy_product = Number(quantity[id].value) + Number(1)
    //     totalPrice[id].innerHTML = new Intl.NumberFormat('vi', {
    //         style: 'currency',
    //         currency: 'VND'
    //     }).format(
    //         (quantiy_product * data[id].promotion_price)
    //     )

    // }

    // const decreaseQuantiy = (id) => {

    //     totalPrice[id].innerHTML = new Intl.NumberFormat('vi', {
    //         style: 'currency',
    //         currency: 'VND'
    //     }).format(
    //         (Number(quantity[id].value) - Number(1)) * data[id].promotion_price
    //     )
    // }
    const formCheckOutCart = document.querySelector('#formCheckOutCart');
    const buutonSubmit = document.querySelector('#buutonSubmit');
    buutonSubmit.addEventListener('click', () => {
        formCheckOutCart.submit();
    })
    const arrCheck = [];
    let outDisscount = document.getElementById('outDisscount');
    const subTotal = document.querySelector('#subTotal');

    const changeCheckCart = (index) => {

        if (arrCheck.indexOf(index) !== -1) {
            const deleteId = arrCheck.indexOf(index);
            arrCheck.splice(deleteId, 1)
        } else {
            arrCheck.push(index);
        }


        arrNum = [];
        arrCheck.forEach((element) => {
            const price = data[element].promotion_price * data[element].quantity
            arrNum.push(price);
        });
        const totalCheckOut = arrNum.reduce((total, item) => { // lấy ra tổng giá của đơn hàng trước khi giảm giá
            return total + item;
        }, 0);
        subTotal.innerHTML = new Intl.NumberFormat('vi', {
            style: 'currency',
            currency: 'VND'
        }).format(
            totalCheckOut
        )


        const shippingDefault = 30000;

        
        let shipping = 30000;
        if (totalCheckOut < 250000 && totalCheckOut > 150000) {
            shipping = 20000;
        } else if (totalCheckOut > 250000 && totalCheckOut < 350000) {
            shipping = 15000;
        } else if (totalCheckOut > 350000) {
            shipping = 0;
        }
        const disscountShip = shippingDefault - shipping;
        let shippingOrder = document.getElementById('shippingOrder');
      
        shippingOrder.value = shippingDefault - disscountShip;

        const outShiping = document.querySelector('#outShipping');





        outDisscount.innerText = new Intl.NumberFormat('vi', { // trả giá được giảm
            style: 'currency',
            currency: 'VND'
        }).format(
            disscountShip
        )
        outShiping.innerText = new Intl.NumberFormat('vi', { // trỏ ra giá của mặc định của phí giao hàng
            style: 'currency',
            currency: 'VND'
        }).format(
            shippingDefault
        )
        const outTotalPriceCheckOut = document.querySelector('#outTotalPriceCheckOut');
        outTotalPriceCheckOut.innerText = new Intl.NumberFormat('vi', {
            style: 'currency',
            currency: 'VND'
        }).format(
            Number(totalCheckOut) + Number(shippingDefault) - Number(disscountShip)
        )

    }
</script>
<?php require_once './views/layouts/footer.php'; ?>