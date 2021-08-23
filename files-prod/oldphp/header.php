<?php
ob_start();
require 'db.php';
session_start();
if(!isset($_SESSION["loginid"])){
	header('Location:login.php');	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />


	<title>SAI POOJA J. HIGH SCHOOL</title>
	<!-- google font -->      
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
	<link href="fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
	<!--bootstrap --> 
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="../assets/plugins/material/material.min.css">
	<link rel="stylesheet" href="../assets/css/material_style.css">
	<!--fixed data tabkes-->
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="css/fixedHeader.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme Styles -->
	<link href="../assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
	<link href="../assets/css/theme/light/style.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/pages/formlayout.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/theme/light/theme-color.css" rel="stylesheet" type="text/css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="" />
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="page-wrapper">
		<!-- start header -->
		<div class="page-header navbar navbar-fixed-top">
			<div class="page-header-inner ">
				<!-- logo start -->
				<div class="page-logo">
					<a href="index.html">
						
						<span class="logo-default">SAI POOJA</span> </a>
				</div>
				<!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
				
				<!-- start mobile menu -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
					<span></span>
				</a>
				<!-- end mobile menu -->
				<!-- start header menu -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
					<li class="dropdown language-switch">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Financial Year: <?php echo $_SESSION["fy_id"];?><span class="fa fa-angle-down"></span>
							</a>							
						</li>
						<li><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
						
						
						<!-- start manage user dropdown -->
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<img alt="" class="img-circle " src="../assets/img/logo.png" />
								<span class="username username-hide-on-mobile"> <?php echo $_SESSION["username"];?> </span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="changepassword.php">
										<i class="icon-user"></i> Change Password </a>
								</li>
								
								<!--<li class="divider"> </li>
								<li>
									<a href="lock_screen.php">
										<i class="icon-lock"></i> Lock
									</a>
								</li>-->
								<li>
									<a href="logout.php">
										<i class="icon-logout"></i> Log Out </a>
								</li>
							</ul>
						</li>
						<!-- end manage user dropdown -->
					
					</ul>
				</div>
			</div>
		</div>
		<!-- end header -->
		<!-- start color quick setting -->
		<!-- end color quick setting -->
		<!-- start page container -->
		<div class="page-container">
			<!-- start sidebar menu -->
			<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll" class="left-sidemenu">
						<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true"
						 data-slide-speed="200" style="padding-top: 20px">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							
							<li class="sidebar-user-panel">
								<div class="user-panel">
									<div class="pull-left image">
										<img src="../assets/img/logo.png" class="img-circle user-img-circle" alt="User Image" />
									</div>
									<div class="pull-left info">
										<p> <?php echo $_SESSION["username"];?></p>
										<a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
									</div>
								</div>
							</li>
							
							
							
							<li class="nav-item start">
								<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
									<span class="title">Students</span><span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								
								
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="all_student.php" class="nav-link "> <span class="title">Students List</span>
										</a>
									</li>
									<!--<li class="nav-item">
										<a href="add_student.php" class="nav-link "> <span class="title">Add Student</span>
										</a>
									</li>-->
									
									<!--<li class="nav-item">
										<a href="student_profile.html" class="nav-link "> <span class="title">About Student</span>
										</a>
									</li>-->
								</ul>
								
							</li>
							
							
							<li class="nav-item">
								<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
									<span class="title">Fees</span><span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								
								
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="javascript:;" class="nav-link nav-toggle">
											<i></i> Fee Structure
											<span class="arrow"></span>
										</a>
										<ul class="sub-menu">
											
											<li class="nav-item">
												<a href="class_fee_struct.php" class="nav-link">
													<i class=""></i>Class Fee</a>
											</li>
											<li class="nav-item">
												<a href="fee_names.php" class="nav-link">
													<i class=""></i> Fee Name</a>
											</li>
											
										</ul>
									</li>
									
									
									<li class="nav-item">
										<a href="all_fee_collection.php" class="nav-link "> <span class="title">Fee Collection</span>
										</a>
									</li>
									
									
									
									
								</ul>
								
							</li>
							
							<li class="nav-item start">
								<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
									<span class="title">Subject</span><span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="subject_names.php" class="nav-link "> <span class="title">Subject Names</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="class_subj_struct.php" class="nav-link "> <span class="title">Class Subject</span>
										</a>
									</li>
								</ul>
							</li>

							<li class="nav-item start">
								<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
									<span class="title">Reports</span><span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								
								
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="dcr.php" class="nav-link "> <span class="title">DCR Report</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="marksheet_setup.php" class="nav-link "> <span class="title">Marksheet Setup</span>
										</a>
									</li>

									<li class="nav-item">
										<a href="classmarksheet_setup.php" class="nav-link "> <span class="title">Class Marksheet Report</span>
										</a>
									</li>


									<!--<li class="nav-item">
										<a href="std.php" class="nav-link "> <span class="title">STD report</span>
										</a>
									</li>-->
									
									<!--<li class="nav-item">
										<a href="student_profile.html" class="nav-link "> <span class="title">About Student</span>
										</a>
									</li>-->
								</ul>
								
							</li>
							
							
							<li class="nav-item start">
								<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
									<span class="title">Admin Rights</span><span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item">
										<a href="all_users.php" class="nav-link "> <span class="title">Manage Users</span>
										</a>
									</li>
									<!--<li class="nav-item">
										<a href="yearadd.php" class="nav-link "> <span class="title">Financial Year</span>
										</a>
									</li>
									
									<li class="nav-item">
										<a href="class_change.php" class="nav-link "> <span class="title">Class Change</span>
										</a>
									</li>-->
								</ul>
								
							</li>
							
							
							
							
						</ul>
					</div>
				</div>
			</div>
			<!-- end sidebar menu -->
			
			
			
				<!-- end page content -->
			

		