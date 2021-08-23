<?php
ob_start();
require 'db.php';  
$fy_id=$_SESSION["fy_id"];
$year=$_SESSION["year"];
session_start();
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

$registration_id="";


?>


<link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
				<div class="page-bar">
						
					
						<div class="page-title">Print Fees</div>
						<input type="hidden" id="sid" value="<?php echo $_SESSION["s_id"];?>">
						<input type="hidden" id="eid" value="<?php echo $_SESSION["e_id"];?>">
						
											
					</div>
				
				<div class="white-box" style="border:1px solid #000;padding:10px" id="feecontent">
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
			
			
			
			 <script type='text/javascript'>
			 
			 $(document).ready(function(){	
			
				var values=document.getElementById("sid").value;
				var values2=document.getElementById("eid").value;
				document.getElementById("feecontent").innerHTML ="";
				
				$.ajax({
                    url:'ajax_calls.php',
                    type:'POST',
                    data:'pfees1='+values+'&pfees2='+values2,
                    success: function(response){
                        document.getElementById("feecontent").innerHTML =response;
						window.print();
						
                    }
                });
			 });
			 </script>
	
			<script src="../assets/plugins/select2/js/select2.js"></script>
    		<script src="../assets/js/pages/select2/select2-init.js"></script>
			<script src='script.js' type='text/javascript'></script>
	 