<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$base_url="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["REQUEST_URI"].'?').'/';
include('model.php');?>
<style type="text/css">
	.mini-stats{    margin-bottom: 5px;
    border-bottom: 1px solid #DDDDDD;
    border-left: 0px;
    padding-bottom: 5px;}

</style>
<script type="text/javascript">
	$(function() { $('#analytics-filter select').change(function(){ $(this).parents('form').submit();}); });
	/*$(function() { 
		var zonelocation=JSON.parse('');
		console.log(zonelocation);
		 $('#analytics-filter select').change(function(){
			var v=$(this).val();
			var n=$(this).attr('name');
			var selectZoneMap=[{}];

			var zones=[];
			var sales_units=[];
			var sales_offices=[];
			var states=[];
			var districts=[];
			var talukas=[];
			var tse=[];
			switch(n){
				case 'zones':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_zone_id==v) : zonelocation;
				break;
				case 'sales_units':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_sales_units_id==v) : zonelocation;
				break;
				case 'sales_offices':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_sales_offices_id==v) : zonelocation;
				break;
				case 'states':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_state_id==v) : zonelocation;
				break;
				case 'districts':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_district_id==v) : zonelocation;
				break;
				case 'talukas':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_talukas_id==v) : zonelocation;
				break;
				case 'tse':
					 selectZoneMap = v ? zonelocation.filter(record=>record.dcm_contact_id==v) : zonelocation;
				break;
			}

			if(selectZoneMap.length > 0){
				selectZoneMap.forEach(function(item){
					zones.push({id:item.dcm_zone_id,name:item.zone_name,selected:n=='zones' ? v : ''});
					sales_units.push({id:item.dcm_sales_units_id,name:item.sales_unit_name,selected:n=='sales_units' ? v : ''});
					sales_offices.push({id:item.dcm_sales_offices_id,name:item.sales_office_name,selected:n=='sales_offices' ? v : ''});
					states.push({id:item.dcm_state_id,name:item.state_name,selected:n=='states' ? v : ''});
					districts.push({id:item.dcm_district_id,name:item.district_name,selected:n=='districts' ? v : ''});
					talukas.push({id:item.dcm_talukas_id,name:item.taluka_name,selected:n=='talukas' ? v : ''});
					tse.push({id:item.dcm_contact_id,name:item.full_name+'[ADID: '+item.adid+' | Mobile: '+item.mobile+']',selected:n=='tse' ? v : ''});
				})
				zones= Array.from(new Set(zones.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));
				sales_units=Array.from(new Set(sales_units.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));
				sales_offices=Array.from(new Set(sales_offices.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));
				states=Array.from(new Set(states.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));
				districts=Array.from(new Set(districts.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));
				talukas=Array.from(new Set(talukas.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));
				tse=Array.from(new Set(tse.map(o => JSON.stringify(o)))).map(str => JSON.parse(str));

				
			}
			
		});
	});*/
</script>
<!-- <link rel="stylesheet" href="<?=$base_url?>dash.css"></link> -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: TEXT FIELDS PANEL -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Filter
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal" id="analytics-filter" method="get" >
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
						<div class="col-md-2 col-sm-3 col-lg-2">
							<div class="make-switch" id="td" name="td" data-on-label="MTD" data-off-label="YTD" value="1">
								<input type="checkbox" checked>
							</div>
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
						<!-- <div class="col-md-2 col-sm-3 col-lg-2">
							<button class="btn btn-blue next-step btn-block">
								Submit
							</button>
						</div> -->
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
<!-- <div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Overall Summary
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Total Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Super Active Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Active Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Total TSE</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Stagnant Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Dormant Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Total Entry</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Inactive Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="btn btn-icon btn-block">
							<div>500</div>
							<div>Deactivated Contractors</div> 
							<div>ACL : 200 | ACC : 300</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div> -->
