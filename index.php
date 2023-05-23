<?php
//Connection statement
require_once('Connections/ukcd.php');

//Aditional Functions
require_once('includes/functions.inc.php');

//Connection statementfilter
require_once('Connections/ukcd.php');

//Aditional Functionsnone
require_once('includes/functions.inc.php');

// Load the common classes
require_once('includes/common/KT_common.php');

// Load the required classes
require_once('includes/tfi/TFI.php');
require_once('includes/tso/TSO.php');
require_once('includes/nav/NAV.php');

// Filter
$tfi_listveh_discounts = new TFI_TableFilter($ukcd, "tfi_listveh_discounts");
$tfi_listveh_discounts->addColumn("veh_enabled", "NUMERIC_TYPE", "veh_enabled", "=");
$tfi_listveh_discounts->addColumn("make_enabled", "NUMERIC_TYPE", "make_enabled", "=");
$tfi_listveh_discounts->addColumn("vanmake_enabled", "NUMERIC_TYPE", "vanmake_enabled", "=");
$tfi_listveh_discounts->addColumn("veh_supplier", "NUMERIC_TYPE", "veh_supplier", "=");
$tfi_listveh_discounts->addColumn("current_vehicle", "NUMERIC_TYPE", "current_vehicle", "=");
$tfi_listveh_discounts->addColumn("commercial", "NUMERIC_TYPE", "commercial", "=");
$tfi_listveh_discounts->addColumn("manufacturer_id", "NUMERIC_TYPE", "manufacturer_id", "=");
$tfi_listveh_discounts->addColumn("model_group", "STRING_TYPE", "model_group", "%");
$tfi_listveh_discounts->addColumn("expanded_body_style_id", "NUMERIC_TYPE", "expanded_body_style_id", "=");
$tfi_listveh_discounts->addColumn("trim", "STRING_TYPE", "trim", "%");
$tfi_listveh_discounts->addColumn("fuel_type_id", "NUMERIC_TYPE", "fuel_type_id", "=");
$tfi_listveh_discounts->addColumn("transmission_type_id", "NUMERIC_TYPE", "transmission_type_id", "=");
$tfi_listveh_discounts->addColumn("doors", "NUMERIC_TYPE", "doors", "=");
$tfi_listveh_discounts->addColumn("veh_show_on_homepage", "CHECKBOX_1_0_TYPE", "veh_show_on_homepage", "%");
$tfi_listveh_discounts->addColumn("veh_show_on_deals_page", "CHECKBOX_1_0_TYPE", "veh_show_on_deals_page", "%");
$tfi_listveh_discounts->addColumn("veh_show_on_stock_page", "CHECKBOX_1_0_TYPE", "veh_show_on_stock_page", "%");
$tfi_listveh_discounts->addColumn("veh_top_left_tag", "NUMERIC_TYPE", "veh_top_left_tag", "=");
$tfi_listveh_discounts->addColumn("veh_top_right_tag", "NUMERIC_TYPE", "veh_top_right_tag", "=");
$tfi_listveh_discounts->addColumn("veh_teaser_text", "STRING_TYPE", "veh_teaser_text", "%");
$tfi_listveh_discounts->addColumn("basic_price", "NUMERIC_TYPE", "basic_price", "=");
$tfi_listveh_discounts->addColumn("veh_buy_disc_perc", "NUMERIC_TYPE", "veh_buy_disc_perc", "=");
$tfi_listveh_discounts->addColumn("veh_buy_disc_fixed", "NUMERIC_TYPE", "veh_buy_disc_fixed", "=");
$tfi_listveh_discounts->addColumn("veh_buy_disc_options_perc", "NUMERIC_TYPE", "veh_buy_disc_options_perc", "=");
$tfi_listveh_discounts->addColumn("veh_sell_disc_perc", "NUMERIC_TYPE", "veh_sell_disc_perc", "=");
$tfi_listveh_discounts->addColumn("veh_sell_disc_fixed", "NUMERIC_TYPE", "veh_sell_disc_fixed", "=");
$tfi_listveh_discounts->addColumn("veh_sell_disc_options_perc", "NUMERIC_TYPE", "veh_sell_disc_options_perc", "=");
$tfi_listveh_discounts->addColumn("veh_profit", "NUMERIC_TYPE", "veh_profit", "=");
$tfi_listveh_discounts->addColumn("manufacturers_delivery", "NUMERIC_TYPE", "manufacturers_delivery", "=");
$tfi_listveh_discounts->Execute();

// Sorter
$tso_listveh_discounts = new TSO_TableSorter("veh_discounts", "tso_listveh_discounts");
$tso_listveh_discounts->addColumn("veh_enabled");
$tso_listveh_discounts->addColumn("make_enabled");
$tso_listveh_discounts->addColumn("vanmake_enabled");
$tso_listveh_discounts->addColumn("veh_supplier");
$tso_listveh_discounts->addColumn("current_vehicle");
$tso_listveh_discounts->addColumn("commercial");
$tso_listveh_discounts->addColumn("manufacturer_id");
$tso_listveh_discounts->addColumn("model_group");
$tso_listveh_discounts->addColumn("expanded_body_style_id");
$tso_listveh_discounts->addColumn("trim");
$tso_listveh_discounts->addColumn("fuel_type_id");
$tso_listveh_discounts->addColumn("transmission_type_id");
$tso_listveh_discounts->addColumn("doors");
$tso_listveh_discounts->addColumn("veh_show_on_homepage");
$tso_listveh_discounts->addColumn("veh_show_on_deals_page");
$tso_listveh_discounts->addColumn("veh_show_on_stock_page");
$tso_listveh_discounts->addColumn("veh_top_left_tag");
$tso_listveh_discounts->addColumn("veh_top_right_tag");
$tso_listveh_discounts->addColumn("veh_teaser_text");
$tso_listveh_discounts->addColumn("basic_price");
$tso_listveh_discounts->addColumn("veh_buy_disc_perc");
$tso_listveh_discounts->addColumn("veh_buy_disc_fixed");
$tso_listveh_discounts->addColumn("veh_buy_disc_options_perc");
$tso_listveh_discounts->addColumn("veh_sell_disc_perc");
$tso_listveh_discounts->addColumn("veh_sell_disc_fixed");
$tso_listveh_discounts->addColumn("veh_sell_disc_options_perc");
$tso_listveh_discounts->addColumn("veh_profit");
$tso_listveh_discounts->addColumn("manufacturers_delivery");
$tso_listveh_discounts->setDefault("veh_enabled DESC");
$tso_listveh_discounts->Execute();

// Navigation
$nav_listveh_discounts = new NAV_Regular("nav_listveh_discounts", "veh_discounts", "", $_SERVER['PHP_SELF'], 50);

// Begin List Recordset
$maxRows_veh_discounts = $_SESSION['max_rows_nav_listveh_discounts'];
$pageNum_veh_discounts = 0;
if (isset($_GET['pageNum_veh_discounts'])) {
  $pageNum_veh_discounts = $_GET['pageNum_veh_discounts'];
}
$startRow_veh_discounts = $pageNum_veh_discounts * $maxRows_veh_discounts;
// Defining List Recordset variable
$NXTFilter__veh_discounts = "1=1";
if (isset($_SESSION['filter_tfi_listveh_discounts'])) {
  $NXTFilter__veh_discounts = $_SESSION['filter_tfi_listveh_discounts'];
}
// Defining List Recordset variable
$NXTSort__veh_discounts = "veh_enabled DESC";
if (isset($_SESSION['sorter_tso_listveh_discounts'])) {
  $NXTSort__veh_discounts = $_SESSION['sorter_tso_listveh_discounts'];
}
$query_veh_discounts = "SELECT vehicles.id, vehicles.manufacturer_id, vehicles.current_vehicle, vehicles.commercial, vehicles.model_group, vehicles.long_description, vehicles.expanded_body_style_id, vehicles.trim, vehicles.fuel_type_id, vehicles.transmission_type_id, vehicles.doors, vehicles.basic_price, vehicles.manufacturers_delivery, vehicles.manufacturers_retail_price, vehicles.OTR, a_ukcd_vehicles.veh_ids_id, a_ukcd_vehicles.veh_supplier, a_ukcd_manufacturers.make_enabled, a_ukcd_manufacturers_vans.vanmake_enabled, a_ukcd_vehicles.veh_enabled, a_ukcd_vehicles.veh_show_on_homepage, a_ukcd_vehicles.veh_show_on_deals_page, a_ukcd_vehicles.veh_show_on_stock_page, a_ukcd_vehicles.veh_top_left_tag, a_ukcd_vehicles.veh_top_right_tag, a_ukcd_vehicles.veh_teaser_text, a_ukcd_vehicles.veh_buy_disc_perc, a_ukcd_vehicles.veh_buy_disc_fixed, a_ukcd_vehicles.veh_sell_disc_perc, a_ukcd_vehicles.veh_sell_disc_fixed, a_ukcd_vehicles.veh_buy_disc_options_perc, a_ukcd_vehicles.veh_sell_disc_options_perc, a_ukcd_vehicles.veh_profit, manufacturers.name AS manufacturer, expanded_body_style.description AS bodytyle, a_ukcd_suppliers.supplier_name FROM vehicles JOIN a_ukcd_vehicles ON vehicles.id = a_ukcd_vehicles.veh_ids_id LEFT JOIN manufacturers ON vehicles.manufacturer_id = manufacturers.id LEFT JOIN expanded_body_style ON vehicles.expanded_body_style_id = expanded_body_style.id LEFT JOIN a_ukcd_manufacturers ON manufacturers.id = a_ukcd_manufacturers.make_ids_id LEFT JOIN a_ukcd_manufacturers_vans ON manufacturers.id = a_ukcd_manufacturers_vans.vanmake_ids_id LEFT JOIN a_ukcd_suppliers ON a_ukcd_vehicles.veh_supplier = a_ukcd_suppliers.supplier_id WHERE  {$NXTFilter__veh_discounts}  ORDER BY  {$NXTSort__veh_discounts}";
$veh_discounts = $ukcd->SelectLimit($query_veh_discounts, $maxRows_veh_discounts, $startRow_veh_discounts) or die($ukcd->ErrorMsg());
if (isset($_GET['totalRows_veh_discounts'])) {
  $totalRows_veh_discounts = $_GET['totalRows_veh_discounts'];
} else {
  $all_veh_discounts = $ukcd->SelectLimit($query_veh_discounts) or die($ukcd->ErrorMsg());
  $totalRows_veh_discounts = $all_veh_discounts->RecordCount();
}
$totalPages_veh_discounts = (int)(($totalRows_veh_discounts-1)/$maxRows_veh_discounts);
// End List Recordset

