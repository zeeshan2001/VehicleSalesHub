<?php

require_once('../common/KT_common.php');
	KT_setServerVariables();
	KT_session_start();

	if (!isset($_SESSION['KT_backArr'])) {
		if (isset($_SERVER['HTTP_REFERER'])) {
			$_SESSION['KT_backArr'] = array();
			array_push($_SESSION['KT_backArr'],$_SERVER['HTTP_REFERER']);
		} else {
			//TODO
			die('There is no page set to go back to. Please click the Back link to be redirected to the form. <a href="javascript: history.go(-1)">Back</a>');
		}
	} else {
		//if (count($_SESSION['KT_backArr']) < 1) {
		//PM NOTE: Above line updated for PHP 7.3+
		if (is_countable($_SESSION['KT_backArr']) && count($_SESSION['KT_backArr']) < 1) {
			if (isset($_SESSION['KT_exBack'])) {
				array_push($_SESSION['KT_backArr'], $_SESSION['KT_exBack']);
			} else {
				//TODO
				die('Internal Error');
			}
		}
	}
	$KT_back = array_pop($_SESSION['KT_backArr']);
		//if (count($_SESSION['KT_backArr']>0) && isset($_GET['KT_back']) && $_GET['KT_back'] == -2) {
	//PM NOTE: Above line updated to fix PHP 7.3+ warning
		if (is_countable($_SESSION['KT_backArr']) && count($_SESSION['KT_backArr']>0) && isset($_GET['KT_back']) && $_GET['KT_back'] == -2) {
		$KT_back = array_pop($_SESSION['KT_backArr']);
	}
	$_SESSION['KT_exBack'] = $KT_back;
	$KT_back = KT_addReplaceParam($KT_back, '/^totalRows_.*$/i');
	KT_redir($KT_back);
	exit;
?>
