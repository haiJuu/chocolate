<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=utf-8');

require_once('./connections/conn_db.php');

if (isset($_GET['p_id']) && isset($_GET['qty'])) {
    $p_id = $_GET['p_id'];
    $qty = $_GET['qty'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $select_cart = "SELECT * FROM cart WHERE p_id=" . $p_id . " AND ip='" . $_SERVER['REMOTE_ADDR'] . "' AND orderid IS NULL";
    $result_cart = $link->query($select_cart);
    if ($result_cart) {
        if ($result_cart->rowCount() == 0) {
            $insert_cart = "INSERT INTO cart(p_id,qty,ip) VALUES (" . $p_id . "," . $qty . ",'" . $ip . "');";
        } else {
            $array_cart = $result_cart->fetch();
            if ($array_cart['qty'] + $qty > 49) {
                $qty = 49;
            } else {
                $qty = $qty + $array_cart['qty'];
            }

            $insert_cart = "UPDATE cart SET qty='" . $qty . "' WHERE cart.cartid='" . $array_cart['cartid'] . "'";
        }
        $result = $link->query($insert_cart);
        $retcode = array("c" => "1", "m" => '謝謝您!產品以加入購物車中');
    } else {
        $retcode = array("c" => "0", "m" => '抱歉!資料無法寫入後台資料庫，請聯絡管理員。');
    }
    // echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
    echo json_encode($retcode);
}
return;
