<?php
//Connection statement
require_once('Connections/ukcd.php');

//Aditional Functions
require_once('includes/functions.inc.php');

// Load the common classes
require_once('includes/common/KT_common.php');

// Load the required classes
require_once('includes/tfi/TFI.php');
require_once('includes/tso/TSO.php');
require_once('includes/nav/NAV.php');

// Filter
$tfi_listsearch1 = new TFI_TableFilter($ukcd, "tfi_listsearch1");
$tfi_listsearch1->addColumn("manufacturer_id", "NUMERIC_TYPE", "manufacturer_id", "=");
$tfi_listsearch1->addColumn("model_group", "STRING_TYPE", "model_group", "=");
$tfi_listsearch1->addColumn("expanded_body_style_id", "NUMERIC_TYPE", "expanded_body_style_id", "=");
$tfi_listsearch1->addColumn("trim", "STRING_TYPE", "trim", "=");
$tfi_listsearch1->addColumn("fuel_type_id", "NUMERIC_TYPE", "fuel_type_id", "=");
$tfi_listsearch1->addColumn("transmission_type_id", "NUMERIC_TYPE", "transmission_type_id", "=");
$tfi_listsearch1->addColumn("doors", "NUMEMRIC_TYPE", "doors", "=");
$tfi_listsearch1->Execute();

// Sorter
$tso_listsearch1 = new TSO_TableSorter("search", "tso_listsearch1");
$tso_listsearch1->addColumn("manufacturer_id");
$tso_listsearch1->addColumn("model_group");
$tso_listsearch1->addColumn("expanded_body_style_id");
$tso_listsearch1->addColumn("trim");
$tso_listsearch1->addColumn("fuel_type_id");
$tso_listsearch1->addColumn("transmission_type_id");
$tso_listsearch1->addColumn("doors");
$tso_listsearch1->addColumn("accelleration_0_to_100_kph");
$tso_listsearch1->addColumn("co2_emissions");
$tso_listsearch1->addColumn("mpg_combined");
$tso_listsearch1->addColumn("insurance_group");
$tso_listsearch1->addColumn("basic_price");
$tso_listsearch1->setDefault("manufacturer_id");
$tso_listsearch1->Execute();

// Navigation
$nav_listsearch1 = new NAV_Regular("nav_listsearch1", "search", "", $_SERVER['PHP_SELF'], 12);

// begin Recordset
$query_year_plate = "SELECT global_year, global_plate FROM a_ukcd_globals";
$year_plate = $ukcd->SelectLimit($query_year_plate) or die($ukcd->ErrorMsg());
$totalRows_year_plate = $year_plate->RecordCount();
// end Recordset

// begin Recordset
$query_manufacturer = "SELECT * FROM manufacturers LEFT JOIN a_ukcd_manufacturers ON id = make_ids_id WHERE make_enabled = 1 ORDER BY name ASC";
$manufacturer = $ukcd->SelectLimit($query_manufacturer) or die($ukcd->ErrorMsg());
$totalRows_manufacturer = $manufacturer->GetRowAssoc();
// end Recordset

// begin Recordset
$query_model_group = "SELECT DISTINCT id, manufacturer_id, model_group, expanded_body_style_id FROM vehicles WHERE commercial = 0 GROUP BY model_group ORDER BY model_group ASC ";
$model_group = $ukcd->SelectLimit($query_model_group) or die($ukcd->ErrorMsg());
$totalRows_model_group = $model_group->RecordCount();

// begin Recordset
$query_bodystyles = "SELECT * FROM expanded_body_style ORDER BY `description` ASC";
$bodystyles = $ukcd->SelectLimit($query_bodystyles) or die($ukcd->ErrorMsg());
$totalRows_bodystyles = $bodystyles->RecordCount();
// end Recordset

// begin Recordset
$query_trimlevel = "SELECT DISTINCT vehicles.id, vehicles.trim, vehicles.model_group FROM vehicles WHERE commercial = 0 GROUP BY vehicles.trim ORDER BY vehicles.trim ASC";
$trimlevel = $ukcd->SelectLimit($query_trimlevel) or die($ukcd->ErrorMsg());
$totalRows_trimlevel = $trimlevel->RecordCount();
// end Recordset

