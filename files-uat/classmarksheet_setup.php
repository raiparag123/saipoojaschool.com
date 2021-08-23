
<?php
ob_start();
require 'db.php'; 
$fy_id=$_SESSION["fy_id"];

if(isset($_GET['response'])){
if($_GET['response']==1){
	echo '<script language="javascript">';
	echo 'alert("No Student present in this class")';
	echo '</script>';

}
else if($_GET['response']==2){
	echo '<script language="javascript">';
	echo 'alert("No Marksheet found for this class")';
	echo '</script>';


}
	


}


?>


<?php require 'header.php';?>
<link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />	
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
														<header>Class Marksheet Print</header>
														<div class="tools">
															<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
															<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
															<!--<a class="t-close btn-color fa fa-times" href="javascript:;"></a>-->
														</div>
													</div>
													<div class="card-body ">
														<form action="classmarksheet_print.php" method="POST">
														
														<div class="form-body">
															<div class="form-group row">
																<label class="control-label col-md-1"><b>Term : </b></label>
																<div class="col-md-2">
																	<select name="term" id="terms" class="form-control  input-height select2">
																		<option value="1">Term 1</option>
																		<option value="2" >Term 2</option>
																	</select>
																
																</div>
																<label class="control-label col-md-1" ><b>Class : </b></label>
																<div class="col-md-3">
																	<select name="class" id="class_drop" class="form-control  input-height select2">
																		<?php 
																		
																		$stmt1 = $mysqli->prepare("SELECT class_id,class_name,medium FROM class_master");
																		$result1 = $stmt1->execute();
																		$stmt1->store_result();
																		$stmt1->bind_result($class_id,$class_name,$medium);		
																		$numberofrows = $stmt1->num_rows;
																		while($data1 = $stmt1->fetch()){
																		?>
																		<option value="<?php echo $class_id;?>" ><?php echo $class_name."-".$medium;?></option>
																		<?php }?>
																	</select>
																</div>
																<div class="col-md-1">
																	<button type="submit" class="btn btn-info"> Display</button>
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
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
			<!-- end page content -->
			<?php include 'footer.html';?>
		<script src="../assets/plugins/select2/js/select2.js"></script>
		<script src="../assets/js/pages/select2/select2-init.js"></script>
		<script src='script_t.js' type='text/javascript'></script>
		