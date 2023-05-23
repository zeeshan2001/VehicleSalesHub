<div class="KT_textnav clearfix">
  <ul>
		<li class="first">
			<a title="first" href="<?php 
				if ($GLOBALS['nav_pageNum'] > 0) {
					printf("%s?pageNum_".$GLOBALS['nav_rsName']."=%d&totalRows_".$GLOBALS['nav_rsName']."=%d%s", $GLOBALS['nav_currentPage'], 0, $GLOBALS['nav_totalRows'], $GLOBALS['nav_queryString']); 
				} else {
					echo "javascript: void(0);";
				}?>"><i class="fas fa-fast-backward fa-2x"></i></a>
		</li>
		<li class="prev">
				<a title="previous" href="<?php
				if ($GLOBALS['nav_pageNum'] > 0) {
					printf("%s?pageNum_".$GLOBALS['nav_rsName']."=%d&totalRows_".$GLOBALS['nav_rsName']."=%d%s", $GLOBALS['nav_currentPage'], max(0, $GLOBALS['nav_pageNum'] - 1), $GLOBALS['nav_totalRows'], $GLOBALS['nav_queryString']);
				} else {
					echo "javascript: void(0);";
				}
				?>"><i class="fas fa-step-backward fa-2x"></i></a>
		</li>
		<li class="next">
			<a title="next" href="<?php 
				if ($GLOBALS['nav_pageNum'] < $GLOBALS['nav_totalPages']) {
					printf("%s?pageNum_".$GLOBALS['nav_rsName']."=%d&totalRows_".$GLOBALS['nav_rsName']."=%d%s", $GLOBALS['nav_currentPage'], min($GLOBALS['nav_totalPages'], $GLOBALS['nav_pageNum'] + 1), $GLOBALS['nav_totalRows'], $GLOBALS['nav_queryString']); 
				} else {
					echo "javascript: void(0);";
				}?>"><i class="fas fa-step-forward fa-2x"></i></a>
		</li>
		<li class="last">
			<a title="last" href="<?php
				if ($GLOBALS['nav_pageNum'] < $GLOBALS['nav_totalPages']) {
					printf("%s?pageNum_".$GLOBALS['nav_rsName']."=%d&totalRows_".$GLOBALS['nav_rsName']."=%d%s", $GLOBALS['nav_currentPage'], $GLOBALS['nav_totalPages'], $GLOBALS['nav_totalRows'], $GLOBALS['nav_queryString']); 
				} else {
					echo "javascript: void(0);";
				}?>"><i class="fas fa-fast-forward fa-2x"></i></a>
		</li>
  </ul>
</div>
