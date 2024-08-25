<?php
$breadcrumb0 = "";
$breadcrumb1 = "";
$breadcrumb2 = "";
$breadcrumb3 = "";

if (isset($_GET['p_id']) && $_GET['p_id'] != '') {
    $select_product = sprintf("SELECT * FROM product,pyclass WHERE product.class_id=pyclass.class_id AND product.p_id=%d", $_GET['p_id']);
    $product = $link->query($select_product);
    $fetch_product = $product->fetch();

    $breadcrumb3 = "<li class='breadcrumb-item active' aria-current='page'>" . $fetch_product['p_name'] . "</li>";

    $breadcrumb2_name = $fetch_product['cname'];
    $breadcrumb2_class_id = $fetch_product['uplink'];

    $breadcrumb2 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $fetch_product['class_id'] . "'>" . $breadcrumb2_name . "</a></li>";

    $select_pyclass = sprintf("SELECT * FROM pyclass WHERE level=1 AND class_id=%d", $breadcrumb2_class_id);
    $pyclass = $link->query($select_pyclass);
    $fetch_pyclass = $pyclass->fetch();

    $breadcrumb1_class_id = $fetch_pyclass['class_id'];
    $breadcrumb1_name = $fetch_pyclass['cname'];
    // $pyclass_level = $fetch_pyclass['level'];
    $breadcrumb1 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $breadcrumb1_class_id . "&level=1'>" . $breadcrumb1_name . "</a></li>";
} elseif (isset($_GET['search_name'])) {
    $breadcrumb0 = "<li class='breadcrumb-item'>找 " . $_GET['search_name'] . " 的商品</li>";
} elseif (isset($_GET['level']) && isset($_GET['class_id'])) {

    $select_pyclass = sprintf("SELECT * FROM pyclass WHERE level=%d AND class_id=%d", $_GET['level'], $_GET['class_id']);
    $pyclass = $link->query($select_pyclass);

    $fetch_pyclass = $pyclass->fetch();
    $breadcrumb1_name = $fetch_pyclass['cname'];
    $breadcrumb1 = "<li class='breadcrumb-item'>" . $breadcrumb1_name . "</li>";
} elseif (isset($_GET['class_id'])) {

    $select_pyclass2 = sprintf("SELECT * FROM pyclass WHERE level=2 AND class_id=%d", $_GET['class_id']);
    $pyclass2 = $link->query($select_pyclass2);

    $fetch_pyclass2 = $pyclass2->fetch();
    $breadcrumb2_name = $fetch_pyclass2['cname'];
    $breadcrumb2_class_id = $fetch_pyclass2['uplink'];
    $breadcrumb2 = "<li class='breadcrumb-item'>" . $breadcrumb2_name . "</li>";


    $select_pyclass1 = sprintf("SELECT * FROM pyclass WHERE level=1 AND class_id=%d", $breadcrumb2_class_id);
    $pyclass1 = $link->query($select_pyclass1);
    $fetch_pyclass1 = $pyclass1->fetch();

    $breadcrumb1_class_id = $fetch_pyclass1['class_id'];
    $breadcrumb1_name = $fetch_pyclass1['cname'];
    // $breadcrumb1_level = $fetch_pyclass1['level'];
    $breadcrumb1 = "<li class='breadcrumb-item'><a href='drugstore.php?class_id=" . $breadcrumb1_class_id . "&level=1'>" . $breadcrumb1_name . "</a></li>";
} else {
    $breadcrumb0 = "<li class='breadcrumb-item'>所有商品</li>";
}

?>

<div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.php"><i class="fa-solid fa-house"></i></a></li>
            <li class="breadcrumb-item">商品分類</li>
            <?php echo $breadcrumb0 . $breadcrumb1 . $breadcrumb2 . $breadcrumb3; ?>
        </ol>
    </nav>
</div>