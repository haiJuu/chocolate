<div class="cart">

    <div class="row justify-content-center">

        <?php
        $select_cart = "SELECT * FROM cart,product,product_img WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND order_id IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cart_id DESC";
        $cart = $link->query($select_cart);
        $cartTotal = 0;
        ?>

        <?php if ($cart->rowCount() != 0) { ?>
            <div class="col-md-8 col-sm-10 col-12">
                <div class="table-responsive-md">
                    <table class="table table-hover mt-3">
                        <thead>
                            <tr>
                                <td colspan="3">購物車 ( <?php echo $cart->rowCount() ?> 件)</td>
                                <td class="text-end" colspan="3">
                                    <button type="button id=" name="btn01" class="btn btn-success" onclick="btn_confirmLink('確定清空購物車?','./cartDelete.php?mode=2')">清空全部</button>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <td width="40%" colspan="2">商品資訊</td>
                                <td class="text-center" width="20%">單價</td>
                                <td class="text-center" width="10%">數量</td>
                                <td class="text-center" width="20%">小計</td>
                                <td class="text-center" width="10%">刪除</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($fetch_cart = $cart->fetch()) {
                            ?>
                                <tr>
                                    <td width="10%">
                                        <img src="./images/product/<?php echo $fetch_cart['img_file']; ?>" alt="<?php echo $fetch_cart['p_name']; ?>" class="img-fluid">
                                    </td>
                                    <td width="30%">
                                        <?php echo $fetch_cart['p_name']; ?></td>
                                    <td class="text-center">
                                        <h4 class="color_e600a0 pt-1">NT$ <?php echo $fetch_cart['p_price']; ?></h4>
                                    </td>
                                    <td class="text-center" style="min-width:100px">
                                        <div class="input-group">
                                            <input type="number" class="form-control text-center" id="qty[]" name="qty[]" value="<?php echo $fetch_cart['qty']; ?>" min="1" max="49" cart_id="<?php echo $fetch_cart['cart_id']; ?>" required style="min-width:60px">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <h4 class="color_e600a0 pt-1"><?php echo $fetch_cart['p_price'] * $fetch_cart['qty']; ?></h4>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger" onclick="btn_confirmLink('確定刪除此商品?','./cartDelete.php?mode=1&cart_id=<?php echo $fetch_cart['cart_id']; ?>')"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            <?php
                                $cartTotal += $fetch_cart['p_price'] * $fetch_cart['qty'];
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr class="text-end">
                                <td colspan="6">
                                    <a href="./drugstore.php">繼續購物</a>　
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <br>
                <div class="table-responsive-md">
                    <table class="table table-hover mt-3">
                        <thead>
                            <tr>
                                <td colspan="2">訂單資訊</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">小計：<?php echo $cartTotal; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>運費：
                                    <?php
                                    if ($cartTotal >= 3000) {
                                        $shippingFee = 0;
                                        echo $shippingFee;
                                    } else {
                                        $shippingFee = 100;
                                        echo $shippingFee;
                                    }
                                    ?>
                                </td>
                                <td class="text-end" colspan="2">
                                    <?php
                                    if ($cartTotal >= 3000) {
                                        echo "(商品已達免運 3000$ 的門檻)";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">合計：<?php echo $cartTotal + $shippingFee; ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text-end">
                                <td colspan="2">
                                    <a href="./checkout.php">前往結帳</a>　
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php } else { ?>

            <div class="alert alert-warning col-md-8 col-sm-10 col-12" role="alert">
                抱歉，目前購物車沒有相關產品。
            </div>

        <?php } ?>

    </div>

</div>