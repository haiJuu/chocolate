<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=utf-8');

require_once('./connections/conn_db.php');

if (isset($_GET['p_id']) && isset($_GET['qty'])) {
    $p_id = $_GET['p_id'];
    $qty = $_GET['qty'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $select_cart = "SELECT * FROM cart WHERE p_id=" . $p_id . " AND ip='" . $_SERVER['REMOTE_ADDR'] . "' AND order_id IS NULL";
    $cart = $link->query($select_cart);

    if ($cart) {
        if ($cart->rowCount() == 0) {
            $manipulation_cart = "INSERT INTO cart(p_id,qty,ip) VALUES (" . $p_id . "," . $qty . ",'" . $ip . "');";
        } else {
            $fetch_cart = $cart->fetch();
            if ($fetch_cart['qty'] + $qty > 49) {
                $qty = 49;
            } else {
                $qty = $qty + $fetch_cart['qty'];
            }

            $manipulation_cart = "UPDATE cart SET qty='" . $qty . "' WHERE cart.cart_id='" . $fetch_cart['cart_id'] . "'";
        }
        $manipulation_successful = $link->query($manipulation_cart);
        $retcode = array("c" => "1", "m" => '已加到購物車');
    } else {
        $retcode = array("c" => "0", "m" => '系統發生錯誤');
    }
    // echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
    echo json_encode($retcode);
}

return;
