<?php

	$KT_DB_uploadErrorMsg = '<strong>File not found:</strong> <br />%s<br /><strong>Please upload the includes/ folder to the testing server.</strong> <br />';
	$KT_DB_uploadFileList = array('KT_Connection.class.php', 'KT_Recordset.class.php', 'KT_FakeRecordset.class.php', '../resources/KT_Resources.php');

	for ($KT_DB_i=0;$KT_DB_i<sizeof($KT_DB_uploadFileList);$KT_DB_i++) {
		$KT_DB_uploadFileName = dirname(realpath(__FILE__)). '/' . $KT_DB_uploadFileList[$KT_DB_i];
		if (file_exists($KT_DB_uploadFileName)) {
			require_once($KT_DB_uploadFileName);
		} else {
			die(sprintf($KT_DB_uploadErrorMsg,$KT_DB_uploadFileList[$KT_DB_i]));
		}
	}

?>
