<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

require_once("./connections/conn_db.php");

if (isset($_GET['email_id']) && $_GET['email_id'] != '') {

    $email_id = $_GET['email_id'];
    $birthday = $_GET['birthday'];
    $cname = $_GET['cname'];
    $member_img = $_GET['member_img'];
    $tssn = $_GET['tssn'];
    $query = sprintf("UPDATE member SET cname='%s',birthday='%s',member_img='%s',tssn='%s' WHERE member.email_id='%d'", $cname, $birthday, $member_img, $tssn, $email_id);
    $result = $link->query($query);

    if ($result) {
        // (!isset($_SESSION)) ? session_start() : "";
        $_SESSION['cname'] = $cname;
        $_SESSION['member_img'] = $member_img;
        $retcode = array("c" => "1", "m" => "謝謝您!會員資料已經更新");
    } else {
        $retcode = array("c" => "0", "m" => "抱歉!資料無法寫入後台資料庫，請聯絡管理員");
    }

    echo json_encode($retcode);
}
return;
