<?php

// carousel
function classActive($now_carousel, $check_carousel)
{
	return (($now_carousel == $check_carousel) ? "active" : "");
}

function carouselsHref($caro)
{
	if ($caro['p_id'] != "") {
		return "goods.php?p_id=" . $caro['p_id'];
	}
}


// imgbar 
function boxShadow($now_brand, $check_brand)
{
	return (($now_brand == $check_brand) ? "box-shadow" : "");
}

function locationCircle($now_class, $check_class)
{
	return (($now_class == $check_class) ? "<span style='color:lightgray;font-size:60%'> ● </span>" : "");
}


// product_list
function buildNavigation($pageNum_Recordset1, $totalPages_Recordset1, $prev_Recordset1, $next_Recordset1, $separator = " | ", $sname, $max_links = 10, $show_page = true, $selmode = 1)
{
	$gmaxRows = "maxRows_" . $sname;
	$gtotalRows = "totalRows_" . $sname;

	global $$gmaxRows, $$gtotalRows;
	$pagesArray = "";
	$firstArray = "";
	$lastArray = "";
	if ($max_links < 2) $max_links = 2;
	if ($pageNum_Recordset1 <= $totalPages_Recordset1 && $pageNum_Recordset1 >= 0) {
		if ($pageNum_Recordset1 > ceil($max_links / 2)) {
			$fgp = $pageNum_Recordset1 - ceil($max_links / 2) > 0 ? $pageNum_Recordset1 - ceil($max_links / 2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links / 2);
			if ($egp >= $totalPages_Recordset1) {
				$egp = $totalPages_Recordset1 + 1;
				$fgp = $totalPages_Recordset1 - ($max_links - 1) > 0 ? $totalPages_Recordset1 - ($max_links - 1) : 1;
			}
		} else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1 + 1;
		}
		if ($totalPages_Recordset1 >= 1) {

			$_get_vars = '';
			if (!empty($_GET) || !empty($HTTP_GET_VARS)) {
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page_num_" . $sname) {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1 + 1;
			$precedente = $pageNum_Recordset1 - 1;

			switch ($selmode) {
				case 1:
					$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$precedente$_get_vars\">$prev_Recordset1</a>" : "$prev_Recordset1";
					break;
				case 2:
					$firstArray = ($pageNum_Recordset1 > 0) ? "<li><a href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$precedente$_get_vars\" aria-label='Previous'><span aria-hidden='true'>$prev_Recordset1</span></a></li>" : "<li class='disabled'><span aria-hidden='true'>$prev_Recordset1</span></li>";
					break;
				case 3:
					$firstArray = ($pageNum_Recordset1 > 0) ? "<li class='page-item'><a class='page-link' href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$precedente$_get_vars\" aria-label='Previous'><span aria-hidden='true'>$prev_Recordset1</span></a></li>" : "<li class='page-item disabled'><span class='page-link' aria-label='Previous' aria-hidden='true'>$prev_Recordset1</span></li>";
					break;
			}

			for ($a = $fgp + 1; $a <= $egp; $a++) {
				$theNext = $a - 1;
				if ($show_page) {
					$textLink = $a;
				} else {
					$min_l = (($a - 1) * $$gmaxRows) + 1;
					$max_l = ($a * $$gmaxRows >= $$gtotalRows) ? $$gtotalRows : ($a * $$gmaxRows);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext / 26);
				if ($theNext != $pageNum_Recordset1) {
					switch ($selmode) {
						case 1:
							$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$theNext$_get_vars\">";
							$pagesArray .= "$textLink</a>" . ($theNext < $egp - 1 ? $separator : "");
							break;
						case 2:
							$pagesArray .= "<li><a href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$theNext$_get_vars\">";
							$pagesArray .= "$textLink</a></li>";
							break;
						case 3:
							$pagesArray .= "<li class='page-item'><a class='page-link' href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$theNext$_get_vars\">";
							$pagesArray .= "$textLink</a></li>";
							break;
					}
				} else {
					switch ($selmode) {
						case 1:
							$pagesArray .= "$textLink" . ($theNext < $egp - 1 ? $separator : "");
							break;
						case 2:
							$pagesArray .= "<li class='active'>$textLink</li>";
							break;
						case 3:
							$pagesArray .= "<li class='page-item active' aria-current='page'><span class='page-link'>$textLink</span></li>";
							break;
					}
				}
			}
			$theNext = $pageNum_Recordset1 + 1;
			$offset_end = $totalPages_Recordset1;
			switch ($selmode) {
				case 1:
					$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
					break;
				case 2:
					$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<li><a href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$successivo$_get_vars\" aria-label='Next'><span aria-hidden='true'>$next_Recordset1</span></a></li>" : "<li class='disabled'><span aria-hidden='true'>$next_Recordset1</span></li>";
					break;
				case 3:
					$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<li class='page-item'><a class='page-link' href=\"$_SERVER[PHP_SELF]?page_num_" . $sname . "=$successivo$_get_vars\" aria-label='Next'><span aria-hidden='true'>$next_Recordset1</span></a></li>" : "<li class='page-item disabled'><span class='page-link' aria-label='Next' aria-hidden='true'>$next_Recordset1</span></li>";
					break;
			}
		}
	}
	return array($firstArray, $pagesArray, $lastArray);
}
