<?php

//Connection statement
require_once('../Connections/ukcd.php');
@session_start();

    $getManufacturer = $_GET['manufacturer'];
    $getModel = $_GET['model'];
    $getBodyStyle = $_GET['bodyStyle'];
    $getTrim = $_GET['trim'];
    $getFuelType = $_GET['fuelType'];
    $getTransmissionType = $_GET['transmissionType'];
    $getDoor = $_GET['door'];
    
    $WHERE_CLAUSE = " WHERE vehicles.commercial = 0 ";
    $reqData = [];

    if($getManufacturer || empty($getManufacturer)) $reqData['manufacturers'] = $getManufacturer || $getManufacturer === '' ? $getManufacturer :  $_SESSION['tfi_listcarmake1_manufacturer_id'];

    if($getModel || empty($getModel)) $reqData['models'] = $getModel || $getModel === '' ? $getModel : $_SESSION['tfi_listcarmake1_model_group'];
    
    if($getBodyStyle || empty($getBodyStyle)) $reqData['bodyStyles'] = $getBodyStyle || $getBodyStyle === '' ? $getBodyStyle : $_SESSION['tfi_listcarmake1_expanded_body_style_id'];

    if($getTrim || empty($getTrim)) $reqData['trims'] = $getTrim || $getTrim === '' ? $getTrim : $_SESSION['tfi_listcarmake1_trim'];

    if($getFuelType || empty($fuelType)) $reqData['fuelTypes'] = $getFuelType || $getFuelType === '' ? $getFuelType : $_SESSION['tfi_listcarmake1_fuel_type_id'];

    if($getTransmissionType || empty($transmissionType)) $reqData['transmissionTypes'] = $getTransmissionType || $getTransmissionType === '' ? $getTransmissionType : $_SESSION['tfi_listcarmake1_transmission_type_id'];


    if($getDoor || empty($getDoor)) $reqData['doors'] = $getDoor || $getDoor === '' ? $getDoor : $_SESSION['tfi_listcarmake1_doors'];


    if (isset($getManufacturer) && !empty($getManufacturer)){
        $_SESSION['tfi_listcarmake1_manufacturer_id'] = $getManufacturer;
        $manufacturer = $getManufacturer;
        $WHERE_CLAUSE .= " AND vehicles.`manufacturer_id`= '$getManufacturer' ";
    }
    if (isset($getModel) && !empty($getModel)){
        $_SESSION['tfi_listcarmake1_model_group'] = $getModel;
        $model = $getModel;
        // $reqData['models'] = $getModel;
        $WHERE_CLAUSE .= " AND vehicles.`model_group`= '$getModel' ";
    }
    if (isset($getBodyStyle) && !empty($getBodyStyle)){
        $_SESSION['tfi_listcarmake1_expanded_body_style_id'] = $getBodyStyle;
        $bodyStyle = $getBodyStyle;
        // $reqData['bodyStyles'] = $getBodyStyle;
        $WHERE_CLAUSE .= " AND expanded_body_style.`id`= '$getBodyStyle' ";
    }
    if (isset($getTrim) && !empty($getTrim)){
        $_SESSION['tfi_listcarmake1_trim'] = $getTrim;
        $trim = $getTrim;
        // $reqData['trims'] = $getTrim;
        $WHERE_CLAUSE .= " AND vehicles.`trim`= '$getTrim' ";
    }
    if (isset($getFuelType) && !empty($getFuelType)){
        $_SESSION['tfi_listcarmake1_fuel_type_id'] = $getFuelType;
        $fuelType = $getFuelType;
        // $reqData['fuelTypes'] = $getFuelType;
        $WHERE_CLAUSE .= " AND fuel_types.`id`= '$getFuelType' ";
    }
    if (isset($getTransmissionType) && !empty($getTransmissionType)){
        $_SESSION['tfi_listcarmake1_transmission_type_id'] = $getTransmissionType;
        $transmissionType = $getTransmissionType;
        // $reqData['transmissionTypes'] = $getTransmissionType;
        $WHERE_CLAUSE .= " AND transmission_types.`id`= '$getTransmissionType' ";
    }
    if (isset($getDoor) && !empty($getDoor)){
        $_SESSION['tfi_listcarmake1_doors'] = $getDoor;
        $door = $getDoor;
        // $reqData['doors'] = $getDoor;
        $WHERE_CLAUSE .= " AND vehicles.`doors`= '$getDoor' ";
    }

    // Defining List Recordset variable
    // $NXTFilter__carmake = "1=1";
    // if (isset($_SESSION['filter_tfi_listcarmake1'])) {
    // $NXTFilter__carmake = $_SESSION['filter_tfi_listcarmake1'];
    // }
    // Defining List Recordset variable
    $NXTSort__carmake = "manufacturer_id";
    if (isset($_SESSION['sorter_tso_listcarmake1'])) {
    $NXTSort__carmake = $_SESSION['sorter_tso_listcarmake1'];
    }

    $query_model_group = "SELECT vehicles.id AS vehicle_id, vehicles.manufacturer_id, manufacturers.name as manufacturer, vehicles.model_group, vehicles.trim, manufacturers.name AS vehicle_make, vehicles.doors, vehicles.transmission_type_id, vehicles.expanded_body_style_id, vehicles.fuel_type_id, transmission_types.name AS transmission, fuel_types.name AS fuel_type, expanded_body_style.description AS bodystyle FROM vehicles LEFT JOIN manufacturers ON vehicles.manufacturer_id = manufacturers.id LEFT JOIN a_ukcd_manufacturers ON manufacturers.id = a_ukcd_manufacturers.make_ids_id LEFT JOIN expanded_body_style ON vehicles.expanded_body_style_id = expanded_body_style.id LEFT JOIN fuel_types ON vehicles.fuel_type_id = fuel_types.id LEFT JOIN transmission_types ON vehicles.transmission_type_id = transmission_types.id ". $WHERE_CLAUSE . " ORDER BY {$NXTSort__carmake}";
    // echo '*******SQL QUERY******* '.$query_model_group; exit;
    $rs = $ukcd->Execute($query_model_group) or die($ukcd->ErrorMsg());
    if($rs === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->ErrorMsg(), E_USER_ERROR);
    } else {
            $rows_returned = $rs->RecordCount();
    }
    
    $manufacturers = [];
    $models = [];
    $bodyStyles = [];
    $trims = [];
    $fuelTypes = [];
    $transmissionTypes = [];
    $doors = [];
    $response = [];

    $rs->MoveFirst();
    while (!$rs->EOF) {

            $manufacturerId = $rs->fields['manufacturer_id'];
            $manufacturer = $rs->fields['manufacturer'];
            
            $model = $rs->fields['model_group'];
            
            $bodyStyleId = $rs->fields['expanded_body_style_id'];
            $bodyStyle = $rs->fields['bodystyle'];
            
            $trim = $rs->fields['trim'];
            
            $fuelTypeId = $rs->fields['fuel_type_id'];
            $fuelType = $rs->fields['fuel_type'];
            
            $transmissionTypeId = $rs->fields['transmission_type_id'];
            $transmissionType = $rs->fields['transmission'];
            
            $door = $rs->fields['doors'];
            

            array_push($manufacturers, ["value" => $manufacturerId, "label" => $manufacturer]);
            array_push($models, ["value" => $model, "label" => $model]);
            array_push($bodyStyles, ["value" => $bodyStyleId, "label" => $bodyStyle]);
            array_push($trims, ["value" => $trim, "label" => $trim]);
            array_push($fuelTypes, ["value" => $fuelTypeId, "label" => $fuelType]);
            array_push($transmissionTypes, ["value" => $transmissionTypeId, "label" => $transmissionType]);
            array_push($doors, ["value" => $door, "label" => $door]);
            $rs->MoveNext();
    }

    $response['options']['manufacturers'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $manufacturers))));
    $response['options']['models'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $models))));
    $response['options']['bodyStyles'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $bodyStyles))));
    $response['options']['trims'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $trims))));
    $response['options']['fuelTypes'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $fuelTypes))));
    $response['options']['transmissionTypes'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $transmissionTypes))));
    $response['options']['doors'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $doors))));

    $response['options']['reqData'] = $reqData;
    $response['options']['selectedFilters'] = [ 
        'manufacturers' => $_SESSION['tfi_listcarmake1_manufacturer_id'],
        'models' => $_SESSION['tfi_listcarmake1_model_group'],
        'bodyStyles' => $_SESSION['tfi_listcarmake1_expanded_body_style_id'],
        'trims' => $_SESSION['tfi_listcarmake1_trim'],
        'fuelTypes' => $_SESSION['tfi_listcarmake1_fuel_type_id'],
        'transmissionTypes' => $_SESSION['tfi_listcarmake1_transmission_type_id'],
        'doors' => $_SESSION['tfi_listcarmake1_doors'],
    ];
    // echo json_encode($rs->GetRows());
    echo json_encode($response);

?>