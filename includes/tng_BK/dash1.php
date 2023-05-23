<?php
//Connection statement
require_once('Connections/ukcd.php');

// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($ukcd, "");
//Grand Levels: Level
if (@$_SESSION['kt_user_permissions_dashboards'] == 1) {
$restrict->addLevel("1");
}else{
$restrict->addLevel("0");
}
$restrict->Execute();
//End Restrict Access To Page
?>
<!doctype html><?php //PHP ADODB document - made with PHAkt [Updated For PHP 7] ?>
<html>
<head>
<title>Dashboard</title>
<meta charset="utf-8">


<link href="includes/skins/main.css" rel="stylesheet" type="text/css">
</head>

<body class="temp">

<?php include('includes/header/header.php'); ?>
		<h1> Dashboard 1</h1>

</body>
</html>
