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
            <div>已完成</div>
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
                    <div class="accordion-header" id="heading">
                        <a class="accordion-button collapsed w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="true" aria-controls="collapse">

                            <h2 class="text-center fs-5" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                <div class="mt-3 mb-3"><strong>合計:NT$<?php echo $total ?></strong></div>
                                <div class="mb-3">購物車 (<?php echo $cart->rowCount() ?>件)</div>
                            </h2>

                        </a>
                    </div>

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

                            <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse" style="border-top:1px solid lightgray;">
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    $select_addbook = sprintf("SELECT *,city.city_name,town.town_name FROM addbook,city,town WHERE email_id='%d' AND setdefault='1' AND addbook.zip=town.post AND town.auto_no=city.auto_no", $_SESSION['email_id']);
    $addbook = $link->query($select_addbook);

    if ($addbook && $addbook->rowCount() != 0) {
        $fetch_addbook = $addbook->fetch();
        $cname = $fetch_addbook["cname"];
        $mobile = $fetch_addbook["mobile"];
        $zip = $fetch_addbook["zip"];
        $address = $fetch_addbook["address"];
        $city_name = $fetch_addbook["city_name"];
        $town_name = $fetch_addbook["town_name"];
    } else {
        $cname = "";
        $mobile = "";
        $zip = "";
        $address = "";
        $city_name = "";
        $town_name = "";
    }

    ?>

    <div class="row justify-content-center">
        <div class="table-responsive-md col-md-4 col-sm-10 col-12">
            <table class="table mt-3">
                <thead>
                    <tr class="table-light fs-5">
                        <td>顧客資料</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>顧客姓名：<?php echo $_SESSION['cname']; ?></p>
                            <p>電子信箱：<?php echo $_SESSION['email']; ?></p>
                            <p>電話號碼：<?php echo $_SESSION['mobile']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table mt-3">
                <thead>
                    <tr class="table-light fs-5">
                        <td>電子發票</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="e_invoice">
                            <p>載具編號 (選填)
                                <input type="text" id="e_invoice" name="e_invoice">
                            </p>
                            <p>公司抬頭 (選填)<input type="text" id="company_name" name="company_name"></p>
                            <p>統一編號 (選填)<input type="text" id="tax_ID_number" name="tax_ID_number"></p>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <div class="table-responsive-md col-md-4 col-sm-10 col-12">
            <table class="table mt-3">
                <thead>
                    <tr class="table-light">
                        <td class="fs-5">收件資料</td>
                        <td class="text-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">其他收件人</a>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <p>收件姓名：<?php echo $cname; ?></p>
                            <p>電話號碼：<?php echo $mobile; ?></p>
                            <p>收件地址：<?php echo $zip . $city_name . $town_name . $address; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table mt-3">
                <thead>
                    <tr class="table-light fs-5">
                        <td>付款資料</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                <select name="howpay" id="howpay" class="howpay" style="padding:5px">
                                    <option value="">請選擇付款方式</option>
                                    <option value="cod" selected>貨到付款</option>
                                    <option value="credit">信用卡</option>
                                    <option value="bank">銀行轉帳</option>
                                    <option value="epay">電子支付</option>
                                </select>
                            </p>
                            <div id="howpayContent" class="howpayContent"></div>
                        </td>
                    </tr>
            </table>

            <table class="table mt-3">
                <thead>
                    <tr class="table-light fs-5">
                        <td>訂單備註</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><textarea class="remark w-100" name="remark" id="remark" rows="3" placeholder="有什麼想告訴賣家嗎?"></textarea></td>
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
                        <a href="./cart.php" style="text-decoration:none">
                            < 返回購物車</a>
                    </td>
                    <td class="text-end">
                        <button type="button" id="uorder" name="uorder" class="btn w-100">提交訂單</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<!-- Addbook Modal -->
<?php
$select_addbook = sprintf("SELECT *,city.city_name,town.town_name FROM addbook,city,town WHERE email_id='%d' AND addbook.zip=town.post AND town.auto_no=city.auto_no", $_SESSION['email_id']);
$addbook = $link->query($select_addbook);
?>

<div class="modal fade checkoutModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">收件人資訊</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="cname" id="cname" class="form-control" placeholder="收件姓名">
                        </div>
                        <div class="col">
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="電話號碼">
                        </div>
                        <div class="col">
                            <select name="city" id="city" class="form-control">
                                <option value="">選擇縣市</option>

                                <?php
                                $select_city = "SELECT * FROM city WHERE State=0";
                                $city = $link->query($select_city);
                                while ($fetch_city = $city->fetch()) { ?>

                                    <option value="<?php echo $fetch_city['auto_no'] ?>"><?php echo $fetch_city['city_name'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <select name="town" id="town" class="form-control">
                                <option value="">選擇鄉鎮市區</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <input type="hidden" name="zip" id="zip" value="">
                            <label for="address" id="zipcode" name="zipcode"></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="地址">
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-auto">
                            <button type="button" class="btn btn-success" id="addbook" name="addbook">新增資料</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">選取</th>
                            <th scope="col">收件姓名</th>
                            <th scope="col">電話號碼</th>
                            <th scope="col">收件地址</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fetch_addbook = $addbook->fetch()) { ?>
                            <tr>
                                <th scope="row">
                                    <input type="radio" name="setdefault" id="setdefault[]" value="<?php echo $fetch_addbook['address_id'] ?>" <?php echo ($fetch_addbook['setdefault']) ? 'checked' : ''; ?>>
                                </th>
                                <td><?php echo $fetch_addbook['cname']; ?></td>
                                <td><?php echo $fetch_addbook['mobile']; ?></td>
                                <td><?php echo $fetch_addbook['zip'] . $fetch_addbook['city_name'] . $fetch_addbook['town_name'] . $fetch_addbook['address']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>