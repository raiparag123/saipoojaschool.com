<?php
ob_start();
require 'db.php';  
//$month_list = array("N/A","April", "May", "June","July","August","September","October","November","December","January","February","March");
$dates="";
?>

<link href="../assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
				<div class="page-bar">
						
					
						<div class="page-title">DCR Report</div>
						<div class="form-group row">
												<div class="col-md-4">
														<label class="control-label">Date :</label>
														<div class="input-append date form_date" data-date-format="dd-mm-yyyy"
														data-date="2013-02-21T15:25:00Z">
														<input onchange="cgdaydrp(this);" class="input-height" size="20" type="text" readonly name="dcrdate" id="dcrdate" value="<?php echo date('d-m-Y');?>">
														<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
														<span class="add-on"><i class="fa fa-calendar"></i></span>
													</div>
												</div>
						
						
						
																			 					
												
												<div class="col-md-4">
												<button onclick="javascript:window.print();" class="btn btn-success btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>

												</div>
												
											
											
							</div>				
				</div>
				
				<div class="white-box" style="border:1px solid #000;" id="feecontent">
					<div class="row">
						<div class="col-md-12 text-center">
							<h1>DCR Report</h1>
						</div>
					</div>
					<div class="row">
								<div class="col-md-4 text-left">
									<p>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<b id="dodcr"><?php echo date('d-m-Y');?></b></p>
								</div>
					</div>
						<div class="row">
							<div class="col-md-12">
								<div class="table-repsonsive-md text-center">
								<table class="table" id="dcrcontent">
									<thead>
										<tr align="left">
											<th >Sr. No</th>
											<th >Date</th>
											<th >Reg No.</th>
											<th >Full Name</th>
											<th >Father Name</th>
											<th >Class</th>
											<th >Month</th>
											<th >To Month</th>
											<th >Amount</th>
											
										</tr>
									</thead>
									
									<tbody>
									<?php
									$tamt=0;
									$dates=date('Y-m-d');
									$cs_id=0;
									$tomonth=0;
									$father_name="";
									$stmt = $mysqli->prepare("SELECT e.father_name,a.cs_id,e.regno,e.first_name,d.class_name,f.month_name,sum(b.fee_amount),g.fy_name,f.month_id 
									FROM stud_fee_master a,stud_fee_log_master b,class_stud_master c,class_master d,stud_regist_master e,month_master f,
								   fy_master g WHERE a.month_id=f.month_id and g.fy_id=c.fy_id and   a.stud_fee_id=b.stud_fee_id and c.cs_id=a.cs_id and
									d.class_id=c.class_id and e.registration_id=c.student_id and a.datetimes like '%$dates%' 
									and c.fy_id=? and c.is_delete = 1  and e.status <> 0 and e.is_delete <> 0 
									GROUP by c.cs_id");
									$stmt->bind_param("d",$fy_id);
									
									$result = $stmt->execute();
									$stmt->store_result();
									$stmt->bind_result($father_name,$cs_id,$reg,$fname,$class_name,$month,$amount,$fy,$month_id);
									$i=1;
									$count=$stmt->num_rows;
									while($data = $stmt->fetch()){
										$tamt =$tamt+$amount;
										if($month_id<10)
										$month=$month." ' ".substr($fy,2,2);
										else
										$month=$month." ' ".substr($fy,5,2);

									$stmt1 = $mysqli->prepare("select month_name,month_id from month_master where month_id=(select max(month_id) from stud_fee_master where cs_id=? and datetimes like '%$dates%')");
									$stmt1->bind_param("d",$cs_id);
                                    $result1 = $stmt1->execute();
									$stmt1->store_result();
									$stmt1->bind_result($tomonth,$month_id);
									while($data1 = $stmt1->fetch()){}

										if($month_id<10)
										$tomonth=$tomonth." ' ".substr($fy,2,2);
										else
										$tomonth=$tomonth." ' ".substr($fy,5,2);


									?>
									
										<tr>
											<td ><?php echo $i;?></td>
											<td ><?php echo date('d-m-Y');?></td>
											<td ><?php echo $reg;?></td>
											<td ><?php echo $fname;?></td>
											<td ><?php echo $father_name;?></td>
											<td ><?php echo $class_name;?></td>
											<td ><?php echo $month;?></td>
											<td ><?php echo $tomonth;?></td>
											
											<td ><?php echo $amount;?></td>
											
											
										</tr>
											
										
										
										
									<?php $i++; }?>
									<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><b>Total</b></td>
									<td><b><?php echo $tamt;?></b></td>
									</tr>									
									</tbody>
								</table>
								<br>
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
	 