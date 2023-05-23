<?php

	$KT_CMN_uploadErrorMsg = '<strong>File not found:</strong> <br />%s<br /><strong>Please upload the includes/ folder to the testing server.</strong> <br />';
	$KT_CMN_uploadFileList = array('KT_config.inc.php', 'KT_functions.inc.php');

	for ($KT_CMN_i=0;$KT_CMN_i<sizeof($KT_CMN_uploadFileList);$KT_CMN_i++) {
		$KT_CMN_uploadFileName = dirname(realpath(__FILE__)). '/' . $KT_CMN_uploadFileList[$KT_CMN_i];
		if (file_exists($KT_CMN_uploadFileName)) {
			require_once($KT_CMN_uploadFileName);
		} else {
			die(sprintf($KT_CMN_uploadErrorMsg,$KT_CMN_uploadFileList[$KT_CMN_i]));
		}
	}
?>