// begin Recordset
$query_manufacturers = "SELECT id, name FROM manufacturers ORDER BY manufacturers.name ASC";
$manufacturers = $ukcd->SelectLimit($query_manufacturers) or die($ukcd->ErrorMsg());
$totalRows_manufacturers = $manufacturers->RecordCount();
// end Recordset

// begin Recordset
$query_models = "SELECT DISTINCT manufacturer_id, model_group FROM vehicles GROUP BY model_group ORDER BY model_group ASC";
$models = $ukcd->SelectLimit($query_models) or die($ukcd->ErrorMsg());
$totalRows_models = $models->RecordCount();
// end Recordset

// begin Recordset
$query_bodystyles = "SELECT * FROM expanded_body_style ORDER BY expanded_body_style.description ASC";
$bodystyles = $ukcd->SelectLimit($query_bodystyles) or die($ukcd->ErrorMsg());
$totalRows_bodystyles = $bodystyles->RecordCount();
// end Recordset

// begin Recordset
$query_trimlevel = "SELECT DISTINCT vehicles.id, vehicles.trim, vehicles.model_group FROM vehicles WHERE vehicles.trim IS NOT NULL GROUP BY vehicles.trim ORDER BY vehicles.trim ASC";
$trimlevel = $ukcd->SelectLimit($query_trimlevel) or die($ukcd->ErrorMsg());
$totalRows_trimlevel = $trimlevel->RecordCount();
// end Recordset

// begin Recordset
$query_fueltype = "SELECT * FROM fuel_types ORDER BY fuel_types.name ASC";
$fueltype = $ukcd->SelectLimit($query_fueltype) or die($ukcd->ErrorMsg());
$totalRows_fueltype = $fueltype->RecordCount();
// end Recordset

// begin Recordset
$query_transmission = "SELECT * FROM transmission_types ORDER BY transmission_types.name ASC";
$transmission = $ukcd->SelectLimit($query_transmission) or die($ukcd->ErrorMsg());
$totalRows_transmission = $transmission->RecordCount();
// end Recordset

// begin Recordset
$query_doors = "SELECT DISTINCT vehicles.doors, vehicles.model_group FROM vehicles WHERE vehicles.doors IS NOT NULL AND vehicles.doors <> '0' GROUP BY vehicles.doors";
$doors = $ukcd->SelectLimit($query_doors) or die($ukcd->ErrorMsg());
$totalRows_doors = $doors->RecordCount();
// end Recordset

// begin Recordset
$query_suppliers = "SELECT supplier_id, supplier_name FROM a_ukcd_suppliers ORDER BY supplier_name ASC";
$suppliers = $ukcd->SelectLimit($query_suppliers) or die($ukcd->ErrorMsg());
$totalRows_suppliers = $suppliers->RecordCount();
// end Recordset

// begin Recordset
$query_vehtabs = "SELECT tab_id, tab_name FROM a_ukcd_vehicle_tabs ORDER BY tab_name ASC";
$vehtabs = $ukcd->SelectLimit($query_vehtabs) or die($ukcd->ErrorMsg());
$totalRows_vehtabs = $vehtabs->RecordCount();
// end Recordset

// begin Recordset
$query_year_plate = "SELECT * FROM a_ukcd_globals";
$year_plate = $ukcd->SelectLimit($query_year_plate) or die($ukcd->ErrorMsg());
$totalRows_year_plate = $year_plate->RecordCount();
// end Recordset

$nav_listveh_discounts->checkBoundries();
?>

<!doctype html><?php //PHP ADODB document - made with PHAkt [Modified By P.Maher] ?>
<html>
<head>
<title>Untitled Document</title>
<meta charset="utf-8">
<link href="includes/skins/main.css" rel="stylesheet" type="text/css" media="all" />
<link href="includes/skins/styles.css" rel="stylesheet" type="text/css" media="all" />
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script src="includes/skins/style.js" type="text/javascript"></script>
<script src="includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="includes/nxt/scripts/list.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: true,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: false,
  record_counter: false
}
</script>
<style type="text/css">
  /* List row settings
  .KT_col_veh_enabled {width:140px; overflow:hidden;}
  .KT_col_make_enabled {width:140px; overflow:hidden;}
  .KT_col_vanmake_enabled {width:140px; overflow:hidden;}
  .KT_col_veh_supplier {width:140px; overflow:hidden;}
  .KT_col_current_vehicle {width:140px; overflow:hidden;}
  .KT_col_commercial {width:140px; overflow:hidden;}
  .KT_col_manufacturer_id {width:140px; overflow:hidden;}
  .KT_col_model_group {width:140px; overflow:hidden;}
  .KT_col_expanded_body_style_id {width:140px; overflow:hidden;}
  .KT_col_trim {width:140px; overflow:hidden;}
  .KT_col_fuel_type_id {width:140px; overflow:hidden;}
  .KT_col_transmission_type_id {width:140px; overflow:hidden;}
  .KT_col_doors {width:140px; overflow:hidden;}
  .KT_col_veh_show_on_homepage {width:140px; overflow:hidden;}
  .KT_col_veh_show_on_deals_page {width:140px; overflow:hidden;}
  .KT_col_veh_show_on_stock_page {width:140px; overflow:hidden;}
  .KT_col_veh_top_left_tag {width:140px; overflow:hidden;}
  .KT_col_veh_top_right_tag {width:140px; overflow:hidden;}
  .KT_col_veh_teaser_text {width:140px; overflow:hidden;}
  .KT_col_basic_price {width:140px; overflow:hidden;}
  .KT_col_veh_buy_disc_perc {width:140px; overflow:hidden;}
  .KT_col_veh_buy_disc_fixed {width:140px; overflow:hidden;}
  .KT_col_veh_buy_disc_options_perc {width:140px; overflow:hidden;}
  .KT_col_veh_sell_disc_perc {width:140px; overflow:hidden;}
  .KT_col_veh_sell_disc_fixed {width:140px; overflow:hidden;}
  .KT_col_veh_sell_disc_options_perc {width:140px; overflow:hidden;}
  .KT_col_veh_profit {width:140px; overflow:hidden;}
  .KT_col_manufacturers_delivery {width:140px; overflow:hidden;} */
  .KT_tng { max-width: 5200px;}
  .KT_tngtable th, .KT_tngtable td.KT_th  { border:none; border-spacing: 0 }
  .KT_tngtable {border-spacing: 0;}
</style>
</head>

<body>
<div class="KT_tng" id="listveh_discounts">
  <h1> Vehicle Discounts
    <?php
  $nav_listveh_discounts->Prepare();
  require("includes/nav/NAV_Text_Statistics.inc.php");
?>
  </h1>
  <div class="KT_tnglist">
    <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
      <div class="KT_options"> <a href="<?php echo $nav_listveh_discounts->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
        <?php
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listveh_discounts'] == 1) {
?>
          <?php echo $_SESSION['default_max_rows_nav_listveh_discounts']; ?>
          <?php
  // else Conditional region1
  } else { ?>
          <?php echo NXT_getResource("all"); ?> (*NOTE* This may take a long time or crash web browser if showing large numberd of records)
          <?php }
  // endif Conditional region1
