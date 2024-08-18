<div class="goods">
    <div class="card mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8 col-12 productImg mb-5 pe-3">
                <div class="me-3">
                    <?php
                    $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort < 6 ORDER BY sort DESC", $_GET['p_id']);
                    $product_img = $link->query($select_product_img);
                    $fetch_product_img = $product_img->fetch()
                    ?>
                    <?php do { ?>
                        <div>
                            <a href="./images/product/<?php echo $fetch_product_img['img_file'] ?>" rel="group" class="fancybox" title="<?php echo $fetch_product['p_name']; ?>">
                                <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" alt="<?php echo $fetch_product['p_name']; ?>" title="<?php echo $fetch_product['p_name']; ?>" class="img-fluid">
                            </a>
                        </div>
                    <?php } while ($fetch_product_img = $product_img->fetch()) ?>
                </div>
                <div>
                    <?php
                    $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort < 6 ORDER BY sort DESC", $_GET['p_id']);
                    $product_img = $link->query($select_product_img);
                    $fetch_product_img = $product_img->fetch()
                    ?>
                    <img id="showGoods" name="showGoods" src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid" alt="<?php echo $fetch_product['p_name']; ?>" title="<?php echo $fetch_product['p_name']; ?>">
                </div>
            </div>

            <div class="col-md-6 col-sm-8 col-12">
                <?php
                $select_brand = sprintf("SELECT * FROM brand,product WHERE brand.b_id=product.b_id AND product.p_id ='%d'", $_GET['p_id']);
                $brand = $link->query($select_brand);
                $fetch_brand = $brand->fetch()
                ?>

                <div class="productInfo">
                    <div class="img-container">
                        <img src="./images/brand/<?php echo $fetch_brand['b_logo']; ?>" alt="<?php echo $fetch_brand['cname']; ?>" title="<?php echo $fetch_brand['cname']; ?>" style="border: 1px solid <?php echo btnColor($fetch_brand['b_id']); ?>;">
                    </div>
                    <h4 class="card-title"><?php echo $fetch_product['p_name']; ?></h4>
                    <p class="card-text"><?php echo $fetch_product['p_intro']; ?></p>
                    <br>
                    <h5 class="color_e600a0">NT$ <?php echo $fetch_product['p_price']; ?></h5>
                    <div class="text-end mb-1"><label for="qty">數量</label></div>
                    <div>
                        <input type="number" id="qty" name="qty" value="1" class="w-100" min="0">
                    </div>
                    <button name="add_cart" id="add_cart" type="button" class="btn w-100 mt-3" onclick="addCart(<?php echo $fetch_product['p_id']; ?>)" style="background-color:<?php echo btnColor($fetch_brand['b_id']); ?>">加入購物車</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row goodsmark justify-content-center text-center mt-5">
        <div class="col-md-3 col-sm-3 col-3"><a href="#mark_description">商品描述</a></div>
        <div class="col-md-3 col-sm-3 col-3"><a href="#mark_award">獲獎紀錄</a></div>
        <div class="col-md-3 col-sm-3 col-3"><a href="#mark_spec">商品規格</a></div>
        <div class="col-md-3 col-sm-3 col-3"><a href="#mark_shipping">運送方式</a></div>
    </div>

    <div class="row justify-content-center text-center">
        <div class="col-md-7 justify-content-center mt-5">
            <a id="mark_description">
                <h5><strong>商品描述</strong></h5>
            </a>
            <hr>

            <?php echo $fetch_product['p_description'] ?>
            <div class="row justify-content-center">
                <?php
                $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort BETWEEN 6 AND 9 ORDER BY sort", $_GET['p_id']);
                $product_img = $link->query($select_product_img);
                while ($fetch_product_img = $product_img->fetch()) { ?>
                    <div class="col-md-10 col-sm-10 col-10 mt-3">
                        <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid mt-3">
                    </div>
                <?php }  ?>
            </div>
        </div>


        <div class="col-md-7 justify-content-center mt-5">
            <a id="mark_award">
                <h5><strong>獲獎紀錄</strong></h5>
            </a>
            <hr>
            <?php echo $fetch_product['p_award'] ?>

            <?php
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort=10", $_GET['p_id']);
            $product_img = $link->query($select_product_img);
            if ($product_img->rowCount() != 0) {
                $fetch_product_img = $product_img->fetch();
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-sm-10 col-10 mt-5">
                        <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="col-md-7 justify-content-center mt-5">
            <a id="mark_spec">
                <h5><strong>商品規格</strong></h5>
            </a>
            <hr>
            <?php echo $fetch_product['p_spec'] ?>

            <?php
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort=11", $_GET['p_id']);
            $product_img = $link->query($select_product_img);
            if ($product_img->rowCount() != 0) {
                $fetch_product_img = $product_img->fetch();
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-3 col-sm-3 col-6 mt-5">
                        <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                    </div>
                </div>
            <?php }
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort=12", $_GET['p_id']);
            $product_img = $link->query($select_product_img);
            if ($product_img->rowCount() != 0) {
                $fetch_product_img = $product_img->fetch();
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-sm-10 col-10 mt-5">
                        <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-7 justify-content-center mt-5">
            <a id="mark_shipping">
                <h5><strong>運送方式</strong></h4>
            </a>
            <hr>
            <?php echo $fetch_product['p_shipping'] ?>

            <?php
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort=16", $_GET['p_id']);
            $product_img = $link->query($select_product_img);
            if ($product_img->rowCount() != 0) {
                $fetch_product_img = $product_img->fetch();
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-sm-10 col-10 mt-5">
                        <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                    </div>
                </div class="row justify-content-center">
            <?php } ?>
        </div>
    </div>
</div>