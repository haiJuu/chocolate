<?php
$memberImgName = $_FILES['memberImg']['name'];
$memberImgTmpLoc = $_FILES['memberImg']['tmp_name'];
$memberImgType = $_FILES['memberImg']['type'];
$memberImgSize = $_FILES['memberImg']['size'];
$memberImgErrorMsg = $_FILES['memberImg']['error'];

if (!$memberImgTmpLoc) {
    $retcode = array("success" => "false", "msg" => "", "error" => "無法建立上傳暫存", "memberImgName" => "");
    echo json_encode($retcode);
    exit();
}

if (move_uploaded_file($memberImgTmpLoc, "./images/member/$memberImgName")) {
    $retcode = array("success" => "true", "msg" => "上傳完成", "error" => "", "memberImgName" => $memberImgName);
} else {
    $retcode = array("success" => "false", "msg" => "", "error" => "上傳失敗", "memberImgName" => "");
}

echo json_encode($retcode);
exit();
