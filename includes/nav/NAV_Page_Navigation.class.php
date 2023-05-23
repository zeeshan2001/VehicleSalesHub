<?php


	class NAV_Page_Navigation extends NAV_Regular {
		var $noPagesToDisplay = 3;
        public function __construct($navName, $rsName, $relPath, $currentPage, $maxRows, $noPagesToDisplay) {
		//function NAV_Page_Navigation($navName, $rsName, $relPath, $currentPage, $maxRows, $noPagesToDisplay) {
			parent::NAV_Regular($navName, $rsName, $relPath, $currentPage, $maxRows);
			$this->noPagesToDisplay = $noPagesToDisplay;
		}
		function Prepare() {
			parent::Prepare();
			$GLOBALS['nav_noPagesToDisplay']     = $this->noPagesToDisplay;
		}
	}
?>
