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

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item">會員</li>
                    <li class="breadcrumb-item">查詢訂單</li>
                </ol>
            </nav>
        </div>

    </header>

    <section id="content" class="container-fluid">

        <?php require_once("./orderContent.php");
        ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

</body>

</html>