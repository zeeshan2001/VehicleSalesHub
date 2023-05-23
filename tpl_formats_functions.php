<?php
function formatSlug($string) {
$string = strtolower($string); //to lowercase
$string = str_replace(' - ', '-', $string); // replace hyphen with spaces either side with hyphen
$string = str_replace('+', '-plus-', $string); // deal with + sign in trim and long description
$string = str_replace(array(' ', '.', '/'), array('-', '', '-'), $string);
$string = str_replace('--', '-', $string); //Fix double hyphens which look ugly
return $string;
}
//Format model name when outputted to page
function formatModel($string) {
$string = strtolower($string); //to lowercase
$string = str_replace('- ','-',ucwords(str_replace('-','- ', $string))); //capitilise
$string = str_replace(array('St-', 'C-Hr', 'Gt-R', 'Phev', 'Xv', 'Cx-', 'Ux '), array('ST-', 'C-HR', 'GT-R', 'PHEV', 'XV', 'CX-', 'UX '), $string); //fix incorrectly formatted trim-level names in DB
return $string;
}
//Format trim-level when outpuitted to page
function formatTrim($string) {
$string = strtolower($string); //to lowercase
$string = str_replace('- ','-',ucwords(str_replace('-','- ', $string))); //title case
$string = str_replace(array('St-', 'Gt ', 'GT-', 'R.s.'), array('ST-', 'GT ', 'GT-', 'R.S.'), $string); //fix incorrectly formatted trim-level names in DB
$string = preg_replace(array('/^St$/','/^Gt$/'), array('ST','GT'), $string); //fix incorrectly formatted trim-level names in DB
return $string;
}
//Format model tree wqhen outputted to page
function formatTree($string) {  //format vehicle tree description
$string = str_replace(array('R.s.', 'Phev'), array('R.S.', 'PHEV'), $string); // incorrectly formated info in DB
return $string;
}
?>
