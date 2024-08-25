<?php
$max_rows_rs = 8;
$page_num_rs = 0;
if (isset($_GET['page_num_rs'])) {
    $page_num_rs = $_GET['page_num_rs'];
}

$start_rows_rs = $max_rows_rs * $page_num_rs;

if (isset($_GET['search_name'])) {
    // $select_product 新增條件
    $select_product1 = sprintf("SELECT * FROM product,product_img,pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.class_id=pyclass.class_id AND product.p_name LIKE '%s' ORDER BY product.p_id DESC", '%' . $_GET['search_name'] . '%');
} elseif (isset($_GET['level']) && $_GET['level'] == 1) {
    // $select_product 新增查詢 pyclass 與條件 
    $select_product1 = sprintf("SELECT * FROM product,product_img,pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.class_id=pyclass.class_id AND pyclass.uplink='%d' ORDER BY product.p_id DESC", $_GET['class_id']);
} elseif (isset($_GET['class_id'])) {
    // $select_product 新增條件 product.classid='%d', $_GET['class_id']
    $select_product1 = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.class_id='%d' ORDER BY product.p_id ASC", $_GET['class_id']);
} else {
    $select_product1 = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id ASC");
}

$select_product2 =  sprintf("%s LIMIT %d,%d", $select_product1, $start_rows_rs, $max_rows_rs);

$product2 = $link->query($select_product2);
$row_num = 1;
?>
<?php
while ($fetch_product2 = $product2->fetch()) { ?>
    <?php if ($row_num % 4 == 1) { ?>
        <div class="product row text-center justify-content-center">
        <?php } ?>

        <div class="card col-md-2 col-sm-3 col-6">
            <a href="goods.php?p_id=<?php echo $fetch_product2['p_id']; ?>">
                <div class="img-container">
                    <img src="./images/product/<?php echo $fetch_product2['img_file']; ?>" class="card-img-top" alt="<?php echo $fetch_product2['p_name']; ?>" title="<?php echo $fetch_product2['p_intro']; ?>">
                </div>
            </a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $fetch_product2['p_name']; ?></h5>
                <p class="card-text">NT$ <?php echo $fetch_product2['p_price']; ?></p>
                <button name="add_cart[]" id="add_cart" type="button" class="btn" onclick="addCart(<?php echo $fetch_product2['p_id']; ?>)" style="background-color:<?php echo btnColor($fetch_product2['b_id']); ?>">加入購物車</button>
            </div>
        </div>

        <?php if ($row_num == $product2->rowCount()) {
            if ($row_num % 4 != 0) {
                for ($empty_card = 0; $empty_card < abs($row_num % 4 - 4); $empty_card++) { ?>
                    <div class="card col-md-2 col-sm-3 col-6">
                        <div class="card-body">
                        </div>
                    </div>
        <?php }
            }
        }
        ?>

        <?php if ($row_num % 4 == 0) { ?>
        </div>
    <?php } ?>

<?php $row_num++;
} ?>

<div class="row mt-2">
    <?php
    if (isset($_GET['count_product1'])) {
        $count_product1 = $_GET['count_product1'];
    } else {
        $product1 = $link->query($select_product1);
        $count_product1 = $product1->rowCount();
    }

    $total_pages_rs = ceil($count_product1 / $max_rows_rs) - 1;
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