<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

require_once("./connections/conn_db.php");

(!isset($_SESSION) ? session_start() : "");

if (isset($_SESSION['email_id']) && $_SESSION['email_id'] != '') {

    $email_id = $_SESSION['email_id'];
    $address_id = $_POST['address_id'];

    $update_addbook = sprintf("UPDATE addbook SET setdefault='0' WHERE email_id='%d' AND setdefault='1'", $email_id);
    $addbook = $link->query($update_addbook);

    $update_addbook = sprintf("UPDATE addbook SET setdefault='1' WHERE address_id='%d'", $address_id);
    $addbook = $link->query($update_addbook);

    if ($addbook) {
        $retcode = array("c" => "1", "m" => "變更資料完成");
    } else {
        $retcode = array("c" => "0", "m" => "系統發生錯誤");
    }

    echo json_encode($retcode);
}
return;
