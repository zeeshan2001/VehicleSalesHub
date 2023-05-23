<?php

 require_once('../../Connections/ukcd.php');
 session_start();

// Set Fetch Mode
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; // Associative array
// $ADODB_FETCH_MODE = ADODB_FETCH_NUM; // Numeric arrray
// ADODB_FETCH_MODE = ADODB_FETCH_DEFAULT;  // Default
// $ADODB_FETCH_MODE = ADODB_FETCH_BOTH // Both
// begin Recordset
$bindvars_saved_vehicles = $_SESSION['kt_login_id'];
$query_saved_vehicles = $ukcd->prepare("SELECT clientveh_id, clientveh_userid, image_filename, clientveh_vehid, manufacturers.name AS make, vehicles.long_description, vehicles.basic_price  FROM a_ukcd_client_vehicles LEFT JOIN vehicles ON clientveh_vehid = vehicles.id LEFT JOIN manufacturers ON vehicles.manufacturer_id = manufacturers.id WHERE clientveh_userid = ?");
$result = $ukcd->execute($query_saved_vehicles, $bindvars_saved_vehicles) or die($ukcd->ErrorMsg());

// PHP ADODB built in function to create array from recordset
$array = $result->GetArray();

// Set JSON header
header('Content-Type: application/json');

// Output array to JSON format;
echo json_encode($array);

?>