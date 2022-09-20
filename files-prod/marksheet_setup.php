<?php
ob_start();
require 'db.php'; 
$month_list = array("N/A","April", "May", "June","July","August","September","October","November","December","January","February","March");
$counter=1;
$reg_id="";
$first_name="";
session_start();
$fy_id=$_SESSION["fy_id"];
?>
<style>


</style>




<link href="../assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
<link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />


<style type="text/css">
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 24px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 24px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>


	
	<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
					   				<header>Marksheet Setup</header>
									<button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
										<i class="material-icons">more_vert</i>
									</button>
									
								</div>
								<div class="card-body" id="bar-parent">
									<form action="Marksheet_Save.php"  enctype="multipart/form-data" method="POST"  class="form-horizontal">
										
										<div class="form-body">
										
											<div class="form-group row">
												<label class="control-label col-md-1">Name :</label>
												<div class="col-md-3">
													<!--<input type="text" autocomplete="off" spellcheck="false" placeholder="Type your Query"  name="typeahead" class="typeahead tt-query"  style="height:30px;width:80%"  />-->
													<select style="width:250px;" class="form-control  select2" id="namemarksdrp" name="namemarksdrp" onchange="cgnamemarks(this);" >
													<option value=0 selected>Select Name</option>
													<?php
														$stmt = $mysqli->prepare("select registration_id,first_name,regno from stud_regist_master a,class_stud_master b where a.registration_id = b.student_id and a.is_delete=1 and b.is_delete=1 
														and b.class_id <> 9 and b.class_id <> 10 and b.fy_id=?");
														$stmt->bind_param("d",$fy_id);
														$result = $stmt->execute();
														$stmt->store_result();
														$stmt->bind_result($reg_id,$first_name,$reg_no);
														$count=$stmt->num_rows;
														while($data = $stmt->fetch())
														{
															
															?>
														<option value="<?php echo $reg_id;?>"><?php echo $reg_no."-".$first_name; ?></option>
													
													
														<?php } $stmt->close();
														
														?>
													</select>
													<input type="hidden" name="first_name" id="first_name" >

												</div>
												
												<label class="control-label col-md-2" >Reg No:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="regno" class="control-label"></label>
													<input type="hidden" name="regno1" id="regno1" >
													<input type="hidden" name="cs_id" id="cs_id" >
													
												</div>
												
												<label class="control-label col-md-2" >Class:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="class_name" class="control-label"></label>
													<input type="hidden" name="class_name1" id="class_name1" >
												</div>
											</div>
											
											
											
											
											<div class="form-group row">
												
												<label class=" col-md-1">Date:</label>
												<div class="col-md-3">
													<div class="input-append date form_date" data-date-format="dd-mm-yyyy"
														data-date="2013-02-21T15:25:00Z">
														<input   style="height:30px;width:40%"   size="10" type="text" readonly name="sheetdate" id="sheetdate" >
														<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
														<span class="add-on"><i class="fa fa-calendar"></i></span>
													</div>	
												</div>
												
												<label class="control-label col-md-2">Father Name:</label>
												
												<div class="col-md-2">
													<label style="font-size:18px;" id="father_name" class="control-label"></label>
													<input type="hidden" name="father_name1" id="father_name1" >
												</div>
												
												<label class="control-label col-md-2">Mother Name:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="mother_name" class="control-label"></label>
													<input type="hidden" name="mother_name1" id="mother_name1" >
												</div>
												
												
											</div>
											

											
											<br>
											<div class="form-group row ">
													
												<div class="col-md-1">
														<label style="font-size:16px;" class="control-label">Select term</label>
													</div>
												<div class="col-md-4">
													<select style="width:150px;" class="form-control" name="termdrp"  id="termdrp" onchange="termchange(this);">
													<option value='0' selected>Select term</option>
													<option value='1' >First term</option>
													<option value='2' >Second term</option>
													</select> 
												</div>
												<div class="col-md-2">
													<button type="button"  class="btn btn-info" id="btncalc" onClick="" >Calculate<i class="fa fa-plus"></i></button>
												</div>
											</div>

											<div class="form-group row">
											<table id="table1" class="table table-striped table-hover">
													<thead>
														<tr id="tablehead">
													</thead>
													<tbody id="tabletr">
													</tbody>
													
											</table>	
										</div>

										<div id="calculate_div" style="display:none;">
										<div class="form-group row ">
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Marks Obtained:</label></div>
												<div class="col-md-2"><input type="text" onblur="percent();" style="width:60px;" class="form-control  text-center" id="txtmarksobtain"  name="txtmarksobtain" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
										

										
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Total Marks:</label></div>
												<div class="col-md-2"><input type="text" onblur="percent();" style="width:60px;" class="form-control  text-center" id="txtmaxmarks" name="txtmaxmarks" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
										</div>
										<div class="form-group row ">
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Percentage:</label></div>
												<div class="col-md-2"><input type="text" readonly style="width:60px;" class="form-control  text-center" name="txtpercent" id="txtpercent" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
										
										
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Result:</label></div>
												<div class="col-md-2"><select  id="selectresult" name="selectresult"  class="form-control  text-center"><option value=0 selected>PASS</option><option value=1>FAIL</option><option value=2>PROMOTE</option> </select></div>
										</div>
										</div>

										<div class="form-actions">
											<div class="row text-center" >
												<div class="col-md-12">
													<button type="submit" id="MarksSaveBtn" style="display: none;" name="MarksSave" class="btn btn-primary m-r-20">Submit</button>
													<!--<button type="button" class="btn btn-default">Cancel</button>-->
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<?php include 'footer.html';?>
			
			
			<script  type='text/javascript'>
			var rows_count="";
			$(document).ready(function(){

				//rows_count = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
			
				

			});


	

			</script>
			
	
			
			<script src="../assets/plugins/select2/js/select2.js"></script>
    		<script src="../assets/js/pages/select2/select2-init.js"></script>
			<script src='script_marks.js' type='text/javascript'></script>