?>
<?php echo NXT_getResource("records"); ?></a> &nbsp;
        &nbsp;

      </div>
      <table cellpadding="2" cellspacing="0" class="KT_tngtable">
        <thead>
          <tr class="KT_row_order">
            <th id="veh_enabled3" class="KT_sorter KT_col_veh_enabled">Supplier</th>
            <th id="make_enabled3" class="KT_sorter KT_col_make_enabled">Vehicle Enabled</th>
            <th id="vanmake_enabled3" class="KT_sorter KT_col_vanmake_enabled">Car Make Enabled</th>
            <th id="veh_supplier3" class="KT_sorter KT_col_veh_supplier">Van Make Enabled</th>
            <th id="current_vehicle3" class="KT_sorter KT_col_current_vehicle">Current Model</th>
            <th id="commercial3" class="KT_sorter KT_col_commercial">Top Left Tab</th>
            <th id="manufacturer_id3" class="KT_sorter KT_col_manufacturer_id">Top Right Tab</th>
            <th id="model_group3" class="KT_sorter KT_col_model_group">On Pages</th>
            <th id="expanded_body_style_id3" class="KT_sorter KT_col_expanded_body_style_id">&nbsp;</th>
            <th id="trim3" class="KT_sorter KT_col_trim">&nbsp;</th>
            <th id="fuel_type_id3" class="KT_sorter KT_col_fuel_type_id">&nbsp;</th>
            <th id="transmission_type_id3" class="KT_sorter KT_col_transmission_type_id">&nbsp;</th>
            <th id="doors3" class="KT_sorter KT_col_doors">&nbsp;</th>

          </tr>
          <tr class="KT_row_order">
            <th id="veh_enabled2" class="KT_sorter KT_col_veh_enabled <?php echo $tso_listveh_discounts->getSortIcon('veh_enabled'); ?>"><span class="KT_sorter KT_col_veh_supplier <?php echo $tso_listveh_discounts->getSortIcon('veh_supplier'); ?>">
              <select name="tfi_listveh_discounts_veh_supplier" id="tfi_listveh_discounts_veh_supplier">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_veh_supplier']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$suppliers->EOF){
?>
                <option value="<?php echo $suppliers->Fields('supplier_id')?>"<?php if (!(strcmp($suppliers->Fields('supplier_id'), @$_SESSION['tfi_listveh_discounts_veh_supplier']))) {echo "SELECTED";} ?>><?php echo $suppliers->Fields('supplier_name')?></option>
                <?php
    $suppliers->MoveNext();
  }
  $suppliers->MoveFirst();
?>
              </select>
            </span></th>
            <th id="make_enabled2" class="KT_sorter KT_col_make_enabled <?php echo $tso_listveh_discounts->getSortIcon('make_enabled'); ?>"><span class="KT_sorter KT_col_veh_enabled <?php echo $tso_listveh_discounts->getSortIcon('veh_enabled'); ?>">
              <select name="tfi_listveh_discounts_veh_enabled" id="tfi_listveh_discounts_veh_enabled">
                <option value="" >Show All</option>
                <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_veh_enabled'])))) {echo "SELECTED";} ?>>Enabled</option>
                <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_veh_enabled'])))) {echo "SELECTED";} ?>>Disabled</option>
              </select>
            </span></th>
            <th id="vanmake_enabled2" class="KT_sorter KT_col_vanmake_enabled <?php echo $tso_listveh_discounts->getSortIcon('vanmake_enabled'); ?>"><span class="KT_sorter KT_col_make_enabled <?php echo $tso_listveh_discounts->getSortIcon('make_enabled'); ?>">
              <select name="tfi_listveh_discounts_make_enabled" id="tfi_listveh_discounts_make_enabled">
                <option value="" >Show All</option>
                <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_make_enabled'])))) {echo "SELECTED";} ?>>Enabled</option>
                <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_make_enabled'])))) {echo "SELECTED";} ?>>Disabled</option>
              </select>
            </span></th>
            <th id="veh_supplier2" class="KT_sorter KT_col_veh_supplier <?php echo $tso_listveh_discounts->getSortIcon('veh_supplier'); ?>"><span class="KT_sorter KT_col_vanmake_enabled <?php echo $tso_listveh_discounts->getSortIcon('vanmake_enabled'); ?>">
              <select name="tfi_listveh_discounts_vanmake_enabled" id="tfi_listveh_discounts_vanmake_enabled">
                <option value="" >Show All</option>
                <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_vanmake_enabled'])))) {echo "SELECTED";} ?>>Enabled</option>
                <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_vanmake_enabled'])))) {echo "SELECTED";} ?>>Disabled</option>
              </select>
            </span></th>
            <th id="current_vehicle2" class="KT_sorter KT_col_current_vehicle <?php echo $tso_listveh_discounts->getSortIcon('current_vehicle'); ?>"><select name="tfi_listveh_discounts_current_vehicle" id="tfi_listveh_discounts_current_vehicle">
              <option value="" >Show All</option>
              <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_current_vehicle'])))) {echo "SELECTED";} ?>>Current Model</option>
              <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_current_vehicle'])))) {echo "SELECTED";} ?>>Old Model</option>
              </select></th>
            <th id="commercial2" class="KT_sorter KT_col_commercial <?php echo $tso_listveh_discounts->getSortIcon('commercial'); ?>"><span class="KT_sorter KT_col_veh_enabled <?php echo $tso_listveh_discounts->getSortIcon('veh_enabled'); ?>">
              <select name="tfi_listveh_discounts_veh_top_left_tag" id="tfi_listveh_discounts_veh_top_left_tag">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_veh_top_left_tag']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$vehtabs->EOF){
?>
                <option value="<?php echo $vehtabs->Fields('tab_id')?>"<?php if (!(strcmp($vehtabs->Fields('tab_id'), @$_SESSION['tfi_listveh_discounts_veh_top_left_tag']))) {echo "SELECTED";} ?>><?php echo $vehtabs->Fields('tab_name')?></option>
                <?php
    $vehtabs->MoveNext();
  }
  $vehtabs->MoveFirst();
?>
              </select>
            </span></th>
            <th id="manufacturer_id2" class="KT_sorter KT_col_manufacturer_id <?php echo $tso_listveh_discounts->getSortIcon('manufacturer_id'); ?>"><span class="KT_sorter KT_col_make_enabled <?php echo $tso_listveh_discounts->getSortIcon('make_enabled'); ?>">
              <select name="tfi_listveh_discounts_veh_top_right_tag" id="tfi_listveh_discounts_veh_top_right_tag">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_veh_top_right_tag']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$vehtabs->EOF){
?>
                <option value="<?php echo $vehtabs->Fields('tab_id')?>"<?php if (!(strcmp($vehtabs->Fields('tab_id'), @$_SESSION['tfi_listveh_discounts_veh_top_right_tag']))) {echo "SELECTED";} ?>><?php echo $vehtabs->Fields('tab_name')?></option>
                <?php
    $vehtabs->MoveNext();
  }
  $vehtabs->MoveFirst();
