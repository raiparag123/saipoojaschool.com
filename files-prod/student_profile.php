<?php
ob_start();
require 'db.php'; 
session_start();
if(!isset($_SESSION["loginid"])){
	header('Location:login.php');	
}

$fy_id=$_SESSION["fy_id"];
$cs_id=0;

if(isset($_REQUEST["edit"]))	{
	
	$regis_id=$_REQUEST["edit"];
	$stmt = $mysqli->prepare("select b.stud_image,c.medium,b.first_name,c.class_name,b.regno,c.medium,b.dob,b.address,b.email,b.father_name,b.mother_name,b.gender,b.mobile_number,b.scholar_no from class_stud_master a,stud_regist_master b,class_master c where a.student_id = b.registration_id and a.class_id=c.class_id and b.registration_id=?");
	$stmt->bind_param("d",$regis_id);
	$result = $stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($stud_image,$medium,$first_name,$class_name,$regno,$medium,$dob,$address,$email,$fname,$mname,$gender,$mobile,$scholar);
	while($data = $stmt->fetch())	{

	}
	
	
}
?>

	<?php require 'header.php';?>
	
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Student Profile</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<!--<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="#">Student</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Student Profile</li>-->
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<div class="card card-topline-aqua">
									<div class="card-body no-padding height-9">
										<div class="row">
											<div class="profile-userpic">
												<img src="<?php 
							if(strpos( $stud_image , 'stud' ) !== false){
							echo $stud_image;
							}
							else{
							echo "noimage.jpg"; 
							}?>" class="img-responsive" alt=""> </div>
										</div> 
										<div class="profile-usertitle">
											<div class="profile-usertitle-name"><?php echo $first_name;?></div>
										</div>
										<ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b>Reg No.</b> <a class="pull-right"><?php echo $regno;?></a>
											</li>
											<li class="list-group-item">
												<b>Class</b> <a class="pull-right"><?php echo $class_name;?></a>
											</li>
											<li class="list-group-item">
												<b>Medium</b> <a class="pull-right"><?php echo $medium;?></a>
											</li>
											<li class="list-group-item">
												<b>Scholar No.</b> <a class="pull-right"><?php echo $scholar;?></a>
											</li>
										</ul>
										<!-- END SIDEBAR USER TITLE -->
										<!-- SIDEBAR BUTTONS -->
										<div class="profile-userbuttons">
											<!--<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary">Follow</button>
											<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-pink">Message</button>
										</div>
										END SIDEBAR BUTTONS -->
									</div>
								</div>
								
								
								<!--<div class="card">
									<div class="card-head card-topline-aqua">
										<header>Marks</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="profile-desc">
											Hello I am Sarah Smith a student in Sanjivni College Surat. I love to study with all my class friends and
											professors.
										</div>
										<ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b>Gender </b>
												<div class="profile-desc-item pull-right">Female</div>
											</li>
											<li class="list-group-item">
												<b>Department</b>
												<div class="profile-desc-item pull-right">Mechanical</div>
											</li>
											<li class="list-group-item">
												<b>Email </b>
												<div class="profile-desc-item pull-right">test@example.com</div>
											</li>
											<li class="list-group-item">
												<b>Phone</b>
												<div class="profile-desc-item pull-right">1234567890</div>
											</li>
										</ul>
										<div class="row list-separated profile-stat">
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 37 </div>
												<div class="uppercase profile-stat-text"> Projects </div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 51 </div>
												<div class="uppercase profile-stat-text"> Tasks </div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 61 </div>
												<div class="uppercase profile-stat-text"> Uploads </div>
											</div>
										</div>
									</div>
								</div>
								
								
								
								
								<div class="card">
									<div class="card-head card-topline-aqua">
										<header>Address</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="row text-center m-t-10">
											<div class="col-md-12">
												<p>456, Pragri flat, varacha road, Surat
													<br> Gujarat, India.</p>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-head card-topline-aqua">
										<header>Interest In</header>
									</div>
									<div class="card-body no-padding height-9">
										<div class="work-monitor work-progress">
											<div class="states">
												<div class="info">
													<div class="desc pull-left">Study</div>
													<div class="percent pull-right">50%</div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="40"
													 aria-valuemin="0" aria-valuemax="100" style="width: 70%">
														<span class="sr-only">50% </span>
													</div>
												</div>
											</div>
											<div class="states">
												<div class="info">
													<div class="desc pull-left">Cricket</div>
													<div class="percent pull-right">85%</div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
													 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
														<span class="sr-only">85% </span>
													</div>
												</div>
											</div>
											<div class="states">
												<div class="info">
													<div class="desc pull-left">Music</div>
													<div class="percent pull-right">20%</div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="40"
													 aria-valuemin="0" aria-valuemax="100" style="width: 35%">
														<span class="sr-only">20% </span>
													</div>
												</div>
											</div>
										</div>
									</div>-->
								</div>
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="card">
										<div class="card-topline-aqua">
											<header></header>
										</div>
										<div class="white-box">
											<!-- Nav tabs -->
											<div class="p-rl-20">
												<ul class="nav customtab nav-tabs" role="tablist">
													<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">Student Info</a></li>
													<!--<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">Activity</a></li>-->
												</ul>
											</div>
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane active fontawesome-demo" id="tab1">
													<div id="biography">
													
													
													
									<div class="card card-topline-yellow">
										<div class="card-head">
											<header>Student Marks</header>
											<div class="tools">
												<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
												<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
												<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
											</div>
										</div>
										<div class="card-body ">
											<div class="table-scrollable">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Class Name</th>
															<th>Year</th>
															<th>First Term</th>
															<th>Second Term</th>
														</tr>
													</thead>
													<tbody>
													<?php if(isset($_REQUEST["edit"]))	{
	
													$regis_id=$_REQUEST["edit"];
													$stmt = $mysqli->prepare("SELECT
														c.fy_name,
														a.class_id,
														b.class_name
													FROM
														class_stud_master a,
														class_master b,
														fy_master c
													WHERE
														student_id = ?
														AND a.fy_id = c.fy_id
														AND a.class_id = b.class_id
													ORDER BY
														a.class_id desc");

													$stmt->bind_param("d",$regis_id);
													$result = $stmt->execute();
													$stmt->store_result();
													$stmt->bind_result($fy_name,$class_id,$class_name);
													while($data = $stmt->fetch())	{
														echo "<tr><td>".$class_name."</td>";
														echo "<td>".$fy_name."</td>";

														$stmt1 = $mysqli->prepare("select a.term_id,a.cs_id,c.class_id,c.class_name from student_term_master a,class_stud_master b,class_master c where a.cs_id =b.cs_id and b.class_id=c.class_id and b.student_id=? AND c.class_id=?");
														$stmt1->bind_param("dd",$regis_id,$class_id);
														$result1 = $stmt1->execute();
														$stmt1->store_result();
														$stmt1->bind_result($term_id,$cs_id,$class_id,$class_name);
														$count=$stmt1->num_rows;
														$fterm=0;
														$sterm=0;
													while($data1 = $stmt1->fetch())	{
														//echo "<td widht='250'><a href='marksheet.php?cs=".$cs_id."&term=".$term_id."'>".$class_name."-Term ".$term_id."</a></td>";
														if($term_id ==1)
															$fterm=1;
														if( $term_id==2 )
															$sterm=1;
												 		}
													if($fterm == 1) echo "<td widht='250'><a href='marksheet.php?cs=".$cs_id."&term=1'>".$class_name."-Term 1</a></td>";
													else echo "<td widht='250'>N/A</td>";
   
													if($sterm == 1) echo "<td widht='250'><a href='marksheet.php?cs=".$cs_id."&term=2'>".$class_name."-Term 2</a></td>";
													else echo "<td widht='250'>N/A</td>";


														echo "</tr>";
														}
	
	
													}
?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
									<div class="row">
															<div class="col-md-3 col-6 b-r"> <strong>Father Name</strong>
																<br>
																<p class="text-muted"><?php echo $fname; ?></p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Mother Name</strong>
																<br>
																<p class="text-muted"><?php echo $mname; ?></p>
															</div>
															<div class="col-md-3 col-6 b-r"> <strong>Date of Birth</strong>
																<br>
																<p class="text-muted"><?php echo $dob; ?></p>
															</div>
															<div class="col-md-3 col-6"> <strong>Mobile</strong>
																<br>
																<p class="text-muted"><?php echo $mobile; ?></p>
															</div>
														</div>
														
														<pre>                                                                                   </pre>
														
														
													</div>
												</div>
												<div class="tab-pane" id="tab2">
													<div class="container-fluid">
														<div class="row">
															<div class="full-width p-rl-20">
																<div class="panel">
																	<form>
																		<textarea class="form-control p-text-area" rows="4" placeholder="Whats in your mind today?"></textarea>
																	</form>
																	<footer class="panel-footer">
																		<button class="btn btn-post pull-right">Post</button>
																		<ul class="nav nav-pills p-option">
																			<li>
																				<a href="#"><i class="fa fa-user"></i></a>
																			</li>
																			<li>
																				<a href="#"><i class="fa fa-camera"></i></a>
																			</li>
																			<li>
																				<a href="#"><i class="fa  fa-location-arrow"></i></a>
																			</li>
																			<li>
																				<a href="#"><i class="fa fa-meh-o"></i></a>
																			</li>
																		</ul>
																	</footer>
																</div>
															</div>
															<div class="full-width p-rl-20">
																<ul class="activity-list">
																	<li>
																		<div class="avatar">
																			<img src="../assets/img/std/std1.jpg" alt="" />
																		</div>
																		<div class="activity-desk">
																			<h5><a href="#">Rajesh</a> <span>Uploaded 3 new photos</span></h5>
																			<p class="text-muted">7 minutes ago near Alaska, USA</p>
																			<div class="album">
																				<a href="#">
																					<img alt="" src="../assets/img/mega-img1.jpg">
																				</a>
																				<a href="#">
																					<img alt="" src="../assets/img/mega-img2.jpg">
																				</a>
																				<a href="#">
																					<img alt="" src="../assets/img/mega-img3.jpg">
																				</a>
																			</div>
																		</div>
																	</li>
																	<li>
																		<div class="avatar">
																			<img src="../assets/img/std/std3.jpg" alt="" />
																		</div>
																		<div class="activity-desk">
																			<h5><a href="#">John Doe</a> <span>attended a meeting with</span>
																				<a href="#">Lina Smith.</a></h5>
																			<p class="text-muted">2 days ago near Alaska, USA</p>
																		</div>
																	</li>
																	<li>
																		<div class="avatar">
																			<img src="../assets/img/std/std4.jpg" alt="" />
																		</div>
																		<div class="activity-desk">
																			<h5><a href="#">Kehn Anderson</a> <span>completed the task “wireframe design” within the dead line</span></h5>
																			<p class="text-muted">4 days ago near Alaska, USA</p>
																		</div>
																	</li>
																	<li>
																		<div class="avatar">
																			<img src="../assets/img/std/std5.jpg" alt="" />
																		</div>
																		<div class="activity-desk">
																			<h5><a href="#">Jacob Ryan</a> <span>was absent office due to sickness</span></h5>
																			<p class="text-muted">4 days ago near Alaska, USA</p>
																		</div>
																	</li>
																</ul>
																<div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i>
																		13 minutes ago</span>
																	<div class="post-img"><img src="../assets/img/slider/fullimage1.jpg" class="img-responsive" alt=""></div>
																	<div>
																		<h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
																		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
																			the industry's standard dummy text ever since the 1500s, </p>
																		<p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i>
																				Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i>
																				Reply</a> </p>
																	</div>
																</div>
																<div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i>
																		37 minutes ago</span>
																	<div class="post-img"><img src="../assets/img/slider/fullimage2.jpg" class="img-responsive" alt=""></div>
																	<div>
																		<h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
																		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
																			the industry's standard dummy text ever since the 1500s, </p>
																		<p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i>
																				Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i>
																				Reply</a> </p>
																	</div>
																</div>
																<div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i>
																		53 minutes ago</span>
																	<div class="post-img"><img src="../assets/img/slider/fullimage3.jpg" class="img-responsive" alt=""></div>
																	<div>
																		<h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
																		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
																			the industry's standard dummy text ever since the 1500s, </p>
																		<p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i>
																				Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i>
																				Reply</a> </p>
																	</div>
																</div>
																<div class="col-lg-12 p-t-20 text-center">
																	<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-info">Load
																		More</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END PROFILE CONTENT -->
						</div>
					</div>
				</div>
				<!-- end page content -->
				<?php include 'footer.html';?>