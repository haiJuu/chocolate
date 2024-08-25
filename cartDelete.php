<?php require_once("./connections/conn_db.php"); ?>
<?php
if (isset($_GET['mode']) && $_GET['mode'] != "") {
    $mode = $_GET['mode'];
    switch ($mode) {
        case 1:
            $delete_cart = sprintf("DELETE FROM cart WHERE cart_id=%d AND order_id IS NULL", $_GET['cart_id']);
            break;
        case 2:
            $delete_cart = sprintf("DELETE FROM cart WHERE ip='%s' AND order_id IS NULL", $_SERVER['REMOTE_ADDR']);
            break;
    }
    $link->query($delete_cart);
}

$deletGoto = "cart.php";
header(sprintf("location:%s", $deletGoto));

?>
