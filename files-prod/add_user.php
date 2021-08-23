<?php
ob_start();
require 'db.php'; 

?>


<?php 





	if(isset($_POST['add-user']))
	{
			
					
					$username = $mysqli->real_escape_string($_POST['username']); 
					$emailid = $mysqli->real_escape_string($_POST['emailid']); 
					$passcode = $mysqli->real_escape_string($_POST['passcode']); 
					$cpasscode = $mysqli->real_escape_string($_POST['cpasscode']); 
					$rights = $mysqli->real_escape_string($_POST['rights']); 
					$user_image = $mysqli->real_escape_string($_POST['user-image']); 
					if(strcmp($passcode,$cpasscode) !=0)
					{
						echo "<script type='text/javascript'>alert('Password donot match');</script>";
						
					}elseif(empty($username) || empty($emailid) || empty($passcode) )
					{
						echo "<script type='text/javascript'>alert('Fill all fields');</script>";
						
					}
					else{
							
								$path="";
								$ftp_server = "182.50.135.99";
								$ftp_username = "fourlance";
								$ftp_userpass = "21July2017";
								$file_name = $_FILES['user-image']['name'];
								$file_type=$_FILES['user-image']['type'];
								$file_ext=strtolower(end(explode('.',$_FILES['user-image']['name'])));
								$source = $_FILES['user-image']['tmp_name'];
								$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
								$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
								$filename1 = "user".date('m-d-Y_H-i-s').".".$file_ext;
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
					
			
							$doc=date('Y-m-d H:i:s');
							$stmt = $mysqli->prepare("INSERT INTO user_master(username,email,passcode,doc,rights,user_image) values (?,?,?,?,?,?);");
							$stmt->bind_param("ssssss",$username,$emailid,$passcode,$doc,$rights,$path);
							
							
							if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
							}
							else{
									//$cs_id=$mysqli->insert_id;
									header('Location:all_users.php');
										
								}
							}			
	}
		
		
		
		
						
					
					
					
					
			
			if(isset($_POST['update-user'])){
				
				
				$username = $mysqli->real_escape_string($_POST['username']); 
				$user_id = $mysqli->real_escape_string($_POST['userid']); 
					$emailid = $mysqli->real_escape_string($_POST['emailid']); 
					$passcode = $mysqli->real_escape_string($_POST['passcode']); 
					$cpasscode = $mysqli->real_escape_string($_POST['cpasscode']); 
					$rights = $mysqli->real_escape_string($_POST['rights']); 
					$user_image = $mysqli->real_escape_string($_POST['user-image']); 
					if(strcmp($passcode,$cpasscode) !=0)
					{
						echo "<script type='text/javascript'>alert('Password donot match');</script>";
						
					}elseif(empty($username) || empty($emailid)  )
					{
						echo "<script type='text/javascript'>alert('Fill all fields');</script>";
						
					}
					else{
					
					$flag=0;
					$path="";
					
					if(!empty($_FILES['user-image']['name']))
						{
							$flag=1;
							
								$ftp_server = "182.50.135.99";
								$ftp_username = "fourlance";
								$ftp_userpass = "21July2017";
								$file_name = $_FILES['user-image']['name'];
								$file_type=$_FILES['user-image']['type'];
								$file_ext=strtolower(end(explode('.',$_FILES['user-image']['name'])));
								$source = $_FILES['user-image']['tmp_name'];
								$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
								$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
								$filename1 = "user".date('m-d-Y_H-i-s').".".$file_ext;
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
					

					
					
					
				
				if($flag==1){
				if(empty($passcode)){
						$stmt = $mysqli->prepare("update user_master set username=?,email=?,rights=?,user_image=? where user_id=? ");
						$stmt->bind_param("ssssd",$username,$emailid,$rights,$path,$user_id);
						}else{
						$stmt = $mysqli->prepare("update user_master set username=?,email=?,rights=?,passcode=?,user_image=? where user_id=? ");
						$stmt->bind_param("sssssd",$username,$emailid,$rights,$passcode,$path,$user_id);
						
						}							
				}
				else
				{
					if(empty($passcode)){
					$stmt = $mysqli->prepare("update user_master set username=?,email=?,rights=? where user_id=? ");
					$stmt->bind_param("sssd",$username,$emailid,$rights,$user_id);
						}else{
							$stmt = $mysqli->prepare("update user_master set username=?,email=?,rights=?,passcode=? where user_id=? ");
							$stmt->bind_param("ssssd",$username,$emailid,$rights,$passcode,$user_id);
						}
				}
				
				if (!$stmt->execute()) { 
					trigger_error('Error executing MySQL query: ' . $stmt->error);
									}
									else{
				$stmt->close();
				header('Location:all_users.php');					
				}
			}
			
			}	
			?>		
					
					
					
					
					
					
	<?php 
				
		if(isset($_GET['edit']))
					{
						$user_id=$_GET['edit'];
							$stmt = $mysqli->prepare("select user_id,username,email,rights,user_image from user_master where user_id=?");
							$stmt->bind_param("d",$user_id);
							$result = $stmt->execute();
							$stmt->store_result();
							$stmt->bind_result($user_id,$username,$email,$rights,$user_image);
							$count=$stmt->num_rows;
							if($count==0)
							header('Location:all_users.php');		
							$first_name=$count;
							$data = $stmt->fetch();
							
							
					}
									
	
				
				
				
				

	?>					

<?php require 'header.php';?>
<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Add User</header>
								
									
								</div>
								<div class="card-body" id="bar-parent">
									<form action="" enctype="multipart/form-data" method="POST"  class="form-horizontal">
										<div class="form-body">
											<div class="form-group row">
												<label class="control-label col-md-2">UserName
												
												</label>
												<div class="col-md-4">
													<input type="text" name="username" placeholder="enter username" class="form-control input-height" value="<?php if(isset($_GET['edit'])) echo $username;  ?>"/>
												</div>
												<label class="control-label col-md-2">Email ID
										
												</label>
												<div class="col-md-4">
													<input type="email" name="emailid" placeholder="enter email id" class="form-control input-height" value="<?php if(isset($_GET['edit'])) echo $email;  ?>" />
												</div>
											</div>
											
											
											<div class="form-group row">
												<label class="control-label col-md-2">Enter Password
													
												</label>
												<div class="col-md-4">
													<input type="password" name="passcode" placeholder="enter password" value="<?php //if(isset($_GET['edit'])) echo $father_name;  ?>" class="form-control input-height" />
												</div>
												<label class="control-label col-md-2">Confirm Password
													
												</label>
												<div class="col-md-4">
													<input type="password" name="cpasscode" placeholder="confirm password" value="<?php //if(isset($_GET['edit'])) echo $mother_name;  ?>" class="form-control input-height" />
												</div>
											</div>
											
											
											<div class="form-group row">
											<label class="control-label col-md-2">User Type
													
												</label>
											<div class="col-md-4">
													<select class="form-control input-height" name="rights">
														<option <?php if($rights=='u') echo 'selected = "selected"'; ?>  value="u">User</option>
														<option <?php if($rights=='a') echo 'selected = "selected"'; ?> value="a">Admin</option>
														
												</select>
											</div>											
												<label class="control-label col-md-2">User Image
													<input type="hidden" name="userid" value="<?php if(isset($_GET['edit'])) echo $user_id;  ?>">
												</label>
												<div class="col-md-4">
														<input name="user-image" type="file" class="default" accept=".png,.jpg">
												</div>

											</div>
											<div class="form-actions">
												<div class="row text-center">
													<div class="col-md-12">
													<?php if(!isset($_GET['edit'])) {?>
														<button type="submit" name="add-user" class="btn btn-info m-r-20">Submit</button>
													<?php }else{ ?>
													<button type="submit" name="update-user" class="btn btn-info m-r-20">Update</button>
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
			