<?php
ob_start();
require 'db.php'; 
session_start();
$fy_id=$_SESSION["fy_id"];
?>

<?php 





	if(isset($_POST['add-year']))
	{
		$fy_id=$_POST['fy_id'];
		$odlfy_id=$fy_id-1;
		$stmt = $mysqli->prepare("update fy_master set is_visible=1 where fy_id = ?");
		$stmt->bind_param("d",$fy_id);
		if (!$stmt->execute()) { 
			trigger_error('Error executing MySQL query: ' . $stmt->error);
		}
		else{
				$stmt = $mysqli->prepare("select student_id,class_id from class_stud_master a,stud_regist_master b where a.student_id=b.registration_id and b.status=1 and a.is_delete=1 and b.is_delete=1 and a.fy_id =? ");
				$stmt->bind_param("d",$odlfy_id);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($student_id,$class_id);
				$count=$stmt->num_rows;
				while($data = $stmt->fetch())
				{
					if($class_id == 8 || $class_id == 18){
						
						$stmt1 = $mysqli->prepare("update stud_regist_master set status = 2 where status = 1 and is_delete=1 and registration_id = ?");
						$stmt1->bind_param("d",$student_id);
						$stmt1->execute();
						

					}
					else if($class_id == 23){
						
						$class_id=1;
						$stmt1 = $mysqli->prepare("insert into class_stud_master (student_id,class_id,fy_id) values (?,?,?)");
						$stmt1->bind_param("ddd",$student_id,$class_id,$fy_id);
						$stmt1->execute();
						$cs_id=$mysqli->insert_id;	
						$i=1;
						while($i < 13){
						$stmt1 = $mysqli->prepare("insert into stud_fee_master (cs_id,month_id)values (?,?)");
						$stmt1->bind_param("dd",$cs_id,$i);
						$stmt1->execute();
						$i++;
						}

					}
					else if($class_id == 26){
						$class_id=11;
						$stmt1 = $mysqli->prepare("insert into class_stud_master (student_id,class_id,fy_id) values (?,?,?)");
						$stmt1->bind_param("ddd",$student_id,$class_id,$fy_id);
						$stmt1->execute();
						
						$cs_id=$mysqli->insert_id;	
						$i=1;
						while($i < 13){
						$stmt1 = $mysqli->prepare("insert into stud_fee_master (cs_id,month_id)values (?,?)");
						$stmt1->bind_param("dd",$cs_id,$i);
						$stmt1->execute();
						$i++;
						}
					}
					else{
						$class_id=$class_id+1;
						$stmt1 = $mysqli->prepare("insert into class_stud_master (student_id,class_id,fy_id) values (?,?,?)");
						$stmt1->bind_param("ddd",$student_id,$class_id,$fy_id);
						$stmt1->execute();
						$cs_id=$mysqli->insert_id;	
						$i=1;
						while($i < 13){
						$stmt1 = $mysqli->prepare("insert into stud_fee_master (cs_id,month_id)values (?,?)");
						$stmt1->bind_param("dd",$cs_id,$i);
						$stmt1->execute();
						$i++;
						}





				
					}
					
				 
				}

				$stmt = $mysqli->prepare("SELECT subject_id,class_id FROM class_subject_master where is_delete = 1 and fy_id = ?");
				$stmt->bind_param("d",$odlfy_id);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($subject_id,$class_id);
				$count=$stmt->num_rows;
				while($data = $stmt->fetch())
				{
						$stmt1 = $mysqli->prepare("insert into class_subject_master (subject_id,class_id,fy_id) values (?,?,?)");
						$stmt1->bind_param("ddd",$subject_id,$class_id,$fy_id);
						$stmt1->execute();
				}
				echo '<script>console.log("Row Inserted to class_subj_master '.$count.'");</script>';

				
				
				
					
			}
			echo '<script>alert("Done")</script>';
		
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
									<header>Add Year</header>
								
									
								</div>
								<div class="card-body" id="bar-parent">
									<form action="" enctype="multipart/form-data" method="POST"  class="form-horizontal">
										<div class="form-body">
											
											
											
											
											
											<div class="form-group row">
											<label class="control-label col-md-2">Year</label>
											<div class="col-md-4">
											<select class="form-control input-height" name="fy_id">
											<?php 
														$stmt = $mysqli->prepare("SELECT fy_id,fy_name FROM fy_master WHERE fy_id = (select fy_id from fy_master where fy_id= ?)+1 and is_visible <> 1");
														$stmt->bind_param("d",$fy_id);
														$result = $stmt->execute();
														$stmt->store_result();
														$stmt->bind_result($fy_id,$fy_name);
														$count=$stmt->num_rows;
														while($data = $stmt->fetch())
														{?>
													
													<option value="<?php echo $fy_id;?>"><?php echo $fy_name; ?></option>
												<?php 	}?>	
												</select>
											</div>											
												

											</div>
											<div class="form-actions">
												<div class="row text-center">
													<div class="col-md-12">
														<button type="submit" name="add-year" class="btn btn-info m-r-20">Add</button>
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
			