// begin Recordset
$query_fueltype = "SELECT * FROM fuel_types ORDER BY `name` ASC";
$fueltype = $ukcd->SelectLimit($query_fueltype) or die($ukcd->ErrorMsg());
$totalRows_fueltype = $fueltype->RecordCount();
// end Recordset

// begin Recordset
$query_transmission = "SELECT * FROM transmission_types ORDER BY name ASC";
$transmission = $ukcd->SelectLimit($query_transmission) or die($ukcd->ErrorMsg());
$totalRows_transmission = $transmission->RecordCount();
// end Recordset

// begin Recordset
$query_doors = "SELECT DISTINCT vehicles.doors, vehicles.model_group FROM vehicles WHERE vehicles.commercial = 0 GROUP BY vehicles.doors";
$doors = $ukcd->SelectLimit($query_doors) or die($ukcd->ErrorMsg());
$totalRows_doors = $doors->RecordCount();
// end Recordset

// Begin List Recordset
$maxRows_search = $_SESSION['max_rows_nav_listsearch1'];
$pageNum_search = 0;
if (isset($_GET['pageNum_search'])) {
	$pageNum_search = $_GET['pageNum_search'];
}
$startRow_search = $pageNum_search * $maxRows_search;
// Defining List Recordset variable
$NXTFilter__search = "1=1";
if (isset($_SESSION['filter_tfi_listsearch1'])) {
	$NXTFilter__search = $_SESSION['filter_tfi_listsearch1'];
}
// Defining List Recordset variable
$NXTSort__search = "manufacturer_id";
if (isset($_SESSION['sorter_tso_listsearch1'])) {
	$NXTSort__search = $_SESSION['sorter_tso_listsearch1'];
}
$query_search = "SELECT vehicles.id AS vehicle_id, vehicles.manufacturer_id, vehicles.model_group, vehicles.manufacturer_model_description, vehicles.image_filename, vehicles.trim, manufacturers.name AS vehicle_make, vehicles.basic_price, vehicles.vehicle_tree_description, vehicles.long_description, vehicles.model_year, vehicles.doors, vehicles.transmission_type_id, vehicles.expanded_body_style_id, vehicles.fuel_type_id, transmission_types.name AS transmission, fuel_types.name AS fuel_type, expanded_body_style.description, a_ukcd_manufacturers.make_seo FROM vehicles LEFT JOIN manufacturers ON vehicles.manufacturer_id = manufacturers.id LEFT JOIN a_ukcd_manufacturers ON manufacturers.id = a_ukcd_manufacturers.make_ids_id LEFT JOIN expanded_body_style ON vehicles.expanded_body_style_id = expanded_body_style.id LEFT JOIN fuel_types ON vehicles.fuel_type_id = fuel_types.id LEFT JOIN transmission_types ON vehicles.transmission_type_id = transmission_types.id WHERE vehicles.commercial = 0 AND  {$NXTFilter__search}  ORDER BY {$NXTSort__search}";
$search = $ukcd->SelectLimit($query_search, $maxRows_search, $startRow_search) or die($ukcd->ErrorMsg());

if (isset($_GET['totalRows_search'])) {
	$totalRows_search = $_GET['totalRows_search'];
} else {
	$all_search = $ukcd->SelectLimit($query_search) or die($ukcd->ErrorMsg());
	$totalRows_search = $all_search->RecordCount();
}
$totalPages_search = (int)(($totalRows_search-1)/$maxRows_search);
// End List Recordset

$nav_listsearch1->checkBoundries();

//Queries For Mega Menu
include 'tpl_mega_top.php';

//Formatting functions
include_once 'tpl_formats_functions.php';

// make slug for vehicle detail URL
$makeOutput = $search->Fields('make_seo');

$navbase = 'new-cars-search';