?>
              </select>
            </span></th>
            <th id="model_group2" class="KT_sorter KT_col_model_group <?php echo $tso_listveh_discounts->getSortIcon('model_group'); ?>"><span class="KT_sorter KT_col_vanmake_enabled <?php echo $tso_listveh_discounts->getSortIcon('vanmake_enabled'); ?>">
              H:
              <input name="tfi_listveh_discounts_veh_show_on_homepage" type="checkbox" id="tfi_listveh_discounts_veh_show_on_homepage" title="Homepage" value="1"  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_veh_show_on_homepage']),"1"))) {echo "checked";} ?> />
            &nbsp;<span class="KT_sorter KT_col_veh_supplier <?php echo $tso_listveh_discounts->getSortIcon('veh_supplier'); ?>">
            D:
            <input name="tfi_listveh_discounts_veh_show_on_deals_page" type="checkbox" id="tfi_listveh_discounts_veh_show_on_deals_page" title="Hot Deals" value="1"  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_veh_show_on_deals_page']),"1"))) {echo "checked";} ?> />
            &nbsp;S:&nbsp;<span class="KT_sorter KT_col_current_vehicle <?php echo $tso_listveh_discounts->getSortIcon('current_vehicle'); ?>">
            <input name="tfi_listveh_discounts_veh_show_on_stock_page" type="checkbox" id="tfi_listveh_discounts_veh_show_on_stock_page" title="Stock Deals" value="1"  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_veh_show_on_stock_page']),"1"))) {echo "checked";} ?> />
            </span></span></span></th>
            <th id="expanded_body_style_id2" class="KT_sorter KT_col_expanded_body_style_id <?php echo $tso_listveh_discounts->getSortIcon('expanded_body_style_id'); ?>">&nbsp;</th>
            <th id="trim2" class="KT_sorter KT_col_trim <?php echo $tso_listveh_discounts->getSortIcon('trim'); ?>">&nbsp;</th>
            <th id="fuel_type_id2" class="KT_sorter KT_col_fuel_type_id <?php echo $tso_listveh_discounts->getSortIcon('fuel_type_id'); ?>">&nbsp;</th>
            <th id="transmission_type_id2" class="KT_sorter KT_col_transmission_type_id <?php echo $tso_listveh_discounts->getSortIcon('transmission_type_id'); ?>">&nbsp;</th>
            <th id="doors2" class="KT_sorter KT_col_doors <?php echo $tso_listveh_discounts->getSortIcon('doors'); ?>">&nbsp;</th>
          </tr>
          <tr class="KT_row_order">
            <th id="veh_enabled" class="KT_sorter KT_col_veh_enabled">Vehicle Type</th>
            <th id="make_enabled" class="KT_sorter KT_col_make_enabled"> <a href="<?php echo $tso_listveh_discounts->getSortLink('make_enabled'); ?>"></a> Manufacturer</th>
            <th id="vanmake_enabled" class="KT_sorter KT_col_vanmake_enabled">Model</th>
            <th id="veh_supplier" class="KT_sorter KT_col_veh_supplier">BodyStyle</th>
            <th id="current_vehicle" class="KT_sorter KT_col_current_vehicle">Trim-Level</th>
            <th id="commercial" class="KT_sorter KT_col_commercial">Fuel Type</th>
            <th id="manufacturer_id" class="KT_sorter KT_col_manufacturer_id">Transmission</th>
            <th id="model_group" class="KT_sorter KT_col_model_group">Doors</th>
            <th id="expanded_body_style_id" class="KT_sorter KT_col_expanded_body_style_id">&nbsp;</th>
            <th id="trim" class="KT_sorter KT_col_trim">&nbsp;</th>
            <th id="fuel_type_id" class="KT_sorter KT_col_fuel_type_id">&nbsp;</th>
            <th id="transmission_type_id" class="KT_sorter KT_col_transmission_type_id">&nbsp;</th>
            <th id="doors" class="KT_sorter KT_col_doors">&nbsp;</th>

          </tr>
            <tr class="KT_row_filter">
              <th><span class="KT_sorter KT_col_veh_supplier <?php echo $tso_listveh_discounts->getSortIcon('veh_supplier'); ?>">
                <select name="tfi_listveh_discounts_commercial" id="tfi_listveh_discounts_commercial">
                  <option value="" >Show All</option>
                  <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_commercial'])))) {echo "SELECTED";} ?>>Cars</option>
                  <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listveh_discounts_commercial'])))) {echo "SELECTED";} ?>>Vans</option>
                </select>
              </span></th>
              <th><select name="tfi_listveh_discounts_manufacturer_id" id="tfi_listveh_discounts_manufacturer_id">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_manufacturer_id']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$manufacturers->EOF){
?>
                <option value="<?php echo $manufacturers->Fields('id')?>"<?php if (!(strcmp($manufacturers->Fields('id'), @$_SESSION['tfi_listveh_discounts_manufacturer_id']))) {echo "SELECTED";} ?>><?php echo $manufacturers->Fields('name')?></option>
                <?php
    $manufacturers->MoveNext();
  }
  $manufacturers->MoveFirst();
?>
              </select></th>
              <th><select name="tfi_listveh_discounts_model_group" id="tfi_listveh_discounts_model_group">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_model_group']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$models->EOF){
?>
                <option value="<?php echo $models->Fields('model_group')?>"<?php if (!(strcmp($models->Fields('model_group'), @$_SESSION['tfi_listveh_discounts_model_group']))) {echo "SELECTED";} ?>><?php echo $models->Fields('model_group')?></option>
                <?php
    $models->MoveNext();
  }
  $models->MoveFirst();
?>
              </select></th>
              <th><select name="tfi_listveh_discounts_expanded_body_style_id" id="tfi_listveh_discounts_expanded_body_style_id">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_expanded_body_style_id']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$bodystyles->EOF){
?>
                <option value="<?php echo $bodystyles->Fields('id')?>"<?php if (!(strcmp($bodystyles->Fields('id'), @$_SESSION['tfi_listveh_discounts_expanded_body_style_id']))) {echo "SELECTED";} ?>><?php echo $bodystyles->Fields('description')?></option>
                <?php
    $bodystyles->MoveNext();
  }
  $bodystyles->MoveFirst();
?>
              </select></th>
              <th><select name="tfi_listveh_discounts_trim" id="tfi_listveh_discounts_trim">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_trim']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$trimlevel->EOF){
?>
                <option value="<?php echo $trimlevel->Fields('trim')?>"<?php if (!(strcmp($trimlevel->Fields('trim'), @$_SESSION['tfi_listveh_discounts_trim']))) {echo "SELECTED";} ?>><?php echo $trimlevel->Fields('trim')?></option>
                <?php
    $trimlevel->MoveNext();
  }
  $trimlevel->MoveFirst();
?>
              </select></th>
              <th><select name="tfi_listveh_discounts_fuel_type_id" id="tfi_listveh_discounts_fuel_type_id">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_fuel_type_id']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$fueltype->EOF){
?>
                <option value="<?php echo $fueltype->Fields('id')?>"<?php if (!(strcmp($fueltype->Fields('id'), @$_SESSION['tfi_listveh_discounts_fuel_type_id']))) {echo "SELECTED";} ?>><?php echo $fueltype->Fields('name')?></option>
                <?php
    $fueltype->MoveNext();
  }
  $fueltype->MoveFirst();
?>
              </select></th>
              <th><select name="tfi_listveh_discounts_transmission_type_id" id="tfi_listveh_discounts_transmission_type_id">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_transmission_type_id']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$transmission->EOF){
?>
                <option value="<?php echo $transmission->Fields('id')?>"<?php if (!(strcmp($transmission->Fields('id'), @$_SESSION['tfi_listveh_discounts_transmission_type_id']))) {echo "SELECTED";} ?>><?php echo $transmission->Fields('name')?></option>
                <?php
    $transmission->MoveNext();
  }
  $transmission->MoveFirst();
?>
              </select></th>
              <th><select name="tfi_listveh_discounts_doors" id="tfi_listveh_discounts_doors" style="padding-right: 1px">
                <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listveh_discounts_doors']))) {echo "SELECTED";} ?>>Show All</option>
                <?php
  while(!$doors->EOF){
?>
                <option value="<?php echo $doors->Fields('doors')?>"<?php if (!(strcmp($doors->Fields('doors'), @$_SESSION['tfi_listveh_discounts_doors']))) {echo "SELECTED";} ?>><?php echo $doors->Fields('doors')?></option>
                <?php
    $doors->MoveNext();
  }
  $doors->MoveFirst();
