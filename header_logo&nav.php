<div class="row">
    <div class="logo col-md-4 col-sm-2 col-4 offset-md-4 align-content-center text-center"><a href="./index.php">
            CHO
        </a>
    </div>

    <div class="font col-md-2 col-sm-2 offset-md-2 offset-sm-6 col-2 align-content-center text-center">
        <a href="#">
            <i class="fas fa-shopping-bag"></i>　
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

                        <?php
                        $query_pyclass_level_1 = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
                        $pyclass_level_1 = $link->query($query_pyclass_level_1);
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                進駐品牌
                            </a>

                            <ul class="dropdown-menu">
                                <?php
                                $query_pyclass_level_1 = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
                                $pyclass_level_1 = $link->query($query_pyclass_level_1); ?>

                                <?php
                                while ($pyclass_result_level_1 = $pyclass_level_1->fetch()) {
                                ?>
                                    <li><a class="dropdown-item" href="#"><?php echo $pyclass_result_level_1['cname']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <?php
                        function navbarRepeat()
                        {
                            global $link;
                            global $query_pyclass_level_1;

                            $pyclass_level_1 = $link->query($query_pyclass_level_1); ?>

                            <?php while ($pyclass_result_level_1 = $pyclass_level_1->fetch()) { ?>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $pyclass_result_level_1['cname']; ?>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <?php
                                        $query_pyclass_level_2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass_result_level_1['class_id']);
                                        $pyclass_level_2 = $link->query($query_pyclass_level_2);

                                        while ($pyclass_result_level_2 = $pyclass_level_2->fetch()) {
                                        ?>
                                            <li><a class="dropdown-item" href="#"><?php echo $pyclass_result_level_2['cname']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li> <?php } ?>
                        <?php } ?>

                        <?php navbarRepeat() ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" aria-expanded="false">
                                最新消息
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="search col-md-2">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</div>