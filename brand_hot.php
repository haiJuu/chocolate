<div class="brand-start">
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12">
            <h2>進駐品牌</h2>
        </div>
    </div>

    <br>
    <div class="row text-center align-items-end">
        <div class="col-md-2 col-sm-4 col-4 offset-md-3">
            <img src="./images/brand/SGS.png" style="width:5vw">
            <div>從產地嚴選原料經 SGS 檢驗合格</div>
        </div>
        <div class="col-md-2 col-sm-4 col-4">
            <img src="./images/brand/NATURAL100.png" style="width:5vw">
            <div>留住天然健康 | 低加工 | 零添加</div>
        </div>
        <div class="col-md-2 col-sm-4 col-4">
            <img src="./images/brand/EU_standards.png" style="width:5vw">
            <div>所有巧克力產品符合歐盟標準</div>
        </div>
    </div>
</div>

<div class="brand row">
    <?php
    $select_brand = "SELECT * FROM brand ORDER BY b_id";
    $brand = $link->query($select_brand);
    ?>

    <?php
    while ($fetch_brand = $brand->fetch()) {
    ?>

        <div class="card text-bg-light col-md-5 col-sm-10 col-10 text-start mb-5">
            <img src="./images/brand/<?php echo $fetch_brand['b_logo'] ?>" class="card-img img-fluid" alt="<?php echo $fetch_brand['cname'] ?>">
            <div class="card-img-overlay ">

                <p class="card-text">
                    <?php echo $fetch_brand['b_content'] ?>
                </p>
                <!-- <a href="#">
                    <button class="card-title">更多關於 <?php echo $fetch_brand['ename'] ?></button>
                </a> -->
            </div>

            <div class="hot-start text-start">
                <!-- <i class="fas fa-crown"></i> <i class="fas fa-crown"></i> <i class="fas fa-crown"></i> <i class="fas fa-crown"></i> <i class="fas fa-crown"></i> -->
                品 × 牌 × 暢 × 銷
            </div>

            <div class="hot">
                <?php
                $select_hot = sprintf("SELECT * FROM hot,product,product_img WHERE hot.b_id=%d AND hot.p_id=product.p_id AND hot.p_id=product_img.p_id AND product_img.sort=1 ORDER BY h_sort", $fetch_brand['b_id']);
                $hot = $link->query($select_hot);
                ?>
                <?php
                while ($fetch_hot = $hot->fetch()) {
                ?>
                    <div class="card">
                        <a href="goods.php?p_id=<?php echo $fetch_hot['p_id'] ?>"><img src="./images/product/<?php echo $fetch_hot['img_file']; ?>" class="card-img-top" alt="BRAND HOT PRODUCT <?php echo $fetch_hot['h_sort']; ?>" title="<?php echo $fetch_hot['p_name']; ?>"></a>
                    </div>
                <?php } ?>
            </div>

        </div>
    <?php } ?>
</div>