<!-- <div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	    <div class="tile">
	        <div class="tile-wrapper">
	            <div class="event-header">
	            	<div class="dbox dbox--color-3">
						<div class="dbox__icon">
							<i class="glyphicon glyphicon-ok"></i>
						</div>
						<div class="dbox__body">
							<span class="dbox__count">Contractors Detail</span>
							<span class="dbox__title"> Total <b><font color="#fff" size="18"><?=digit_formatter($total_contractors['total'])?></font></b> Users</span>
						</div>
						 <div class="dates">
	                <div class="start">
	                    <strong>Total ACC Contractors</strong> <?=digit_formatter($acc_total_contractors)?>
	                    <span></span>
	                </div>
	                <div class="ends">
	                    <strong>Total ACL Contractors</strong> <?=digit_formatter($acl_total_contractors)?>
	                </div>
	            </div>			
					</div>
	           

	            <div class="stats">

	                <div>
	                    <strong>Total Volume</strong> <?=digit_formatter(round($total_volume_yearly))?> MT
	                </div>
					<div>
	                    <strong>Total Vol.(ACC)</strong> <?=digit_formatter(round($total_volume_yearly_acc))?> MT
	                </div>
					<div>
	                    <strong>Total Vol.(ACL)</strong> <?=digit_formatter(round($total_volume_yearly_acl))?> MT
	                </div>

	              <div>
	                    <strong>Total TSE</strong> <?=digit_formatter(count($tse))?>
	                </div>

	                <div>
	                    <strong>Total Entries</strong> <?=digit_formatter($total_entries['total'])?>
	                </div> 

	            </div>

	            <div class="stats">

	                <div>
	                    <strong>Total LoggedIn</strong> <?=digit_formatter($total_loggedIn['total'])?>
	                </div>

	                <div>
	                    <strong>Total Points</strong> <?=digit_formatter(round($total_points['total']))?>
	                </div>

	                <div>
	                    <strong>Productivity</strong> <?=round($total_volume_yearly/$total_contractors['total'])?>
	                </div>

	            </div>

	            <div class="stats">

	                <div>
	                    <strong>SuperActive</strong> <?=digit_formatter($total_superactive['total'])?>
	                </div>

	                <div>
	                    <strong>Active</strong> <?=digit_formatter($total_active['total'])?>
	                </div>

	                <div>
	                    <strong>Stagnant</strong> <?=digit_formatter($total_stag['total'])?>
	                </div>

	            </div>
				 <div class="stats">

	                <div>
	                    <strong>This Mon. Enrol.</strong> <?=digit_formatter($total_superactive['total'])?>
	                </div>

	                <div>
	                    <strong>Active</strong> <?=digit_formatter($total_active['total'])?>
	                </div>

	                <div>
	                    <strong>Stagnant</strong> <?=digit_formatter($total_stag['total'])?>
	                </div>

	            </div> 

	          <div class="event-footer">
	                <a href="#" class="Cbtn Cbtn-primary">View</a>
	                <a href="#" class="Cbtn Cbtn-danger">Delete</a>
	            </div> 
	        </div>
	    </div> 
	</div> -->	

<!-- <div class="row">
	<div class="col-sm-3">
		<button class="btn btn-icon btn-block">
			<i class="clip-clip"></i>
			Projects <span class="badge badge-info"> 4 </span>
		</button>
	</div>
	<div class="col-sm-3">
		<button class="btn btn-icon btn-block pulsate">
			<i class="clip-bubble-2"></i>
			Messages <span class="badge badge-info"> 23 </span>
		</button>
	</div>
	<div class="col-sm-3">
		<button class="btn btn-icon btn-block">
			<i class="clip-calendar"></i>
			Calendar <span class="badge badge-info"> 5 </span>
		</button>
	</div>
	<div class="col-sm-3">
		<button class="btn btn-icon btn-block">
			<i class="clip-list-3"></i>
			Notifications <span class="badge badge-info"> 9 </span>
		</button>
	</div>
</div> -->

