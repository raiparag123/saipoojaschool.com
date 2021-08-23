<?php
ob_start();
require 'db.php';  
$fy_id=3;
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
$registration_id="";

if(isset($_REQUEST["cs_id"]))	{ 
	$cs_id=$_REQUEST["cs_id"];
	$stmt = $mysqli->prepare("select b.first_name,c.class_name,b.registration_id from class_stud_master a,stud_regist_master b,class_master c where a.student_id = b.registration_id 	and a.class_id=c.class_id and  cs_id=?");
	$stmt->bind_param("d",$cs_id);
	$result = $stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($first_name,$class_name,$registration_id);
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
				<div class="page-bar">
						
					
						<div class="page-title">View Fee Reciept</div>
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
													<label class="control-label">Registration :</label>
													<label class="control-label"><?php echo $registration_id;?></label>
												</div>	
												<!--<div class="col-lg-3">
													<label class="control-label">Paid By:</label>
													<input calss="form-control" type="text" name="paidby" id="paidby">
												</div>	-->
						</div>
						
						<div class="form-group row">
																			 					
												<div class="col-md-3">
													<select class="form-control" name="month2" onchange="cgmonthdrp(this);">
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
													
													<option value="<?php echo $stdfee_drp;?>"><?php if($month_id<10) echo $month_list[$month_id].' \''.substr($year,2,2); else echo $month_list[$month_id].'-'.substr($year,5,2); ?></option>

													<?php }
													$stmt->close();
													} ?>

													</select>
												</div>	
												<div class="col-md-4">
												<button onclick="javascript:window.print();" class="btn btn-success btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>

												</div>
												<div class="col-md-4">
												<a href="alter_fees.php?cs_id=<?php echo $cs_id;?>" ><button type="button"  class="btn btn-info"  id="addnew" style="display:none">Modify<i class="fa fa-plus"></i></button></a>												
												</div>
											</div>
											
											
					</div>
				
				<div class="white-box" style="border:1px solid #000;" id="feecontent">
					<!--<div class="row">
							<div class="col-md-2 offset-md-1 text-right">
							<img src="../assets/img/logo.png" alt="logo" class="img-responsive" />
							</div>
							<div class="col-md-6 offset-md-1 text-center">
								<h1>SAI POOJA  J. HIGH SCHOOL</h1>
								<h4>Narottampur, Varanasi</h4>
							</div>
						</div>
						<hr>
						<br>
						<div class="row">
							<div class="col-md-4 text-left">
								<p><b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b> MAHIMA</p>
								<p><b>F. Name&nbsp;:&nbsp;&nbsp;</b> RAM BHUVAN</p>
								<p><b>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b> CLASS-8</p>
								<p><b>Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</b> JAN '18 to Feb '18</p>
							</div>
							<div class="col-md-4 offset-md-4 text-right">
							<p><b>Date&nbsp;:&nbsp;&nbsp;</b> 03-01-2019</p>
							<p><b>Reg. No&nbsp;:&nbsp;&nbsp;</b> 385&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="table-repsonsive-md text-center">
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">Sr. No</th>
											<th class="text-left">Paticulars</th>
											<th class="text-left">Amount</th>
											<th class="text-center"> </th>
											<th class="text-center">Month</th>
											<th class="text-right">Total</th>
										</tr>
									</thead>
									
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td class="text-left">Admission/ Re-Admission</td>
											<td class="text-left">500</td>
											<td class="text-center">x</td>
											<td class="text-center">1</td>
											<td class="text-right">500.00</td>
										</tr>
											
										
										
										
										<tr>
											<td>Sign</td>
											<td></td>
											<td></td>
											<td></td>
											<th>Grand Total</th>
											<th class="text-right">450.00</th>
										</tr>
										
									</tbody>
								</table>
								<br>
								</div>
							</div>
						</div>-->
						
						
						
					</div>
					
					
					
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div>
			<!-- end page content -->
	
			<?php include 'footer.html';?>
			
			
			
			 
			
			<script src="../assets/plugins/select2/js/select2.js"></script>
    		<script src="../assets/js/pages/select2/select2-init.js"></script>
			<script src='script.js' type='text/javascript'></script>
	 