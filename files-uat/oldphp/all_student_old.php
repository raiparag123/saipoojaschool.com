<?php
ob_start();
require 'db.php'; 
session_start();
if(!isset($_SESSION["loginid"])){
	header('Location:login.php');	
}
$stmt1="";
$registration_id="";
$regno="";
$fy_id=$_SESSION["fy_id"];
$class_name="N/A";
$medium="N/A";
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
														<header>All Students List</header>
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
																	<a href="add_student.php" id="addRow" class="btn btn-info">
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
																		<th> Name </th>
																		<th> Reg No.</th>
																		<th> Class </th>
																		<th> Medium </th>
																		<th> Status</th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																$stmt = $mysqli->prepare("select status,first_name,last_name,stud_image,registration_id,regno from stud_regist_master where is_delete=1 order by registration_id  desc");
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($status,$first_name,$last_name,$stud_image,$registration_id,$regno);
																$count=$stmt->num_rows;
																while($data = $stmt->fetch()) //use fetch() fetch_assoc() is not a member of mysqli_stmt class
																{
																$stmt1 = $mysqli->prepare("select b.class_name,b.medium from class_stud_master a,class_master b where a.class_id=b.class_id and a.student_id=? and fy_id=? order by a.cs_id desc limit 1");
																$stmt1->bind_param("dd",$registration_id,$fy_id);
																$result1 = $stmt1->execute();
																$stmt1->store_result();
																$stmt1->bind_result($class_name,$medium);
																while($data1 = $stmt1->fetch()){}
																?>
																
																	<tr class="odd gradeX">
																		<td class="patient-img">
																			<img src="<?php 
																			if(strpos( $stud_image , 'stud' ) !== false){
																			echo $stud_image;
																			}
																			else{
																			echo "noimage.jpg"; 
																			}?>" alt="">
																		</td>
																		
																		<td class="left"><?php echo $first_name;?></td>
																		<td><?php echo $regno;?></td>
																		<td class="left"><?php echo $class_name;?></td>
																		<td><?php echo $medium;?></td>
																		<td>
																		<?php
																		if($status==1) echo "Studying";
																		elseif($status==2) echo "Passed Out";
																		elseif($status==3) echo "Left School";
																		elseif($status==4) echo "Terminated";
																		?>
																		
																		</td>
																		<td>
																		<a href="student_profile.php?edit=<?php echo $registration_id; ?>" class="btn btn-pink btn-xs">
																				<i class="fa fa-user"></i>
																			</a>
																			
																			<a href="add_student.php?edit=<?php echo $registration_id; ?>" class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil"></i>
																			</a>
																			
																				
																			<a href="application-form.php?print=<?php echo $registration_id; ?>" class="btn btn-success btn-xs">
																				<i class="fa fa-print"></i>
																			</a>
																			<button id="<?php echo $registration_id; ?>"   class="btn btn-danger btn-xs deletestud">
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
			<!-- end page content -->
			<?php include 'footer.html';?>
			<script src='script.js' type='text/javascript'></script>
			
			<!--<script type="text/javascript" language="javascript" >
					$(document).ready(function(){
						$(document).on('click', '.delete', function(){
							var delctl=this;
							var id = $(this).attr("id");
							if(confirm("Are you sure you want to remove this?"))
							{
							$.ajax({
								url:"ajax_calls.php",
								method:"POST",
								data:{delstud:id},
								success:function(data){
									$(delctl).closest('tr').fadeOut(800,function(){
										$(this).remove();
									});
							
								}
							
							}
									
							}
						}	}	
 </script>-->