<div class="row">
		<div class="col-sm-12">
			<div class="tabbable tabs-left">
				<ul id="myTab3" class="nav nav-tabs tab-green">
					<li class="active">
						<a href="#panel_tab4_example1" data-toggle="tab">
							<i class="pink fa fa-dashboard"></i> AAA
						</a>
					</li>
					<li class="">
						<a href="#panel_tab4_example2" data-toggle="tab">
							<i class="blue fa fa-user"></i> ACC
						</a>
					</li>
					<li class="">
						<a href="#panel_tab4_example3" data-toggle="tab">
							<i class="fa fa-rocket"></i> ACL
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel_tab4_example1">
						<ul class="mini-stats col-sm-12">
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_good">
									<span>3,5,9,8,13,11,14</span>+10%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_contractors['total'])?></strong>
									Contractors
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_good">
									<span>3,5,9,8,13,11,14</span>+10%
								</div> -->
								<div class="values">
									<strong><?=round($total_volume_yearly/$total_contractors['total'])?> MT / Cont.</strong>
									Productivity
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_neutral">
									<span>20,15,18,14,10,12,15,20</span>0%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_loggedIn['total'])?></strong>
									Logged IN Contractor
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_neutral">
									<span>20,15,18,14,10,12,15,20</span>0%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter(round($total_volume_yearly))?> MT</strong>
									Total Volume
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_bad">
									<span>4,6,10,8,12,21,11</span>+50%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter(count($tse))?></strong>
									TE / TSE
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_bad">
									<span>4,6,10,8,12,21,11</span>+50%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_entries['total'])?></strong>
									Total Entries
								</div>
							</li>
						</ul>
					</div>
					<div class="tab-pane" id="panel_tab4_example2">
						<ul class="mini-stats col-sm-12">
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_good">
									<span>3,5,9,8,13,11,14</span>+10%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($acc_total_contractors)?></strong>
									ACC Contractors
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_good">
									<span>3,5,9,8,13,11,14</span>+10%
								</div> -->
								<div class="values">
									<strong><?=round($total_volume_yearly_acc/$acc_total_contractors)?> MT / Cont.</strong>
									ACC Productivity
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_neutral">
									<span>20,15,18,14,10,12,15,20</span>0%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_loggedIn_acc['total'])?></strong>
									ACC Logged IN Contractor
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_neutral">
									<span>20,15,18,14,10,12,15,20</span>0%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter(round($total_volume_yearly_acc))?> MT</strong>
									Total ACC Volume
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_bad">
									<span>4,6,10,8,12,21,11</span>+50%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter(count($tse))?></strong>
									TE / TSE
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_bad">
									<span>4,6,10,8,12,21,11</span>+50%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_entries['total'])?></strong>
									Total Entries
								</div>
							</li>
						</ul>
					</div>
					<div class="tab-pane" id="panel_tab4_example3">
						<ul class="mini-stats col-sm-12">
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_good">
									<span>3,5,9,8,13,11,14</span>+10%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($acl_total_contractors)?></strong>
									ACL Contractors
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_good">
									<span>3,5,9,8,13,11,14</span>+10%
								</div> -->
								<div class="values">
									<strong><?=round($total_volume_yearly_acl/$acl_total_contractors)?> MT / Cont.</strong>
									ACL Productivity
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_neutral">
									<span>20,15,18,14,10,12,15,20</span>0%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_loggedIn_acl['total'])?></strong>
									ACL Logged IN Contractor
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_neutral">
									<span>20,15,18,14,10,12,15,20</span>0%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter(round($total_volume_yearly_acl))?> MT</strong>
									Total ACL Volume
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_bad">
									<span>4,6,10,8,12,21,11</span>+50%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter(count($tse))?></strong>
									TE / TSE
								</div>
							</li>
							<li class="col-sm-3 col-lg-2">
								<!-- <div class="sparkline_bar_bad">
									<span>4,6,10,8,12,21,11</span>+50%
								</div> -->
								<div class="values">
									<strong><?=digit_formatter($total_entries['total'])?></strong>
									Total Entries
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

