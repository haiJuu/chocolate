<div class="cartProgressBar row justify-content-center mb-5">
    <div class="col-md-4 col-sm-8 col-10 justify-content-center">
        <div>
            <div><a href="./cart.php">1</a></div>
            <div>購物車</div>
        </div>
        <hr>
        <div>
            <div style="background-color:gray">2</div>
            <div>填資料</div>
        </div>
        <hr>
        <div>
            <div>3</div>
            <div>再確認</div>
        </div>
    </div>
</div>

<div class="checkout">

    <?php
    $select_cart = "SELECT * FROM cart,product,product_img WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND order_id IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cart_id DESC";
    $cart = $link->query($select_cart);
    $cartTotal = 0;
    $total = $_SESSION["total"];
    ?>

    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-10 col-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading">
                        <div class="text-center fs-5" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="true" aria-controls="collapse" style="cursor:pointer;padding:1rem">
                            <div class="mt-3 mb-3"><strong>合計:NT$<?php echo $total ?></strong></div>
                            <div class="mb-3">購物車 (<?php echo $cart->rowCount() ?>件)</div>
                        </div>
                    </h2>
                    <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="padding:0;">
                            <div class="table-responsive-md">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td width="40%" colspan="2" class="text-start">商品資訊</td>
                                            <td class="text-center" width="20%">單價</td>
                                            <td class="text-center" width="10%">數量</td>
                                            <td class="text-end" width="20%">小計</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($fetch_cart = $cart->fetch()) {
                                        ?>
                                            <tr>
                                                <td colspan="2" class="text-start">
                                                    <img src="./images/product/<?php echo $fetch_cart['img_file']; ?>" alt="<?php echo $fetch_cart['p_name']; ?>" class="img-fluid">
                                                    <?php echo $fetch_cart['p_name']; ?>
                                                </td>
                                                <td class="text-center">
                                                    NT$<?php echo $fetch_cart['p_price']; ?>
                                                </td>
                                                <td class="text-center fs-10" style="min-width:100px">
                                                    <?php echo $fetch_cart['qty']; ?>
                                                </td>
                                                <td class="text-end">
                                                    <?php echo $fetch_cart['p_price'] * $fetch_cart['qty']; ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $cartTotal += $fetch_cart['p_price'] * $fetch_cart['qty'];
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="border-color:white">
                                            <td colspan="3"></td>
                                            <td>
                                                <div class="mb-3 mt-3">小計：</div>
                                                <div class="mb-3">運費：</div>
                                                <div>合計：</div>
                                            </td>
                                            <td class="text-end">
                                                <div class="mb-3">NT$<?php echo $cartTotal; ?></div>
                                                <div class="mb-3">
                                                    NT$<?php
                                                        if ($cartTotal >= 3000) {
                                                            $shippingFee = 0;
                                                            echo $shippingFee . "<br>(已達免運門檻)";
                                                        } else {
                                                            $shippingFee = 100;
                                                            echo $shippingFee;
                                                        }
                                                        ?>
                                                </div>
                                                <div>NT$<?php echo $cartTotal + $shippingFee; ?></div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="table-responsive-md col-md-4 col-sm-10 col-12">
            <table class="table mt-3">
                <thead>
                    <tr class="table-light fs-5">
                        <td>送貨資料</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>收件人姓名</td>
                    </tr>
                    <tr>
                        <td>收件人電話號碼</td>
                    </tr>
                    <tr>
                        <td>收件人郵遞區號</td>
                    </tr>
                    <tr>
                        <td>收件人地址</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-outline-primary">選擇其他收件人</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="table-responsive-md col-md-4 col-sm-10 col-12">
            <table class="table mt-3">
                <thead>
                    <tr class="table-light fs-5">
                        <td>付款資料</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            收件人姓名
                        </td>
                    </tr>
                    <tr>
                        <td>
                            收件人電話號碼
                        </td>
                    </tr>
                    <tr>
                        <td>
                            收件人郵遞區號
                        </td>
                    </tr>
                    <tr>
                        <td>
                            收件人地址
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-outline-primary">選擇其他收件人</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="table-responsive-md col-md-8 col-sm-10 col-12">
            <table class="table mt-3">
                <tr>
                    <td>
                        <a href="./cart.php" style="text-decoration:none">< 返回購物車</a>
                    </td>
                    <td class="text-end">
                        <button type="button" class="btn btn-danger">提交訂單</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>