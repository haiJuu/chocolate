<hr>
<div class="brand-start">
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12">
            <h2>進駐品牌</h2>
        </div>
    </div>

    <br>
    <div class="row text-center align-items-end">
        <div class="col-md-2 col-sm-4 col-4 offset-md-3">
            <img src="./images/SGS.png" style="width:5vw">
            <div>從產地嚴選原料經 SGS 檢驗合格</div>
        </div>
        <div class="col-md-2 col-sm-4 col-4">
            <img src="./images/NATURAL100.png" style="width:5vw">
            <div>留住天然健康 | 低加工 | 零添加</div>
        </div>
        <div class="col-md-2 col-sm-4 col-4">
            <img src="./images/EU_standards.png" style="width:5vw">
            <div>所有巧克力產品符合歐盟標準</div>
        </div>
    </div>
</div>

<div class="brand row">
    <?php
    $query_brand = "SELECT * FROM brand ORDER BY b_id";
    $brand = $link->query($query_brand);
    ?>

    <?php
    while ($brand_result = $brand->fetch()) {
    ?>

        <div class="card text-bg-light col-md-5 col-sm-10 col-10 text-start mb-5">
            <img src="./images/brand/<?php echo $brand_result['b_logo'] ?>" class="card-img img-fluid" alt="<?php echo $brand_result['cname'] ?>">
            <div class="card-img-overlay ">

                <p class="card-text">
                    <?php echo $brand_result['b_content'] ?>
                </p>
                <!-- <a href="#">
                    <button class="card-title">更多關於 <?php echo $brand_result['ename'] ?></button>
                </a> -->
            </div>
            <div class="hot-start"><i class="fas fa-crown"></i> 熱銷商品</div>

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
                        <a href="#"><img src="./images/product/<?php echo $brand_hot_result['img_file']; ?>" class="card-img-top" alt="BRAND HOT PRODUCT <?php echo $brand_hot_result['h_sort']; ?>" title="<?php echo $brand_hot_result['p_name']; ?>"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>