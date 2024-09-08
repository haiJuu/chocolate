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

    </header>

    <?php
    if ((isset($_POST['formctl'])) && ($_POST['formctl'] == 'reg')) {
        $email = $_POST['email'];
        $pw1 = md5($_POST['pw1']);
        $cname = $_POST['cname'];
        $tssn = $_POST['tssn'];
        $birthday = $_POST['birthday'];
        $mobile = $_POST['mobile'];
        $zip = $_POST['zip'] == "" ? NULL : $_POST['zip'];
        $address = $_POST['address'] == "" ? NULL : $_POST['address'];
        $memberImg = $_POST['memberImg'] == "" ? NULL : $_POST['memberImg'];
        $insert_member = "INSERT INTO member(email,pw1,cname,mobile,tssn,birthday,member_img) VALUES ('" . $email . "','" . $pw1 . "','" . $cname . "','" . $mobile . "','" . $tssn . "','" . $birthday . "','" . $memberImg . "')";
        $member = $link->query($insert_member);
        $email_id = $link->lastInsertId();

        if ($member) {
            $insertsql = "INSERT INTO addbook(email_id,setdefault,cname,mobile,zip,address) VALUES ('" . $email_id . "','1','" . $cname . "','" . $mobile . "','" . $zip . "','" . $address . "')";
            $addbook = $link->query($insertsql);

            $_SESSION['login'] = true;
            $_SESSION['email_id'] = $email_id;
            $_SESSION['email'] = $email;
            $_SESSION['cname'] = $cname;
            echo "<script language='javascript'>alert('謝謝您，會員資料已完成註冊');location.href='./index.php'</script>";
        }
    }
    ?>

    <section id="content" class="container-fluid">

        <?php require_once("./registerContent.php") ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

    <script type="text/javascript">
        getCaptcha();
    </script>

</body>

</html>