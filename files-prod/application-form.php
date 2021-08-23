<?php
ob_start();
require 'db.php'; 
require 'header.php';
require 'birthdate.php';
$fy_id=$_SESSION["fy_id"];
$fullname="";
$fname="";
$mname="";
$gname="";
$gender="";
$dob="";
$livingup="";
$regno="";
$tel="";
$mob="";
$laddress="";
$paddress="";
$oldschool="";
$oldclass="";
$aadhar="";
$email="";
$doa="";
$classadmit="";
$scholar="";
$caste="";
$occupation="";
$transfer="";
$curr_class="";
if(isset($_GET['print']))
{
	$reg=$_GET['print'];
$stmt = $mysqli->prepare("SELECT scholar_no,first_name,father_name,mother_name,dob,caste_name,father_occupation,address,regno,telephone,mobile_number,taddress,livinginup,log_datetime,dateofadmiss,gender,email,gname,oldschool,oldclass,aadhar,c.class_name,stud_image,transfer FROM stud_regist_master a,class_stud_master b,class_master c where b.class_id=c.class_id and a.registration_id=b.student_id and a.registration_id=?");
																$stmt->bind_param("d",$reg);
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($scholar,$fullname,$fname,$mname,$dob,$caste,$occupation,$paddress,$regno,$tel,$mob,$laddress,$livingup,$logdate,$doa,$gender,$email,$gname,$oldschool,$oldclass,$aadhar,$classadmit,$stud_image,$transfer);
																//$count=$stmt->num_rows;
																$data = $stmt->fetch();
	
$birth_date = $dob;
$new_birth_date = explode('-', $birth_date);
$year = $new_birth_date[2];
$month = $new_birth_date[1];
$day  = $new_birth_date[0];
$birth_day=ucwords(strtolower(numberTowords($day)));
$birth_year=ucwords(strtolower(numberTowords($year)));
$monthNum = $month;
$dateObj = DateTime::createFromFormat('!m', $monthNum);//Convert the number into month name
$monthName = ucfirst($dateObj->format('F'));

	
?>

			<!-- start page content -->
			<style type="text/css">
u {    
    border-bottom: 2px dotted #000;
    text-decoration: none;
}

	
</style>
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Application Form</div>
							</div>
							
							
							<div class="text-right">
									
									<button onclick="javascript:window.print();" class="btn btn-primary btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
							</div>
						</div>
					</div>
					<div class="white-box" style="border: 1px solid #000">
						
						<div class="row">
							<div class="col-md-2 text-center">
							<img src="../assets/img/logo.png" alt="logo" class="img-responsive" style="height: 120px;width:90%;" />
							</div>
							<div class="col-md-8 text-center">
								<h2>SAI POOJA  J. HIGH SCHOOL</h2>
								<button type="button" class="btn btn-dark" style="border-radius: 25px;">Narottampur, Varanasi</button>
							</div>
							<div class="col-md-2 text-center" >
							<img src="<?php 
							if(strpos( $stud_image , 'stud' ) !== false){
							echo $stud_image;
							}
							else{
							echo "noimage.jpg"; 
							}?>" alt="logo" class="img-responsive" style="border: 1px solid #000;height: 120px;width:90%;"/>
							</div>
							
						</div>
						<hr style="border-top: 1px solid #000">
						<div class="row">
							<div class="col-md-12 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>1. Name of Student :  </b> <?php echo strtoupper($fullname); ?></p>
							</div>
							<div class="col-md-12 text-left">	
								<p style="margin: 30px 0 15px; font-size: 15px"><b>2. Name of Father :  </b> <?php echo strtoupper($fname); ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>3. Name of Mother :  </b> <?php echo strtoupper($mname); ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>4. Name of Guardian : </b> <?php echo strtoupper($gname); ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>5.Sex  : </b> <?php if($gender=='m') echo 'Male';else echo 'Female';  ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b> Religion/Caste : </b> <?php echo $caste; ?></p>
							</div>
							
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>5. Occupation : </b> <?php echo $occupation; ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b> Email ID : </b> <?php echo $email; ?></p>
							</div>
							
							
							<div class="col-md-12 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>6. Home Address: </b> <?php echo $paddress; ?></p>
							</div>
							<div class="col-md-12 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>7. Local Address: </b> <?php  if(strcmp($laddress,$paddress)==0) echo 'Same as above.'; else echo $laddress; ?></p>
							</div>
							
							<div class="col-md-4 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>8. Date of Birth : </b> <?php echo $dob; ?></p>
							</div>
							<div class="col-md-8 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b> In words: </b> <?php echo $birth_day.' '.$monthName.','.$birth_year; ?></p>
							</div>
							
							<div class="col-md-12 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px">
									<b>9. The school he or she comes from </b> <?php echo $oldschool.','; ?>
									<b> </b> <?php echo $oldclass; ?> 
							</p>
							</div>
	
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>10. Phone No. : </b> <?php echo $tel; ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b> Mobile No : </b> <?php echo $mob; ?></p>
							</div>
							
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>11. Aadhar No. : </b> <?php echo $aadhar; ?></p>
							</div>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b> Transfer Certificate : </b><?php if($transfer=='on') echo 'YES'; else echo 'NO'; ?></p>
							</div>
							<div class="col-md-12 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>13. The class to which the pupil seek admission: </b> <?php echo $classadmit; ?></p>
							</div>
								
							<div class="col-md-12 text-center">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>I hereby solemnly declare taht the above statement are quite correct</b></p>
							</div>
							<br>
							<br>
							<br>
							
							<br>
							<div class="col-md-6 text-left">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>Date: </b> <?php echo $doa; ?></p>
							</div>
							<div class="col-md-6 text-right">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>Signature of Father / Guardian </b></p>
								
							</div>
							
							<div class="col-md-12 text-center">
								<p style="margin: 30px 0 15px; font-size: 15px"><b>The student has been examined and found fit to be admitted into  <?php echo $classadmit; ?> .</b></p>
							</div>
							
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-12">
							<div class="white-box">
								
							<div class="row">
								<div class="col-md-"></div>

								<div class="row container" style="justify-content:center;height:150px;">
									<div class="col-md-2" style="float:right">
										<img src="../assets/img/logo.png" alt="logo" style="height:25%;" class="logo-small" />
									</div>
									<div class="col-md-6" style="float:left;">
									<h1>SAI POOJA  J. HIGH SCHOOL</h1>
									<h4 style="font-size:15px; color:#03225C;margin-left:20%;">Narottampur, Varanasi</h4>
									</div>
								</div>
								<hr>
							
												
									<div class="col-md-12">
										<div class="table-responsive m-t-40">
											<table class="table table-hover">
												<thead>
													<tr>
														<th class="text-center">#</th>
														<th class="text-right">Fees Type</th>
														<th class="text-right">Frequency</th>
														<th class="text-right">Date</th>
														<th class="text-right">Invoice number</th>
														<th class="text-right">Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="text-center">1</td>
														<td class="text-right">Annual Fees</td>
														<td class="text-right">Yearly</td>
														<td class="text-right">2016-11-19</td>
														<td class="text-right">#IN-345609865</td>
														<td class="text-right">$100</td>
													</tr>
													<tr>
														<td class="text-center">2</td>
														<td class="text-right">Tuition Fees</td>
														<td class="text-right">Monthly</td>
														<td class="text-right">2016-11-19</td>
														<td class="text-right">#IN-345604565</td>
														<td class="text-right">$50</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-12">
										<div class="pull-right m-t-30 text-right">
											<p>Sub - Total amount: $150</p>
											<p>Discount : $10 </p>
											<p>Tax (10%) : $14 </p>
											<hr>
											<h3><b>Total :</b> $164</h3>
										</div>
										<div class="clearfix"></div>
										<hr>
										
									</div>
								</div>
							</div>
							
							
						</div>
					</div> -->
				</div>
			</div>
			<!-- end page content -->
<?php }?>
				<?php include 'footer.html';?>
