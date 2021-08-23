<?php
ob_start();
require 'db.php'; 

?>


<?php 

$first_name="";
$last_name="";
$father_name="";
$mother_name="";
$dob="";
$caste_name="";
$father_occupation="";
$class_id="";
$eclass_id="";
$address="";
$area="";
$city="";
$state="";
$mobile_number1="";
$mobile_number2=""; 
$nationality="";
$pin="";
$livinginup="";
$mother_tongue="";
$gender="";
$email="";
$fy_id="";
$efy_id="";
$Err ="";




		if(isset($_POST['add-teacher'])){
			
					$first_name = $mysqli->real_escape_string($_POST['firstname']); 
					$last_name = $mysqli->real_escape_string($_POST['surname']);		
					$father_name = $mysqli->real_escape_string($_POST['fathername']); 
					$gender = $mysqli->real_escape_string($_POST['gender']);
					$dob = $mysqli->real_escape_string($_POST['dob']);					
					$occupation = $mysqli->real_escape_string($_POST['foccupation']); 
					$subject_Expert = $mysqli->real_escape_string($_POST['subjectExp']);
					$doj = $mysqli->real_escape_string($_POST['DOJ']);
					$address = $mysqli->real_escape_string($_POST['paddress']); 
					$area = $mysqli->real_escape_string($_POST['parea']); 
					$pin = $mysqli->real_escape_string($_POST['ppincode']);
					$city = $mysqli->real_escape_string($_POST['pcity']); 
					$state = $mysqli->real_escape_string($_POST['pstate']); 
					$is_Temp_Address_Same = $mysqli->real_escape_string($_POST['addresscheck']);
					$living_in_UP = $mysqli->real_escape_string($_POST['livinginup']);
					$nationality = $mysqli->real_escape_string($_POST['nation']); 
					$mobile_number1 = $mysqli->real_escape_string($_POST['mob1']); 
					$mobile_number2 = $mysqli->real_escape_string($_POST['mob2']); 
					$email = $mysqli->real_escape_string($_POST['email']); 
					$fy_id = $mysqli->real_escape_string($_POST['fy_id']); 
					
					if(empty($first_name))
					{
						$Err = "Please enter first name";
					}
					else if(empty($last_name))
					{
						$Err = "Please enter surname";
					}
					else if(empty($father_name))
					{
						$Err = "Please enter father name";
					}
					else if(empty($gender))
					{
						$Err = "Please select gender";
					}
					else if (empty($dob))
					{
						$Err = "Please select DOB";						
					}
					else if (empty($qualification))
					{
						$Err = "Please enter qualification";
					}
					else if(empty($subject_Expert))
					{
						$Err = "Please enter subject expertise";
					}
					else if(empty($doj))
					{
						$Err = "Please enter DOJ";
					}
					else if(empty($address))
					{
						$Err = "Please enter Address";
					}
					else if(empty($area))
					{
						$Err = "Please enter area";
					}
					else if(empty($pin))
					{
						$Err = "Please enter pincode";
					}
					else if(empty($city))
					{
						$Err = "Please enter city";
					}
					else if(empty($state))
					{
						$Err = "Please enter state";
					}
					else if(empty($living_in_UP))
					{
						$Err = "Please enter living in UP from";
					}
					else if(empty($mobile_number1))
					{
						$Err = "Please enter mobile number";
					}
					else if(empty($email))
					{
						$Err = "Please enter emial id";
					}
					else
					{
					$path="";
					$path1="";
	
					$ftp_server = "182.50.135.99";
					$ftp_username = "fourlance";
					$ftp_userpass = "21July2017";
					$file_name = $_FILES['teacher-image']['name'];
					$file_type=$_FILES['teacher-image']['type'];
					$file_ext=strtolower(end(explode('.',$_FILES['teacher-image']['name'])));
					$source = $_FILES['teacher-image']['tmp_name'];
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
					
			
		
		$stmt = $mysqli->prepare("INSERT INTO stud_regist_master(first_name,class_id,fy_id,last_name,father_name,mother_name,dob,caste_name,father_occupation,address,area,city,state,mobile_number1,mobile_number2,nationality,livinginup,mother_tongue,gender,email,stud_image,pin) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssssssssssssssssd",$first_name,$class_id,$fy_id,$last_name,$father_name,$mother_name,$dob,$caste_name,$father_occupation,$address,$area,$city,$state,$mobile_number1,$mobile_number2,$nationality,$livinginup,$mother_tongue,$gender,$email,$path,$pin);
		 if (!$stmt->execute()) { 
        trigger_error('Error executing MySQL query: ' . $stmt->error);
		}
		$stmt->close();
		//$mysqli->close();
		
					}
		
						}							
					
					?>
					
			<?php
			
			if(isset($_POST['update-student'])){
				$first_name = $mysqli->real_escape_string($_POST['firstname']); 
					$last_name = $mysqli->real_escape_string($_POST['surname']);		
					$father_name = $mysqli->real_escape_string($_POST['fathername']); 
					$mother_name = $mysqli->real_escape_string($_POST['mothername']); 
					$dob = $mysqli->real_escape_string($_POST['dob']); 
					$caste_name = $mysqli->real_escape_string($_POST['castename']); 
					$father_occupation = $mysqli->real_escape_string($_POST['foccupation']); 
					$class_id = $mysqli->real_escape_string($_POST['class_id']); 
					$address = $mysqli->real_escape_string($_POST['paddress']); 
					$area = $mysqli->real_escape_string($_POST['parea']); 
					$city = $mysqli->real_escape_string($_POST['pcity']); 
					$state = $mysqli->real_escape_string($_POST['pstate']); 
					$mobile_number1 = $mysqli->real_escape_string($_POST['mob1']); 
					$mobile_number2 = $mysqli->real_escape_string($_POST['mob2']); 
					$nationality = $mysqli->real_escape_string($_POST['nation']); 
					$pin = $mysqli->real_escape_string($_POST['ppincode']); 
					$livinginup = $mysqli->real_escape_string($_POST['ppincode']); 
					$mother_tongue = $mysqli->real_escape_string($_POST['mtongue']); 
					$gender = $mysqli->real_escape_string($_POST['gender']); 
					$email = $mysqli->real_escape_string($_POST['email']); 
					$fy_id = $mysqli->real_escape_string($_POST['fy_id']); 
					
					
					$path="";
					$path1="";
					if(!empty($_FILES['stud-image']['name']))
						{
							
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
				$stmt = $mysqli->prepare("update stud_regist_master set first_name=?,class_id=?,fy_id=?,last_name=?,father_name=?,mother_name=?,dob=?,caste_name=?,father_occupation=?,address=?,area=?,city=?,state=?,mobile_number1=?,mobile_number2=?,nationality=?,livinginup=?,mother_tongue=?,gender=?,email=?,stud_image=?,pin=? where registration_id=?");
				$stmt->bind_param("sssssssssssssssssssssdd",$first_name,$class_id,$fy_id,$last_name,$father_name,$mother_name,$dob,$caste_name,$father_occupation,$address,$area,$city,$state,$mobile_number1,$mobile_number2,$nationality,$livinginup,$mother_tongue,$gender,$email,$path,$pin,$reg);
				if (!$stmt->execute()) { 
					trigger_error('Error executing MySQL query: ' . $stmt->error);
									}
				$stmt->close();
			}
		
			?>		
					
					
					
					
					
					
	<?php 
				
		if(isset($_GET['edit']))
					{
						$reg=$_GET['edit'];
							$stmt = $mysqli->prepare("SELECT first_name,last_name,father_name,mother_name,dob,caste_name,father_occupation,a.class_id,address,area,city,state,mobile_number1,mobile_number2,nationality,pin,livinginup,mother_tongue,gender,email,fy_id FROM stud_regist_master a, class_master b where a.class_id=b.class_id and a.registration_id=$reg");
																//$pop=13;
																//$stmt->bind_param("d",$pop);
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($first_name,$last_name,$father_name,$mother_name,$dob,$caste_name,$father_occupation,$eclass_id,$address,$area,$city,$state,$mobile_number1,$mobile_number2,$nationality,$pin,$livinginup,$mother_tongue,$gender,$email,$efy_id);
																$count=$stmt->num_rows;
																$first_name=$count;
																$data = $stmt->fetch();
																//$first_name="pop".$gender;
																				
					}
									
	
				
				
				
				

	?>					

<?php require 'header.php';?>
<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Add Professor</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="#">Professor</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Add Professor</li>
							</ol>
						</div>
					</div>
					<div id="ErrorDiv" class="page-bar">
						<span style="color:red"><?php echo $Err;?></span>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Basic Information</header>
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
									<form action="" enctype="multipart/form-data" method="POST" id="form_sample_1" class="form-horizontal">
										<div class="form-body">
											<div class="form-group row">
												<label class="control-label col-md-2">First Name
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="firstname" placeholder="Enter First Name" class="form-control input-height" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST" ) echo $first_name;  ?>"/>
												</div>
												<label class="control-label col-md-2">SurName
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="surname" placeholder="Enter Surname" class="form-control input-height" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $last_name;  ?>" />
												</div>
											</div>
											
											
											<div class="form-group row">
												<label class="control-label col-md-2">Father Name
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="fathername" placeholder="Enter Father Name" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $father_name;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">Gender
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
												<select class="form-control input-height" name="gender">
													<option value="0">Select...</option>
													<option <?php if($gender=='m') echo 'selected = "selected"'; ?> value="m">Male</option>
													<option <?php if($gender=='f') echo 'selected = "selected"'; ?> value="f">Female</option>
												</select>
												</div>
											</div>
											
											
											<div class="form-group row">
												
												<label class="control-label col-md-2">Date Of Birth
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-group date form_date " data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2"
													 data-link-format="yyyy-mm-dd">
														<input class="form-control input-height" size="12" placeholder="Date of Birth" type="text" name="dob" value="<?php if(isset($_GET['edit'])|| $_SERVER["REQUEST_METHOD"] == "POST") echo $dob;  ?>">
														<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
													</div>
													<input type="hidden" id="dtp_input2" value="" />
												</div>
												
												<label class="control-label col-md-2">Qualification
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="qualification"  value="<?php if(isset($_GET['edit'])|| $_SERVER["REQUEST_METHOD"] == "POST") echo $father_occupation;  ?>"    placeholder="Enter Education Qualification" class="form-control input-height" />
												</div>
											
											</div>
											
											<div class="form-group row">
												
												<label class="control-label col-md-2">Subject Expertise
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="subjectExp" placeholder="Enter Subject Expertise" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $mother_tongue;  ?>" class="form-control input-height" />
												</div>
												
												<label class="control-label col-md-2">Date Of Joining
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-group date form_date " data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2"
													 data-link-format="yyyy-mm-dd">
														<input class="form-control input-height" size="12" placeholder="Date of Joining" type="text" name="DOJ" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $dob;  ?>">
														<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
													</div>
													<input type="hidden" id="dtp_input2" value="" />
												</div>
											</div>
											
												
											<div class="form-group row">
											
														<label class="control-label col-md-2">
														<span class="input-group-addon">
															<i class="fa fa-address-card"></i>
														</span>Address
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
												
													<textarea name="paddress" placeholder="Enter Address" class="form-control-textarea" rows="3" ><?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $address;  ?></textarea>
												</div>
												<label class="control-label col-md-2">Area
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="parea" placeholder="enter area" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $area;  ?>" class="form-control input-height" />
												</div>
											</div>
											
											
											
											
											
											<div class="form-group row">
												<label class="control-label col-md-2">Pincode/City
													<span class="required"> * </span>
												</label>
												<div class="col-md-2">
													<input type="text" name="ppincode" placeholder="Enter Pincode" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $pin;  ?>" class="form-control input-height" />
												</div>
												<div class="col-md-2">
													<input type="text" name="pcity" placeholder="Enter city"  value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $city;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">State 
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
												<input type="text" name="pstate" placeholder="Enter State" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $state;  ?>" class="form-control input-height" />
												</div>
											</div>
												
									
											<div class="form-group row">
												
												<label class="control-label col-md-7"><input type="checkbox" name="addresscheck" value=	""  class="form-control input-height" />
												Temporary Address same as Permament Address</label>
											</div>
											
											
											<div class="form-group row">
												<label class="control-label col-md-2">Living in UP from
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="livinginup" placeholder="" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $livinginup;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">Nationality
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input type="text" name="nation" placeholder="enter Nationality" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $nationality;  ?>"  class="form-control input-height" />
												</div>
											</div>
											
											
											<div class="form-group row">
												<label class="control-label col-md-2">Mobile Number 1
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-phone"></i>
														</span>
														<input type="text" name="mob1" placeholder="enter mobile number1" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $mobile_number1;  ?>" class="form-control input-height" />
													</div>														
												</div>
												<label class="control-label col-md-2">Mobile Number 2
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-phone"></i>
														</span>
														<input type="text" name="mob2" placeholder="enter mobile number2" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $mobile_number2;  ?>" class="form-control input-height" />
													</div>														
												</div>
												
											</div>
											
								
											<div class="form-group row">
												<label class="control-label col-md-2">Email ID
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
												<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
													<input type="text" name="email" placeholder="enter emailid" value="<?php if(isset($_GET['edit']) || $_SERVER["REQUEST_METHOD"] == "POST") echo $email;  ?>" class="form-control input-height" />
												</div>
												</div>
												
												<label class="control-label col-md-2">Professor Picture
													<span class="required"> * </span>
												</label>
												<div class="col-md-4">
													<input name="teacher-image" type="file" class="default" accept=".png,.jpg">
												</div>
												
												
												
											</div>
											

											<div class="form-actions">
												<div class="row">
													<div class="offset-md-3 col-md-9">
														<?php 
														if(isset($_GET['edit']))
															{?>
																<button type="submit" name="update-student" class="btn btn-info m-r-20">Update</button>
															<?php }
															else{ 
														?><button type="submit" name="add-teacher" class="btn btn-info m-r-20">Submit</button>
															<?php }?>
														<button type="button" class="btn btn-default">Cancel</button>
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