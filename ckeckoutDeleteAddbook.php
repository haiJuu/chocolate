<?php require_once("./connections/conn_db.php"); ?>
<?php
if (isset($_GET['address_id']) && $_GET['address_id'] != "") {
    $address_id = $_GET['address_id'];

    $delete_addbook = sprintf("DELETE FROM addbook WHERE address_id=%d", $_GET['address_id']);

    $link->query($delete_addbook);
}

$deletGoto = "./checkout.php";
header(sprintf("location:%s", $deletGoto));

?>
