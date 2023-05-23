<?php
// Paging - Results per page and calculate offset
$maxRows_carmake = 12;
$pageNum_carmake = 0;
if (isset($_GET['pageNum_carmake'])) {
	$pageNum_carmake = $_GET['pageNum_carmake'];
}
$startRow_carmake = $pageNum_carmake * $maxRows_carmake;
?>
