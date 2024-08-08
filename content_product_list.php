<hr>
<div class="product-start">
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12">
            <h2>商品一覽</h2>
        </div>
    </div>

    <br>
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12">
            <?php
            $query_brand = "SELECT * FROM brand ORDER BY b_id";
            $brand = $link->query($query_brand);
            while ($brand_result = $brand->fetch()) {
            ?>
                <img src="./images/brand/<?php echo $brand_result['b_logo'] ?>" alt="<?php echo $brand_result['cname'] ?>" style="width:3vw;margin-right:2rem;border-radius:10%">
            <?php } ?>
        </div>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12">
            <div>黑巧克力 | 風味巧克力 | 牛奶巧克力 | 巧克力豆 | 生巧克力</div>
        </div>
    </div>
</div>

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
    <?php if ($i % 6 == 1) { ?>
        <div class="product row text-center">
        <?php } ?>

        <div class="card col-md-2 col-sm-4 col-6">
            <a href="#"><img src="./images/product/<?php echo $pLFetch['img_file']; ?>" class="card-img-top" alt="<?php echo $pLFetch['p_name']; ?>" title="<?php echo $pLFetch['p_intro']; ?>"></a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $pLFetch['p_name']; ?></h5>
                <p class="card-text">NT$ <?php echo $pLFetch['p_price']; ?></p>
                <a href="#" class="btn">加入購物車</a>
                <!-- <a href="#" class="btn"><i class="fas fa-regular fa-cart-shopping"></i></a> -->
            </div>
        </div>

        <?php if ($i % 6 == 0 || $i == $productList->rowCount()) { ?>
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