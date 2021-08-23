<?php
ob_start();
require 'db.php';
session_start();  
$fy_id=$_SESSION["fy_id"];
$i="";
$count="";
$csid="";
$first_name="";$class_name="";$medium="";$month_id="";$month_name="";
$month_list = array("N/A","April", "May", "June","July","August","September","October","November","December","January","February","March");
$month_list_db=array("N/A");
$class_id="";
$fee_name="";
$fee_amount="";
$fee_name_id="";
$stfid="";
$stdfee_drp="";
$year="";

if(isset($_REQUEST["cs_id"]))	{ 
	$cs_id=$_REQUEST["cs_id"];
	$stmt = $mysqli->prepare("select b.first_name,c.class_name,c.medium from class_stud_master a,stud_regist_master b,class_master c where a.student_id = b.registration_id 	and a.class_id=c.class_id and  cs_id=?");
	$stmt->bind_param("d",$cs_id);
	$result = $stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($first_name,$class_name,$medium);
	while($data = $stmt->fetch())	{

	}
	$stmt->close();
}

?>


<link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Add Fees</header>
									<button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
										<i class="material-icons">more_vert</i>
									</button>
									<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" data-mdl-for="panel-button">
										<li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
										<li class="mdl-menu__item"><i class="material-icons">print</i>Another action</li>
										<li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
									</ul>
								</div>
								<div class="card-body" id="bar-parent">
									<form action="ajax_calls.php" enctype="multipart/form-data" method="POST" id="form_sample_1" class="form-horizontal">
										
										<div class="form-body">
										
											<div class="form-group row">
												<div class="col-md-3">
														<label class="control-label">Name :</label>
														<label class="control-label" ><?php echo $first_name?></label>
												</div>
												<div class="col-md-3">
													<label class="control-label">Class :</label>
													<label class="control-label"><?php echo $class_name;?></label>
													<input type="hidden" name="studfeeid" value="<?php echo $stfid;?>">	
												</div>
												<div class="col-lg-3">
													<label class="control-label">Medium :</label>
													<label class="control-label"><?php echo $medium;?></label>
												</div>	
												<!--<div class="col-lg-3">
													<label class="control-label">Paid By:</label>
													<input calss="form-control" type="text" name="paidby" id="paidby">
												</div>	-->
											</div>
											<div class="form-group row">
																			 					
												<div class="col-md-3">
													<select class="form-control" name="month2" onchange="altermonthdrp(this);">
													<option value=0 selected>Select Month</option>
													<?php
													
													if(isset($_REQUEST["cs_id"]))	{ 
														$cs_id=$_REQUEST["cs_id"];
														$stmt = $mysqli->prepare("select d.stud_fee_id,a.first_name,c.class_name,c.class_id,c.medium,d.month_id,e.month_name,b.fy_id,f.fy_name from stud_regist_master a,class_stud_master b,class_master c,stud_fee_master d,month_master e,fy_master f where a.registration_id=b.student_id and b.class_id=c.class_id and b.cs_id=d.cs_id and d.month_id=e.month_id and d.cs_id=? and b.fy_id=f.fy_id and d.status=1");
														$stmt->bind_param("d",$cs_id);
														$result = $stmt->execute();
														$stmt->store_result();
														$stmt->bind_result($stdfee_drp,$first_name,$class_name,$class_id,$medium,$month_id,$month_name,$fy_id,$year);
														$count=$stmt->num_rows;
														while($data = $stmt->fetch())
														{
														
													?>
													
													<option value="<?php echo $stdfee_drp;?>"><?php if($month_id<10) echo $month_list[$month_id].'-'.substr($year,2,2); else echo $month_list[$month_id].'-'.substr($year,5,2); ?></option>

													<?php }
													$stmt->close();
													} ?>

													</select>
												</div>	
												<div class="col-md-4">
													<button type="button"  class="btn btn-info" onClick="alteraddrow()" id="addnew" style="display:none">Add New<i class="fa fa-plus"></i></button>
												</div>
											</div>

											<div class="form-group row">
											<table id="table1" class="table table-striped table-hover">
													<thead>
														<tr>
														<th>Action</th>
														<th>Fee Name</th>
														<th> Amount </th>
														</tr>
													</thead>
													<tbody id="tablebody">
													<?php	
													if(isset($_REQUEST["stf_id"]))	{
															
														$stmt = $mysqli->prepare("select c.fee_name_id,c.fee_name,b.fee_amount from fee_master a,fee_struct_master b,fee_name_master c where a.fee_id=b.fee_id and b.fee_name_id=c.fee_name_id and a.class_id=? and fy_id=?");
														$stmt->bind_param("dd",$class_id,$fy_id);
														$result = $stmt->execute();
														$stmt->store_result();
														$stmt->bind_result($fee_name_id,$fee_name,$fee_amount);
														$count=$stmt->num_rows;
														
														$counter=1;
														while($data = $stmt->fetch())
														{}
														}
														
													?>	
													
													</tbody>
											</table>	
										</div>

										<div class="form-actions">
											<div class="row">
												<div class="offset-md-3 col-md-9">
													<button type="submit" name="alterfee" class="btn btn-info m-r-20">Update</button>
													<button type="button" class="btn btn-default">Reset</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end page content -->
	
			<?php include 'footer.html';?>
			
			
			
			 
			
			<script src="../assets/plugins/select2/js/select2.js"></script>
    		<script src="../assets/js/pages/select2/select2-init.js"></script>
			<script src='script.js' type='text/javascript'></script>
	 