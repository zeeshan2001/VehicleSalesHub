<?php

	$KT_MXI_uploadErrorMsg = '<strong>File not found:</strong> <br />%s<br /><strong>Please upload the includes/ folder to the testing server.</strong> <br />';
	$KT_MXI_uploadFileList = array('../common/KT_common.php', '../common/lib/resources/KT_Resources.php', '../common/lib/db/KT_Db.php', 'MXI_functions.inc.php', 'MXI_Includes.class.php');

	for ($KT_MXI_i=0;$KT_MXI_i<sizeof($KT_MXI_uploadFileList);$KT_MXI_i++) {
		$KT_MXI_uploadFileName = dirname(realpath(__FILE__)). '/' . $KT_MXI_uploadFileList[$KT_MXI_i];
		if (file_exists($KT_MXI_uploadFileName)) {
			require_once($KT_MXI_uploadFileName);
		} else {
			die(sprintf($KT_MXI_uploadErrorMsg,$KT_MXI_uploadFileList[$KT_MXI_i]));
		}
	}
?>
