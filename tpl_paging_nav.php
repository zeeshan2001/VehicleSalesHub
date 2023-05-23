	<div class="recordnav">
			<?php if ($pageNum_carmake > 0) { // Show if not first page ?>
					<a href="<?php printf("%s/%d%s", $navbase, max(0, $pageNum_carmake - 1), '/'.$totalRows_carmake); ?>" rel="prev"><i class="fas fa-caret-square-left"></i></a>
					<?php } // Show if not first page ?>
			<span><?php echo (min($startRow_carmake + 1, $totalRows_carmake)) ?> - 
						<?php echo min($startRow_carmake + $maxRows_carmake, $totalRows_carmake) ?> of
		<?php echo $totalRows_carmake ?> vehicles </span>
			<?php if ($pageNum_carmake < $totalPages_carmake) { // Show if not last page ?>
					<a href="<?php printf("%s/%d%s", $navbase, min($totalPages_carmake, $pageNum_carmake + 1), '/'.$totalRows_carmake); ?>" rel="next"><i class="fas fa-caret-square-right"></i></a>
					<?php } // Show if not last page ?>
	</div>