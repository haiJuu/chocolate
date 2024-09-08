<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("phpLib.php");

if (!isset($_SESSION['login'])) {
    $goToPath = "./login.php?goToPath=checkout";
    header(sprintf("Location:%s", $goToPath));
}
?>


<!doctype html>
<html lang="zh-TW">

<head>

    <?php require_once("./headFile.php") ?>

</head>

<body>

    <header class="container-fluid fixed-top">

        <?php require_once("./header.php") ?>

    </header>

    <section id="content" class="container-fluid">

        <?php require_once("./checkoutContent.php") ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

</body>

</html>