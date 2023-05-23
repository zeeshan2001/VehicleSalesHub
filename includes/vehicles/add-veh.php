<?php
//Connection statement
require_once('../../Connections/ukcd.php');

//PM TODO: check if user is auuthenticated before insert record
// Required variables
$userid = $_POST['clientveh_userid'];
$vehid = $_POST['clientveh_vehid'];
//$status = $_POST['status'];



$table = 'a_ukcd_client_vehicles';
 
$record = array();
$record['clientveh_userid']  = $userid; 
$record['clientveh_vehid'] = $vehid;
// ADODB autoExecute method auotmatically sanitizes input
$ukcd->autoExecute($table,$record,'INSERT');

?> 
