<div class="nav row">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">

                    <?php
                    function navbarRepeat()
                    {
                        global $link;

                        $query_pyclass_level_1 = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
                        $pyclass_level_1 = $link->query($query_pyclass_level_1);

                        while ($pyclass_result_level_1 = $pyclass_level_1->fetch()) { ?>
                            <li class="nav-item ms-4 me-4 dropdown">
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

                </ul>
            </div>
        </div>
    </nav>
</div>