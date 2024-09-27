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
                    <li class="breadcrumb-item">個人資料</li>
                </ol>
            </nav>
        </div>

    </header>

    <section id="content" class="container-fluid">

        <?php require_once("./memberContent.php");
        ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

    <script>
        $('#changePW').validate({
            rules: {
                PWOld: {
                    required: true,
                    remote: "./memberCheckPwd.php?email_id=<?php echo $_SESSION['email_id'] ?>",
                },
                PWNew1: {
                    required: true,
                    maxlength: 20,
                    minlength: 4,
                },
                PWNew2: {
                    required: true,
                    equalTo: "#PWNew1",
                },
            },
            messages: {
                PWOld: {
                    required: "必填",
                    remote: "舊密碼輸入錯誤",
                },
                PWNew1: {
                    required: "必填",
                    maxlength: "密碼最大長度為20位(4-20位英文字母與數字的組合)",
                    minlength: "密碼最小長度為4位(4-20位英文字母與數字的組合)"
                },
                PWNew2: {
                    required: "必填",
                    equalTo: "兩次輸入的新密碼必須一致",
                },
            }
        })
    </script>

</body>

</html>