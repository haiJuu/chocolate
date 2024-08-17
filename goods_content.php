<div class="card goods">
    <div class="row justify-content-center">

        <div class="col-md-4 col-sm-8 col-10">
            <?php
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort < 6 ORDER BY sort DESC", $_GET['p_id']);
            $product_img = $link->query($select_product_img);
            $fetch_product_img = $product_img->fetch()
            ?>

            <img id="showGoods" name="showGoods" src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid rounded-start" alt="<?php echo $fetch_product['p_name']; ?>" title="<?php echo $fetch_product['p_name']; ?>">

            <div class="row mt-2">
                <?php do { ?>
                    <div class="col-md-3 col-sm-3">
                        <a href="./images/product/<?php echo $fetch_product_img['img_file'] ?>" rel="group" class="fancybox" title="<?php echo $fetch_product['p_name']; ?>">
                            <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" alt="<?php echo $fetch_product['p_name']; ?>" title="<?php echo $fetch_product['p_name']; ?>" class="img-fluid">
                        </a>
                    </div>
                <?php } while ($fetch_product_img = $product_img->fetch()) ?>
            </div>
        </div>

        <div class="col-md-4 col-sm-8 col-10">
            <div class="card-body">
                <h4 class="card-title"><?php echo $fetch_product['p_name']; ?></h4>
                <p class="card-text"><?php echo $fetch_product['p_intro']; ?></p>
                <h4 class="color_e600a0">$ <?php echo $fetch_product['p_price']; ?></h4>

                <div class="row">
                    <div class="col-md-12 col-sm-8 col-10 mt-3">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text color-success" id="inputGroup-sizing-lg">數量</span>
                            <input type="number" id="qty" name="qty" value="1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-8 col-10 mt-3">
                        <button name="add_cart" id="add_cart" type="button" class="btn btn-success btn-lg color-success" onclick="addcart(<?php echo $fetch_product['p_id']; ?>)">加入購物車</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row goodsmark justify-content-center text-center mt-5">

        <div class="col-md-3 col-sm-3 col-3"><a href="#product_mark1">商品介紹</a></div>
        <div class="col-md-3 col-sm-3 col-3"><a href="#product_mark2">獲獎紀錄</a></div>
        <div class="col-md-3 col-sm-3 col-3"><a href="#product_mark3">商品規格</a></div>
        <div class="col-md-3 col-sm-3 col-3"><a href="#product_mark4">運送方式</a></div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 justify-content-center mt-5">
            <a id="product_mark1">
                <h5>商品介紹</h5>
            </a>
            <?php echo $fetch_product['p_content'] ?>

            <div class="row">
                <?php
                $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort BETWEEN 6 AND 8 ORDER BY sort DESC", $_GET['p_id']);
                $product_img = $link->query($select_product_img);
                ?>

                <?php while ($fetch_product_img = $product_img->fetch()) { ?>
                    <div class="col-md-12 col-sm-12 col-12 mt-3">
                        <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                    </div>
                <?php }  ?>
            </div>

        </div>
        <div class="col-md-8 justify-content-center mt-5">
            <a id="product_mark2">
                <h5>獲獎紀錄</h5>
            </a>
            <?php echo $fetch_product['p_medal'] ?>

            <?php
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort=9", $_GET['p_id']);
            $product_img = $link->query($select_product_img);

            if ($product_img->rowCount() != 0) {
                $fetch_product_img = $product_img->fetch();
            ?>
                <div class="col-md-12 col-sm-12 col-12 mt-5">
                    <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                </div>

            <?php } ?>

        </div>
        <div class="col-md-8 justify-content-center mt-5">
            <a id="product_mark3">
                <h5>商品規格</h5>
            </a>
            <?php echo $fetch_product['p_other'] ?>

            <?php
            $select_product_img = sprintf("SELECT * FROM product_img WHERE product_img.p_id=%d AND product_img.sort=10", $_GET['p_id']);
            $product_img = $link->query($select_product_img);

            if ($product_img->rowCount() != 0) {
                $fetch_product_img = $product_img->fetch();
            ?>
                <div class="col-md-12 col-sm-12 col-12 mt-5">
                    <img src="./images/product/<?php echo $fetch_product_img['img_file']; ?>" class="img-fluid">
                </div>

            <?php } ?>

        </div>
        <div class="col-md-8 justify-content-center mt-5">
            <a id="product_mark4">
                <h5>運送方式</h5>
            </a>
            <?php echo ""; ?>
        </div>
    </div>

</div>