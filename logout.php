<?php (!isset($_SESSION)) ? session_start() : "";
$_SESSION['login'] = null;
$_SESSION['email_id'] = null;
$_SESSION['email'] = null;
$_SESSION['cname'] = null;
$_SESSION['mobile'] = null;
$_SESSION['member_img'] = null;

unset($_SESSION['login']);
unset($_SESSION['email_id']);
unset($_SESSION['email']);
unset($_SESSION['cname']);
unset($_SESSION['mobile']);
unset($_SESSION['member_img']);

$goToPath = "index.php";
header(sprintf("Location:%s", $goToPath));
