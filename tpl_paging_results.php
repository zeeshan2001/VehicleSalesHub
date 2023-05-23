<?php
//Paging - Check for URL parameter to confirm multiple pages
$carmake = $ukcd->SelectLimit($query_carmake, $maxRows_carmake, $startRow_carmake) or die($ukcd->ErrorMsg());
if (isset($_GET['totalRows_carmake'])) {
	$totalRows_carmake = $_GET['totalRows_carmake'];
} else {
	$all_carmake = $ukcd->SelectLimit($query_carmake) or die($ukcd->ErrorMsg());
	$totalRows_carmake = $all_carmake->RecordCount();
}
$totalPages_carmake = (int)(($totalRows_carmake-1)/$maxRows_carmake);
?>
