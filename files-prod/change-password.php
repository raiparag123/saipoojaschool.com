<?php
ob_start();
require 'db.php'; 
session_start();
$fy_id=$_SESSION["fy_id"];
?>


\			

<?php require 'header.php';?>
<!-- start page content -->
<link href="../assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!--select2-->
    <link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	
	
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
								<header>Change Password</header>
								</div>

								<div class="container">
	<div class="row">
		<div class="col-sm-4">
		    
		    <label>Current Password</label>
		    <div class="form-group pass_show"> 
                <input type="password" value="faisalkhan@123" class="form-control" placeholder="Current Password"> 
            </div> 
		       <label>New Password</label>
            <div class="form-group pass_show"> 
                <input type="password" value="faisal.khan@123" class="form-control" placeholder="New Password"> 
            </div> 
		       <label>Confirm Password</label>
            <div class="form-group pass_show"> 
                <input type="password" value="faisal.khan@123" class="form-control" placeholder="Confirm Password"> 
            </div> 
            
		</div>  
	</div>
</div>

								<div class="card-body" id="bar-parent">
									<form action="" enctype="multipart/form-data" method="POST"  class="form-horizontal">
										<div class="form-body">
											<div class="form-group row">
												<label class="control-label col-md-2">Full Name
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="fullname" placeholder="enter full name" class="form-control input-height" value="<?php if(isset($_GET['edit'])) echo $fullname;  ?>"/>
												</div>
												<label class="control-label col-md-2">Father Name
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="fname" placeholder="enter father name" class="form-control input-height" value="<?php if(isset($_GET['edit'])) echo $fname;  ?>" />
												</div>
											</div>
											
											
											<div class="form-group row">
												<label class="control-label col-md-2">Mother Name
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="mname" placeholder="enter mother name" value="<?php if(isset($_GET['edit'])) echo $mname;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">Guardian Name
													<span class="required">  </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="gname" placeholder="enter guardian name" value="<?php if(isset($_GET['edit'])) echo $gname;  ?>" class="form-control input-height" />
												</div>
											</div>
											
											
											<div class="form-group row">
											<label class="control-label col-md-2">Gender
													<span class="required"> * </span>
												</label>
											<div class="col-md-4">
											
													<div class="radio radio">
														<input id="male" value="m" name="gender" <?php if($gender=='m') echo 'checked'; ?> type="radio">
														<label for="male">
															Male
														</label>
													</div>
													<div class="radio radio-yellow">
														<input id="female" value="f" name="gender" <?php if($gender=='f') echo 'checked'; ?> type="radio">
														<label for="female">
															Female
														</label>
													</div>
											</div>
												
												
												<label class="control-label col-md-2">Date Of Birth
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-append date form_date" data-date-format="dd-mm-yyyy"
														data-date="2013-02-21T15:25:00Z">
														<input class="input-height" size="20" type="text" value="<?php if(isset($_GET['edit'])) echo $dob;?>" readonly name="dob">
														<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
														<span class="add-on"><i class="fa fa-calendar"></i></span>
													</div>
													
													
													
												</div>
											
											</div>
											
											<div class="form-group row">
												<label class="control-label col-md-2">Living in UP from
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="livingup" placeholder="living in years" value="<?php if(isset($_GET['edit'])) echo $livingup;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">Occupation
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text"  name="occupation" placeholder="enter occupation" value="<?php if(isset($_GET['edit'])) echo $occupation;  ?>"  class="form-control input-height" />
												</div>
											</div>

												<div class="form-group row">
												<label class="control-label col-md-2">Religion/Caste
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="caste" placeholder="Enter Religion/Caste" value="<?php if(isset($_GET['edit'])) echo $caste;  ?>" class="form-control input-height" />
												</div>
												
												
												<label class="control-label col-md-2">Email ID
												</label>
												<div class="col-md-4">
														<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-envelope"></i>
																</span>
															<input type="email" name="email" placeholder="enter emailid" value="<?php if(isset($_GET['edit'])) echo $email;  ?>" class="form-control input-height" />
														</div>
													</div>
												
											</div>
											
											
								 			<div class="form-group row">
												<label class="control-label col-md-2">Telephone
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-phone"></i>
														</span>
														<input type="text" name="tel" placeholder="enter telephone number" value="<?php if(isset($_GET['edit'])) echo $tel;  ?>" class="form-control input-height" />
													</div>														
												</div>
												<label class="control-label col-md-2">Mobile Number
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-phone"></i>
														</span>
														<input type="text" name="mob" placeholder="enter mobile number2" value="<?php if(isset($_GET['edit'])) echo $mob;  ?>" class="form-control input-height" />
													</div>														
												</div>
												
											</div>
											
											
											
											<div class="form-group row">
											
												<label class="control-label col-md-2">
														<span class="input-group-addon">
															<i class="fa fa-address-card"></i>
														</span>Local Address
														<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<textarea onkeyup="localcopy()" style="resize: none;" name="laddress" id="laddress" placeholder="Enter local address" class="form-control-textarea" rows="3" ><?php if(isset($_GET['edit'])) echo $laddress;  ?></textarea>
												</div>
												<label class="control-label col-md-2">
														<span class="input-group-addon">
															<i class="fa fa-address-card"></i>
														</span>Permament Address
														
												</label>
												<div class="col-md-4">
													<textarea readonly style="resize: none;" id="paddress" name="paddress" placeholder="Enter permanent address" class="form-control-textarea" rows="3" ><?php if(isset($_GET['edit'])) echo $paddress;  ?></textarea>
												</div>
											</div>
											
											<div class="form-group row">
                                                    <label class="control-label col-md-7" >
                                                     <input checked onclick="localcheck()" id="localchk" type="checkbox">Local Address same as Permament Address
                                                    </label>
											</div>
											
											<div class="form-group row">
												<label class="control-label col-md-2">Old School Name
												</label>
												<div class="col-md-4">
													<input type="text" name="oldschool" placeholder="old school details" value="<?php if(isset($_GET['edit'])) echo $oldschool;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">Class in old school
													
												</label>
												<div class="col-md-4">
													<input type="text" name="oldclass" placeholder="old school class" value="<?php if(isset($_GET['edit'])) echo $oldclass;  ?>"  class="form-control input-height" />
												</div>
											</div>
											
											<div class="form-group row">
											
												<label class="control-label col-md-2">Aadhar Number
													<span class="required"> * </span></label>
												<div class="col-md-4">
														<input type="text" name="aadhar" placeholder="Enter aadhar number" value="<?php if(isset($_GET['edit'])) echo $aadhar;  ?>" class="form-control input-height" />
												</div>
												
												<label class="control-label col-md-2">Registration ID
												</label>
												<div class="col-md-4">
														<div class="input-group">
															
															<input type="text" name="regno" placeholder="enter reg.no." value="<?php if(isset($_GET['edit'])) echo $regno;  ?>" class="form-control input-height" />
														</div>
													</div>
											</div>	
											
											<div class="form-group row">
												<label class="control-label col-md-2">Date of Admission
														<span class="required"> * </span>
												</label>
													<div class="col-md-4">
														<div class="input-append date form_date" data-date-format="dd-mm-yyyy"
															data-date="2013-02-21T15:25:00Z">
															<input class="input-height" size="20" type="text" value="<?php if(isset($_GET['edit'])) echo $doa;  ?>" readonly name="doa">
															<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
															<span class="add-on"><i class="fa fa-calendar"></i></span>
														</div>
													</div>
													
													<label class="control-label col-md-2">Class of Admission
													<span class="required"> * </span>
													</label>
													<div class="col-md-4">
													<select name="classadmit" class="form-control  input-height select2">
													<option value="" selected>Select Class</option>
													<?php
																	$stmt = $mysqli->prepare("select class_id,medium,class_name from class_master order by medium");
																	$result = $stmt->execute();
																	$stmt->store_result();
																	$stmt->bind_result($class_id,$medium,$class_name);
																	$count=$stmt->num_rows;
																	while($data = $stmt->fetch()) 
																	{
														?>
													
															<option value="<?php echo $class_id; ?>" <?php if($class_id==$classadmit) echo 'selected = "selected"';  ?> ><?php echo $class_name." : ".$medium; ?></option>
															<?php } ?>
													</select>
													
													</div>
												
												
											</div>
											
											
											
											
										
											
											
										
											<div class="form-group row">
												<label class="control-label col-md-2">Currently Studying
													<span class="required"> * </span>
													</label>
													<div class="col-md-4">
													<select name="currclass" class="form-control  input-height select2">
													<option value="" selected>Select Class</option>
													<?php
																	$stmt = $mysqli->prepare("select class_id,medium,class_name from class_master order by medium");
																	$result = $stmt->execute();
																	$stmt->store_result();
																	$stmt->bind_result($class_id,$medium,$class_name);
																	$count=$stmt->num_rows;
																	while($data = $stmt->fetch()) 
																	{
														?>
													
															<option value="<?php echo $class_id; ?>" <?php if($class_id==$curr_class) echo 'selected = "selected"';  ?> ><?php echo $class_name." : ".$medium; ?></option>
															<?php } ?>
													</select>
													
													</div>
													
												<label class="control-label col-md-2">Scholar No.
													<span class="required"> * </span></label>
												<div class="col-md-4">
														<input type="text" name="scholar" placeholder="Enter scholar number" value="<?php if(isset($_GET['edit'])) echo $scholar;  ?>" class="form-control input-height" />
												</div>
											</div>
											
											
											<div class="form-group row">
											
											<label class="control-label col-md-2">Student Picture
												</label>
												<!--<div class="compose-editor" class="control-label col-md-4">-->
												<div class="control-label col-md-4">
													<input name="stud-image" type="file" class="default" accept=".png,.jpg,.jpeg">
												</div>
												<label class="control-label col-md-2">Transfer Certificate</label>
												<div class="control-label col-md-4 text-left">
														<label class="switchToggle">
															<input type="checkbox" name="transfer" <?php if($transfer=='on') echo 'checked'; ?>>
															<span class="slider yellow round"></span>
														</label>
												</div>
										</div>
											
											
											
											

											<div class="form-actions">
												<div class="row text-center">
													<div class="col-md-12">
														<?php 
														if(isset($_GET['edit']))
															{?>
																<button type="submit" name="update-student" class="btn btn-info m-r-20">Update</button>
															<?php }
															else{ 
														?><button type="submit" name="add-student" class="btn btn-info m-r-20">Submit</button>
															<?php }?>
														<button type="submit" name="cancel" class="btn btn-default">Cancel</button>
													</div>
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
			<?php 
			$mysqli->close();
			?>
			
			<!--select2-->
    <script src="../assets/plugins/select2/js/select2.js"></script>
    <script src="../assets/js/pages/select2/select2-init.js"></script>
	<script>
	
	  
$(document).ready(function(){
$('.pass_show').append('<span class="ptxt">Show</span>');  
});
  

$(document).on('click','.pass_show .ptxt', function(){ 

$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

});  
	
	</script>	
	
    