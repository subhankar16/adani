<?php
$servername = "localhost";
$username = "root";
$password = "";

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