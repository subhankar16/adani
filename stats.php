<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() { 
		//document.querySelectorALL('#analytics-filter select').each(function())
	});
</script>
<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$base_url="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["REQUEST_URI"].'?').'/';
include('model.php');?>
<link rel="stylesheet" href="<?=$base_url?>dash.css"></link>
<div class="row">
	<div class="col-sm-12">
		<!-- start: TEXT FIELDS PANEL -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				Filter
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal" id="analytics-filter">
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
<div class="row">
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
							<span class="dbox__title"> Total <b><font color="#fff" size="18">500</font></b> Users</span>
						</div>
						
						<!-- <div class="dbox__action">
							<button class="dbox__action__btn">More Info</button>
						</div>	 -->
						 <div class="dates">
	                <div class="start">
	                    <strong>Total ACC Contractors</strong> 200
	                    <span></span>
	                </div>
	                <div class="ends">
	                    <strong>Total ACL Contractors</strong> 300
	                </div>
	            </div>			
					</div>
	           

	            <div class="stats">

	                <div>
	                    <strong>Total Volume</strong> 3098
	                </div>

	                <div>
	                    <strong>Total TSE</strong> 562
	                </div>

	                <div>
	                    <strong>Total Entries</strong> 182
	                </div>

	            </div>

	            <div class="stats">

	                <div>
	                    <strong>Total LoggedIn</strong> 3098
	                </div>

	                <div>
	                    <strong>Total Points</strong> 562
	                </div>

	                <div>
	                    <strong>Productivity</strong> 182
	                </div>

	            </div>

	            <div class="stats">

	                <div>
	                    <strong>SuperActive</strong> 3098
	                </div>

	                <div>
	                    <strong>Active</strong> 562
	                </div>

	                <div>
	                    <strong>Stagnant</strong> 182
	                </div>

	            </div>

	           <!--  <div class="event-footer">
	                <a href="#" class="Cbtn Cbtn-primary">View</a>
	                <a href="#" class="Cbtn Cbtn-danger">Delete</a>
	            </div> -->
	        </div>
	    </div> 
	</div>
</div>

