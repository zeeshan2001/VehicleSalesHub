<?php
function KT_setServerVariables_srchfnc() {
	if (!isset($_SERVER['QUERY_STRING']) && isset($_ENV['QUERY_STRING'])) {
		$_SERVER['QUERY_STRING'] = $_ENV['QUERY_STRING'];
	}
	if (!isset($_SERVER['QUERY_STRING'])) {
		$_SERVER['QUERY_STRING'] = '';
	}
	if (!isset($_SERVER['PHP_SELF']) && isset($_ENV['PHP_SELF'])) {
		$_SERVER['PHP_SELF'] = $_ENV['PHP_SELF'];
	}
	if (!isset($_SERVER['REQUEST_URI']) && isset($_ENV['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_ENV['REQUEST_URI'];
	}
	if (!isset($_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'].(isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:"");
	}
	if (!isset($_SERVER['SERVER_NAME']) && isset($_ENV['SERVER_NAME'])) {
		$_SERVER['SERVER_NAME'] = $_ENV['SERVER_NAME'];
	}
	if (!isset($_SERVER['HTTP_HOST']) && isset($_ENV['HTTP_HOST'])) {
		$_SERVER['HTTP_HOST'] = $_ENV['HTTP_HOST'];
	}
	if (!isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SERVER_NAME'])) {
		$_SERVER['HTTP_HOST'] = $_SERVER['SERVER_NAME'];
	}
	if (!isset($_SERVER['HTTPS']) && isset($_ENV['HTTPS'])) {
		$_SERVER['HTTPS'] = $_ENV['HTTPS'];
	}
	if (!isset($_SERVER['HTTP_REFERER']) && isset($_ENV['HTTP_REFERER'])) {
		$_SERVER['HTTP_REFERER'] = $_ENV['HTTP_REFERER'];
	}
	if (!isset($_SERVER['HTTP_USER_AGENT']) && isset($_ENV['HTTP_USER_AGENT'])) {
		$_SERVER['HTTP_USER_AGENT'] = $_ENV['HTTP_USER_AGENT'];
	}
	if (!isset($_SERVER['REMOTE_ADDR']) && isset($_ENV['REMOTE_ADDR'])) {
		$_SERVER['REMOTE_ADDR'] = $_ENV['REMOTE_ADDR'];
	}
	if (!isset($_SERVER['SCRIPT_FILENAME']) && isset($_ENV['SCRIPT_FILENAME'])) {
		$_SERVER['SCRIPT_FILENAME'] = $_ENV['SCRIPT_FILENAME'];
	}
	if (!isset($_SERVER['PATH_TRANSLATED']) && isset($_ENV['PATH_TRANSLATED'])) {
		$_SERVER['PATH_TRANSLATED'] = $_ENV['PATH_TRANSLATED'];
	}
	if (!isset($_SERVER['PATH_TRANSLATED']) && isset($_SERVER['ORIG_PATH_TRANSLATED'])) {
		$_SERVER['PATH_TRANSLATED'] = $_SERVER['ORIG_PATH_TRANSLATED'];
	}
	if (!isset($_SERVER['PATH_TRANSLATED']) && isset($_SERVER['DOCUMENT_ROOT']) && isset($_SERVER['PHP_SELF'])) {
		$_SERVER['PATH_TRANSLATED'] = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];
	}
	if (!isset($_SERVER['PATH_TRANSLATED']) && isset($_SERVER['SCRIPT_FILENAME'])) {
		$_SERVER['PATH_TRANSLATED'] = $_SERVER['SCRIPT_FILENAME'];
	}
	if (!isset($_SERVER['SERVER_PROTOCOL']) && isset($_ENV['SERVER_PROTOCOL'])) {
		$_SERVER['SERVER_PROTOCOL'] = $_ENV['SERVER_PROTOCOL'];
	}
	if (!isset($GLOBALS['HTTP_SERVER_VARS'])) {
		$GLOBALS['HTTP_SERVER_VARS'] = &$_SERVER;
	}
	if (!isset($GLOBALS['HTTP_GET_VARS'])) {
		$GLOBALS['HTTP_GET_VARS'] = &$_GET;
	}
	if (!isset($GLOBALS['HTTP_POST_VARS'])) {
		$GLOBALS['HTTP_POST_VARS'] = &$_POST;
	}
	if (!isset($GLOBALS['HTTP_COOKIE_VARS'])) {
		$GLOBALS['HTTP_COOKIE_VARS'] = &$_COOKIE;
	}
	if (!isset($GLOBALS['HTTP_SESSION_VARS'])) {
		$GLOBALS['HTTP_SESSION_VARS'] = &$_SESSION;
	}
	if (!isset($GLOBALS['HTTP_ENV_VARS'])) {
		$GLOBALS['HTTP_ENV_VARS'] = &$_ENV;
	}
}
	
function KT_Rel2AbsUrl_srchfnc($pageUrl, $templateUrl, $relUrl) {
	if (substr($relUrl,0,1) == "/") {
		return KT_getServerName_srchfnc().$relUrl;
	}
	if (strpos($relUrl,"://") !== false) {
		return $relUrl;
	}
	
	$arrTemplateUrl = explode('/', $templateUrl);
	array_pop($arrTemplateUrl);
	if (strpos($templateUrl,"://") !== false) {
		$ret = implode('/', $arrTemplateUrl) . (count($arrTemplateUrl)>0?'/':'') . $relUrl;
	} else {
		$arrPageUrl = explode('/', $pageUrl);
		array_pop($arrPageUrl);
		$ret = implode('/', $arrPageUrl) . '/' . implode('/', $arrTemplateUrl) . (count($arrTemplateUrl)>0?'/':'') . $relUrl;
	}
	$ret = KT_CanonizeRelPath_srchfnc($ret);
	return $ret;
}

function KT_CanonizeRelPath_srchfnc($relPath) {
	if (strpos($relPath, "..") !== false || strpos($relPath, "/.") !== false) {
		$parts = explode('/',$relPath);
		$newParts = array();
		for($i=0;$i<count($parts);$i++) {
			if ($parts[$i] == '..') {
				if (count($newParts) > 0) {
					array_pop($newParts);
				} else {
					$newParts[] = $parts[$i];
				}
			} elseif ($parts[$i] != '.') {
				$newParts[] = $parts[$i];
			}
		}
		$ret = implode('/',$newParts);
	} else {
		$ret = $relPath;
	}
	return $ret;
}

function KT_getServerName_srchfnc()
{
	$protocol = strtolower(array_shift(explode('/', $_SERVER['SERVER_PROTOCOL'])));
	if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
		$protocol = "https";
	}
	$baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'];
	if (substr($baseUrl, -1)=='/') {
		$baseUrl = substr($baseUrl, 0, strlen($baseUrl)-1);
	}
	if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!='' && $_SERVER['SERVER_PORT']!='80' && $_SERVER['SERVER_PORT']!='443') {
		$baseUrl .= ':'.$_SERVER['SERVER_PORT'];
	}
	return $baseUrl;
}

