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

//echo phpinfo();
//print_r($_GET);die();

function count_digit($number) {
  return strlen($number);
}

function divider($number_of_digits) {
    $tens="1";

  if($number_of_digits>8)
    return 10000000;

  while(($number_of_digits-1)>0)
  {
    $tens.="0";
    $number_of_digits--;
  }
  return $tens;
}
//function call

function digit_formatter($num){
//$num = "789";
$ext="";//thousand,lac, crore
$number_of_digits = count_digit($num); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=divider($number_of_digits-1);
    else
        $divider=divider($number_of_digits);
}
else
    $divider=1;

$fraction=$num/$divider;
$fraction=number_format($fraction,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext="K";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext="L";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext="Cr";
return $fraction." ".$ext;
}

$filter=!empty($_GET) ? $_GET : array('zones'=>'','sales_units'=>'','sales_offices'=>'','states'=>'','districts'=>'','talukas'=>'','tse'=>'','td'=>'');

//print_r($filter);exit;


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

$states = $conn->query("SELECT id,name FROM cog_states where is_active='1' and cog_countries_id='100'")->fetchAll(PDO::FETCH_ASSOC);
$stateptions=array_map(function($item){
	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
}, $states);

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

$zoneLocation=$conn->query("SELECT * FROM dcm_tse_wise_contractor_count_analytics;")->fetchAll(PDO::FETCH_ASSOC);

$enrollmentSummary=$conn->query("SELECT esd.*,es.brand_id FROM `dcm_enrolment_summary` es left join dcm_enrolment_summary_details esd on esd.dcm_enrolment_summary_id=es.id where DATE(esd.created_at)=DATE('2025-06-14')")->fetchAll(PDO::FETCH_ASSOC);



// $channelParterTypes = $conn->query("SELECT id,name FROM dcm_hierarchies where id in (9,10,11,12,13,14)")->fetchAll(PDO::FETCH_ASSOC);
// $channelParterTypeptions=array_map(function($item){
// 	return '<option value="'.$item['id'].'">'.$item['name'].'</option>';
// }, $channelParterTypes);

//$channelPartners = $conn->query("SELECT id,id_extern01,first_name FROM dcm_contacts where dcm_hierarchies_id in (9,10,11,12,13,14) and is_deleted='0'")->fetchAll(PDO::FETCH_ASSOC);
//$channelPartnerptions=array_map(function($item){
	//return '<option value="'.$item['id'].'">'.$item['first_name'].'[SapCode: '.$item['id_extern01'].']</option>';
//}, $channelPartners);
$total_contractors=$conn->query("SELECT count(*) as total FROM `dcm_contacts` where dcm_hierarchies_id ='20' and is_deleted='0'")->fetch(PDO::FETCH_ASSOC);

$enrollmentSummary=array_map(function($item){
	$item['cumulative_sale_serialize_data']=unserialize($item['cumulative_sale_serialize_data']);
    $item['monthly_sale_serialize_data']=unserialize($item['monthly_sale_serialize_data']);
    $item['tier_serialize_data']=unserialize($item['tier_serialize_data']);
    return $item;
}, $enrollmentSummary);

// General
$cumulative_sale_serialize_data=array_column($enrollmentSummary,'cumulative_sale_serialize_data');
$monthly_sale_serialize_data=array_column($enrollmentSummary,'monthly_sale_serialize_data');

$total_volume_yearly=array_sum(array_column($cumulative_sale_serialize_data,'Total'));
$total_volume_monthly=array_sum(array_column($monthly_sale_serialize_data,'Total'));

$total_loggedIn_Users=$conn->query("SELECT sf.dcm_contacts_id,zl.dcm_brand_id FROM `sf_guard_user` as sf left join `dcm_contacts` as  c on c.id=sf.dcm_contacts_id left join `dcm_zone_contact_mapping` as zc on zc.dcm_contact_id=sf.dcm_contacts_id left join `dcm_zone_location_mapping` as zl on zl.id=zc.dcm_zone_location_mapping_id where sf.dcm_hierarchies_id ='20' and sf.last_login is not NULL and c.is_deleted='0' and c.dcm_hierarchies_id='20' group by sf.dcm_contacts_id,zl.dcm_brand_id")->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($total_loggedIn_Users);

