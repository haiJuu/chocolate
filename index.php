<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("php_lib.php");
?>


<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./head_file.php") ?>
</head>

<body>

    <header class="container-fluid fixed-top">

        <?php require_once("./header_logo.php") ?>
        <?php require_once("./header_nav.php") ?>

    </header>

    <section id="content" class="container-fluid">

        <?php require_once("./content_caro.php") ?>
        <?php require_once("./content_brand&hot.php") ?>
        <?php require_once("./content_product_list.php") ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./js_file.php") ?>

</body>

</html>