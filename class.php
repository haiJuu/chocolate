<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("phpLib.php");
?>


<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./headFile.php") ?>
</head>

<body>

    <header class="container-fluid fixed-top">

        <?php require_once("./header.php") ?>
        <?php require_once("./breadcrumb.php") ?>

    </header>

    <section id="content" class="container-fluid">

        <?php require_once("./classBar.php") ?>
        <?php require_once("./classContent.php") ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

</body>

</html>