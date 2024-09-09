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

<?php
if ($uorder->rowCount() != 0) {
?>

    <div class="order">
        <div class="accordion" id="accordionExample">

            <?php while ($fetch_uorder = $uorder->fetch()) { ?>

                <div class="accordion-item">

                    <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                        <a class="accordion-button w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>" style="text-decoration: none;">
                            <div class="table-responsive-md w-100">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td width="15%">訂單編號</td>
                                            <td width="20%">下單日期時間</td>
                                            <td width="15%">付款方式</td>
                                            <td width="15%">訂單狀態</td>
                                            <td width="10%">收件人</td>
                                            <td width="25%">地址</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
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
                            $ptotal = 0;
                            ?>

                            <div class="table-responsive-md w-100">
                                <table class="table mt-3">
                                    <thead>
                                        <tr class="table-light">
                                            <td width="10%">圖片</td>
                                            <td width="30%">名稱</td>
                                            <td width="10%">價格</td>
                                            <td width="10%">數量</td>
                                            <td width="15%">小計</td>
                                            <td width="15%">狀態</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($fetch_cart = $cart->fetch()) {
                                        ?>
                                            <tr>
                                                <td><img src="./images/product/<?php echo $fetch_cart['img_file']; ?>" alt="<?php echo $fetch_cart['p_name']; ?>" class="img-fluid"></td>
                                                <td><?php echo $fetch_cart['p_name']; ?></td>
                                                <td>
                                                    <h4 class="color_e600a0 pt-1"><?php echo $fetch_cart['p_price']; ?></h4>
                                                </td>
                                                <td style="min-width:100px">
                                                    <?php echo $fetch_cart['qty']; ?>
                                                </td>
                                                <td>
                                                    <h4 class="color_e600a0 pt-1"><?php echo $fetch_cart['p_price'] * $fetch_cart['qty']; ?></h4>
                                                </td>
                                                <td><?php echo $fetch_cart['status'] ?></td>
                                            </tr>
                                        <?php $ptotal += $fetch_cart['p_price'] * $fetch_cart['qty'];
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">累計：<?php echo $ptotal; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">運費：100</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="color_red">總計：<?php echo $ptotal + 100; ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <?php $i++;
            } ?>

        </div>
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

    </div>

    <div class="col-md-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
            </ul>
        </nav>
    </div>

<?php } else { ?>

    <div class="alert alert-info" role="alert">
        抱歉，目前購物車沒有任何訂單。
    </div>

<?php } ?>