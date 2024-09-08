<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

require_once("./connections/conn_db.php");

(!isset($_SESSION) ? session_start() : "");

if (isset($_SESSION['email_id']) && $_SESSION['email_id'] != "") {
    $email_id = $_SESSION['email_id'];
    $address_id = $_POST['address_id'];
    $e_invoice = $_POST['e_invoice'];
    $company_name = $_POST['company_name'];
    $tax_ID_number = $_POST['tax_ID_number'];
    $remark = $_POST['remark'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $order_id = date('Ymdhis') . rand(10000, 99999);

    $insert_uorder = sprintf("INSERT INTO uorder (order_id,email_id,address_id,e_invoice,company_name,tax_ID_number,howpay,paystatus,status,remark) VALUES ('%s','%d','%d','%s','%s','%s','3','35','7','%s')", $order_id, $email_id, $address_id, $e_invoice, $company_name, $tax_ID_number, $remark);
    $uorder = $link->query($insert_uorder);

    if ($uorder) {
        $update_cart = sprintf("UPDATE cart SET order_id='%s',email_id='%d',status='8' WHERE ip='%s' AND order_id IS NULL", $order_id, $email_id, $ip);
        $cart = $link->query($update_cart);

        $retcode = array("c" => "1", "m" => "訂單已經成立");
    } else {
        $retcode = array("c" => "0", "m" => "系統發生錯誤");
    }

    echo json_encode($retcode);
}
return;
