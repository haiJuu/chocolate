<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

require_once("./connections/conn_db.php");

if (isset($_GET['email_id']) && $_GET['email_id'] != '') {
    $email_id = $_GET['email_id'];
    $PWNew1 = $_GET['PWNew1'];
    $query = sprintf("UPDATE member SET pw1='%s' WHERE member.email_id='%d'", $PWNew1, $email_id);
    $result = $link->query($query);

    if ($result) {
        $retcode = array("c" => "1", "m" => "會員密碼已經更新");
    } else {
        $retcode = array("c" => "0", "m" => "系統發生錯誤");
    }

    echo json_encode($retcode);
}
return;
