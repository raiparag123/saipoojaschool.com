<?php
	ob_start();
	require 'db.php'; 
?>

	<?php 
				
		if(isset($_GET['del']))
		{
			
			$reg=$_GET['del'];
			$stmt = $mysqli->prepare("delete from stud_regist_master WHERE registration_id=?");
			$stmt->bind_param("d",$reg);
			if (!$stmt->execute()) { 
					trigger_error('Error executing MySQL query: ' . $stmt->error);
			}
			$stmt->close();
		}
	?>
<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">All Professor List</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="#">Professor</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">All Professor List</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tabbable-line">
								<ul class="nav customtab nav-tabs" role="tablist">
									<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">List View</a></li>
									<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">Grid View</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active fontawesome-demo" id="tab1">
										<div class="row">
											<div class="col-md-12">
												<div class="card card-box">
													<div class="card-head">
														<header>All Professor List</header>
														<div class="tools">
															<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
															<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
															<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
														</div>
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																<div class="btn-group">
																	<a href="add_professor.html" id="addRow" class="btn btn-info">
																		Add New <i class="fa fa-plus"></i>
																	</a>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-6">
																<div class="btn-group pull-right">
																	<a class="btn deepPink-bgcolor  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
																		<i class="fa fa-angle-down"></i>
																	</a>
																	<ul class="dropdown-menu pull-right">
																		<li>
																			<a href="javascript:;">
																				<i class="fa fa-print"></i> Print </a>
																		</li>
																		<li>
																			<a href="javascript:;">
																				<i class="fa fa-file-pdf-o"></i> Save as PDF </a>
																		</li>
																		<li>
																			<a href="javascript:;">
																				<i class="fa fa-file-excel-o"></i> Export to Excel </a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>

														<div class="table-scrollable">
															<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
															 id="example4">
																<thead>
																	<tr>
																		<th></th>
																		<th> Class</th>
																		<th> Name </th>
																		<th> Department </th>
																		<th> Mobile </th>
																		<th> Medium</th>
																		<th>Admission Date</th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																$stmt = $mysqli->prepare("select first_name,stud_image,mobile_number1,registration_id from stud_regist_master");
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($first_name,$stud_image,$mobile_number1,$registration_id);
																$count=$stmt->num_rows;
																while($data = $stmt->fetch()) //use fetch() fetch_assoc() is not a member of mysqli_stmt class
																{
																
																?>
																
																	<tr class="odd gradeX">
																		<td class="patient-img">
																			<img src="<?php echo $stud_image;?>" alt="">
																		</td>
																		<td class="left">18</td>
																		<td><?php echo $first_name;?></td>
																		<td class="left">Mechanical</td>
																		<td><a href="tel:4444565756">
																				<?php echo $mobile_number1;?> </a></td>
																		<td><a href="mailto:shuxer@gmail.com">
																				rajesh@gmail.com </a></td>
																		<td class="left">22 Feb 2010</td>
																		<td>
																			<a href="add_student.php?edit=<?php echo $registration_id; ?>" class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil"></i>
																			</a>
																			<a href="?del=<?php echo $registration_id; ?>"  onclick="return confirm('Sure To Delete  '); " class="btn btn-danger btn-xs">
																				<i class="fa fa-trash-o "></i>
																			</a>
																		</td>
																	</tr>
																	<?php }
																
																$stmt->close();
																$mysqli->close();
																?>
																	
													
																</tbody>
															</table>
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
				</div>
			</div>
			<!-- end page content -->
			<?php include 'footer.html';?>