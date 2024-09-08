<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

require_once("./connections/conn_db.php");

(!isset($_SESSION) ? session_start() : "");

if (isset($_SESSION['email_id']) && $_SESSION['email_id'] != "") {
    $email_id = $_SESSION['email_id'];
    $cname = $_POST['cname'];
    $mobile = $_POST['mobile'];
    $zip = $_POST['zip'];
    $address = $_POST['address'];

    $update_addbook = sprintf("UPDATE addbook SET setdefault='0' WHERE email_id='%d' AND setdefault='1'", $email_id);
    $addbook = $link->query($update_addbook);


    $insert_addbook = "INSERT INTO addbook (setdefault,email_id,cname,mobile,zip,address) VALUES ('1','" . $email_id . "','" . $cname . "','" . $mobile . "','" . $zip . "','" . $address . "')";
    $addbook = $link->query($insert_addbook);

    if ($addbook) {
        $retcode = array("c" => "1", "m" => "新增資料成功");
    } else {
        $retcode = array("c" => "0", "m" => "系統發生錯誤");
    }

    echo json_encode($retcode);
}
return;