//PHP ADODB document - made with PHAkt [Updated For PHP 7]
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
<?php include 'tpl_meta.php'; ?>
<title>Search For & Compare <?php echo $year_plate->Fields('global_year'); ?>  New Car Deals | UK Car Discount</title>
<meta id="description" name="description" content="Use our advanced search tools to find your ideal new car deal. All vehicles are UK dealer supplied, finance or outright purchase options and pay after delivery.">
<meta name="keywords" id="keywords" content="new car search, compare new cars, new car deals, uk, discount, <?php echo $year_plate->Fields('global_year'); ?> , <?php echo $year_plate->Fields('global_plate'); ?> plate">
<link href="/assets/css/styles.css" rel="stylesheet">
<?php include('tpl_base.php'); ?>
	<style>
		/* PM TODO: MOVE THESE RULES TO MAIN SCSS FILE */
		.benefit button {
			width: 49%;
			border-radius: .2rem;
			padding: 0.5rem;
			background: #fff;
			color: #23265B;
		}
		.benefit button {
		cursor: pointer;
		}
		.benefit select {
			border:none;
		}
		.sortby {
			background-color: #23265B;
			color: #fff;
			border-radius: 0.5rem;
			padding: 0.2rem 0.6rem;
			margin-right: 0.2rem;
		}
		.sort-links {
			width:100%;
			text-align:center;
			margin-bottom: 1rem;
		}
		a.KT_desc {
			color: #A81E22;
		}
		a.KT_asc {
			color: #A81E22;
		}
		a.KT_desc::after {
			font-family: "FontAwesome";
			font-size: 1.2rem;
			content: '\f150';	
			margin: 0 0.4rem;
		}
		a.KT_asc::after {
			font-family: "FontAwesome";
			font-size: 1.2rem;
			line-height: 2.6rem;
			content: '\f151';
			margin: 0 0.4rem;
		}
	</style>
</head>
<body>
<?php include 'tpl_header.php'; ?>
<div class="container">
			<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope
					itemtype="https://schema.org/ListItem">
				<a itemprop="item" href="/">
				<span itemprop="name">Home</span></a>
				<meta itemprop="position" content="1">
			</li>
			<li itemprop="itemListElement" itemscope
					itemtype="https://schema.org/ListItem">
				<a itemprop="item" href="/new-cars-search">
				<span itemprop="name">New Cars Search</span></a>
				<meta itemprop="position" content="2">
			</li>
		</ol><form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
		<div id="page-header">

						<h1>Search For New Car Deals</h1>

				<h2>Compare and search for the latest discount <?php echo $year_plate->Fields('global_year'); ?> new cars</h2>

				<div id="bandf">

					<div class="benefit"><select name="tfi_listsearch1_manufacturer_id" id="tfi_listsearch1_manufacturer_id">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_manufacturer_id']))) {echo "SELECTED";} ?>>Any Make</option>
								<?php
	while(!$manufacturer->EOF){
?>
								<option value="<?php echo $manufacturer->Fields('id')?>"<?php if (!(strcmp($manufacturer->Fields('id'), @$_SESSION['tfi_listsearch1_manufacturer_id']))) {echo "SELECTED";} ?>><?php echo $manufacturer->Fields('name')?></option>
								<?php
		$manufacturer->MoveNext();
	}
	$manufacturer->MoveFirst();
?>
							</select></div>
					<div class="benefit"><select name="tfi_listsearch1_model_group" id="tfi_listsearch1_model_group">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_model_group']))) {echo "SELECTED";} ?>>Any Model</option>
								<?php
	while(!$model_group->EOF){
?>
								<option value="<?php echo $model_group->Fields('model_group')?>"<?php if (!(strcmp($model_group->Fields('model_group'), @$_SESSION['tfi_listsearch1_model_group']))) {echo "SELECTED";} ?>><?php echo $model_group->Fields('model_group')?></option>
								<?php
		$model_group->MoveNext();
	}
	$model_group->MoveFirst();
?>
							</select></div>
					<div class="benefit"><select name="tfi_listsearch1_expanded_body_style_id" id="tfi_listsearch1_expanded_body_style_id">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_expanded_body_style_id']))) {echo "SELECTED";} ?>>Any Bodytype</option>
								<?php
	while(!$bodystyles->EOF){
?>
								<option value="<?php echo $bodystyles->Fields('id')?>"<?php if (!(strcmp($bodystyles->Fields('id'), @$_SESSION['tfi_listsearch1_expanded_body_style_id']))) {echo "SELECTED";} ?>><?php echo $bodystyles->Fields('description')?></option>
								<?php
		$bodystyles->MoveNext();
	}
	$bodystyles->MoveFirst();
