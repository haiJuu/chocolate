<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=utf-8');

require_once('./connections/conn_db.php');

$select_cityAndTown = sprintf("SELECT town.town_name,town.post,city.city_name FROM town,city WHERE town.auto_no=city.auto_no AND town.town_no='%d'", $_GET['auto_no']);

$cityAndTown = $link->query($select_cityAndTown);
if ($cityAndTown->rowCount() > 0) {
    $fetch_cityAndTown = $cityAndTown->fetch();
    $retcode = array("c" => "1", "post" => $fetch_cityAndTown['post'], "city_name" => $fetch_cityAndTown['city_name'], "town_name" => $fetch_cityAndTown['town_name']);
} else {
    $retcode = array("c" => "0", "m" => "沒有資料");
}

echo json_encode($retcode);
return;
