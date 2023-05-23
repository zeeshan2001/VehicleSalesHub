<?php
if(strstr($_SERVER['SERVER_NAME'], 'uk-car-discount')) {
	$theurl = 'https://www.uk-car-discount.co.uk';
}
elseif (strstr($_SERVER['SERVER_NAME'], 'ukcardiscount')){
	$theurl = 'https://www.ukcardiscount.uk';
}
else {
	$theurl = 'http://ukcd.test';
}
?>
