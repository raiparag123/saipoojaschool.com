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
			<style>
thead input {
        width: 100%;
    }
	
</style>
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
														<header>Students List</header>
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
															<table id="example23" class="display"> 
																<thead>
																	<tr>
																		<th class="dt-center"></th>
																		<th class="dt-center"> Name </th>
																		<th class="dt-center"> Reg No.</th>
																		<th class="dt-center"> Class </th>
																		<th class="dt-center"> Medium </th>
																		<th class="dt-center"> Status</th>
																		<th class="dt-center"> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																$stmt = $mysqli->prepare("select status,first_name,last_name,stud_image,registration_id,regno,c.class_name,c.medium from stud_regist_master a ,class_stud_master b ,class_master c where a.registration_id = b.student_id and a.is_delete=1 and b.is_delete =1 and b.fy_id = ?  and b.class_id = c.class_id");
																$stmt->bind_param("d",$fy_id);
																$result = $stmt->execute();
																$stmt->store_result();
																$stmt->bind_result($status,$first_name,$last_name,$stud_image,$registration_id,$regno,$class_name,$medium);
																$count=$stmt->num_rows;
																while($data = $stmt->fetch()) 
																{
																?>
																    
																	<tr >
																		<td width="40" class="patient-img dt-center">
																			<img src="<?php 
																			if(strpos( $stud_image , 'stud' ) !== false){
																			echo $stud_image;
																			}
																			else{ 
																			echo "noimage.jpg"; 
																			}?>" alt="">
																		</td>
																		
																		<td width="250" class="dt-left" ><?php echo $first_name;?></td>
																		<td width="100" class="dt-center"><?php echo $regno;?></td>
																		<td width="130" class="dt-center"><?php echo $class_name;?></td>
																		<td width="130" class="dt-center"><?php echo $medium;?></td>
																		<td width="130" class="dt-center">
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
			<script src='script_fixed.js' type='text/javascript'></script>
			<script type='text/javascript'>
		$(document).ready(function() {

	var table = $('#example').DataTable();
 
$('#container').css( 'display', 'block' );
table.columns.adjust().draw();
});  

</script>