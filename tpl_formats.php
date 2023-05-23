<?php
function formatSlug($string) {
$string = strtolower($string); //to lowercase
$string = str_replace(' - ', '-', $string); // replace hyphen with spaces either side with hyphen
$string = str_replace(array(' ', '.', '/'), array('-', '', '-'), $string); //spaces to hyphen, forward slash to hyphen and strip dots
return $string;
}
//Format model name
function formatModel($string) { 
$string = strtolower($string); //to lowercase
$string = str_replace('- ','-',ucwords(str_replace('-','- ', $string))); //capitilise
$string = str_replace(array('St-', 'C-Hr', 'Gt-R'), array('ST-', 'C-HR', 'GT-R'), $string); //fix incorrectly formatted trim-level names in DB
return $string;
}
//Format trim-level
function formatTrim($string) { 
$string = strtolower($string); //to lowercase
$string = str_replace('- ','-',ucwords(str_replace('-','- ', $string))); //title case
$string = str_replace(array('St-', 'Gt ', 'GT-', 'R.s.'), array('ST-', 'GT ', 'GT-', 'R.S.'), $string); //fix incorrectly formatted trim-level names in DB
$string = preg_replace(array('/^St$/','/^Gt$/'), array('ST','GT'), $string); //fix incorrectly formatted trim-level names in DB
return $string;
}
//Format model tree
function formatTree($string) {  //format vehicle tree description
$string = str_replace(array('R.s.', 'Phev'), array('R.S.', 'PHEV'), $string); // incorrectly formated info in DB
return $string;
}
?>
