<?php
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysqli"
	$MM_ukcd_HOSTNAME = '127.0.0.1';
	$MM_ukcd_DATABASE = 'mysqli:ukcardiscount_ukcd';
	// $MM_ukcd_DATABASE = 'ukcardiscount_ukcd';
	$MM_ukcd_DBTYPE   = preg_replace('/:.*$/', '', $MM_ukcd_DATABASE);
	$MM_ukcd_DATABASE = preg_replace('/^[^:]*?:/', '', $MM_ukcd_DATABASE);
	// $MM_ukcd_USERNAME = 'ukcardiscount_zeeshan';
	$MM_ukcd_USERNAME = 'root';
	// $MM_ukcd_PASSWORD = 'devtest5473#';
	$MM_ukcd_PASSWORD = '';
	$MM_ukcd_LOCALE = 'En';
	$MM_ukcd_MSGLOCALE = 'En';
	$MM_ukcd_CTYPE = 'C';
	$KT_locale = $MM_ukcd_MSGLOCALE;
	$KT_dlocale = $MM_ukcd_LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;

	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR.'/../adodb/adodb.inc.php');
	$ukcd=KTNewConnection($MM_ukcd_DBTYPE);

	if($MM_ukcd_DBTYPE == 'access' || $MM_ukcd_DBTYPE == 'odbc'){
		if($MM_ukcd_CTYPE == 'P'){
			$ukcd->PConnect($MM_ukcd_DATABASE, $MM_ukcd_USERNAME,$MM_ukcd_PASSWORD);
		} else $ukcd->Connect($MM_ukcd_DATABASE, $MM_ukcd_USERNAME,$MM_ukcd_PASSWORD);
	} else if (($MM_ukcd_DBTYPE == 'ibase') or ($MM_ukcd_DBTYPE == 'firebird')) {
		if($MM_ukcd_CTYPE == 'P'){
			$ukcd->PConnect($MM_ukcd_HOSTNAME.':'.$MM_ukcd_DATABASE,$MM_ukcd_USERNAME,$MM_ukcd_PASSWORD);
		} else $ukcd->Connect($MM_ukcd_HOSTNAME.':'.$MM_ukcd_DATABASE,$MM_ukcd_USERNAME,$MM_ukcd_PASSWORD);
	}else {
		if($MM_ukcd_CTYPE == 'P'){
			$ukcd->PConnect($MM_ukcd_HOSTNAME,$MM_ukcd_USERNAME,$MM_ukcd_PASSWORD, $MM_ukcd_DATABASE);
		} else $ukcd->Connect($MM_ukcd_HOSTNAME,$MM_ukcd_USERNAME,$MM_ukcd_PASSWORD, $MM_ukcd_DATABASE);
   }

	if (!function_exists('prepareData')) {
		function prepareData($HTTP_VARS){
			if (is_array($HTTP_VARS)) {
				foreach ($HTTP_VARS as $name=>$value) {
					if (!is_array($value)) {
						$HTTP_VARS[$name] = addslashes($value);
					} else {
						foreach ($value as $name1=>$value1) {
							if (!is_array($value1)) {
								$HTTP_VARS[$name1][$value1] = addslashes($value1);
							}
						}
					}
				}
			}
			return $HTTP_VARS;
		}
			$_GET = prepareData($_GET);
			$_POST = prepareData($_POST);
			$_COOKIE = prepareData($_COOKIE);
	}
	if (!isset($_SERVER['REQUEST_URI']) && isset($_ENV['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_ENV['REQUEST_URI'];
	}
	if (!isset($_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'].(isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:"");
	}
?>