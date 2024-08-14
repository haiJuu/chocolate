<div class="row">
    <div class="logo col-md-4 col-sm-2 col-4 offset-md-4 align-content-center text-center"><a href="./index.php">
            CHO
        </a>
    </div>

    <div class="font col-md-2 col-sm-2 offset-md-2 offset-sm-6 col-2 align-content-center text-center">
        <?php
        $select_cart = "SELECT * FROM cart WHERE order_id is NULL AND ip='" . $_SERVER['REMOTE_ADDR'] . "'";
        $cart = $link->query($select_cart);
        $count_cart = $cart->rowCount();
        ?>

        <a href="#">
            <i class="fas fa-shopping-bag"></i><span class="badge"><?php echo $count_cart != 0 ? "+" . $count_cart : ''; ?></span>　
        </a>
        <a href="#">
            <i class="fas fa-portrait"></i>
        </a>
    </div>
    <div class="nav col-md-10 col-sm-2 text-center">
        <nav class="navbar navbar-expand-lg">
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" aria-expanded="false">
                                關於 CHO
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                進駐品牌
                            </a>

                            <ul class="dropdown-menu">
                                <?php
                                $select_pyclass1 = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
                                $pyclass1 = $link->query($select_pyclass1);

                                while ($fetch_pyclass1 = $pyclass1->fetch()) {
                                ?>
                                    <li><a class="dropdown-item" href="#"><?php echo $fetch_pyclass1['cname']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                商品分類
                            </a>

                            <?php
                            $pyclass1 = $link->query($select_pyclass1);
                            ?>

                            <ul class="dropdown-menu">

                                <li class="nav-item">
                                    <a class="dropdown-item" href="./drugstore.php" role="button" aria-expanded="false">
                                        所有商品
                                    </a>
                                </li>
                                <?php while ($fetch_pyclass1 = $pyclass1->fetch()) { ?>
                                    <li class="nav-item dropend">
                                        <a href="drugstore.php?class_id=<?php echo $fetch_pyclass1['class_id']; ?>&level=<?php echo $fetch_pyclass1['level']; ?>" class="dropdown-item dropdown-toggle">
                                            <?php echo $fetch_pyclass1['cname']; ?>
                                        </a>
                                        <ul class="dropdown-menu">

                                            <?php

                                            $select_pyclass2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $fetch_pyclass1['class_id']);


                                            $pyclass2 = $link->query($select_pyclass2);

                                            ?>

                                            <?php while ($fetch_pyclass2 = $pyclass2->fetch()) { ?>
                                                <li><a class="dropdown-item" href="drugstore.php?class_id=<?php echo $fetch_pyclass2['class_id']; ?>"><?php echo $fetch_pyclass2['cname']; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>


                        <?php

                        function navbarRepeat()
                        {
                            global $link;
                            global $select_pyclass1;

                            $pyclass1 = $link->query($select_pyclass1); ?>

                            <?php while ($fetch_pyclass1 = $pyclass1->fetch()) { ?>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $fetch_pyclass1['cname']; ?>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <?php
                                        $select_pyclass2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $fetch_pyclass1['class_id']);
                                        $pyclass2 = $link->query($select_pyclass2);

                                        while ($fetch_pyclass2 = $pyclass2->fetch()) {
                                        ?>
                                            <li><a class="dropdown-item" href="#"><?php echo $fetch_pyclass2['cname']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li> <?php } ?>
                        <?php } ?>

                        <?php // navbarRepeat() 
                        ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" aria-expanded="false">
                                最新消息
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" aria-expanded="false">
                                聯絡我們
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="search col-md-2">
        <form action="./drugstore.php" method="get" name="search" id="search" class="d-flex" role="search">
            <input name="search_name" id="search_name" class="form-control me-2" type="search" placeholder="找商品" aria-label="Search" value="<?php echo (isset($_GET['search_name']) ? $_GET['search_name'] : '') ?>" required>
            <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</div>