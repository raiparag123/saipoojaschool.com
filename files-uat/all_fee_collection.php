<?php
ob_start();
require 'db.php'; 
session_start();
$f_year=$_SESSION["year"];
$fy_id=$_SESSION["fy_id"];


$month_list = array("NA","April", "May", "June","July","August","September","October","November","December","January","February","March");
$reg="";
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
														<header>All Fees List</header>
														<div class="tools">
															<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
															<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
															<!--<a class="t-close btn-color fa fa-times" href="javascript:;"></a>-->
														</div>
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																
															</div>
															<div class="col-md-6 col-sm-6 col-6">
																																
																
															</div>
														</div>

														<div class="table-scrollable">
															<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
															 id="example4">
																<thead>
																	<tr>
																		
																		<th> Name </th>
																		<th> Class</th>
																		<th>Reg No.</th>
																		<th> Medium</th>
																		<th> Paid till</th>
																	   <th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
				$stmt = $mysqli->prepare("select c.registration_id,c.first_name,c.last_name,a.class_name,a.medium,b.roll_no,b.cs_id from class_master a,class_stud_master b,stud_regist_master c where a.class_id=b.class_id and b.student_id=c.registration_id and b.fy_id=? and c.is_delete=1 and c.status=1");
				$stmt->bind_param("d",$fy_id);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($reg,$first_name,$last_name,$class_name,$medium,$rollno,$cs_id);
				$count=$stmt->num_rows;
				while($data = $stmt->fetch()) 
				{
					$stmt1 = $mysqli->prepare("select stud_fee_id,a.month_id,b.month_name from stud_fee_master a,month_master b where a.month_id=b.month_id and status=0 and cs_id=? order by a.month_id limit 1");
					$stmt1->bind_param("d",$cs_id);
					$result1 = $stmt1->execute();
					$stmt1->store_result();
					$stmt1->bind_result($stud_feeid,$month_id,$month_name);
					$count1=$stmt1->num_rows;
					
					while($data1 = $stmt1->fetch())
					{					

																?>
																
																	<tr class="odd gradeX">
																		
																		<td class="left"><?php echo $first_name;?></td>
																		
																		<td class="left"><?php  echo $class_name?></td>
																		<td><?php  echo $reg;?></td>
																		<td><?php  echo $medium;?></td>
																		<td class="left">
																		<?php if($month_id > 1)
																		{
																			if($month_id < 11)
																			echo $month_list[$month_id-1].' \' '.substr($f_year,2,2);
																			else
																			echo $month_list[$month_id-1].' \' '.substr($f_year,5,2);
																		}
																		else{ echo "N/A";}
																		?>
																		</td>
																		
																		<td class="text-center">
																		
																		<a href="collect_fees.php?stf_id=<?php echo $stud_feeid;?>" id="collectfee" class="btn btn-primary">
																		Collect<i class="fa fa-plus"></i>
																			</a>
																			<a href="alter_fees.php?cs_id=<?php echo $cs_id;?>" class="btn btn-warning">																			
																				Edit<i class="fa fa-edit"></i>
																			</a>
																			<a href="view_fees.php?cs_id=<?php echo $cs_id;?>" class="btn btn-success">View<i class="fa fa-print"></i></a>
																		</td>
																	</tr>
																	<?php 
																	}
																}
																
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
			<script src='script.js' type='text/javascript'></script>
		