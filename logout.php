<?php (!isset($_SESSION)) ? session_start() : "";
$_SESSION['login'] = null;
$_SESSION['email_id'] = null;
$_SESSION['email'] = null;
$_SESSION['cname'] = null;

unset($_SESSION['login']);
unset($_SESSION['email_id']);
unset($_SESSION['email']);
unset($_SESSION['cname']);

$goToPath = "index.php";
header(sprintf("Location:%s", $goToPath));
