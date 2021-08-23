<?php
ob_start();
require 'db.php'; 

?>




	<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12">
							<div class="tabbable-line">
								
								<div class="tab-content">
									<div class="tab-pane active fontawesome-demo" id="tab1">
										<div class="row">
											<div class="col-md-12">
												<div class="card card-box">
													<div class="card-head">
														<header>User List</header>
														<div class="tools">
															<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
															
															<!--<a class="t-close btn-color fa fa-times" href="javascript:;"></a>-->
														</div>
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																<div class="btn-group">
																	<a href="add_user.php" id="addRow" class="btn btn-info">
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
																		<th></th>
																		<th>User Name</th>
																		<th> Email Id </th>
																		<th> Type</th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																$stmt = $mysqli->prepare("select user_id,username,email,rights,user_image from user_master");
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($user_id,$username,$email,$rights,$user_image);
																$count=$stmt->num_rows;
																while($data = $stmt->fetch()) //use fetch() fetch_assoc() is not a member of mysqli_stmt class
																{
																
																?>
																
																	<tr class="odd gradeX">
																		<td class="patient-img">
																			<img src="<?php echo $user_image;?>" alt="">
																		</td>
																		<td class="left"><?php echo $username;?></td>
																		<td class="left"><?php echo $email;?></td>
																		<td class="left"><?php if($rights=='a') echo "Admin"; else echo "User"?></td>
																		
																		<td>
																			<a href="add_user.php?edit=<?php echo $user_id; ?>" class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil"></i>
																			</a>
																			
																				<button id="<?php echo $user_id; ?>"   class="btn btn-danger btn-xs deleteuser">
																				<i class="fa fa-trash-o "></i>
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
			<?php include 'footer.html';?>
			<script src='script1.js' type='text/javascript'></script>
			
			