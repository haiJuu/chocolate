<?php
$breadcrumb_pyclass_level_0 = "";
$breadcrumb_pyclass_level_1 = "";
$breadcrumb_pyclass_level_2 = "";
// $breadcrumb_pyclass_level_3 = "";

// page 58
// if (isset($_GET['p_id']) && $_GET['p_id'] != '') {
//     $sqlString = sprintf("SELECT * FROM product,pyclass,(SELECT classid as upclassid,level as uplevel,cname as upcname FROM pyclass WHERE level=1) as uplevel WHERE product.classid=pyclass.classid AND pyclass.uplink=uplevel.upclassid AND product.p_id=%d", $_GET['p_id']);

// } else

if (isset($_GET['search_name'])) {
    $pyclass_level_1 = "<li class='breadcrumb-item'>找 " . $_GET['search_name'] . " 的商品</li>";
} elseif (isset($_GET['level']) && isset($_GET['class_id'])) {

    $query_pyclass_level_1 = sprintf("SELECT * FROM pyclass WHERE level=%d AND class_id=%d", $_GET['level'], $_GET['class_id']);
    $pyclass_level_1 = $link->query($query_pyclass_level_1);

    $pyclass_level_1_result = $pyclass_level_1->fetch();
    $pyclass_level_1_cname = $pyclass_level_1_result['cname'];
    $breadcrumb_pyclass_level_1 = "<li class='breadcrumb-item'>" . $pyclass_level_1_cname . "</li>";
} elseif (isset($_GET['class_id'])) {

    $query_pyclass_level_2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d", $_GET['class_id']);
    $pyclass_level_2 = $link->query($query_pyclass_level_2);

    $pyclass_level_2_result = $pyclass_level_2->fetch();
    $pyclass_level_2_cname = $pyclass_level_2_result['cname'];
    $pyclass_level_2_uplink = $pyclass_level_2_result['uplink'];
    $breadcrumb_pyclass_level_2 = "<li class='breadcrumb-item'>" . $pyclass_level_2_cname . "</li>";

    $query_pyclass_level_1 = sprintf("SELECT * FROM pyclass WHERE level=1 AND class_id=%d", $pyclass_level_2_uplink);
    $pyclass_level_1 = $link->query($query_pyclass_level_1);
    $pyclass_level_1_result = $pyclass_level_1->fetch();
    $pyclass_level_1_cname = $pyclass_level_1_result['cname'];
    $pyclass_level_1_level = $pyclass_level_1_result['level'];
    $breadcrumb_pyclass_level_1 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $pyclass_level_2_uplink . "&level=" . $pyclass_level_1_level . "'>" . $pyclass_level_1_cname . "</a></li>";
} else {
    $breadcrumb_pyclass_level_0 = "<li class='breadcrumb-item'>所有商品</li>";
}

?>

<div class="row" style="padding-right:0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">首頁</a></li>
            <li class="breadcrumb-item">商品分類</li>
            <?php echo $breadcrumb_pyclass_level_0 . $breadcrumb_pyclass_level_1 . $breadcrumb_pyclass_level_2; ?>
        </ol>
    </nav>
</div>