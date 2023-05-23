<?php

	$KT_CSV_uploadErrorMsg = '<strong>File not found:</strong> <br />%s<br /><strong>Please upload the includes/ folder to the testing server.</strong> <br /><a href="http://www.interaktonline.com/error/?error=upload_includes" onclick="return confirm(\'Some data will be submitted to InterAKT. Do you want to continue?\');" target="KTDebugger_0">Online troubleshooter</a>';
	$KT_CSV_uploadFileList = array('../common/KT_common.php', '../common/lib/db/KT_Db.php', 'CSV_Export.class.php');

	for ($KT_CSV_i=0;$KT_CSV_i<sizeof($KT_CSV_uploadFileList);$KT_CSV_i++) {
		$KT_CSV_uploadFileName = dirname(realpath(__FILE__)). '/' . $KT_CSV_uploadFileList[$KT_CSV_i];
		if (file_exists($KT_CSV_uploadFileName)) {
			require_once($KT_CSV_uploadFileName);
		} else {
			die(sprintf($KT_CSV_uploadErrorMsg,$KT_CSV_uploadFileList[$KT_CSV_i]));
		}
	}
?>