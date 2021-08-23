<?php
ob_start();
require 'db.php'; 

?>




	<?php 
				
		/*if(isset($_GET['del']))
					{
						
						$reg=$_GET['del'];
						$stmt = $mysqli->prepare("delete from stud_regist_master WHERE registration_id=?");
						$stmt->bind_param("d",$reg);
						if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
						}
						$stmt->close();
					}*/
						?>
<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Fee Name List</div>
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
														<header>Fee Names List</header>
														<div class="tools">
															<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
															<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
															<!--<a class="t-close btn-color fa fa-times" href="javascript:;"></a>-->
														</div>
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																<div class="btn-group">
																	<a href="#" id="AddFeename"   data-toggle="modal" data-target="#FeeNameModal" data-id="0" class="btn btn-info">
																		Add New <i class="fa fa-plus"></i>
																	</a>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-6">
																
																
															</div>
														</div>

														<div class="table-scrollable">
															<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
															 id="example4">
																<thead>
																	<tr>
																		<th>Fee Name</th>
																		<th> Edit </th>
																		
																	</tr>
																</thead>
																<tbody id="feetable">
																<?php 
																$stmt = $mysqli->prepare("select fee_name_id,fee_name from fee_name_master");
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($fee_name_id,$fee_name);
																$count=$stmt->num_rows;
																while($data = $stmt->fetch()) //use fetch() fetch_assoc() is not a member of mysqli_stmt class
																{
																
																?>
																
																	<tr class="odd gradeX">
																		
																		<td class="left"><?php echo $fee_name;?></td>
																		<td>
																			<button id="EditFeename"   data-toggle="modal" data-target="#FeeNameModal" data-id="<?php echo $fee_name_id?>"   class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil "></i>
																			</button>
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
			
			
			<div class="modal fade" id="FeeNameModal" role="dialog">
            <div class="modal-dialog">
                <div id="content-data"></div>
            </div>
        </div>
			<!-- end page content -->
			<?php include 'footer.html';?>
			<script src='script.js' type='text/javascript'></script>