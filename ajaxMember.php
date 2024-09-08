<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

require_once("./connections/conn_db.php");

if (isset($_GET['email_id']) && $_GET['email_id'] != '') {

    $email_id = $_GET['email_id'];
    $query = sprintf("SELECT email_id,email,cname,tssn,birthday,member_img FROM member WHERE email_id=%d", $email_id);

    $result = $link->query($query);
    if ($result) {
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $retcode = array("c" => "1", "m" => '', "d" => $data);
    } else {
        $retcode = array("c" => 0, "m" => "抱歉!資料無法連結後台資料庫，請聯絡管理員");
    }

    echo json_encode($retcode);
}

return;
