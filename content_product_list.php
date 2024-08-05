<?php
$maxRows_rs = 12;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
    $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $maxRows_rs * $pageNum_rs;

$sqlString0501 = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id ASC", $maxRows_rs);

$sqlString05 = sprintf("%s LIMIT %d,%d", $sqlString0501, $startRow_rs, $maxRows_rs);
$productList = $link->query($sqlString05);
$i = 1;
?>
<?php
while ($pLFetch = $productList->fetch()) { ?>
    <?php if ($i % 4 == 1) { ?>
        <div class="row text-center">
        <?php } ?>
        <div class="card col-md-3">
            <img src="./images/product/<?php echo $pLFetch['img_file']; ?>" class="card-img-top" alt="<?php echo $pLFetch['p_name']; ?>" title="<?php echo $pLFetch['p_name']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $pLFetch['p_name']; ?></h5>
                <p class="card-text"><?php echo mb_substr($pLFetch['p_intro'], 0, 30, "utf-8"); ?></p>
                <p class="card-text">NT$ <?php echo $pLFetch['p_price']; ?></p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
            </div>
        </div>

        <?php if ($i % 4 == 0 || $i == $productList->rowCount()) { ?>
        </div>
    <?php } ?>

<?php $i++;
} ?>

<div class="row mt-2">
    <?php
    if (isset($_GET['totalRows_rs'])) {
        $totalRows_rs = $_GET['totalRows_rs'];
    } else {
        $all_rs = $link->query($sqlString0501);
        $totalRows_rs = $all_rs->rowCount();
    }

    $totalPages_rs = ceil($totalRows_rs / $maxRows_rs) - 1;
    $prev_rs = "&laquo";
    $next_rs = "&raquo";
    $separator = "|";
    $max_links = 20;
    $pages_rs = buildNavigation($pageNum_rs, $totalPages_rs, $prev_rs, $next_rs, $separator, $max_links, true, 3, "rs");
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
        </ul>
    </nav>
</div>