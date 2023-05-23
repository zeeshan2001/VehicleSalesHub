**************************
NOV/DEV 2018 UPDATES
**************************
1) edited includes/nav/NAV_Regular.class.php added strip_tagsn to show_all URL output for some further XSS protection

2) Updated PEAR libraries for PHP 7.2

3) Updated various includes files for PHP 7.2

4) Updated ADODB for PHP 7.2


**************************
2016-2017 UPDATES
CUSTOM INCLUDES FOLDER
**************************

1) Added basic nav.php
2) Added CSS for centering forms [see common.css]
3) Added CSS for centering NXT forms and lists [see common.css]
4) Added CSS for equal width form elements [see common.css]
5) Added files for spin.js [see /includes/loader/]
6) Added code to trigger spinner on form submit [see includes/nxt/scripts/form.js]
7) Added code to trigger spinner on delete from list page [see includes/nxt/scripts/list.js (lines 180/181)
8) Various visual tweaks to the Aqua theme

//DIV ENCLOSURE TO CENTER THE LOGIN FORM

<div class="login-box-outer">
<div class="login-box">
 //LOGIN FORM HERE
</div</div>

********************************************************************************

//DIV ENCLOSE TO CENTER NXT FORMS AND LISTS

<div class="KT_mainarea"> </div>

********************************************************************************

//SPIN.JS LOADER CODE - ADD BEFORE CLOSING BODY TAG ON FORM PAGES:

<?php includes ('includes/loader/spinner.php') />

********************************************************************************