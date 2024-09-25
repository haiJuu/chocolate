<?php
$max_rows_rs = 5;
$page_num_rs = 0;


if (isset($_GET['page_num_rs'])) {
    $page_num_rs = $_GET['page_num_rs'];
}
$start_rows_rs = $page_num_rs * $max_rows_rs;

$select_uorder = sprintf("SELECT uorder.order_id,uorder.create_date ,uorder.remark,howpay.ms_name AS howpay,status.ms_name AS status,addbook.* FROM uorder,addbook,multiselect AS howpay,multiselect AS status WHERE howpay.ms_id=uorder.howpay AND status.ms_id=uorder.status AND uorder.email_id='%d' AND uorder.address_id=addbook.address_id ORDER BY uorder.create_date DESC LIMIT %d,%d", $_SESSION['email_id'], $start_rows_rs, $max_rows_rs);

$uorder = $link->query($select_uorder);

$i = 1;
?>

<div class="order">

    <?php
    if ($uorder->rowCount() != 0) {
    ?>
        <div class="accordion row" id="accordionExample">

            <?php while ($fetch_uorder = $uorder->fetch()) { ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                        <a class="accordion-button w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>" style="text-decoration: none;">
                            <div class="table-responsive-md w-100">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <td width="15%">訂單編號</td>
                                            <td width="20%">訂單日期</td>
                                            <td width="15%">付款方式</td>
                                            <td width="15%">訂單狀態</td>
                                            <td width="10%">收件人</td>
                                            <td width="25%">地址</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><?php echo $fetch_uorder['order_id']; ?></td>
                                            <td><?php echo $fetch_uorder['create_date']; ?></td>
                                            <td><?php echo $fetch_uorder['howpay']; ?></td>
                                            <td><?php echo $fetch_uorder['status']; ?></td>
                                            <td><?php echo $fetch_uorder['cname']; ?></td>
                                            <td><?php echo $fetch_uorder['address']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </h2>

                    <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == 1) ? 'show' : ''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <?php
                            $select_cart = sprintf("SELECT *,status.ms_name AS status FROM cart,product,product_img,multiselect AS status WHERE cart.order_id='%s' AND status.ms_id=cart.status AND cart.p_id=product_img.p_id AND product.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cart.create_date DESC", $fetch_uorder['order_id']);
                            $cart = $link->query($select_cart);
                            $cartTotal = 0;
                            ?>

                            <div class="table-responsive-md w-100">
                                <table class="table mt-3">
                                    <thead>
                                        <tr class="table-light text-center">
                                            <td td width="30%" class="text-start">商品資訊</td>
                                            <td width="15%">價格</td>
                                            <td width="15%">數量</td>
                                            <td width="15%">小計</td>
                                            <td width="25%">狀態</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($fetch_cart = $cart->fetch()) {
                                        ?>
                                            <tr class="text-center">
                                                <td class="text-start" style="display:flex"><img src="./images/product/<?php echo $fetch_cart['img_file']; ?>" alt="<?php echo $fetch_cart['p_name']; ?>" class="img-fluid">
                                                    <div><?php echo $fetch_cart['p_name']; ?></div>
                                                </td>
                                                <td>
                                                    NT$ <?php echo $fetch_cart['p_price']; ?>
                                                </td>
                                                <td style="min-width:100px">
                                                    <?php echo $fetch_cart['qty']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch_cart['p_price'] * $fetch_cart['qty']; ?>
                                                </td>
                                                <td><?php echo $fetch_cart['status'] ?></td>
                                            </tr>
                                        <?php $cartTotal += $fetch_cart['p_price'] * $fetch_cart['qty'];
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center" style="border-color:white">
                                            <td colspan="3"></td>
                                            <td>
                                                <div class="mb-3 mt-3">小計：</div>
                                                <div class="mb-3">運費：</div>
                                                <div>合計：</div>
                                            </td>
                                            <td>
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

                            <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>" style="border-top:1px solid lightgray;">
                            </a>

                        </div>
                    </div>
                </div>

            <?php $i++;
            } ?>

        </div>


        <div class="row mt-2">

            <?php
            if (isset($_GET['count_uorder'])) {
                $count_uorder = $_GET['count_uorder'];
            } else {

                $select_uorder = sprintf("SELECT uorder.order_id,uorder.create_date ,uorder.remark,howpay.ms_name AS howpay,status.ms_name AS status,addbook.* FROM uorder,addbook,multiselect AS howpay,multiselect AS status WHERE howpay.ms_id=uorder.howpay AND status.ms_id=uorder.status AND uorder.email_id='%d' AND uorder.address_id=addbook.address_id ORDER BY uorder.create_date DESC", $_SESSION['email_id']);

                $uorder = $link->query($select_uorder);
                $count_uorder = $uorder->rowCount();
            }

            $total_pages_rs = ceil($count_uorder / $max_rows_rs) - 1;
            $prev_pages_rs = "&laquo";
            $next_pages_rs = "&raquo";
            $separator = "|";
            $max_links = 20;
            $pages_rs = buildNavigation($page_num_rs, $total_pages_rs, $prev_pages_rs, $next_pages_rs, $separator, "rs", $max_links, true, 3);

            ?>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
                </ul>
            </nav>

        </div>


    <?php } else { ?>

        <div class="row justify-content-center">
            <div class="emptyOrder col-md-4 col-sm-6 col-8 text-center">
                <i class="fa-solid fa-circle-exclamation mb-5"></i>
                <h5>訂單沒有資料</h5>

                <button id="goToUpper" class="btn w-75 mt-5">
                    回上一頁
                </button>
            </div>
        </div>

    <?php } ?>

</div>