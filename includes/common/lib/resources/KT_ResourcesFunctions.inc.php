<?php

/**
 * Getter the resource value;
 * @var string $resourceName the resource key;
 * @var array $dictionary  dictionary name;
 * @var array $args array with optional parameters for sprintf functions.
 * @return string;
 * @access public
 */
function KT_getResource($resourceName='default', $dictionary='default', $args = array()) {
	if (!isset($GLOBALS['interakt']['resources'])) {
		$GLOBALS['interakt']['resources'] = array();
	}
	$dictionaryFileName = KT_realpath(dirname(realpath(__FILE__)). '/../../../resources/'). '%s.res.php';
	$resourceValue = $resourceName;
	
	if (!isset($GLOBALS['interakt']['resources'][$dictionary])) {
		@include(sprintf($dictionaryFileName,$dictionary));
		if (isset($res)) {
			$GLOBALS['interakt']['resources'][$dictionary] = $res;
			unset($res);
		}
		@include(sprintf($dictionaryFileName,$dictionary."_pro"));
		if (isset($res)) {
			$GLOBALS['interakt']['resources'][$dictionary] = array_merge($GLOBALS['interakt']['resources'][$dictionary], $res);
		}

	}

	if (isset($GLOBALS['interakt']['resources'][$dictionary][$resourceName])) {
		$resourceValue = $GLOBALS['interakt']['resources'][$dictionary][$resourceName];
	} else {
		/*if (trim($resourceName) != "" && trim($resourceName) != "%s") {
			die("<br />Resource '".$resourceName."' not defined in dictionary '".$dictionary."'.<br />");
		}*/
		if (substr($resourceValue,-2) == "_D") {
			$resourceValue = substr($resourceValue,0,-2);
		}
	}

	if (count($args) > 0) {
		array_unshift($args, $resourceValue);
		$resourceValue = call_user_func_array('sprintf', $args);
	}
	return $resourceValue;
}
?>
