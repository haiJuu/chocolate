<div class="imgbar">
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 col-12 img-flex">
            <?php
            $select_brand = "SELECT * FROM brand,pyclass WHERE brand.class_id=pyclass.class_id ORDER BY b_id";
            $brand = $link->query($select_brand);
            ?>

            <?php
            if (isset($_GET['class_id'])) {
                if (isset($_GET['level']) && $_GET['level'] == 1) {
                    $now_brand = $_GET['class_id'];
                } else {
                    $select_pyclass = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d ORDER BY sort", $_GET['class_id']);
                    $pyclass = $link->query($select_pyclass);
                    $fetch_pyclass = $pyclass->fetch();

                    $now_brand = $fetch_pyclass['uplink'];
                }
            } else {
                $now_brand = 0;
            }
            ?>

            <?php
            while ($fetch_brand = $brand->fetch()) {
            ?>
                <a href="drugstore.php?class_id=<?php echo $fetch_brand['class_id']; ?>&level=<?php echo $fetch_brand['level']; ?>">
                    <div class="img-container">
                        <img src="./images/brand/<?php echo $fetch_brand['b_logo'] ?>" alt="<?php echo $fetch_brand['cname'] ?>" title="<?php echo $fetch_brand['cname'] ?>" class="<?php echo boxShadow($now_brand, $fetch_brand['class_id']); ?>">
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>

    <?php
    if (isset($_GET['class_id'])) {

        if (isset($_GET['level']) && $_GET['level'] == 1) {
            $select_pyclass = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $_GET['class_id']);

            $drugstore_href = "class_id=" . $_GET['class_id'];
            $check_class = $_GET['class_id'];
        } else {
            $select_pyclass = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d ORDER BY sort", $_GET['class_id']);
            $pyclass = $link->query($select_pyclass);
            $fetch_pyclass = $pyclass->fetch();

            $select_pyclass = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $fetch_pyclass['uplink']);

            $drugstore_href = "class_id=" . $fetch_pyclass['uplink'] . "&level=1";
            $check_class = 0;
        }

        $now_class = $_GET['class_id'];
        $pyclass = $link->query($select_pyclass);
    ?>


        <div class="row text-center">
            <nav class="navbar navbar-expand-lg justify-content-center">
                <div>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="drugstore.php?<?php echo $drugstore_href; ?>">
                                    <?php echo locationDot($now_class, $check_class); ?> 全部
                                </a>
                            </li>

                            <?php while ($fetch_pyclass = $pyclass->fetch()) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="drugstore.php?class_id=<?php echo $fetch_pyclass['class_id']; ?>">
                                        <?php echo locationDot($_GET['class_id'], $fetch_pyclass['class_id']); ?>
                                        <?php
                                        // if ($fetch_pyclass['class_id'] == $_GET['class_id']) {
                                        //     echo "<i class='fa-solid fa-location-dot'> </i>";
                                        // } 
                                        ?>
                                        <?php echo $fetch_pyclass['cname']; ?>
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