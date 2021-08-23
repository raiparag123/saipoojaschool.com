<?php
ob_start();
require 'db.php'; 
session_start();
$fy_id=$_SESSION["fy_id"];
?>




<?php require 'header.php';?>
<link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />	
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Class Fee Structure</div>
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><a class="parent-item" href="#">Fee List</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Fee Name List</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tabbable-line">
								
								<div class="tab-content">
									<div class="tab-pane active fontawesome-demo" id="tab1">
										<div class="row">
											<div class="col-md-12">
												<div class="card card-box">
													<div class="card-head">
														<header>Class Fees</header>
														<div class="tools">
															<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
															<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
															<!--<a class="t-close btn-color fa fa-times" href="javascript:;"></a>-->
														</div>
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-10 col-sm-10 col-10">
																<div class="btn-group">
																	Medium :
																	<select name="medium_drop" id="medium_drop" class="form-control  input-height select2">
																	<option value="0" selected>Select Medium</option>
																	<option value="Hindi">Hindi</option>
																	<option value="English" >English</option>
																	</select>
																	Class Name: <select name="class_drop" id="class_drop" class="form-control  input-height select2">
																	<option value="0" selected >Select Class</option>
																	<option value="Nursery" >Nursery</option>
																	<option value="LKG" >LKG</option>
																	<option value="UKG" >UKG</option>
																	<option value="Class-1" >Class 1</option>
																	<option value="Class-2" >Class 2</option>
																	<option value="Class-3" >Class 3</option>
																	<option value="Class-4" >Class 4</option>
																	<option value="Class-5" >Class 5</option>
																	<option value="Class-6" >Class 6</option>
																	<option value="Class-7" >Class 7</option>
																	<option value="Class-8" >Class 8</option>
																	<option value="Class-9" >Class 9</option>
																	<option value="Class-10">Class 10</option>
																	
																	</select>
																	
																	<button type="button" name="shwfeebtn" id="shwfeebtn"> Display</button>
																	
																	
																</div>
															</div>
															<div class="col-md-4 col-sm-4 col-4">
																
																<button type="button" style="display: none;"  id="addclassfee"   class="btn btn-info">
																			Add New <i class="fa fa-plus"></i>
																	</button>
															</div>
														</div>

														<div class="table-scrollable">
															<table class="table table-striped table-bordered table-hover order-column valign-middle">
																<thead>
																	<tr>
																		<th>Fee Name</th>
																		<th>Fee Amount</th>
																		<th> Edit </th>
																		
																	</tr>
																</thead>
																<tbody id="feetbls">
																
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
			
			
			<div class="modal fade" id="ClassFeeModal" role="dialog">
            <div class="modal-dialog">
					<div id="content-data"></div>
            </div>
        </div>
			<!-- end page content -->
			<?php include 'footer.html';?>
		<script src="../assets/plugins/select2/js/select2.js"></script>
		<script src="../assets/js/pages/select2/select2-init.js"></script>
		<script src='script.js' type='text/javascript'></script>
		