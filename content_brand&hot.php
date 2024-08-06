<div class="brand row">
    <?php
    $query_brand = "SELECT * FROM brand ORDER BY b_id";
    $brand = $link->query($query_brand);
    ?>

    <?php
    while ($brand_result = $brand->fetch()) {
    ?>

        <div class="card text-bg-light col-md-5 col-sm-10 col-10 text-end">
            <img src="./images/brand/<?php echo $brand_result['b_logo'] ?>" class="card-img img-fluid" alt="<?php echo $brand_result['cname'] ?>">
            <div class="card-img-overlay ">

                <p class="card-text">
                    <?php echo $brand_result['b_content'] ?>
                </p>
                <!-- <a href="#">
                    <button class="card-title">更多關於 <?php echo $brand_result['ename'] ?></button>
                </a> -->
            </div>

            <div class="hot">
                <?php
                $b_id = $brand_result['b_id'];
                $query_brand_hot = "SELECT * FROM hot,product,product_img WHERE hot.b_id=$b_id AND hot.p_id=product.p_id AND hot.p_id=product_img.p_id AND product_img.sort=1 ORDER BY h_sort";
                $brand_hot = $link->query($query_brand_hot);
                ?>
                <?php
                while ($brand_hot_result = $brand_hot->fetch()) {
                ?>
                    <div class="card">
                        <img src="./images/product/<?php echo $brand_hot_result['img_file']; ?>" class="card-img-top" alt="BRAND HOT PRODUCT <?php echo $brand_hot_result['h_sort']; ?>" title="<?php echo $brand_hot_result['p_name']; ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>