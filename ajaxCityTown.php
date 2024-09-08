<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=utf-8');

require_once('./connections/conn_db.php');

$select_town = sprintf("SELECT * FROM town WHERE auto_no='%d'", $_POST['auto_no']);
$town = $link->query($select_town);
$htmlElement = "<option value=''>選擇鄉鎮市區</option>";
if ($town->rowCount() > 0) {
    while ($fetch_town = $town->fetch()) {
        $htmlElement = $htmlElement . "<option value='" . $fetch_town['town_no'] . "'>" . $fetch_town['town_name'] . "</option>";
    }
    $retcode = array("c" => "1", "m" => $htmlElement);
} else {
    $retcode = array("c" => "0", "m" => "找不到相關資料");
}

echo json_encode($retcode);
return;
