<div class="checkout">
    
    <?php
    $select_cart = "SELECT * FROM cart,product,product_img WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND order_id IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cart_id DESC";
    $cart = $link->query($select_cart);
    $cartTotal = 0;
    ?>

    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-10 col-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            合計
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <div class="table-responsive-md">
                                <table class="table table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <td colspan="5">購物車合計 ( <?php echo $cart->rowCount() ?> 件)</td>
                                        </tr>
                                        <tr class="table-warning">
                                            <td width="40%" colspan="2">商品資訊</td>
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
                                                <td width="10%"><img src="./images/product/<?php echo $fetch_cart['img_file']; ?>" alt="<?php echo $fetch_cart['p_name']; ?>" class="img-fluid"></td>
                                                <td width="30%"><?php echo $fetch_cart['p_name']; ?></td>
                                                <td class="text-center">
                                                    <h4 class="color_e600a0 pt-1">NT$ <?php echo $fetch_cart['p_price']; ?></h4>
                                                </td>
                                                <td class="text-center" style="min-width:100px">
                                                    <?php echo $fetch_cart['qty']; ?>
                                                </td>
                                                <td class="text-end">
                                                    <h4 class="color_e600a0 pt-1"><?php echo $fetch_cart['p_price'] * $fetch_cart['qty']; ?></h4>
                                                </td>
                                            </tr>
                                        <?php
                                            $cartTotal += $fetch_cart['p_price'] * $fetch_cart['qty'];
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>小計：</td>
                                            <td class="text-end"><?php echo $cartTotal; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>運費：</td>
                                            <td class="text-end">
                                                <?php
                                                if ($cartTotal >= 3000) {
                                                    $shippingFee = 0;
                                                    echo $shippingFee . "<br>(已達免運門檻)";
                                                } else {
                                                    $shippingFee = 100;
                                                    echo $shippingFee;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>合計：</td>
                                            <td class="text-end"><?php echo $cartTotal + $shippingFee; ?></td>
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
                    <tr>
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
                    <tr>
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
            <table class="table table-hover mt-3">
                <tr>
                    <td>
                        <a href="./cart.php">返回購物車</a>
                    </td>
                    <td class="text-end">
                        <button type="button" id="btn04" name="btn04" class="btn btn-danger">提交訂單</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>