?>
							</select></div>
					<div class="benefit"><select name="tfi_listsearch1_trim" id="tfi_listsearch1_trim">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_trim']))) {echo "SELECTED";} ?>>Any Trim</option>
								<?php
	while(!$trimlevel->EOF){
?>
								<option value="<?php echo $trimlevel->Fields('trim')?>"<?php if (!(strcmp($trimlevel->Fields('id'), @$_SESSION['tfi_listsearch1_trim']))) {echo "SELECTED";} ?>><?php echo $trimlevel->Fields('trim')?></option>
								<?php
		$trimlevel->MoveNext();
	}
	$trimlevel->MoveFirst();
?>
							</select></div>
					<div class="benefit"><select name="tfi_listsearch1_fuel_type_id" id="tfi_listsearch1_fuel_type_id">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_fuel_type_id']))) {echo "SELECTED";} ?>>Any Fuel Type</option>
								<?php
	while(!$fueltype->EOF){
?>
								<option value="<?php echo $fueltype->Fields('id')?>"<?php if (!(strcmp($fueltype->Fields('id'), @$_SESSION['tfi_listsearch1_fuel_type_id']))) {echo "SELECTED";} ?>><?php echo $fueltype->Fields('name')?></option>
								<?php
		$fueltype->MoveNext();
	}
	$fueltype->MoveFirst();
?>
							</select></div>
					<div class="benefit"><select name="tfi_listsearch1_transmission_type_id" id="tfi_listsearch1_transmission_type_id">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_transmission_type_id']))) {echo "SELECTED";} ?>>Any Transmission</option>
								<?php
	while(!$transmission->EOF){
?>
								<option value="<?php echo $transmission->Fields('id')?>"<?php if (!(strcmp($transmission->Fields('id'), @$_SESSION['tfi_listsearch1_transmission_type_id']))) {echo "SELECTED";} ?>><?php echo $transmission->Fields('name')?></option>
								<?php
		$transmission->MoveNext();
	}
	$transmission->MoveFirst();
?>
							</select></div>
					<div class="benefit"><select name="tfi_listsearch1_doors" id="tfi_listsearch1_doors">
								<option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listsearch1_doors']))) {echo "SELECTED";} ?>>Any No. of doors</option>
								<?php
	while(!$doors->EOF){
?>
								<option value="<?php echo $doors->Fields('doors')?>"<?php if (!(strcmp($doors->Fields('doors'), @$_SESSION['tfi_listsearch1_doors']))) {echo "SELECTED";} ?>><?php echo $doors->Fields('doors')?></option>
								<?php
		$doors->MoveNext();
	}
	$doors->MoveFirst();
?>
							</select></div>
<div class="benefit">
	<button type="submit" name="tfi_listsearch1" value="<?php echo NXT_getResource("Filter"); ?>" title="filter records" class="filter_records" id="search_filters"><i class="fas fa-search"></i> SEARCH</button>
	<button formaction="/new-cars-search?reset_filter_tfi_listsearch1=1" value="Reset" title="reset filter" class="reset_filter" style="background:#fff"><i class="fas fa-times-circle fa-1x"></i> RESET</button>

	</div>

				</div>
		</div>
	
	<?php include 'tpl_paging_search.php'; ?>
	<div class="sort-links"> <span class="sortby">SORT BY:</span> <a class="<?php echo $tso_listsearch1->getSortIcon('basic_price'); ?>" href="<?php echo $tso_listsearch1->getSortLink('basic_price'); ?>">LIST PRICE</a> | <a class="<?php echo $tso_listsearch1->getSortIcon('insurance_group'); ?>" href="<?php echo $tso_listsearch1->getSortLink('insurance_group'); ?>">INS GROUP</a> | <a class="<?php echo $tso_listsearch1->getSortIcon('co2_emissions'); ?>" href="<?php echo $tso_listsearch1->getSortLink('co2_emissions'); ?>">EMISSIONS</a> | <a class="<?php echo $tso_listsearch1->getSortIcon('mpg_combined'); ?>" href="<?php echo $tso_listsearch1->getSortLink('mpg_combined'); ?>">MPG</a></div>
		<div class="box-container">
			<?php
	while (!$search->EOF) {
include('tpl_car_search_results.php');
		$search->MoveNext();
	}
?>
		</div>
		<?php include 'tpl_paging_search.php'; ?>
	</form>
	<?php include 'tpl_footer.php'; ?>

