<?php
ob_start();
require 'db.php'; 
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);

session_start();

$fy_id=0;
$fy_name="";



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="" />
	<title>Sai Pooja J. High School</title>
	<!-- google font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
	<!-- icons -->
		
	<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/pages/formlayout.css" rel="stylesheet" type="text/css" />
	
	<!-- bootstrap -->
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="../assets/css/pages/extra_pages.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="" />
</head>
<?php




if(isset($_POST['checklogin'])){
	
	$user_id="";
	$username = $mysqli->real_escape_string($_POST['username']); 
	$passcode = $mysqli->real_escape_string($_POST['pass']);
	$fy_id = $mysqli->real_escape_string($_POST['fy_id']);
	
		$stmt = $mysqli->prepare("select a.user_id,a.rights,b.fy_name from user_master a,fy_master b where a.username=? and a.passcode=? and b.fy_id=?");
							$stmt->bind_param("ssd",$username,$passcode,$fy_id);
							$result = $stmt->execute();
							$stmt->store_result();
							$stmt->bind_result($user_id,$rights,$fy_name);
							$count=$stmt->num_rows;
							while($data = $stmt->fetch()){}
							if($count>0){
								$_SESSION["loginid"]=$user_id;
								$_SESSION["username"]=$username;
								$_SESSION["type"]=$rights;
								$_SESSION["fy_id"]=$fy_id;	
								//$_SESSION["year"]=substr($fy_name,2,2);
								$_SESSION["year"]=$fy_name;
								
							header('Location:student_list.php');	
							}
							else
								echo "<script type='text/javascript'>alert('Invalid Username/Password');</script>";

	
}

?>
<body>
	<div class="limiter">
		<!--<div class="container-login100 page-background">-->
		<div class="container-login100 page-background">
			<div class="wrap-login100">
				
				<form action="" enctype="multipart/form-data" method="POST"  class="login100-form validate-form">
					<span class="login100-form-logo">
						<img alt="" src="../assets/img/logo.png">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						
					</div>
					<div class="container-login100-form-btn">
							<select class="form-control  select2" name="fy_id" style="width: 150px;">
							
							<?php							
							$stmt = $mysqli->prepare("SELECT fy_id,fy_name from fy_master where is_visible = 1 order by fy_name desc");
							$result = $stmt->execute();
							$stmt->store_result();
							$stmt->bind_result($fy_id,$fy_name);
							$count=$stmt->num_rows;
							while($data = $stmt->fetch())
							{					
							?>
								<option value='<?php echo $fy_id;?>'><?php echo $fy_name;?></option>
								<?php 
								
							}
							?>
							</select>
						
					</div>
					
					<br>
					
				<!--<div class="checkbox checkbox-icon-black">
												<input id="rememberChk1" type="checkbox" checked="checked">
												<label for="rememberChk1">
													Remember me
												</label>
			</div>-->
					<div class="container-login100-form-btn">
						<button type="submit" name="checklogin" class="login100-form-btn">
							Login
						</button>
					</div>
					<!--<div class="text-center p-t-30">
						<a class="txt1" href="forgot_password.html">
							Forgot Password?
						</a>
					</div>-->
				</form>
			</div>
		</div>
	</div>
	<!-- start js include path -->
	<script src="../assets/plugins/jquery/jquery.min.js"></script>
	<!-- bootstrap -->
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/js/pages/extra-pages/pages.js"></script>
	<!-- end js include path -->
</body>



</html>