?>
              </select></th>
              <th><!--<input type="submit" name="tfi_listveh_discounts" value="<?php echo NXT_getResource("Filter"); ?>" />--><button type="submit" name="tfi_listveh_discounts" value="<?php echo NXT_getResource("Filter"); ?>" title="filter records" class="filter_records"><i class="fas fa-search fa-2x"></i></button>
                                    <button formaction="<?php echo $tfi_listveh_discounts->getResetFilterLink(); ?>" value="Reset" title="reset filter" class="reset_filter"><i class="fas fa-times-circle fa-2x"></i></button></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            <!-- <tr>
              <td colspan="15">hellow world</td>
            </tr> -->
            <tr class="KT_row_filter">
              <!-- <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th> -->
              <!-- <th>&nbsp;</th> -->
              <!-- <th>&nbsp;</th> -->
              <!-- <th>&nbsp;</th> -->
              <th colspan="15">
                <div id="save_records" class="save_btn" style="display: none; float: left">SAVE</div>
                <div id="save_bulk_records" class="save_btn" style="display: none; float: left">BULK UPDATE</div>
                <div id="save_bulk_records_btn" class="save_btn" style="float: right">ENABLE BULK MODE</div>
              </th>
            </tr>
            <tr class="KT_row_filter">
              <td colspan="13">
                <table width="100%" border="0" cellspacing="2" cellpadding="5" style="background: #fff">
                <tbody>
                  <tr>
                    <th>Enabled?</th>
                    <th>Supplier</th>
                    <th>Teaset Text</th>
                    <th>Top Left Label</th>
                    <th>Top Right Label</th>
                    <th>On Pages ( Home | Deals | Stock)</th>
                    <th>Basic</th>
                    <th>Buying Discounts (V% | V£ | O%)</th>
                    <th>Discount Buying Price</th>
                    <th>Selling Discounts  (V% | V£ | O%)</th>
                    <th>Profit</th>
                    <th>Delivery</th>
                    <th>RFL</th>
                    <th>Save</th>
                    <th>SP</th>
                  </tr>
                  <tr data-id="bulk-enabled-row">
                    <td>
                    <input 
                      class="input-enabled-bulk bulk-element" 
                      id="veh_enabled-bulk" 
                      type="checkbox" title="Enabled?">
                      
                    </td>
                    <td class="mw-100">
                      <select class="select-supplier-bulk bulk-element" id="veh_supplier-bulk">
                        <option value="" selected>Show All</option>
                        <?php
                          while(!$suppliers->EOF){
                        ?>
                                        <option value="<?php echo $suppliers->Fields('supplier_id'); ?>"><?php echo $suppliers->Fields('supplier_name')?></option>
                                        <?php
                            $suppliers->MoveNext();
                          }
                          $suppliers->MoveFirst();
                        ?>
                      </select>
                      
                    </td>
                    <td class="mw-100">
                      <input class="input-teaset-bulk c-input bulk-element" type="text" id="veh_teaser_text-bulk" />
                    </td>
                    <td class="mw-100">
                    <select class="input-top_left_tab-bulk bulk-element" id="veh_top_left_tag-bulk">
                      <option value="">Show All</option>
                      <?php
                        while(!$vehtabs->EOF){
                          ?>
                          <option value="<?php echo $vehtabs->Fields('tab_id')?>"><?php echo $vehtabs->Fields('tab_name')?></option>
                          <?php
                            $vehtabs->MoveNext();
                        }
                        $vehtabs->MoveFirst();
                      ?>
                    </select>
                    <td class="mw-100">
                    <select class="input-top_right_tab-bulk bulk-element" id="veh_top_right_tag-bulk">
                      <option value="">Show All</option>
                      <?php
                        while(!$vehtabs->EOF){
                          ?>
                          <option value="<?php echo $vehtabs->Fields('tab_id')?>"><?php echo $vehtabs->Fields('tab_name')?></option>
                          <?php
                            $vehtabs->MoveNext();
                        }
                        $vehtabs->MoveFirst();
                      ?>
                    </select>
                    <td><span class="bulk-element">H:</span>
                      <input 
                        class="checkbox-homepage-bulk bulk-element" 
                        name="checkbox" 
                        type="checkbox" 
                        id="veh_show_on_homepage-bulk" 
                        title="Show on homepage">
                      &nbsp;<span class="bulk-element">D:</span>
                      <input 
                        class="checkbox-hotdeals-bulk bulk-element" 
                        name="checkbox2" 
                        type="checkbox" 
                        id="veh_show_on_deals_page-bulk"  
                        title="Show on Hot Deals page">
                      &nbsp;<span class="bulk-element">S:</span>
                      <input 
                        class="checkbox-stockdeals-bulk bulk-element" 
                        name="checkbox3" 
                        type="checkbox" 
                        id="veh_show_on_stock_page-bulk" 
                        title="Show on Stock Deals Page"></td>
                    <td>&nbsp</td>
                    <td style="white-space: nowrap">
                      <input 
                        id="veh_buy_disc_perc-bulk" 
                        type="number" size="4" 
                        min="0"
                        class="input-buy-perc-bulk c-input w-70 bulk-element">
                      <input 
                        id="veh_buy_disc_fixed-bulk" 
                        type="number" size="4" 
                        min="0"
                        class="input-buy-fixed-bulk c-input w-70 bulk-element">
                      <input 
                        id="veh_buy_disc_options_perc-bulk" 
                        type="number" size="4" 
                        min="0"
                        class="input-buy-option-perc-bulk c-input w-70 bulk-element"></td>
                    <td><span class="bulk-element">Basic - (V%) - (V£)</span></td>
                    <td style="white-space: nowrap">
                      <input 
                        id="veh_sell_disc_perc-bulk" 
                        type="number" size="4" 
                        min="0"
                        class="input-sell-perc-bulk c-input w-70 bulk-element">
                      <input 
                        id="veh_sell_disc_fixed-bulk" 
                        type="number" size="4" 
                        min="0"
                        class="input-sell-fixed-bulk c-input w-70 bulk-element">
                      <input 
                        id="veh_sell_disc_options_perc-bulk"  
                        type="number" size="6" 
                        min="0"
                        class="input-sell-option-perc-bulk c-input w-70 bulk-element"></td>
                    <td>
                      <input 
                        id="veh_profit-bulk" 
                        type="number" size="6" 
                        min="0"
                        class="input-profit-bulk c-input w-70 bulk-element">
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                              <?php
  while (!$veh_discounts->EOF) {
?>
<?php
    
    // Misc vars used in clalcuations
$vat_rate = $year_plate->Fields('global_vat'); //used as a percentage
$regfee = $year_plate->Fields('global_1st_reg'); //standard fee for all cars
$delivery_ex = $veh_discounts->Fields('manufacturers_delivery'); //delivery excluding VAT (tax)
$delivery_vat = ($vat_rate/ 100) * $delivery_ex; //calculate VAT on delivery
$delivery_vat = number_format($delivery_vat, 2, '.', ''); //calculate VAT on delivery
$delivery_inc = $delivery_ex + $delivery_vat; //delivery including VAT (tax)
$veh_basic_price = $veh_discounts->Fields('basic_price'); //basic price without any discount
$veh_retail = $veh_discounts->Fields('manufacturers_retail_price'); // retail price of vehicle only with including VAT (tax)
$veh_otr = $veh_discounts->Fields('OTR'); // OTR price: retail vehicle price + reg fee + road fund license + delivery (including VAT)
$road_fund_license = $veh_otr - ($veh_retail + $regfee + $delivery_inc);
$road_fund_license = round($road_fund_license);
$road_fund_license =  number_format($road_fund_license, 2, '.', ''); // Calculates road fund license

$veh_ids_id = $veh_discounts->Fields('veh_ids_id');
$supplier_name = $veh_discounts->Fields('supplier_name');
$supplier_id = $veh_discounts->Fields('supplier_id');
$veh_buy_disc_perc = $veh_discounts->Fields('veh_buy_disc_perc');
$veh_buy_disc_fixed = $veh_discounts->Fields('veh_buy_disc_fixed');

$veh_buy_disc_perc = number_format((float)$veh_buy_disc_perc, 2, '.', '');
$veh_buy_disc_fixed = number_format((float)$veh_buy_disc_fixed, 2, '.', '');
$veh_basic_price = number_format((float)$veh_basic_price, 2, '.', '');

$vbd = $veh_basic_price - ($veh_basic_price * ($veh_buy_disc_perc)/100) - $veh_buy_disc_fixed;
$vbd = number_format((float)$vbd, 2, '.', '');
?>
                  <tr>
                    <td colspan="15"><span style="color:red;font-weight:bold"><?php echo $veh_discounts->Fields('manufacturer'); ?> <?php echo $veh_discounts->Fields('long_description'); ?> &#9660; </span></td>
                  </tr>
                  <tr data-id="<?php echo $veh_discounts->Fields('veh_ids_id'); ?>">
                    <td>
                    <input 
                      class="input-enabled" 
                      id="veh_enabled-<?php echo $veh_ids_id; ?>" 
                      type="checkbox" title="Enabled?" 
                      <?php echo $veh_discounts->Fields('veh_enabled') ? "checked" : "" ?>>
                      
                    </td>
                    <td class="mw-100">
                      <select class="select-supplier" id="veh_supplier-<?php echo $veh_ids_id; ?>">
                        <option value="" selected>Show All</option>
                        <?php
                          while(!$suppliers->EOF){
                        ?>
                                        <option value="<?php echo $suppliers->Fields('supplier_id'); ?>" <?php echo $suppliers->Fields('supplier_id') == $veh_discounts->Fields('veh_supplier') ? "SELECTED" : "";?>><?php echo $suppliers->Fields('supplier_name')?></option>
                                        <?php
                            $suppliers->MoveNext();
                          }
                          $suppliers->MoveFirst();
                        ?>
                      </select>
                      
                    </td>
                    <td class="mw-100">
                      <input class="c-input input-teaset" type="text" id="veh_teaser_text-<?php echo $veh_ids_id; ?>" value="<?php echo $veh_discounts->Fields('veh_teaser_text'); ?>" />
                    </td>
                    <td class="mw-100">
                    <select class="input-top_left_tab" id="veh_top_left_tag-<?php echo $veh_ids_id; ?>">
                      <option value="">Show All</option>
                      <?php
                        while(!$vehtabs->EOF){
                          ?>
                          <option value="<?php echo $vehtabs->Fields('tab_id')?>"  <?php echo $vehtabs->Fields('tab_id') == $veh_discounts->Fields('veh_top_left_tag') ? "SELECTED" : "";?>><?php echo $vehtabs->Fields('tab_name')?></option>
                          <?php
                            $vehtabs->MoveNext();
                        }
                        $vehtabs->MoveFirst();
                      ?>
                    </select>
                    <td class="mw-100">
                    <select class="input-top_right_tab" id="veh_top_right_tag-<?php echo $veh_ids_id; ?>">
                      <option value="">Show All</option>
                      <?php
                        while(!$vehtabs->EOF){
                          ?>
                          <option value="<?php echo $vehtabs->Fields('tab_id')?>"  <?php echo $vehtabs->Fields('tab_id') == $veh_discounts->Fields('veh_top_right_tag') ? "SELECTED" : "";?>><?php echo $vehtabs->Fields('tab_name')?></option>
                          <?php
                            $vehtabs->MoveNext();
                        }
                        $vehtabs->MoveFirst();
                      ?>
                    </select>
                    <td>H:
                      <input 
                        class="checkbox-homepage" 
                        name="checkbox" 
                        type="checkbox" 
                        id="veh_show_on_homepage-<?php echo $veh_ids_id; ?>" 
                        <?php echo $veh_discounts->Fields('veh_show_on_homepage') ? "checked" : "" ?>
                        title="Show on homepage">
                      &nbsp;D:
                      <input 
                        class="checkbox-hotdeals" 
                        name="checkbox2" 
                        type="checkbox" 
                        id="veh_show_on_deals_page-<?php echo $veh_ids_id; ?>"
                        <?php echo $veh_discounts->Fields('veh_show_on_deals_page') ? "checked" : "" ?>  
                        title="Show on Hot Deals page">
                      &nbsp;S:
                      <input 
                        class="checkbox-stockdeals" 
                        name="checkbox3" 
                        type="checkbox" 
                        id="veh_show_on_stock_page-<?php echo $veh_ids_id; ?>"
                        <?php echo $veh_discounts->Fields('veh_show_on_stock_page') ? "checked" : "" ?> 
                        title="Show on Stock Deals Page"></td>
                    <td><span id="vbp-<?php echo $veh_ids_id; ?>"><?php echo $veh_basic_price; ?></span></td>
                    <td style="white-space: nowrap">
                      <input 
                        id="veh_buy_disc_perc-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_buy_disc_perc'); ?>"
                        type="number" size="4" 
                        min="0"
                        class="c-input input-buy-perc w-70">
                      <input 
                        id="veh_buy_disc_fixed-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_buy_disc_fixed'); ?>"
                        type="number" size="4" 
                        min="0"
                        class="c-input input-buy-fixed w-70">
                      <input 
                        id="veh_buy_disc_options_perc-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_buy_disc_options_perc'); ?>"
                        type="number" size="4" 
                        min="0"
                        class="c-input input-buy-option-perc w-70"></td>
                    <td><span id="dbp-<?php echo $veh_ids_id; ?>"><?php echo $vbd; ?></span></td>
                    <td style="white-space: nowrap">
                      <input 
                        id="veh_sell_disc_perc-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_sell_disc_perc'); ?>" 
                        type="number" size="4" 
                        min="0"
                        class="c-input w-70 input-sell-perc">
                      <input 
                        id="veh_sell_disc_fixed-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_sell_disc_fixed'); ?>" 
                        type="number" size="4" 
                        min="0"
                        class="c-input w-70  input-sell-fixed">
                      <input 
                        id="veh_sell_disc_options_perc-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_sell_disc_options_perc'); ?>" 
                        type="number" size="6" 
                        min="0"
                        class="c-input w-70 input-sell-option-perc"></td>
                    <td>
                      <input 
                        id="veh_profit-<?php echo $veh_ids_id; ?>" 
                        value="<?php echo $veh_discounts->Fields('veh_profit'); ?>" 
                        type="number" size="6" 
                        min="0"
                        class="c-input w-70 input-profit">
                    </td>
                    <td><?php echo $delivery_ex; ?></td>
                    <td><?php echo $road_fund_license; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                                <?php
    $veh_discounts->MoveNext();
  }
  $veh_discounts->MoveFirst();