function KT_getPHP_SELF_srchfnc() {
	KT_setServerVariables_srchfnc();
	$script = $_SERVER['REQUEST_URI'];
	if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
		$script = substr($script, 0, -strlen($_SERVER['QUERY_STRING']));
	}
	if (substr($script, -1) == '?') {
		$script = substr($script, 0, -1);
	}
	return $script;
}
/**
 * Return the URL of the page in which the script is called. 
 * @return string return the URL (ex. http://server.com/dir/papa.php );
 */
function KT_getUri_srchfnc()
{
	$script = KT_getPHP_SELF_srchfnc();
	if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO']!='' && $_SERVER['PATH_INFO']!=$script) {
		$script = substr($script, 0, strlen($script)-strlen($_SERVER['PATH_INFO']));
	}
	return KT_getServerName_srchfnc() . $script;
}

function KT_makeIncludedURL_srchfnc($url) {
	$ret = $url;
	if (isset($GLOBALS['KT_REL_PATH'])) {
		if (!preg_match("#^/#", $ret) && !preg_match("#^[a-z]+://#", $ret)) {
			$ret = $GLOBALS['KT_REL_PATH'] . $ret;
		}
	}
	return $ret;
}

class KT_MXSearchConfig {
	var $Tables; //array of table configurations
	
	function KT_MXSearchConfig() {
		$this->Tables = array();
	}
	
	function addTable($tableName, $tableImportance, $titleField, $descField, $pageName, $pageParam, $aditionalCond) {
		$url = KT_Rel2AbsUrl_srchfnc(KT_getUri_srchfnc(), "", KT_makeIncludedURL_srchfnc($pageName));
		
		$this->Tables[$tableName] = array(
		     'TableImportance' => $tableImportance,
		     'resultTitle' => "$titleField",
		     'resultDesc' => "$descField",
		     'pageName' => "$url",
		     'pageParam' => "$pageParam",
		     'AditionalCondition' => "$aditionalCond",
		     'searchColumns' => array()
		   );
	}
	
	function addField($tableName, $fieldName, $fieldImportance) {
		$this->Tables[$tableName]['searchColumns'][$fieldName] = $fieldImportance;
	}
}
// end class 
?>
