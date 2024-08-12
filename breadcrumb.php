<?php
$breadcrumb_0 = "";
$breadcrumb_1 = "";
$breadcrumb_2 = "";
$breadcrumb_3 = "";

if (isset($_GET['p_id']) && $_GET['p_id'] != '') {
    $query_product_class_id = sprintf("SELECT * FROM product,pyclass WHERE product.class_id=pyclass.class_id AND product.p_id=%d", $_GET['p_id']);
    $product_class_id = $link->query($query_product_class_id);
    $product_class_id_result = $product_class_id->fetch();

    $breadcrumb_3 = "<li class='breadcrumb-item active' aria-current='page'>" . $product_class_id_result['p_name'] . "</li>";

    $pyclass_level_2_cname = $product_class_id_result['cname'];
    $pyclass_level_2_uplink = $product_class_id_result['uplink'];

    $breadcrumb_2 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $product_class_id_result['class_id'] . "'>" . $pyclass_level_2_cname . "</a></li>";

    $query_pyclass_level_1 = sprintf("SELECT * FROM pyclass WHERE level=1 AND class_id=%d", $pyclass_level_2_uplink);
    $pyclass_level_1 = $link->query($query_pyclass_level_1);
    $pyclass_level_1_result = $pyclass_level_1->fetch();

    $pyclass_level_1_class_id = $pyclass_level_1_result['class_id'];
    $pyclass_level_1_cname = $pyclass_level_1_result['cname'];
    // $pyclass_level_1_level = $pyclass_level_1_result['level'];
    $breadcrumb_1 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $pyclass_level_1_class_id . "&level=1'>" . $pyclass_level_1_cname . "</a></li>";
} elseif (isset($_GET['search_name'])) {
    $pyclass_level_1 = "<li class='breadcrumb-item'>找 " . $_GET['search_name'] . " 的商品</li>";
} elseif (isset($_GET['level']) && isset($_GET['class_id'])) {

    $query_pyclass_level_1 = sprintf("SELECT * FROM pyclass WHERE level=%d AND class_id=%d", $_GET['level'], $_GET['class_id']);
    $pyclass_level_1 = $link->query($query_pyclass_level_1);

    $pyclass_level_1_result = $pyclass_level_1->fetch();
    $pyclass_level_1_cname = $pyclass_level_1_result['cname'];
    $breadcrumb_1 = "<li class='breadcrumb-item'>" . $pyclass_level_1_cname . "</li>";
} elseif (isset($_GET['class_id'])) {

    $query_pyclass_level_2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d", $_GET['class_id']);
    $pyclass_level_2 = $link->query($query_pyclass_level_2);

    $pyclass_level_2_result = $pyclass_level_2->fetch();
    $pyclass_level_2_cname = $pyclass_level_2_result['cname'];
    $pyclass_level_2_uplink = $pyclass_level_2_result['uplink'];
    $breadcrumb_2 = "<li class='breadcrumb-item'>" . $pyclass_level_2_cname . "</li>";

    $query_pyclass_level_1 = sprintf("SELECT * FROM pyclass WHERE level=1 AND class_id=%d", $pyclass_level_2_uplink);
    $pyclass_level_1 = $link->query($query_pyclass_level_1);
    $pyclass_level_1_result = $pyclass_level_1->fetch();

    $pyclass_level_1_class_id = $pyclass_level_1_result['class_id'];
    $pyclass_level_1_cname = $pyclass_level_1_result['cname'];
    // $pyclass_level_1_level = $pyclass_level_1_result['level'];
    $breadcrumb_1 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $pyclass_level_1_class_id . "&level=1'>" . $pyclass_level_1_cname . "</a></li>";
} else {
    $breadcrumb_0 = "<li class='breadcrumb-item'>所有商品</li>";
}

?>

<div class="row" style="padding-right:0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php">首頁</a></li>
            <li class="breadcrumb-item">商品分類</li>
            <?php echo $breadcrumb_0 . $breadcrumb_1 . $breadcrumb_2 . $breadcrumb_3; ?>
        </ol>
    </nav>
</div>