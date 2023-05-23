
<?php
//Connection statement
require_once('../../Connections/ukcd.php');

$data = json_decode(file_get_contents('php://input'), true);
$vehid = $data['id'];

//$id = 1; // tested manually and working

//delete
$delveh = $ukcd->prepare('DELETE FROM a_ukcd_client_vehicles WHERE clientveh_id = ?');
$result = $ukcd->execute($delveh, $vehid);

?>