$total_loggedIn=count(array_unique(array_column($total_loggedIn_Users,'dcm_contact_id')));

echo $total_loggedIn;die;

$total_entries=$conn->query("SELECT count(*) as total FROM `contractor_purchase_report_data_backup`")->fetch(PDO::FETCH_ASSOC);

$total_points=$conn->query("SELECT SUM(`total_credit_points`-`total_debit_points`) as total FROM `contractor_balance_sheet_data` WHERE `is_deleted_contractor`='0' and dcm_hierarchies_id_contractor ='20'")->fetch(PDO::FETCH_ASSOC);

$total_superactive=$conn->query("SELECT count(DISTINCT dcm_contact_id_contractor) as total FROM `contractor_purchase_report_data_backup` where date(`purchase_date`) <= DATE_SUB(CURDATE(),INTERVAL 30 DAY) and `purchase_status`='Approved'")->fetch(PDO::FETCH_ASSOC);

$total_active=$conn->query("SELECT count(DISTINCT dcm_contact_id_contractor) as total FROM `contractor_purchase_report_data_backup` where date(`purchase_date`) <= DATE_SUB(CURDATE(),INTERVAL 90 DAY) and date(`purchase_date`) >  DATE_SUB(CURDATE(),INTERVAL 30 DAY) and `purchase_status`='Approved';")->fetch(PDO::FETCH_ASSOC);

$total_stag=$conn->query("SELECT count(DISTINCT dcm_contact_id_contractor) as total FROM `contractor_purchase_report_data_backup` where date(`purchase_date`) <= DATE_SUB(CURDATE(),INTERVAL 180 DAY) and date(`purchase_date`) >  DATE_SUB(CURDATE(),INTERVAL 90 DAY) and `purchase_status`='Approved';")->fetch(PDO::FETCH_ASSOC);

//ACC

$acc_array=array_filter($enrollmentSummary,function($item){return $item['brand_id']=='1'; });
//echo '<pre>';
//print_r($acc_array);exit;
$acc_total_contractors=array_sum(array_column($acc_array,'total_contact_count'));

$cumulative_sale_serialize_data_acc=array_column($acc_array,'cumulative_sale_serialize_data');
$monthly_sale_serialize_data_acc=array_column($acc_array,'monthly_sale_serialize_data');

$total_volume_yearly_acc=array_sum(array_column($cumulative_sale_serialize_data_acc,'Total'));
$total_volume_monthly_acc=array_sum(array_column($monthly_sale_serialize_data_acc,'Total'));

//$total_loggedIn_acc=$conn->query("SELECT count(*) as total FROM `sf_guard_user` as sf left join dcm_zone_contact_mapping zc on zc.dcm_contact_id=sf.dcm_contacts_id left join dcm_zone_location_mapping zl on zl.id=zc.dcm_zone_location_mapping_id where sf.dcm_hierarchies_id ='20' and sf.last_login is not NULL and zl.dcm_brand_id='1'")->fetch(PDO::FETCH_ASSOC);

// ACL

$acl_array=array_filter($enrollmentSummary,function($item){return $item['brand_id']=='2'; });
$acl_total_contractors=array_sum(array_column($acl_array,'total_contact_count'));
$cumulative_sale_serialize_data_acl=array_column($acl_array,'cumulative_sale_serialize_data');
$monthly_sale_serialize_data_acl=array_column($acl_array,'monthly_sale_serialize_data');
$total_volume_yearly_acl=array_sum(array_column($cumulative_sale_serialize_data_acl,'Total'));
$total_volume_monthly_acl=array_sum(array_column($monthly_sale_serialize_data_acl,'Total'));
//$total_loggedIn_acl=$conn->query("SELECT count(*) as total FROM `sf_guard_user` as sf left join dcm_zone_contact_mapping zc on zc.dcm_contact_id=sf.dcm_contacts_id left join dcm_zone_location_mapping zl on zl.id=zc.dcm_zone_location_mapping_id where sf.dcm_hierarchies_id ='20' and sf.last_login is not NULL and zl.dcm_brand_id='2'")->fetch(PDO::FETCH_ASSOC);





//print_r($total_entries);die;


//print_r(unserialize($enrollmentSummary[0]['cumulative_sale_serialize_data']));
//echo '<pre>';print_r($acc_array);die;

//$total

?>