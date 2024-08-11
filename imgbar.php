<div class="imgbar">
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12 img-flex">
            <?php
            $query_brand = "SELECT * FROM brand,pyclass WHERE brand.class_id=pyclass.class_id ORDER BY b_id";
            $brand = $link->query($query_brand);
            ?>

            <?php
            if (isset($_GET['class_id'])) {
                if (isset($_GET['level']) && $_GET['level'] == 1) {
                    $now_brand = $_GET['class_id'];
                } else {
                    $query_pyclass_class_id = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d ORDER BY sort", $_GET['class_id']);
                    $pyclass_class_id = $link->query($query_pyclass_class_id);
                    $pyclass_result_class_id = $pyclass_class_id->fetch();

                    $now_brand = $pyclass_result_class_id['uplink'];
                }
            } else {
                $now_brand = 0;
            }
            ?>

            <?php
            while ($brand_result = $brand->fetch()) {
            ?>
                <a href="drugstore.php?class_id=<?php echo $brand_result['class_id']; ?>&level=<?php echo $brand_result['level']; ?>">
                    <div class="img-container">
                        <img src="./images/brand/<?php echo $brand_result['b_logo'] ?>" alt="<?php echo $brand_result['cname'] ?>" title="<?php echo $brand_result['cname'] ?>" class="<?php echo boxShadow($now_brand, $brand_result['class_id']); ?>">
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>

    <?php
    if (isset($_GET['class_id'])) {

        if (isset($_GET['level']) && $_GET['level'] == 1) {
            $query_pyclass_level_2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $_GET['class_id']);

            $all_href = "class_id=" . $_GET['class_id'];
            $check_brand = $_GET['class_id'];
        } else {
            $query_pyclass_class_id = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d ORDER BY sort", $_GET['class_id']);
            $pyclass_class_id = $link->query($query_pyclass_class_id);
            $pyclass_result_class_id = $pyclass_class_id->fetch();

            $query_pyclass_level_2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass_result_class_id['uplink']);

            $all_href = "class_id=" . $pyclass_result_class_id['uplink'] . "&level=1";
            $check_brand = 0;
        }

        $now_class = $_GET['class_id'];
        $pyclass_level_2 = $link->query($query_pyclass_level_2);
    ?>


        <div class="row text-center">
            <nav class="navbar navbar-expand-lg justify-content-center">
                <div>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="drugstore.php?<?php echo $all_href; ?>">
                                    <?php echo nowClass($now_class, $check_brand); ?> 全部
                                </a>
                            </li>

                            <?php while ($pyclass_result_level_2 = $pyclass_level_2->fetch()) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="drugstore.php?class_id=<?php echo $pyclass_result_level_2['class_id']; ?>">
                                        <?php echo nowClass($_GET['class_id'], $pyclass_result_level_2['class_id']); ?>
                                        <?php
                                        // if ($pyclass_result_level_2['class_id'] == $_GET['class_id']) {
                                        //     echo "<i class='fa-solid fa-location-dot'> </i>";
                                        // } 
                                        ?>
                                        <?php echo $pyclass_result_level_2['cname']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    <?php } ?>

</div>