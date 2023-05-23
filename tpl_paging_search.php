<?php
// PM TODO: FIX PHP NOTICE FOR $queryString_search - WILL PROBABLY UPDATE & USE BUILT IN ADODB PAGING FUNCTIONS
error_reporting(E_ALL & ~E_NOTICE);
?>
	<div class="recordnav">
			<?php if ($pageNum_search > 0) { // Show if not first page ?>
					<a href="<?php printf("%s?pageNum_search=%d%s", $_SERVER["PHP_SELF"], max(0, $pageNum_search - 1), $queryString_search); ?>" rel="prev"><i class="fas fa-caret-square-left"></i></a>
					<?php } // Show if not first page ?>
			<span><?php echo (min($startRow_search + 1, $totalRows_search)) ?> - 
						<?php echo min($startRow_search + $maxRows_search, $totalRows_search) ?> of
		<?php echo $totalRows_search ?> vehicles </span>
			<?php if ($pageNum_search < $totalPages_search) { // Show if not last page ?>
					<a href="<?php printf("%s?pageNum_search=%d%s", $_SERVER["PHP_SELF"], min($totalPages_search, $pageNum_search + 1), $queryString_search); ?>" rel="next"><i class="fas fa-caret-square-right"></i></a>
					<?php } // Show if not last page ?>
	</div>