<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("phpLib.php");

if (isset($_GET['goToPath'])) {
    $goToPath = $_GET['goToPath'] . ".php";
} else {
    $goToPath = "index.php";
}

if (isset($_SESSION['login'])) {
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

        <?php if (!isset($_SESSION['login'])) { ?>
            <div class="login">
                <div class="row justify-content-center">
                    <div class="loginCol col-md-4 col-sm-6 col-10">
                        <h3 id="profile-name" class="profile-name-card mb-5">已經是會員</h3>
                        <form action="" method="POST" id="loginForm">
                            <input type="email" id="inputAccount" name="inputAccount" class="mb-3 w-100" placeholder="請輸入電郵" required autofocus>

                            <div class="w-100 mb-3" style="position: relative;">
                                <input type="password" id="inputPassword" name="inputPassword" class="w-100" placeholder="請輸入密碼" requireds>
                                <i id="checkEye" class="fas fa-eye"></i>
                            </div>
                            <div class="forgetPassword">
                                <a href="#" style="color:darkblue">忘記密碼 ?</a>
                            </div>
                            <button type="submit" class="btn w-100 mt-3">
                                會員登入
                            </button>
                        </form>

                        <h3 id="profile-name" class="profile-name-card mt-5 mb-5">還不是會員</h3>
                        <div class="other mt-5 text-center">
                            <a href="./register.php">
                                <button class="btn w-100">
                                    註冊會員
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="member">
                <div class="row justify-content-center">
                    <div class="loginCol col-md-4 col-sm-6 col-10">
                        會員資料
                    </div>
                </div>
            </div>

        <?php } ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>
</body>

</html>