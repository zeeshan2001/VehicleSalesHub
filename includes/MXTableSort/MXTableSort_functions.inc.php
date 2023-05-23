<?php
function getSortParameter($rsName, $validArr, $defaultValue) {
  $value = "";
  if (isset($_GET['order_'.$rsName])) {
    $value = $_GET['order_'.$rsName];
  }
	$found = false;
	for($i=0;$i<count($validArr);$i++) {
		if ($value == $validArr[$i]) {
			$value = $validArr[$i];
			$found = true;
			break;
		}
		if ($value == $validArr[$i]." DESC") {
			$value = $validArr[$i]." DESC";
			$found = true;
			break;
		}
	}
	if ($found == false) {
		$value = $defaultValue;
	}
	$GLOBALS['KT_order_'.$rsName] = $value;
	return $value;
}

// Get Current Sort
function getCurrentSort($rsName) {
  $value = $GLOBALS['KT_order_'.$rsName];
  return $value;
}

//Get Sort Icon Function
function getSortIcon($rsName,$column){
  $value = getCurrentSort($rsName);
  if ($value == $column) {
    return 'v';
  } elseif ($value == $column.' DESC') {
    return '^';
  }
}

//Get Sort Link Function
function getSortLink($rsName,$column){
  $value = getCurrentSort($rsName);
  $paramVal = $column;  
  if($value == $column){
  	$paramVal .= " DESC";
  }
  if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
	  $ret = MXTableSort_replaceParam($_SERVER['QUERY_STRING'],"order_".$rsName, $paramVal);
  } else {
	  $ret = "order_".$rsName.'='.urlencode($paramVal);
  }
  
  if (!isset($_SERVER['PHP_SELF']) && isset($_ENV['PHP_SELF'])) {
      $_SERVER['PHP_SELF'] = $_ENV['PHP_SELF'];
  }
  return $_SERVER['PHP_SELF'].'?'.$ret;
  }
  
function MXTableSort_replaceParam($qstring, $paramName, $paramValue = null) {
	$arr = explode('&',$qstring);
	foreach($arr as $key=>$value) {
		$tmpArr = explode('=',$value);
		if ($tmpArr[0] == $paramName) {
			unset($arr[$key]);
			break;
		}
	}
	if ($paramValue !== null) {
		$arr[] = $paramName.'='.urlencode($paramValue);
	}
	$ret = implode('&',$arr);
  return $ret;
}


?>
