<div class="row">

    <div class="logo col-md-4 offset-md-4 col-sm-2 col-4 align-content-center text-center">
        <a href="./index.php">
            CHO
        </a>
    </div>

    <div class="font col-md-4 col-sm-10 col-8 align-content-center text-end pe-4">
        <?php
        if (isset($_SESSION['login'])) {
            $select_cart = "SELECT * FROM cart WHERE order_id is NULL AND ip='" . $_SERVER['REMOTE_ADDR'] . "' AND email_id ='" . $_SESSION['email_id'] . "'";
            $cart = $link->query($select_cart);
            $count_cart = $cart->rowCount();
        }
        ?>
        <a href="./cart.php">
            <i class="fas fa-shopping-bag"></i><span class="badge"><?php echo isset($_SESSION['login']) ? $count_cart : "0"; ?></span>
        </a>

        <?php if (isset($_SESSION['login'])) { ?>

            <ul class="navbar-nav" style="display:inline-block;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="./images/member/<?php echo ($_SESSION['member_img'] != '') ? $_SESSION['member_img'] : 'bear.jpg'; ?>" width="40" height="40" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./member.php">個人資料</a></li>
                        <li><a class="dropdown-item" href="./order.php">查詢訂單</a></li>
                        <li><a class="dropdown-item" href="#" onclick="confirmLink('確定登出 ?','./logout.php')">登　　出</a></li>
                    </ul>
                </li>
            </ul>

        <?php } else { ?>
            <a href="./login.php">
                <i class="fas fa-portrait ms-3"></i>
            </a>
        <?php } ?>

    </div>

    <div class="nav col-md-9 col-sm-6 col-6">
        <nav class="navbar navbar-expand-lg">
            <div>
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                                    <a class="dropdown-item" href="./class.php" role="button" aria-expanded="false">
                                        所有商品
                                    </a>
                                </li>
                                <?php while ($fetch_pyclass1 = $pyclass1->fetch()) { ?>
                                    <li class="nav-item dropend">
                                        <a href="./class.php?class_id=<?php echo $fetch_pyclass1['class_id']; ?>&level=<?php echo $fetch_pyclass1['level']; ?>" class="dropdown-item dropdown-toggle">
                                            <?php echo $fetch_pyclass1['cname']; ?>
                                        </a>
                                        <ul class="dropdown-menu">

                                            <?php

                                            $select_pyclass2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $fetch_pyclass1['class_id']);


                                            $pyclass2 = $link->query($select_pyclass2);

                                            ?>

                                            <?php while ($fetch_pyclass2 = $pyclass2->fetch()) { ?>
                                                <li><a class="dropdown-item" href="./class.php?class_id=<?php echo $fetch_pyclass2['class_id']; ?>"><?php echo $fetch_pyclass2['cname']; ?></a></li>
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

    <div class="search col-md-3 col-sm-6 col-6 pe-4 pt-2">
        <form action="./class.php" method="get" name="search" id="search" class="d-flex justify-content-end" role="search">
            <input name="search_name" id="search_name" class="form-control me-2" type="search" placeholder="找商品" aria-label="Search" value="<?php echo (isset($_GET['search_name']) ? $_GET['search_name'] : '') ?>" required>
            <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

</div>