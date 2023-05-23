<?php


	$KT_TFI_uploadErrorMsg = '<strong>File not found:</strong> <br />%s<br /><strong>Please upload the includes/ folder to the testing server.</strong> <br />>';
	$KT_TFI_uploadFileList = array(
		'../common/KT_common.php',
		'../common/lib/db/KT_Db.php',
		'../tng/tNG.inc.php',
		'TFI_TableFilter.class.php');

	for ($KT_TFI_i=0;$KT_TFI_i<sizeof($KT_TFI_uploadFileList);$KT_TFI_i++) {
		$KT_TFI_uploadFileName = dirname(realpath(__FILE__)). '/' . $KT_TFI_uploadFileList[$KT_TFI_i];
		if (file_exists($KT_TFI_uploadFileName)) {
			require_once($KT_TFI_uploadFileName);
		} else {
			die(sprintf($KT_TFI_uploadErrorMsg,$KT_TFI_uploadFileList[$KT_TFI_i]));
		}
	}
	
	KT_setServerVariables();
	KT_session_start();
?>