?>
                </tbody>
              </table></td>

          </tr>
            <tr class="KT_row_filter">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>

            </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="KT_bottomnav">
        <div>
          <?php
            $nav_listveh_discounts->Prepare();
            require("includes/nav/NAV_Text_Navigation.inc.php");
          ?>
        </div>
      </div>
      <div class="KT_bottombuttons">
       <!-- <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource("edit_all"); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource("delete_all"); ?></a> </div>
        <span>&nbsp;</span>
        <select name="no_new" id="no_new">
          <option value="1">1</option>
          <option value="3">3</option>
          <option value="6">6</option>
        </select>
        <a class="KT_additem_op_link" href="form.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> --></div>
    </form>
  </div>
  <br class="clearfixplain" />
</div>
<p>&nbsp;</p>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

	//update dropdowns when changed
  	const $el = [];
	$el[0] = null; 
  $el[1] = $("#tfi_listveh_discounts_commercial");
	$el[2] = $("#tfi_listveh_discounts_manufacturer_id");
	$el[3] = $("#tfi_listveh_discounts_model_group");
	$el[4] = $("#tfi_listveh_discounts_expanded_body_style_id");
	$el[5] = $("#tfi_listveh_discounts_trim");
	$el[6] = $("#tfi_listveh_discounts_fuel_type_id");
	$el[7] = $("#tfi_listveh_discounts_doors");
	$el[8] = $("#tfi_listveh_discounts_transmission_type_id");
	

	$elIds = [
		null,
    'tfi_listveh_discounts_commercial',
		'tfi_listveh_discounts_manufacturer_id',
		'tfi_listveh_discounts_model_group',
		'tfi_listveh_discounts_expanded_body_style_id',
		'tfi_listveh_discounts_trim',
		'tfi_listveh_discounts_fuel_type_id',
		'tfi_listveh_discounts_doors',
		'tfi_listveh_discounts_transmission_type_id'
	];

  	function updateFilterDropdowns(dropdownName, dropdownData, responseData, selectedDropdownId){
		let $dropdownElement = null;
		let defaultSelected = '';
		let selectedRecord = ''; 
		let reqData = responseData?.reqData;
		let selectedFilters = responseData?.selectedFilters;
      
		if(dropdownName === 'manufacturers'){
			$dropdownElement = $el[2];
			defaultSelected = 'Show All';
		}else if(dropdownName === 'models'){
			$dropdownElement = $el[3];
			defaultSelected = 'Show All';
		}
		else if(dropdownName === 'bodyStyles'){
			$dropdownElement = $el[4];
			defaultSelected = 'Show All';
		}
		else if(dropdownName === 'trims') {
			$dropdownElement = $el[5];
			defaultSelected = 'Show All';
		}
		else if(dropdownName === 'fuelTypes'){
			$dropdownElement = $el[6];
			defaultSelected = 'Show All';
		}
		else if(dropdownName === 'doors'){
			$dropdownElement = $el[7];
			defaultSelected = 'Show All';
		}
		else if(dropdownName === 'transmissionTypes'){
			$dropdownElement = $el[8];
			defaultSelected = 'Show All';
		}	
		// else if(dropdownName === 'commercials'){
		// 	$dropdownElement = $el[8];
		// 	defaultSelected = 'Show All';
		// }	

		if($dropdownElement){
			let dropdownElementId = $($dropdownElement).attr('id');

			let selectedIndex = $elIds.indexOf(selectedDropdownId)
			let dropdownElementIndex = $elIds.indexOf(dropdownElementId)
			if(dropdownElementIndex > selectedIndex){
				let dropdownHtml = `<option value="">${defaultSelected}</option>`;
				let sortedDropdownData = dropdownData.sort(function (a, b){
          
					if(a.label < b.label) return -1;
					if(b.label < a.label) return 1;
					return 0;
				});
				for(let record of dropdownData){
					if(record.value !== null){
						dropdownHtml += `<option value="${record.value}">${record.label}</option>`;
					}
				}
				$($dropdownElement).html(dropdownHtml)
			}

      if(dropdownName === 'manufacturers') {
				$(`#tfi_listveh_discounts_manufacturer_id`).val(selectedFilters['manufacturers']);
				if(responseData["manufacturers"].some(el => el.value === reqData["manufacturers"])){
					$(`#tfi_listveh_discounts_manufacturer_id`).val(reqData["manufacturers"]);
				}else{
					$(`#tfi_listveh_discounts_manufacturer_id`).val("");
				}
			}else if(dropdownName === 'models') {
				$(`#tfi_listveh_discounts_model_group`).val(selectedFilters['models']);
				if(responseData["models"].some(el => el.value === reqData["models"])){
					$(`#tfi_listveh_discounts_model_group`).val(reqData["models"]);
				}else{
					$(`#tfi_listveh_discounts_model_group`).val("");
				}
			}else if(dropdownName === 'bodyStyles'){
				$(`#tfi_listveh_discounts_expanded_body_style_id`).val(selectedFilters['bodyStyles']);
				if(responseData["bodyStyles"].some(el => el.value === reqData["bodyStyles"])){
					$(`#tfi_listveh_discounts_expanded_body_style_id`).val(reqData['bodyStyles']);
				}else{
					$(`#tfi_listveh_discounts_expanded_body_style_id`).val("");
				}
			}
			else if(dropdownName === 'trims') {
				$(`#tfi_listveh_discounts_trim`).val(selectedFilters['trims']); 
				if(responseData["trims"].some(el => el.value === reqData["trims"])){
					$(`#tfi_listveh_discounts_trim`).val(reqData['trims']);
				}else{
					$(`#tfi_listveh_discounts_trim`).val("");
				}
			}
			else if(dropdownName === 'fuelTypes'){
				$(`#tfi_listveh_discounts_fuel_type_id`).val(selectedFilters['fuelTypes']);
				if(responseData["fuelTypes"].some(el => el.value === reqData["fuelTypes"])){
					$(`#tfi_listveh_discounts_fuel_type_id`).val(reqData['fuelTypes']);
				}else{
					$(`#tfi_listveh_discounts_fuel_type_id`).val("");
				}
			}
			else if(dropdownName === 'doors'){
				$(`#tfi_listveh_discounts_doors`).val(selectedFilters['doors']);
				if(responseData["doors"].some(el => el.value === reqData["doors"])){
					$(`#tfi_listveh_discounts_doors`).val(reqData['doors']);
				}else{
					$(`#tfi_listveh_discounts_doors`).val("");
				}
			}
			else if(dropdownName === 'transmissionTypes'){
				$(`#tfi_listveh_discounts_transmission_type_id`).val(selectedFilters['transmissionTypes']);
				if(responseData["transmissionTypes"].some(el => el.value === reqData["transmissionTypes"])){
					$(`#tfi_listveh_discounts_transmission_type_id`).val(reqData['transmissionTypes']);					
				}else{
					$(`#tfi_listveh_discounts_transmission_type_id`).val("");
				}
			}
		}		
	}

	function getSelectedDropdowns(selectedDropdownId, onPageLoaded){
		let selectedDropdowns = {};
		let manufacturerId = 'tfi_listveh_discounts_manufacturer_id';
		let modelId = 'tfi_listveh_discounts_model_group';
		let bodyStyleId = 'tfi_listveh_discounts_expanded_body_style_id';
		let trimId = 'tfi_listveh_discounts_trim';
		let fuelTypeId = 'tfi_listveh_discounts_fuel_type_id';
		let transmissionId = 'tfi_listveh_discounts_transmission_type_id';
		let doorId = 'tfi_listveh_discounts_doors';
		let commercialId = 'tfi_listveh_discounts_commercial';
		if(selectedDropdownId === commercialId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
		}if(selectedDropdownId === manufacturerId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val();
		}else if(selectedDropdownId === modelId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_model_group']; ?>` : $(`#${modelId}`).val()
		}else if(selectedDropdownId === bodyStyleId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
		}else if(selectedDropdownId === trimId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_trim']; ?>` : $(`#${trimId}`).val()
		}else if(selectedDropdownId === fuelTypeId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_trim']; ?>` : $(`#${trimId}`).val()
			selectedDropdowns['fuelType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_fuel_type_id']; ?>` : $(`#${fuelTypeId}`).val()
		}else if(selectedDropdownId === transmissionId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_trim']; ?>` : $(`#${trimId}`).val()
			selectedDropdowns['fuelType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_fuel_type_id']; ?>` : $(`#${fuelTypeId}`).val()
			selectedDropdowns['transmissionType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_transmission_type_id']; ?>` : $(`#${transmissionId}`).val()
		}else if(selectedDropdownId === doorId){
			selectedDropdowns['commercial'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_commercial']; ?>` : $(`#${commercialId}`).val();
			selectedDropdowns['manufacturer'] = $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_trim']; ?>` : $(`#${trimId}`).val()
			selectedDropdowns['fuelType'] = $(`#${fuelTypeId}`).val()
			selectedDropdowns['transmissionType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_transmission_type_id']; ?>` : $(`#${transmissionId}`).val()
			selectedDropdowns['door'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listveh_discounts_doors']; ?>` : $(`#${doorId}`).val()
		}
		
		return selectedDropdowns;
	}

	function sendAjaxRequest(data, selectedDropdownId) {
		$.ajax({
			url: 'includes/search/api.php',
			type: 'get',
			data: data,
			success: function (response){
				responseParsed = JSON.parse(response);
				if(responseParsed?.options){
					for(let key in responseParsed?.options){
						if(responseParsed?.options?.hasOwnProperty(key)){
							updateFilterDropdowns(key, responseParsed?.options[key], responseParsed?.options, selectedDropdownId)
						}
					}
				}

			},
			error: function (err){
				console.log('*err: ', err)
			}
		});
	}
  
  var modified_data = []

  function updateRecords(){
    var row_id = $(this).closest('tr').attr('data-id')
    let secondClassName = $(this).attr('class').split(' ')[1];
    console.log('*second: ', secondClassName)
    var element_id = $(this).attr('id')
    var element_id_p1 = element_id.split('-')[0]
    var element_id_p2 = element_id.split('-')[1]
    var records_array = <?php echo json_encode($veh_discounts->GetRows()); ?>;
    var records_array_clone = [...records_array]
    

      let record = records_array.find(item => item.veh_ids_id === row_id)
      let indexOfItemAlreadyAdded = modified_data?.findIndex(item => item?.veh_ids_id === row_id)
      let isRecordChanged = false;

      let veh_enabled = $(`#veh_enabled-${element_id_p2}`).prop("checked") ? 1 : null
      let veh_supplier = $(`#veh_supplier-${element_id_p2}`).val() ? $(`#veh_supplier-${element_id_p2}`).val() : null
      let veh_teaser_text = $(`#veh_teaser_text-${element_id_p2}`).val() ? $(`#veh_teaser_text-${element_id_p2}`).val() : null
      let veh_top_left_tag = $(`#veh_top_left_tag-${element_id_p2}`).val() ? $(`#veh_top_left_tag-${element_id_p2}`).val() : null
      let veh_top_right_tag = $(`#veh_top_right_tag-${element_id_p2}`).val() ? $(`#veh_top_right_tag-${element_id_p2}`).val() : null
      let veh_show_on_homepage = $(`#veh_show_on_homepage-${element_id_p2}`).prop('checked') ? 1 : null
      let veh_show_on_deals_page = $(`#veh_show_on_deals_page${element_id_p2}`).prop('checked') ? 1 : null
      let veh_show_on_stock_page = $(`#veh_show_on_stock_page-${element_id_p2}`).prop('checked') ? 1 : null
      let veh_buy_disc_fixed = $(`#veh_buy_disc_fixed-${element_id_p2}`).val() ? $(`#veh_buy_disc_fixed-${element_id_p2}`).val() : "0.00"
      let veh_buy_disc_options_perc = $(`#veh_buy_disc_options_perc-${element_id_p2}`).val() ? $(`#veh_buy_disc_options_perc-${element_id_p2}`).val() : null
      let veh_buy_disc_perc = $(`#veh_buy_disc_perc-${element_id_p2}`).val() ? $(`#veh_buy_disc_perc-${element_id_p2}`).val() : "0.00"
      let veh_sell_disc_fixed = $(`#veh_sell_disc_fixed-${element_id_p2}`).val() ? $(`#veh_sell_disc_fixed-${element_id_p2}`).val() : null
      let veh_sell_disc_options_perc = $(`#veh_sell_disc_options_perc-${element_id_p2}`).val() ? $(`#veh_sell_disc_options_perc-${element_id_p2}`).val() : null
      let veh_sell_disc_perc = $(`#veh_sell_disc_perc-${element_id_p2}`).val() ? $(`#veh_sell_disc_perc-${element_id_p2}`).val() : null
      let veh_profit = $(`#veh_profit-${element_id_p2}`).val() ? $(`#veh_profit-${element_id_p2}`).val() : null
      let basic_price = $(`#vbp-${element_id_p2}`).text() ? $(`#vbp-${element_id_p2}`).text() : 0
        // console.log('*el: ', veh_top_right_tag)
      if(
        record.veh_enabled === veh_enabled && 
        record.veh_supplier === veh_supplier &&
        record.veh_teaser_text === veh_teaser_text &&
        record.veh_top_left_tag === veh_top_left_tag &&
        record.veh_top_right_tag === veh_top_right_tag &&
        record.veh_show_on_homepage === veh_show_on_homepage &&
        record.veh_show_on_deals_page === veh_show_on_deals_page &&
        record.veh_show_on_stock_page === veh_show_on_stock_page &&
        record.veh_buy_disc_fixed === veh_buy_disc_fixed &&
        record.veh_buy_disc_options_perc === veh_buy_disc_options_perc &&
        record.veh_buy_disc_perc === veh_buy_disc_perc &&
        record.veh_sell_disc_fixed === veh_sell_disc_fixed &&
        record.veh_sell_disc_options_perc === veh_sell_disc_options_perc &&
        record.veh_sell_disc_perc === veh_sell_disc_perc &&
        record.veh_profit === veh_profit
      ){
          isRecordChanged = false
        }else{
          isRecordChanged = true
        }
        // if(isRecordChanged){
        //   console.log('*equal not', indexOfItemAlreadyAdded, isRecordChanged)
        // }else{
        //   console.log('*equal', indexOfItemAlreadyAdded, isRecordChanged)
        // }

        if(indexOfItemAlreadyAdded < 0 && isRecordChanged) {
          let updatedRecord = {
                  veh_ids_id: record.veh_ids_id,
                  veh_buy_disc_fixed: veh_buy_disc_fixed,
                  veh_buy_disc_options_perc: veh_buy_disc_options_perc,
                  veh_buy_disc_perc: veh_buy_disc_perc,
                  veh_enabled: veh_enabled,
                  veh_profit: veh_profit,
                  veh_sell_disc_fixed: veh_sell_disc_fixed,
                  veh_sell_disc_options_perc: veh_sell_disc_options_perc,
                  veh_sell_disc_perc: veh_sell_disc_perc,
                  veh_show_on_deals_page: veh_show_on_deals_page,
                  veh_show_on_homepage: veh_show_on_homepage,
                  veh_show_on_stock_page: veh_show_on_stock_page,
                  veh_supplier: veh_supplier,
                  veh_teaser_text: veh_teaser_text,
                  veh_top_left_tag: veh_top_left_tag,
                  veh_top_right_tag: veh_top_right_tag
                }
          modified_data.push(updatedRecord)
        }else if(indexOfItemAlreadyAdded >= 0 && isRecordChanged){
          if($(`#${element_id_p1}-${element_id_p2}`).attr('type') == 'checkbox'){
            modified_data[indexOfItemAlreadyAdded][element_id_p1] = $(`#${element_id_p1}-${element_id_p2}`).prop('checked') ? '1' : null 
          }else{
            modified_data[indexOfItemAlreadyAdded][element_id_p1] = $(`#${element_id_p1}-${element_id_p2}`).val() 
          }
        }else if(!isRecordChanged){
          modified_data.splice(indexOfItemAlreadyAdded,1)
        }

        if(modified_data.length > 0){
          $("#save_records").css("display", "block")
        }else{
          $("#save_records").css("display", "none")
        }

        let discount_buying_price = $("#dbp-"+element_id_p2).text() ? $("#dbp-"+element_id_p2).text() : '';

        if(secondClassName === 'input-buy-perc'){
          basic_price = parseFloat(basic_price)
          veh_buy_disc_perc = parseFloat(veh_buy_disc_perc)
          discount_buying_price = basic_price - (basic_price*veh_buy_disc_perc/100);
          console.log('*price: ', basic_price, veh_buy_disc_perc, discount_buying_price)
          $("#dbp-"+element_id_p2).text(discount_buying_price)
        }
        if(secondClassName === 'input-buy-fixed'){
          discount_buying_price = parseFloat(discount_buying_price) - veh_buy_disc_fixed;
          $("#dbp-"+element_id_p2).text(discount_buying_price)
        }
        
    console.log('*arr: ', modified_data)
    
  }

  function setBulkValue(className, value) {
    if(value) {
        $(`.${className}`).val(value)
        if($(`.${className}`).attr('type') === 'checkbox'){
          $(`.${className}`).prop("checked",value)
        }else{
          $(`.${className}`).val(value)
        }
      }else{
        if($(`.${className}`).attr('type') === 'checkbox'){
          $(`.${className}`).prop("checked","")
        }else{
          $(`.${className}`).val("")
        }
        
      }
  }

  function validateBulkUpdateFunc(){
    let firstClassName = $(this).attr('class').split(' ')[0];
    let className = firstClassName.substring(0,firstClassName.length-5);
    if($(this).attr('type') === 'checkbox'){
      let value = $(this).prop("checked") ? '1' : null
      $(`.${className}`).prop("checked", value)
    }else{
      let value = $(this).val()
      $(`.${className}`).val(value);
    }
    $("#save_bulk_records").css("display","block");
    
  }

  function setRowsDisable(){
    $("table").find(`
      .select-supplier, 
      .input-top_left_tab, 
      .input-top_right_tab,
      .input-enabled,
      .checkbox-homepage,
      .checkbox-hotdeals,
      .checkbox-stockdeals,
      .input-teaset,
      .input-buy-perc,
      .input-buy-fixed,
      .input-buy-option-perc,
      .input-sell-perc,
      .input-sell-fixed,
      .input-sell-option-perc,
      .input-profit`).attr("disabled", true);
  }

  function setRowsEnable(){
    $("table").find(`
        .select-supplier, 
        .input-top_left_tab, 
        .input-top_right_tab,
        .input-enabled,
        .checkbox-homepage,
        .checkbox-hotdeals,
        .checkbox-stockdeals,
        .input-teaset,
        .input-buy-perc,
        .input-buy-fixed,
        .input-buy-option-perc,
        .input-sell-perc,
        .input-sell-fixed,
        .input-sell-option-perc,
        .input-profit`).attr("disabled", false);
  }

	$(document).ready(function() {

    $("#save_bulk_records_btn").click(function(){
      $(".bulk-element").toggle()
      if($(this).text() === "ENABLE BULK MODE"){
        $(this).text("DISABLE BULK MODE")
        setRowsDisable()
        $("#save_records").css("display","none")
      }else{
        $(this).text("ENABLE BULK MODE")
        // setRowsEnable();
        // $("#save_records").css("display","none")
        window.location.reload();
      }
    })
		//if sessions are set then set dropdowns according to that
		let tempData = {};
		for(let i=1; i<8; i++){
			tempData = getSelectedDropdowns(($el[i]).attr('id'), true);	
			sendAjaxRequest(tempData, ($el[i]).attr('id'));
		}

		$el[1].add($el[2]).add($el[3]).add($el[4]).add($el[5]).add($el[6]).add($el[7]).add($el[8]).on('change', async function(){
				const selectedDropdownId= $(this).attr('id') 
				const data = getSelectedDropdowns(selectedDropdownId, false);
				await sendAjaxRequest(data, selectedDropdownId);
				setTimeout(() => {
					$("#search_filters").click();
				}, 500);
			});

      $(`.select-supplier, 
        .input-top_left_tab, 
        .input-top_right_tab,
        .input-enabled,
        .checkbox-homepage,
        .checkbox-hotdeals,
        .checkbox-stockdeals,
        .input-teaset,
        .input-buy-perc,
        .input-buy-fixed,
        .input-buy-option-perc,
        .input-sell-perc,
        .input-sell-fixed,
        .input-sell-option-perc,
        .input-profit   
        `).keyup(updateRecords).change(updateRecords)

        $(`.select-supplier-bulk, 
        .input-top_left_tab-bulk, 
        .input-top_right_tab-bulk,
        .input-enabled-bulk,
        .checkbox-homepage-bulk,
        .checkbox-hotdeals-bulk,
        .checkbox-stockdeals-bulk,
        .input-teaset-bulk,
        .input-buy-perc-bulk,
        .input-buy-fixed-bulk,
        .input-buy-option-perc-bulk,
        .input-sell-perc-bulk,
        .input-sell-fixed-bulk,
        .input-sell-option-perc-bulk,
        .input-profit-bulk   
        `).keyup(validateBulkUpdateFunc).change(validateBulkUpdateFunc)

        $("#save_records").click(function(){
          if(modified_data.length > 0){
            let reqData = {
              request_type: 'update_records',
              data: modified_data
            }
            $.ajax({
              url: 'includes/search/api2.php',
              type: 'post',
              data: reqData,
              success: function (response){
                // responseParsed = JSON.parse(response);
                // console.log('*res: ', responseParsed);
                $("#save_records").css("display", "none");
                modified_data = [];
              },
              error: function (err){
                console.log('*err: ', err)
              }
            });
          }
        })

        $("#save_bulk_records").click(function(){
            let reqData = {
              request_type: 'update_bulk_records',
              data: {
                veh_enabled: $(`#veh_enabled-bulk`).prop("checked") ? '1' : null,
                veh_supplier: $(`#veh_supplier-bulk`).val(),
                veh_teaser_text: $(`#veh_teaser_text-bulk`).val(),
                veh_top_left_tag: $(`#veh_top_left_tag-bulk`).val(),
                veh_top_right_tag: $(`#veh_top_right_tag-bulk`).val(),
                veh_show_on_homepage: $(`#veh_show_on_homepage-bulk`).prop("checked") ? '1' : null,
                veh_show_on_deals_page: $(`#veh_show_on_deals_page-bulk`).prop("checked") ? '1' : null,
                veh_show_on_stock_page: $(`#veh_show_on_stock_page-bulk`).prop("checked") ? '1' : null,
                veh_buy_disc_fixed: $(`#veh_buy_disc_fixed-bulk`).val(),
                veh_buy_disc_options_perc: $(`#veh_buy_disc_options_perc-bulk`).val(),
                veh_buy_disc_perc: $(`#veh_buy_disc_perc-bulk`).val(),
                veh_sell_disc_fixed: $(`#veh_sell_disc_fixed-bulk`).val(),
                veh_sell_disc_options_perc: $(`#veh_sell_disc_options_perc-bulk`).val(),
                veh_sell_disc_perc: $(`#veh_sell_disc_perc-bulk`).val(),
                veh_profit: $(`#veh_profit-bulk`).val(),
              }
            }
            $.ajax({
              url: 'includes/search/api2.php',
              type: 'post',
              data: reqData,
              success: function (response){
                $("#save_bulk_records").css("display", "none");
                setRowsEnable();
                $("#save_bulk_records_btn").text("ENABLE BULK MODE")
              },
              error: function (err){
                console.log('*err: ', err)
              }
            });
        }) 

         
	});
</script>

<?php
$veh_discounts->Close();
$manufacturers->Close();
$models->Close();
$bodystyles->Close();
$trimlevel->Close();
$fueltype->Close();
$transmission->Close();
$doors->Close();
$suppliers->Close();
$vehtabs->Close();

$year_plate->Close();
?>
