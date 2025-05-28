<?php
$servername = "localhost:8889";
$username = "root";
$password = "root";

try {
  $conn = new PDO("mysql:host=$servername;dbname=devadani", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die;
}


$zones = $conn->query("SELECT id,zone_name FROM dcm_zones where is_active='1'")->fetchAll(PDO::FETCH_ASSOC);
$zoneoptions=array_map(function($item){
	return '<option value="'.$item['id'].'">'.$item['zone_name'].'</option>';
}, $zones);

$rso = $conn->query("SELECT id,name FROM dcm_sales_units where is_active='1'")->fetchAll(PDO::FETCH_ASSOC);
$rsoptions=array_map(function($item){
	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
}, $rso);

$branches = $conn->query("SELECT id,name FROM dcm_sales_offices where is_active='1'")->fetchAll(PDO::FETCH_ASSOC);
$branchptions=array_map(function($item){
	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
}, $branches);

$districts = $conn->query("SELECT id,name FROM dcm_district where is_active='1'")->fetchAll(PDO::FETCH_ASSOC);
$districtptions=array_map(function($item){
	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
}, $districts);

$talukas = $conn->query("SELECT id,name FROM dcm_talukas where is_active='1'")->fetchAll(PDO::FETCH_ASSOC);
$talukaptions=array_map(function($item){
	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
}, $talukas);

$tse = $conn->query("SELECT dcm_contact_id,full_name,adid,mobile FROM dcm_tse_wise_contractor_count_analytics where dcm_contact_id>0 group by dcm_contact_id")->fetchAll(PDO::FETCH_ASSOC);
$tseptions=array_map(function($item){
	return '<option value="'.$item['dcm_contact_id'].'">'.$item['full_name'].'[ADID: '.$item['adid'].' | Mobile: '.$item['mobile'].'] </option>';
}, $tse);

// $channelParterTypes = $conn->query("SELECT id,name FROM dcm_hierarchies where id in (9,10,11,12,13,14)")->fetchAll(PDO::FETCH_ASSOC);
// $channelParterTypeptions=array_map(function($item){
// 	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
// }, $channelParterTypes);

//$channelPartners = $conn->query("SELECT id,id_extern01,first_name FROM dcm_contacts where dcm_hierarchies_id in (9,10,11,12,13,14) and is_deleted='0'")->fetchAll(PDO::FETCH_ASSOC);
//$channelPartnerptions=array_map(function($item){
	//return '<option value="'.$item['id'].'">'.$item['first_name'].'[SapCode: '.$item['id_extern01'].']</option>';
//}, $channelPartners);

//echo '<pre>';
//print_r($zoneoptions);

?>

<div class="row">
	<div class="col-sm-12">
		<!-- start: TEXT FIELDS PANEL -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Filter
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
					<div class="form-group">
						<div class="col-md-3 col-sm-6 col-lg-2">
							<select id="zones" name="zones" class="form-control search-select">
								<option value="">All Zones</option>
								<?=($zones ? implode("",$zoneoptions):'')?>
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-lg-2" >
							<select id="sales_units" name="sales_units" class="form-control search-select">
								<option value="">All RSO</option>
								<?=($rso ? implode("",$rsoptions):'')?>
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-lg-2">
							<select id="sales_offices" name="sales_offices" class="form-control search-select">
								<option value="">All Branches</option>
								<?=($branches ? implode("",$branchptions):'')?>
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-lg-2">
							<select id="states" name="states" class="form-control search-select">
								<option value="">All States</option>
								<?=($states ? implode("",$stateptions):'')?>
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-lg-2">
							<select id="districts" name="districts" class="form-control search-select">
								<option value="">All Districts</option>
								<?=($districts ? implode("",$districtptions):'')?>
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-lg-2">
							<select id="talukas" name="talukas" class="form-control search-select">
								<option value="">All Talukas</option>
								<?=($talukas ? implode("",$talukaptions):'')?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-lg-6">
							<select id="tse" name="tse" class="form-control search-select">
								<option value="">All TSE</option>
								<?=($tse ? implode("",$tseptions):'')?>
							</select>
						</div>
						<div class="make-switch" data-on-label="MTD" data-off-label="YTD">
							<input type="checkbox" checked>
						</div>
						<!-- <div class="col-md-3 col-sm-6 col-lg-3">
							<select id="tse" name="tse" class="form-control search-select">
								<option value="">All Channel Partner Types</option>
								
							</select>
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<select id="tse" name="tse" class="form-control search-select">
								<option value="">All Channel Partners</option>
							</select>
						</div>  -->
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
