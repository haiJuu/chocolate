<?php
include_once("./connections/conn_db.php");

if (isset($_GET['email_id'])) {
    $email_id = $_GET['email_id'];
    $PWOld = MD5($_GET['PWOld']);
    $select_member = sprintf("SELECT email_id FROM member WHERE email_id='%d' AND pw1='%s'", $email_id, $PWOld);

    $member = $link->query($select_member);
    $count_member = $member->rowCount();
    if ($count_member != 0) {
        echo "true";
        return;
    }
}

echo "false";

return;
