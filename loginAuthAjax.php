<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;chartset=utf-8');

(!isset($_SESSION)) ? session_start() : "";
require_once('./connections/conn_db.php');

if (isset($_POST['inputAccount']) && isset($_POST['inputPassword'])) {
    $inputAccount = $_POST['inputAccount'];
    $inputPassword = $_POST['inputPassword'];

    $select_member = sprintf("SELECT * FROM member WHERE email='%s' AND pw1='%s'", $inputAccount, $inputPassword);
    $member = $link->query($select_member);

    if ($member) {
        if ($member->rowCount() == 1) {
            $fetch_member = $member->fetch();
            if ($fetch_member['active']) {
                $_SESSION['login'] = true;
                $_SESSION['email_id'] = $fetch_member['email_id'];
                $_SESSION['email'] = $fetch_member['email'];
                $_SESSION['cname'] = $fetch_member['cname'];
                $retcode = array("c" => "1", "m" => "登入成功");
            } else {
                $retcode = array("c" => "2", "m" => "會員尚未啟動或已被鎖定");
            }
        } else {
            $retcode = array("c" => "2", "m" => "帳號或密碼輸入錯誤");
        }
    } else {
        $retcode = array("c" => "0", "m" => "目前無法登入");
    }

    echo json_encode($retcode);
}

return;
