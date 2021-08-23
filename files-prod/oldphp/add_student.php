<?php
ob_start();
require 'db.php'; 
session_start();
$fy_id=$_SESSION["fy_id"];
?>


<?php 

$logdate="";
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
$curr_class="";
$transfer="";







	if(isset($_POST['add-student']))
	{
			
		$fullname = $mysqli->real_escape_string($_POST['fullname']);
		$fname = $mysqli->real_escape_string($_POST['fname']);
		$mname = $mysqli->real_escape_string($_POST['mname']);
		$gname = $mysqli->real_escape_string($_POST['gname']);
		$gender = $mysqli->real_escape_string($_POST['gender']);
		$dob = $mysqli->real_escape_string($_POST['dob']);
		$livingup = $mysqli->real_escape_string($_POST['livingup']);
		$regno = $mysqli->real_escape_string($_POST['regno']);
		$tel = $mysqli->real_escape_string($_POST['tel']);
		$mob = $mysqli->real_escape_string($_POST['mob']);
		$laddress = $mysqli->real_escape_string($_POST['laddress']);
		$paddress = $mysqli->real_escape_string($_POST['paddress']);
		$oldschool = $mysqli->real_escape_string($_POST['oldschool']);
		$oldclass = $mysqli->real_escape_string($_POST['oldclass']);
		$aadhar = $mysqli->real_escape_string($_POST['aadhar']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$doa = $mysqli->real_escape_string($_POST['doa']);
		$classadmit = $mysqli->real_escape_string($_POST['classadmit']);
		$scholar = $mysqli->real_escape_string($_POST['scholar']);
		$caste = $mysqli->real_escape_string($_POST['caste']);
		$occupation = $mysqli->real_escape_string($_POST['occupation']);
		$curr_class = $mysqli->real_escape_string($_POST['currclass']);
		$transfer = $mysqli->real_escape_string($_POST['transfer']);
		$logdate=date('Y-m-d H:i:s');
		$fy_id=$_SESSION["fy_id"];
		$path="";
					
	
			$ftp_server = "182.50.135.99";
			$ftp_username = "fourlance";
			$ftp_userpass = "21July2017";
			$file_name = $_FILES['stud-image']['name'];
			$file_type=$_FILES['stud-image']['type'];
			$file_ext=strtolower(end(explode('.',$_FILES['stud-image']['name'])));
			$source = $_FILES['stud-image']['tmp_name'];
			
			$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
			$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
			$filename1 = "stud".date('m-d-Y_H-i-s').".".$file_ext;
			$path = "saipooja.fourlance.in/saipooja/files/uploads/".$filename1;
			$expensions= array("jpg","png","jpeg");
			if(in_array($file_ext,$expensions)=== false){
				$errors[]="extension not allowed, please choose a (jpeg,jpg,png) file.";
			}
			if(empty($errors)==true)
			{	
				$done = ftp_put($ftp_conn, $path, $source, FTP_BINARY);
				// close connection
				ftp_close($ftp_conn);
			}
			if(!empty($_FILES['stud-image']['name']))
			$path = "uploads/".$filename1; 
		else
			$path = "imagenotavailable"; 
			
		
		$stmt = $mysqli->prepare("insert into stud_regist_master (scholar_no,first_name,father_name,mother_name,dob,caste_name,father_occupation,address,regno,telephone,mobile_number,taddress,livinginup,stud_image,log_datetime,dateofadmiss,gender,email,admitclass,gname,oldschool,oldclass,aadhar,transfer) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
		$stmt->bind_param("ssssssssssssssssssdsssss",$scholar,$fullname,$fname,$mname,$dob,$caste,$occupation,$paddress,$regno,$tel,$mob,$laddress,$livingup,$path,$logdate,$doa,$gender,$email,$classadmit,$gname,$oldschool,$oldclass,$aadhar,$transfer);
		 
		 
		if (!$stmt->execute()) { 
			trigger_error('Error executing MySQL query: ' . $stmt->error);
		}
		else{
		
			$student_id=$mysqli->insert_id;
			
			$stmt = $mysqli->prepare("insert into class_stud_master(class_id,student_id,fy_id) values (?,?,?)");
			$stmt->bind_param("ddd",$curr_class,$student_id,$fy_id);
			if (!$stmt->execute()) { 
						trigger_error('Error executing MySQL query: ' . $stmt->error);
			}
			else
			{
				$cs_id=$mysqli->insert_id;
				$stmt = $mysqli->prepare("select fy_name from fy_master where fy_id=?");
				$stmt->bind_param("d",$fy_id);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($fy_name);
				$count=$stmt->num_rows;
				//if($count>0) echo "<script type='text/javascript'>alert('$fy_id');</script>";
				while($data = $stmt->fetch()) 
				{
				$year=$fy_name;	
				}
																
				$status=0;
				$year=substr($fy_name,2,2);
				$dates=$month[0].'-'.$year;
				$stmt = $mysqli->prepare("insert into stud_fee_master(cs_id,month_id,status) values (?,?,?)");
				for($i=1;$i<=12;$i++){
				$stmt->bind_param("ddd",$cs_id,$i,$status);
				$stmt->execute();
				}
				
				header('Location:all_student.php');
				
				
					
			}		
		}
		
		
		
		
						
					
	}
		
					
					?>
					
			<?php
			
			if(isset($_POST['update-student'])){
				$fullname = $mysqli->real_escape_string($_POST['fullname']);
		$fname = $mysqli->real_escape_string($_POST['fname']);
		$mname = $mysqli->real_escape_string($_POST['mname']);
		$gname = $mysqli->real_escape_string($_POST['gname']);
		$gender = $mysqli->real_escape_string($_POST['gender']);
		$dob = $mysqli->real_escape_string($_POST['dob']);
		$livingup = $mysqli->real_escape_string($_POST['livingup']);
		$regno = $mysqli->real_escape_string($_POST['regno']);
		$tel = $mysqli->real_escape_string($_POST['tel']);
		$mob = $mysqli->real_escape_string($_POST['mob']);
		$laddress = $mysqli->real_escape_string($_POST['laddress']);
		$paddress = $mysqli->real_escape_string($_POST['paddress']);
		$oldschool = $mysqli->real_escape_string($_POST['oldschool']);
		$oldclass = $mysqli->real_escape_string($_POST['oldclass']);
		$aadhar = $mysqli->real_escape_string($_POST['aadhar']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$doa = $mysqli->real_escape_string($_POST['doa']);
		$classadmit = $mysqli->real_escape_string($_POST['classadmit']);
		$scholar = $mysqli->real_escape_string($_POST['scholar']);
		$caste = $mysqli->real_escape_string($_POST['caste']);
		$occupation = $mysqli->real_escape_string($_POST['occupation']);
		$curr_class = $mysqli->real_escape_string($_POST['currclass']);
		$transfer = $mysqli->real_escape_string($_POST['transfer']);
		$logdate=date('Y-m-d H:i:s');
		$fy_id=$_SESSION["fy_id"];
					
					$flag=0;
					$path="";
			
					if(!empty($_FILES['stud-image']['name']))
						{
							$flag=1;
							$ftp_server = "182.50.135.99";
								$ftp_username = "fourlance";
								$ftp_userpass = "21July2017";
								$file_name = $_FILES['stud-image']['name'];
								$file_type=$_FILES['stud-image']['type'];
								$file_ext=strtolower(end(explode('.',$_FILES['stud-image']['name'])));
								$source = $_FILES['stud-image']['tmp_name'];
								$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
								$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
								$filename1 = "stud".date('m-d-Y_H-i-s').".".$file_ext;
								$path = "saipooja.fourlance.in/saipooja/files/uploads/".$filename1;
								$expensions= array("jpg","png","jpeg");
								if(in_array($file_ext,$expensions)=== false){
									$errors[]="extension not allowed, please choose a (jpeg,jpg,png) file.";
								}
								if(empty($errors)==true)
								{	
									$done = ftp_put($ftp_conn, $path, $source, FTP_BINARY);
									// close connection
									ftp_close($ftp_conn);
								}
								$path = "uploads/".$filename1; 
								
								
						}
					
					
				$reg=$_GET['edit'];
				if($flag==1){
				$stmt = $mysqli->prepare("update stud_regist_master set  scholar_no=?,first_name=?,father_name=?,mother_name=?,dob=?,caste_name=?,father_occupation=?,address=?,regno=?,telephone=?,mobile_number=?,taddress=?,livinginup=?,stud_image=?,dateofadmiss=?,gender=?,email=?,admitclass=?,gname=?,oldschool=?,oldclass=?,aadhar=?,transfer=? where registration_id=?");
				$stmt->bind_param("sssssssssssssssssdsssssd",$scholar,$fullname,$fname,$mname,$dob,$caste,$occupation,$paddress,$regno,$tel,$mob,$laddress,$livingup,$path,$doa,$gender,$email,$classadmit,$gname,$oldschool,$oldclass,$aadhar,$transfer,$reg);
				}
				else
				{
					$stmt = $mysqli->prepare("update stud_regist_master set  scholar_no=?,first_name=?,father_name=?,mother_name=?,dob=?,caste_name=?,father_occupation=?,address=?,regno=?,telephone=?,mobile_number=?,taddress=?,livinginup=?,dateofadmiss=?,gender=?,email=?,admitclass=?,gname=?,oldschool=?,oldclass=?,aadhar=?,transfer=? where registration_id=?");
					$stmt->bind_param("ssssssssssssssssdsssssd",$scholar,$fullname,$fname,$mname,$dob,$caste,$occupation,$paddress,$regno,$tel,$mob,$laddress,$livingup,$doa,$gender,$email,$classadmit,$gname,$oldschool,$oldclass,$aadhar,$transfer,$reg);
					
				}
				
				if (!$stmt->execute()) { 
					trigger_error('Error executing MySQL query: ' . $stmt->error);
									}
									else{
					$stmt = $mysqli->prepare("update class_stud_master set class_id=? where fy_id=? and student_id=?");
					$stmt->bind_param("ddd",$curr_class,$_SESSION["fy_id"],$reg);
					$stmt->execute();
				$stmt->close();
				header('Location:all_student.php');					
				}
			}
			
			
			?>		
					
					
					
					
					
					
	<?php 
		if(isset($_POST['cancel'])){
			header('Location:all_student.php');		
		}		
		if(isset($_GET['edit']))
					{
						$reg=$_GET['edit'];
							$stmt = $mysqli->prepare("SELECT scholar_no,first_name,father_name,mother_name,dob,caste_name,father_occupation,address,regno,telephone,mobile_number,taddress,livinginup,log_datetime,dateofadmiss,gender,email,gname,oldschool,oldclass,aadhar,a.admitclass,b.class_id,transfer FROM stud_regist_master a,class_stud_master b where a.registration_id=b.student_id and a.registration_id=? and b.fy_id=?");
																$stmt->bind_param("dd",$reg,$_SESSION["fy_id"]);
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($scholar,$fullname,$fname,$mname,$dob,$caste,$occupation,$paddress,$regno,$tel,$mob,$laddress,$livingup,$logdate,$doa,$gender,$email,$gname,$oldschool,$oldclass,$aadhar,$classadmit,$curr_class,$transfer);
																//$count=$stmt->num_rows;
																$data = $stmt->fetch();
																
																				
					}
									
	
				
				
				
				

	?>					

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
									<header>Add Student</header>
								
									
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
	function localcheck()
	{
		var checkBox = document.getElementById("localchk");
		if (checkBox.checked == true){
			document.getElementById("paddress").value = document.getElementById("laddress").value;
			document.getElementById('paddress').readOnly = true;
		} else {
		document.getElementById('paddress').readOnly = false;
	}
	}
	
	function localcopy()
	{
		var checkBox = document.getElementById("localchk");
		if (checkBox.checked == true){
			document.getElementById("paddress").value = document.getElementById("laddress").value;
		}
		
	}
	
	</script>	
	
    