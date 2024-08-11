<?php
$max_rows_rs = 8;
$page_num_rs = 0;
if (isset($_GET['page_num_rs'])) {
    $page_num_rs = $_GET['page_num_rs'];
}

$start_row_rs = $max_rows_rs * $page_num_rs;

if (isset($_GET['search_name'])) {
    // $query_product 新增條件
    $query_product = sprintf("SELECT * FROM product,product_img,pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.class_id=pyclass.class_id AND product.p_name LIKE '%s' ORDER BY product.p_id DESC", '%' . $_GET['search_name'] . '%');
} elseif (isset($_GET['level']) && $_GET['level'] == 1) {
    // $query_product 新增查詢 pyclass 與條件 
    $query_product = sprintf("SELECT * FROM product,product_img,pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.class_id=pyclass.class_id AND pyclass.uplink='%d' ORDER BY product.p_id DESC", $_GET['class_id']);
} elseif (isset($_GET['class_id'])) {
    // $query_product 新增條件 product.classid='%d', $_GET['class_id']
    $query_product = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.class_id='%d' ORDER BY product.p_id ASC", $_GET['class_id']);
} else {
    $query_product = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id ASC");
}

$query_product_limit =  sprintf("%s LIMIT %d,%d", $query_product, $start_row_rs, $max_rows_rs);

$product_limit = $link->query($query_product_limit);
$row_num = 1;
?>
<?php
while ($product_result = $product_limit->fetch()) { ?>
    <?php if ($row_num % 4 == 1) { ?>
        <div class="product row text-center justify-content-center">
        <?php } ?>

        <div class="card col-md-2 col-sm-4 col-6">
            <a href="#"><img src="./images/product/<?php echo $product_result['img_file']; ?>" class="card-img-top" alt="<?php echo $product_result['p_name']; ?>" title="<?php echo $product_result['p_intro']; ?>"></a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $product_result['p_name']; ?></h5>
                <p class="card-text">NT$ <?php echo $product_result['p_price']; ?></p>
                <a href="#" class="btn">加入購物車</a>
            </div>
        </div>

        <?php if ($row_num == $product_limit->rowCount()) {
            if ($row_num % 4 != 0) {
                for ($empty_card = 0; $empty_card < abs($row_num % 4 - 4); $empty_card++) { ?>
                    <div class="card col-md-2 col-sm-4 col-6">
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
    if (isset($_GET['total_rows_rs'])) {
        $total_rows_rs = $_GET['total_rows_rs'];
    } else {
        $all_rs = $link->query($query_product);
        $total_rows_rs = $all_rs->rowCount();
    }

    $total_pages_rs = ceil($total_rows_rs / $max_rows_rs) - 1;
    $prev_rs = "&laquo";
    $next_rs = "&raquo";
    $separator = "|";
    $max_links = 20;
    $pages_rs = buildNavigation($page_num_rs, $total_pages_rs, $prev_rs, $next_rs, $separator, "rs",$max_links, true, 3, );
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
        </ul>
    </nav>
</div>