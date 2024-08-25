<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf8');

require_once("./connections/conn_db.php");

if (isset($_POST['cart_id']) && isset($_POST['qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $select_cart = sprintf("UPDATE cart SET qty='%d' WHERE cart.cart_id='%d'", $qty, $cart_id);
    $cart = $link->query($select_cart);
    if ($cart) {
        $retcode = array("c" => "1", "m" => "已更新購物車");
    } else {
        $retcode = array("c" => "0", "m" => "系統發生錯誤");
    }
    echo json_encode($retcode);
}
return;
