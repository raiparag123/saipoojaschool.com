<?php
ob_start();
require 'db.php'; 
$month_list = array("N/A","April", "May", "June","July","August","September","October","November","December","January","February","March");
$counter=1;
$reg_id="";
$first_name="";
$fy_id=$_SESSION["fy_id"]; 

	if(isset($_GET["cs_id"])){
		$cs_id=$_GET["cs_id"];
		$term_id=$_GET["term_id"];
		$stmt=$mysqli->prepare("SELECT a.student_term_id,a.total_marks_obtained,a.percentage,a.result,a.total_marks FROM student_term_master a where a.cs_id=? and a.term_id=?");
		$stmt->bind_param("dd",$cs_id,$term_id);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($student_term_id,$total_mo,$percent,$passfail,$mm);
		$numberofrows=$stmt->num_rows;
		while($data = $stmt->fetch()){
			//echo $student_term_id;
//			echo "<input type=hidden name='stud_term_id' value=".$student_term_id.">";
		}
		
		if($numberofrows == 0)
			echo "No Data Found";
			else{
		
		$stmt=$mysqli->prepare("select b.first_name,b.father_name,b.mother_name,c.class_name,b.regno FROM class_stud_master a,stud_regist_master b,class_master c where a.student_id=b.registration_id and a.class_id=c.class_id and a.cs_id=?");
		$stmt->bind_param("d",$cs_id);
		$result=$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($first_name,$father_name,$mother_name,$class_name,$regno);
		$numberofrows=$stmt->num_rows;
		while($data = $stmt->fetch()){}



		
		



	


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
									<input type=hidden name='cs_id' value="<?php echo $cs_id; ?>" >
										<input type=hidden name='term_id' value="<?php echo $term_id; ?>" >
										<input type=hidden name='stud_term_id' value="<?php echo $student_term_id; ?>" >
										<div class="form-body">
										
											<div class="form-group row">
												<label class="control-label col-md-1">Name:</label>
												<div class="col-md-3">
													<label style="font-size:18px;" id="regno" class="control-label"><?php echo $first_name;?></label>

												</div>
												
												<label class="control-label col-md-2" >Reg No:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="regno" class="control-label"><?php echo $regno;?></label>
													
													
													
												</div>
												
												<label class="control-label col-md-2" >Class:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="class_name" class="control-label"><?php echo $class_name;?></label>
						
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
													<label style="font-size:18px;" id="father_name" class="control-label"><?php echo $father_name;?></label>
													
												</div>
												
												<label class="control-label col-md-2">Mother Name:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="mother_name" class="control-label"><?php echo $mother_name;?></label>
													<input type="hidden" name="mother_name1" id="mother_name1" >
												</div>
												
												
											</div>
											

											
											<br>
											<div class="form-group row ">
													
											<label class="control-label col-md-2">Term:</label>
												<div class="col-md-2">
													<label style="font-size:18px;" id="mother_name" class="control-label"><?php echo $term_id;?></label>
	
												</div>

												<div class="col-md-2">
													<button type="button"  class="btn btn-info" id="btncalc" onClick="Calc();" >Calculate<i class="fa fa-plus"></i></button>
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
														
														<?php 
														/*
														
														$stmt = $mysqli->prepare("select from student_term_master a where a.student_term_id=?");
														$stmt->bind_param("d",$stud_term_id);
														$result = $stmt->execute();
														$stmt->store_result();
														$stmt->bind_result($total_mo,$percent,$passfail,$mm);		
														$numberofrows = $stmt->num_rows;
														
														while($data = $stmt->fetch()){}
															
														*/
														?>
													
										</div>
										
										<div id="calculate_div" >
										<div class="form-group row ">
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Marks Obtained:</label></div>
												<div class="col-md-2"><input size='6'  value="<?php echo $total_mo; ?>" onblur="percent();" type="text" style="width:60px;" class="form-control  text-center" id="txtmarksobtain"  name="txtmarksobtain" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
										

										
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Total Marks:</label></div>
												<div class="col-md-2"><input size='6' value="<?php echo $mm; ?>" type="text" onblur="percent();" style="width:60px;" class="form-control  text-center" id="txtmaxmarks" name="txtmaxmarks" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
										</div>
										<div class="form-group row ">
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Percentage:</label></div>
												<div class="col-md-2"><input  size='8' type="text" readonly value="<?php echo $percent; ?>" style="width:60px;" class="form-control  text-center" name="txtpercent" id="txtpercent" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
										
										
												<div class="col-md-2"><label style="font-size:13px;" class="control-label">Result:</label></div>
												<div class="col-md-2"><select  style='width: 80px;' id="selectresult"  name="selectresult"  class="form-control  text-center"><option value=0 <?php  if($passfail ==0) echo "selected"; ?> >PASS</option><option value=1 <?php  if($passfail ==1) echo "selected"; ?> >FAIL</option><<option value=2 <?php  if($passfail ==2) echo "selected"; ?> >PROMOTE</option> /select></div>
												<input type="submit" value="" style="display: none;">
										</div>
										</div>
										


										<div class="form-actions">
											<div class="row text-center" >
												<div class="col-md-12">
													<button type="submit" id="MarksUpdateBtn" name="MarksUpdate" class="btn btn-primary m-r-20">Update</button>
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
			var cs_id=<?php echo $_GET["cs_id"]; ?>;
			var term_id=<?php echo $_GET["term_id"]; ?>;
			var stud_term_id=<?php echo $student_term_id; ?>;
			
			
			
			function edit_load()
			{	
				$.ajax({
					url:'ajax_calls_marks.php',
					type:'POST',
					data:'editload='+stud_term_id+'&term_id='+term_id,
					success: function(response){
						var drpval = JSON.parse(response);
	//					console.log(drpval[2][2]);
						document.getElementById("tablehead").innerHTML="";
						if(term_id == 1){
						document.getElementById("tablehead").innerHTML="<th>Subject</th><th> UT1</th><th> ACT1</th><th> INT1</th><th> SA1</th><th>Total(100)</th><th> GRADE </th>";
						document.getElementById("btncalc").onclick =Calc;
						}
						else{
						document.getElementById("tablehead").innerHTML="<th>Subject</th><th> UT1</th><th> ACT1</th><th> INT1</th><th> SA1</th><th> UT2</th><th> ACT2</th><th> INT2</th><th> SA2</th><th>Total(200)</th><th> GRADE </th>";
						document.getElementById("btncalc").onclick =Calc2;
						}

						$("#table1").find("tr:gt(0)").remove(); //delete all row except first
						rows_count=0;
						var total=0;
						for(var i=1;i <= drpval[0][1];i++){
							var tables=document.getElementById("table1");
							var newRow = tables.insertRow(-1);
							var newCell = newRow.insertCell(0);
							rows_count++;
							
							if(term_id == 1){
								newCell.innerHTML = drpval[rows_count][1]+'<input type="hidden" name="rows['+rows_count+'][subj]" value="'+drpval[rows_count][0]+'">';
								newCell = newRow.insertCell(1);	
								newCell.innerHTML = '<input type="text" onclick="this.select();" style="width:50px;" id="ut1_'+rows_count+'" value="'+drpval[rows_count][2]+'"    class="form-control  text-center" name="rows['+rows_count+'][ut1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
								newCell = newRow.insertCell(2);	
								newCell.innerHTML = '<input type="text" onclick="this.select();" style="width:50px;" value="'+drpval[rows_count][3]+'"  id="act1_'+rows_count+'" class="form-control  text-center" name="rows['+rows_count+'][act1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
								newCell = newRow.insertCell(3);	
								newCell.innerHTML ='<input type="text" onclick="this.select();" style="width:50px;" value="'+drpval[rows_count][4]+'"  id="int1_'+rows_count+'" class="form-control  text-center" name="rows['+rows_count+'][int1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
								newCell = newRow.insertCell(4);	
								newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" value="'+drpval[rows_count][5]+'"  id="sa1_'+rows_count+'" class="form-control  text-center" name="rows['+rows_count+'][sa1]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
								newCell = newRow.insertCell(5);		
								
								if(!isNaN(drpval[rows_count][2]))
								total =  Number(drpval[rows_count][2]);
								if(!isNaN(drpval[rows_count][3]))
								total = total + Number(drpval[rows_count][3]);
								if(!isNaN(drpval[rows_count][4]))
								total = total + Number(drpval[rows_count][4]);
								if(!isNaN(drpval[rows_count][5]))
								total = total + Number(drpval[rows_count][5]);

								
								newCell.innerHTML = '<input type="text"  value="'+total+'" onclick="this.select();" style="width:50px;" class="form-control text-center"  id="total_'+rows_count+'"  name="rows['+rows_count+'][total]" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
								newCell = newRow.insertCell(6);	
								if(drpval[rows_count][6] == 'A1')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option selected value="A1">A1</option><option value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'A2')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  selected value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'B1')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option  selected value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'B2')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option  selected value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'C1')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option  selected value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'C2')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option  selected value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'D')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option  selected value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'E1')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option selected  value="E1">E1</option><option value="E2">E2</option></select>';
								else if(drpval[rows_count][6] == 'E2')
								newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option  selected value="E2">E2</option></select>';

								newCell = newRow.insertCell(7);

						
						}
						else if(term_id==2){
									newCell.innerHTML = drpval[rows_count][1]+'<input type="hidden" name="rows['+rows_count+'][subj]" value="'+drpval[rows_count][0]+'">';
									newCell = newRow.insertCell(1);	
									newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][2]+'"  readonly name="rows['+rows_count+'][ut1]" id="ut1_'+rows_count+'"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
									newCell = newRow.insertCell(2);	
									newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][3]+'"   readonly name="rows['+rows_count+'][act1]" id="act1_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
									
									newCell = newRow.insertCell(3);
									newCell.innerHTML ='<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][4]+'"   readonly name="rows['+rows_count+'][int1]" id="int1_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
									
									newCell = newRow.insertCell(4);	
									newCell.innerHTML = '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][5]+'"  readonly name="rows['+rows_count+'][sa1]" id="sa1_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
									
									newCell = newRow.insertCell(5);
									newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center" value="'+drpval[rows_count][6]+'" name="rows['+rows_count+'][ut2]" id="ut2_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';	
									newCell = newRow.insertCell(6);	
									newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center"  value="'+drpval[rows_count][7]+'" name="rows['+rows_count+'][act2]" id="act2_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
									
									newCell = newRow.insertCell(7);
									newCell.innerHTML +='<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center"  value="'+drpval[rows_count][8]+'"  name="rows['+rows_count+'][int2]" id="int2_'+rows_count+'"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">';		
									newCell = newRow.insertCell(8);	
									
									newCell.innerHTML += '<input type="text"  onclick="this.select();" style="width:50px;" class="form-control  text-center"  value="'+drpval[rows_count][9]+'"  name="rows['+rows_count+'][sa2]" id="sa2_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
									newCell = newRow.insertCell(9);
									if(!isNaN(drpval[rows_count][2]))
									total =  Number(drpval[rows_count][2]);
									if(!isNaN(drpval[rows_count][3]))
									total = total + Number(drpval[rows_count][3]);
									if(!isNaN(drpval[rows_count][4]))
									total = total + Number(drpval[rows_count][4]);
									if(!isNaN(drpval[rows_count][5]))
									total = total + Number(drpval[rows_count][5]);
									if(!isNaN(drpval[rows_count][6]))
									total = total + Number(drpval[rows_count][6]);
									if(!isNaN(drpval[rows_count][7]))
									total = total + Number(drpval[rows_count][7]);
									if(!isNaN(drpval[rows_count][8]))
									total = total + Number(drpval[rows_count][8]);
									if(!isNaN(drpval[rows_count][9]))
									total = total + Number(drpval[rows_count][9]);
									newCell.innerHTML += '<input type="text"  value="'+total+'" onclick="this.select();" style="width:50px;" class="form-control  text-center" name="rows['+rows_count+'][total]" id="total_'+rows_count+'" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
									newCell = newRow.insertCell(10);


									if(drpval[rows_count][10] == 'A1')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option selected value="A1">A1</option><option value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'A2')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  selected value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'B1')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option  selected value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'B2')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option  selected value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'C1')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option  selected value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'C2')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option  selected value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'D')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option  selected value="D">D</option><option value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'E1')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option selected  value="E1">E1</option><option value="E2">E2</option></select>';
											else if(drpval[rows_count][10] == 'E2')
											newCell.innerHTML = '<select  name="rows['+rows_count+'][grade]" class="form-control   text-center" id="grade_'+rows_count+'" ><option  value="A1">A1</option><option  value="A2">A2</option><option value="B1">B1</option><option value="B2" >B2</option><option value="C1">C1</option><option value="C2">C2</option><option value="D">D</option><option value="E1">E1</option><option  selected value="E2">E2</option></select>';						
									newCell = newRow.insertCell(11);

						}




						}









						
						//console.log(drpval[2][3]);
					}
				});
			
			}





			$(document).ready(function(){

				//rows_count = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
				edit_load();
				

			});


	

			</script>
			
	
			
			<script src="../assets/plugins/select2/js/select2.js"></script>
    		<script src="../assets/js/pages/select2/select2-init.js"></script>
			<script src='script_marks.js' type='text/javascript'></script>
		<?php } } ?>