<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("phpLib.php");

if (isset($_GET['sPath'])) {
    $sPath = $_GET['sPath'] . ".php";
} else {
    $sPath = "index.php";
}

if (isset($_SESSION['login'])) {
    header(sprintf("Location:%s", $sPath));
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

        <div class="login">

            <img src="" alt="logo" id="profile-img" class="profile-img-card">
            <p id="profile-name" class="profile-name-card">會員登入</p>
            <form action="" method="POST" class="form-signin" id="form1">
                <input type="email" id="inputAccount" name="inputAccount" class="form-control" placeholder="Account" required autofocus>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn btn-signin mt-4">sign in</button>
            </form>
            <div class="other mt-5 text-center">
                <a href="register.php">New user</a>
                <a href="#">Forget the password?</a>
            </div>

        </div>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

</body>

</html>