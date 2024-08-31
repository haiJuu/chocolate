<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=utf-8');

require_once('./connections/conn_db.php');

$select_cityAndTown = sprintf("SELECT town.tname,town.post,city.cname FROM town,city WHERE town.auto_no=city.auto_no AND town.town_no='%d'", $_GET['auto_no']);

$cityAndTown = $link->query($select_cityAndTown);
if ($cityAndTown->rowCount() > 0) {
    $fetch_cityAndTown = $cityAndTown->fetch();
    $retcode = array("c" => "1", "post" => $fetch_cityAndTown['post'], "cname" => $fetch_cityAndTown['cname'], "tname" => $fetch_cityAndTown['tname']);
} else {
    $retcode = array("c" => "0", "m" => "沒有資料");
}

echo json_encode($retcode);
return;
