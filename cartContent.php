<div class="cartProgressBar row justify-content-center mb-5">
    <div class="col-md-4 col-sm-8 col-10 justify-content-center">
        <div>
            <div style="background-color:gray">1</div>
            購物車
        </div>
        <hr>
        <div>
            <div>2</div>
            填資料
        </div>
        <hr>
        <div>
            <div>3</div>
            已完成
        </div>
    </div>
</div>

<div class="cart">
    <div class="row justify-content-center">

        <?php
        $select_cart = "SELECT * FROM cart,product,product_img WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND order_id IS NULL AND cart.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cart_id DESC";
        $cart = $link->query($select_cart);
        $cartTotal = 0;
        ?>

        <?php if ($cart->rowCount() != 0) { ?>
            <div class="col-md-8 col-sm-11 col-11">
                <div class="table-responsive-md">
                    <table class="table mt-3">
                        <thead>
                            <tr class="table-light">
                                <td colspan="6" class="text-start fs-5">購物車 (<?php echo $cart->rowCount() ?>件)</td>
                            </tr>
                            <tr class="text-center">
                                <td width="30%" colspan="2" class="text-start">商品資訊</td>
                                <td width="20%">單價</td>
                                <td width="15%">數量</td>
                                <td width="20%">小計</td>
                                <td width="15%" style="min-width:75px">刪除</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($fetch_cart = $cart->fetch()) {
                            ?>
                                <tr class="text-center">
                                    <td colspan="2" class="text-start">
                                        <a href="./product.php?p_id=<?php echo $fetch_cart['p_id']; ?>" style="    text-decoration: none;color: black;">
                                            <img src="./images/product/<?php echo $fetch_cart['img_file']; ?>" alt="<?php echo $fetch_cart['p_name']; ?>" class="img-fluid">
                                            <?php echo $fetch_cart['p_name']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        NT$<?php echo $fetch_cart['p_price']; ?>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number" id="qty[]" name="qty[]" value="<?php echo $fetch_cart['qty']; ?>" min="1" max="49" cart_id="<?php echo $fetch_cart['cart_id']; ?>" required>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $fetch_cart['p_price'] * $fetch_cart['qty']; ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-times" onclick="confirmLink('確定刪除此商品?','./cartDelete.php?mode=1&cart_id=<?php echo $fetch_cart['cart_id']; ?>')"></i>
                                    </td>
                                </tr>
                            <?php
                                $cartTotal += $fetch_cart['p_price'] * $fetch_cart['qty'];
                            } ?>
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <td colspan="5"></td>
                                <td>
                                    <a onclick="confirmLink('確定刪除全商品?','./cartDelete.php?mode=2')">刪除<br>全部</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <br>
                <div class="table-responsive-md">
                    <table class="table mt-3">
                        <thead class="text-start fs-5">
                            <tr class="table-light">
                                <td colspan="2">訂單資訊</td>
                            </tr>
                        </thead>
                        <tbody class="text-start">
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
                                <?php $total = $cartTotal + $shippingFee;
                                $_SESSION["total"] = $total;
                                ?>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text-end">
                                <td colspan="2">
                                    <a href="./class.php" style="text-decoration:none">
                                        < 繼續購物</a>　
                                            <a href="./checkout.php" style="text-decoration:none">前往結帳 ></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php } else { ?>

            <div class="emptyCart col-md-4 col-sm-6 col-8 text-center">
                <i class="fa-solid fa-circle-exclamation mb-5"></i>
                <h5>購物車是空的</h5>
                <a href="./class.php">
                    <button class="btn w-75 mt-5">
                        返回購物
                    </button>
                </a>
            </div>

        <?php } ?>

    </div>

</div>