</div>
<script src="/assets/js/nav.js" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

	//update dropdowns when changed
  	const $el = [];
	$el[0] = null; 
	$el[1] = $("#tfi_listsearch1_manufacturer_id");
	$el[2] = $("#tfi_listsearch1_model_group");
	$el[3] = $("#tfi_listsearch1_expanded_body_style_id");
	$el[4] = $("#tfi_listsearch1_trim");
	$el[5] = $("#tfi_listsearch1_fuel_type_id");
	$el[6] = $("#tfi_listsearch1_doors");
	$el[7] = $("#tfi_listsearch1_transmission_type_id");

	$elIds = [
		null,
		'tfi_listsearch1_manufacturer_id',
		'tfi_listsearch1_model_group',
		'tfi_listsearch1_expanded_body_style_id',
		'tfi_listsearch1_trim',
		'tfi_listsearch1_fuel_type_id',
		'tfi_listsearch1_doors',
		'tfi_listsearch1_transmission_type_id'
	];

  	function updateFilterDropdowns(dropdownName, dropdownData, responseData, selectedDropdownId){
		let $dropdownElement = null;
		let defaultSelected = '';
		let selectedRecord = ''; 
		let reqData = responseData?.reqData;
		let selectedFilters = responseData?.selectedFilters;

		if(dropdownName === 'models'){
			$dropdownElement = $el[2];
			defaultSelected = 'Any Model';
		}
		else if(dropdownName === 'bodyStyles'){
			$dropdownElement = $el[3];
			defaultSelected = 'Any Body Style';
		}
		else if(dropdownName === 'trims') {
			$dropdownElement = $el[4];
			defaultSelected = 'Any Trim';
		}
		else if(dropdownName === 'fuelTypes'){
			$dropdownElement = $el[5];
			defaultSelected = 'Any Fuel Type';
		}
		else if(dropdownName === 'doors'){
			$dropdownElement = $el[6];
			defaultSelected = 'Any Doors';
		}
		else if(dropdownName === 'transmissionTypes'){
			$dropdownElement = $el[7];
			defaultSelected = 'Any Transmission';
		}	

		if($dropdownElement){
			let dropdownElementId = $($dropdownElement).attr('id');

			let selectedIndex = $elIds.indexOf(selectedDropdownId)
			let dropdownElementIndex = $elIds.indexOf(dropdownElementId)

			if(dropdownElementIndex > selectedIndex){
				let dropdownHtml = `<option value="">${defaultSelected}</option>`;
				let sortedDropdownData = dropdownData.sort(function (a, b){
					if(a.value < b.value) return -1;
					if(b.value < a.value) return 1;
					return 0;
				});
				for(let record of dropdownData){
					if(record.value !== null){
						dropdownHtml += `<option value="${record.value}">${record.label}</option>`;
					}
				}
				$($dropdownElement).html(dropdownHtml)
			}

 
			if(dropdownName === 'models') {
				$(`#tfi_listsearch1_model_group`).val(selectedFilters['models']);
				if(responseData["models"].some(el => el.value === reqData["models"])){
					$(`#tfi_listsearch1_model_group`).val(reqData["models"]);
				}else{
					$(`#tfi_listsearch1_model_group`).val("");
				}
			}else if(dropdownName === 'bodyStyles'){
				$(`#tfi_listsearch1_expanded_body_style_id`).val(selectedFilters['bodyStyles']);
				if(responseData["bodyStyles"].some(el => el.value === reqData["bodyStyles"])){
					$(`#tfi_listsearch1_expanded_body_style_id`).val(reqData['bodyStyles']);
				}else{
					$(`#tfi_listsearch1_expanded_body_style_id`).val("");
				}
			}
			else if(dropdownName === 'trims') {
				$(`#tfi_listsearch1_trim`).val(selectedFilters['trims']); 
				if(responseData["trims"].some(el => el.value === reqData["trims"])){
					$(`#tfi_listsearch1_trim`).val(reqData['trims']);
				}else{
					$(`#tfi_listsearch1_trim`).val("");
				}
			}
			else if(dropdownName === 'fuelTypes'){
				$(`#tfi_listsearch1_fuel_type_id`).val(selectedFilters['fuelTypes']);
				if(responseData["fuelTypes"].some(el => el.value === reqData["fuelTypes"])){
					$(`#tfi_listsearch1_fuel_type_id`).val(reqData['fuelTypes']);
				}else{
					$(`#tfi_listsearch1_fuel_type_id`).val("");
				}
			}
			else if(dropdownName === 'doors'){
				$(`#tfi_listsearch1_doors`).val(selectedFilters['doors']);
				if(responseData["doors"].some(el => el.value === reqData["doors"])){
					$(`#tfi_listsearch1_doors`).val(reqData['doors']);
				}else{
					$(`#tfi_listsearch1_doors`).val("");
				}
			}
			else if(dropdownName === 'transmissionTypes'){
				$(`#tfi_listsearch1_transmission_type_id`).val(selectedFilters['transmissionTypes']);
				if(responseData["transmissionTypes"].some(el => el.value === reqData["transmissionTypes"])){
					$(`#tfi_listsearch1_transmission_type_id`).val(reqData['transmissionTypes']);					
				}else{
					$(`#tfi_listsearch1_transmission_type_id`).val("");
				}
			}
		}		
	}

	function getSelectedDropdowns(selectedDropdownId, onPageLoaded){
		let selectedDropdowns = {};
		let manufacturerId = 'tfi_listsearch1_manufacturer_id';
		let modelId = 'tfi_listsearch1_model_group';
		let bodyStyleId = 'tfi_listsearch1_expanded_body_style_id';
		let trimId = 'tfi_listsearch1_trim';
		let fuelTypeId = 'tfi_listsearch1_fuel_type_id';
		let transmissionId = 'tfi_listsearch1_transmission_type_id';
		let doorId = 'tfi_listsearch1_doors';
		if(selectedDropdownId === manufacturerId){
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val();
		}else if(selectedDropdownId === modelId){
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_model_group']; ?>` : $(`#${modelId}`).val()
		}else if(selectedDropdownId === bodyStyleId){
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
		}else if(selectedDropdownId === trimId){
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_trim']; ?>` : $(`#${trimId}`).val()
		}else if(selectedDropdownId === fuelTypeId){
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_trim']; ?>` : $(`#${trimId}`).val()
			selectedDropdowns['fuelType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_fuel_type_id']; ?>` : $(`#${fuelTypeId}`).val()
		}else if(selectedDropdownId === transmissionId){
			selectedDropdowns['manufacturer'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_manufacturer_id']; ?>` : $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_trim']; ?>` : $(`#${trimId}`).val()
			selectedDropdowns['fuelType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_fuel_type_id']; ?>` : $(`#${fuelTypeId}`).val()
			selectedDropdowns['transmissionType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_transmission_type_id']; ?>` : $(`#${transmissionId}`).val()
		}else if(selectedDropdownId === doorId){
			selectedDropdowns['manufacturer'] = $(`#${manufacturerId}`).val()
			selectedDropdowns['model'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_model_group']; ?>` : $(`#${modelId}`).val()
			selectedDropdowns['bodyStyle'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_expanded_body_style_id']; ?>` : $(`#${bodyStyleId}`).val()
			selectedDropdowns['trim'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_trim']; ?>` : $(`#${trimId}`).val()
			selectedDropdowns['fuelType'] = $(`#${fuelTypeId}`).val()
			selectedDropdowns['transmissionType'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_transmission_type_id']; ?>` : $(`#${transmissionId}`).val()
			selectedDropdowns['door'] = onPageLoaded ? `<?php echo $_SESSION['tfi_listsearch1_doors']; ?>` : $(`#${doorId}`).val()
		}
		
		return selectedDropdowns;
	}

	function sendAjaxRequest(data, selectedDropdownId) {
		$.ajax({
			url: '/includes/search/api.php',
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
	$(document).ready(function() {

		//if sessions are set then set dropdowns according to that
		let tempData = {};
		for(let i=1; i<8; i++){
			tempData = getSelectedDropdowns(($el[i]).attr('id'), true);	
			sendAjaxRequest(tempData, ($el[i]).attr('id'));
		}

		$el[1].add($el[2]).add($el[3]).add($el[4]).add($el[5]).add($el[6]).add($el[7]).on('change', async function(){
				const selectedDropdownId= $(this).attr('id') 
				const data = getSelectedDropdowns(selectedDropdownId, false);
				await sendAjaxRequest(data, selectedDropdownId);
				setTimeout(() => {
					$("#search_filters").click();
				}, 500);
			});
	});
</script>
</body>
</html>
<?php
$search->Close();
require_once('tpl_mega_close.php');
?>
