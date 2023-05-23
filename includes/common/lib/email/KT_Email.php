<?php

	$KT_EML_uploadErrorMsg = '<strong>File not found:</strong> <br />%s<br /><strong>Please upload the includes/ folder to the testing server.</strong> <br />';
	$KT_EML_uploadFileList = array('KT_Email.class.php', '../resources/KT_Resources.php');

	for ($KT_EML_i=0;$KT_EML_i<sizeof($KT_EML_uploadFileList);$KT_EML_i++) {
		$KT_EML_uploadFileName = dirname(realpath(__FILE__)). '/' . $KT_EML_uploadFileList[$KT_EML_i];
		if (file_exists($KT_EML_uploadFileName)) {
			require_once($KT_EML_uploadFileName);
		} else {
			die(sprintf($KT_EML_uploadErrorMsg,$KT_EML_uploadFileList[$KT_EML_i]));
		}
	}

	define('PEARDIR', dirname(realpath(__FILE__)) . '/Pear/');

?>
