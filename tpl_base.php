<?php
if(strstr($_SERVER['SERVER_NAME'], 'uk-car-discount')) {
	echo '<base href="https://www.uk-car-discount.co.uk">';
}
elseif (strstr($_SERVER['SERVER_NAME'], 'ukcardiscount')){
	echo '<base href="https://searchcode.ukcardiscount.uk">';
}
else {
	echo '<base href="http://ukcd.test">';
}
?>
