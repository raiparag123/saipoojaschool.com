<?php
ob_start();
require 'db.php';
session_start();
$f_year=$_SESSION["year"];
$fy_id=$_SESSION["fy_id"];
$i="";
$count="";
$csid="";
$first_name="";$class_name="";$medium="";$month_id="";$month_name="";
$month_list = array("N/A","April", "May", "June","July","August","September","October","November","December","January","February","March");
$class_id="";
$fee_name="";
$fee_amount="";
$fee_name_id="";
$stfid="";

if(isset($_REQUEST["stf_id"]))	{ 
		$stfid=$_REQUEST["stf_id"];		
		
		$stmt = $mysqli->prepare("select a.first_name,a.last_name,a.registration_id,c.class_name,c.class_id,c.medium,d.month_id,e.month_name,b.fy_id from stud_regist_master a,class_stud_master b,class_master c,stud_fee_master d,month_master e where a.registration_id=b.student_id and b.class_id=c.class_id and b.cs_id=d.cs_id and   d.month_id=e.month_id  and stud_fee_id=?  and d.status=0");
		$stmt->bind_param("d",$stfid);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($first_name,$last_name,$reg_id,$class_name,$class_id,$medium,$month_id,$month_name,$fy_id);
		$count=$stmt->num_rows;
		while($data = $stmt->fetch())
		{

		}
	}


?>


<link href="../assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	<?php require 'header.php';?>
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Collect Fees</header>
									<button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
										<i class="material-icons">more_vert</i>
									</button>
									
								</div>
								<div class="card-body" id="bar-parent">
									<form action="ajax_calls.php" enctype="multipart/form-data" method="POST"  class="form-horizontal">
										
										<div class="form-body">
										
											<div class="form-group row">
												<div class="col-md-3">
														<label style="font-size:16px;" class="control-label">Name :</label>
														<label style="font-size:18px;" class="control-label"><?php echo $first_name.' '.$last_name;?></label>
												</div>
												<div class="col-md-3">
													<label style="font-size:16px;" class="control-label">Class :</label>
													<label style="font-size:18px;" class="control-label"><?php echo $class_name;?></label>
													<input type="hidden" name="studfeeid" value="<?php echo $stfid;?>">	
												</div>
												<div class="col-lg-3">
													<label style="font-size:16px;" class="control-label">Medium :</label>
													<label style="font-size:18px;" class="control-label"><?php echo $medium;?></label>
												</div>	
													<div class="col-lg-3">
													<label style="font-size:16px;" class="control-label">Reg No :</label>
													<label style="font-size:18px;" class="control-label"><?php echo $reg_id;?></label>
												</div>	
												<!--<div class="col-lg-3">
													<label class="control-label">Paid By:</label>
													<input calss="form-control" type="text" name="paidby">
												</div>	-->
											</div>
											<br>
											<div class="form-group row ">
													<div class="col-md-2">
													</div><div class="col-md-1">
														<label style="font-size:16px;" class="control-label">Month:</label>
													</div>
												<div class=" col-md-2">
													<select style="width:150px;" class="form-control" name="month1" disabled id="month1">	
														<option value="<?php echo $month_id; ?>"><?php if($month_id <10) echo $month_name.' \' '.substr($f_year,2,2); else echo $month_name.' \' '.substr($f_year,5,2);?></option>
													</select>														
												</div>
													<div class="col-md-1 text-center">
											<label style="font-size:16px;" class="control-label">To</label>
											</div>
												<div class="col-md-2">
													<select style="width:150px;" class="form-control" name="month2" onchange="monthchgedrp(this);">
													<?php 
													for($i=$month_id;$i<=12;$i++){
													?>
													
													<option value="<?php echo $i;?>"><?php  if($i <10) echo $month_list[$i].' \' '.substr($f_year,2,2); else echo $month_list[$i].' \' '.substr($f_year,5,2);?></option>

													<?php } ?>

													</select>
												</div>
												<div class="col-md-2">
													<button type="button"  class="btn btn-info" onClick="addfeerows()" >Add New<i class="fa fa-plus"></i></button>
												</div>
											</div>

											<div class="form-group row">
											<table id="table1" class="table table-striped table-hover">
													<thead>
														<tr>
														<th>Action</th>
														<th>Fee Name</th>
														<th class="text-center"> Month </th>
														<th> Amount </th>
														<th> Total</th>
														</tr>
													</thead>
													<tbody id="tablebody">
													<?php	
													if(isset($_REQUEST["stf_id"]))	{
															
														$stmt = $mysqli->prepare("select c.fee_name_id,c.fee_name,b.fee_amount from fee_master a,fee_struct_master b,fee_name_master c where a.fee_id=b.fee_id and b.fee_name_id=c.fee_name_id and a.class_id=? and fy_id=?");
														$stmt->bind_param("dd",$class_id,$fy_id);
														$result = $stmt->execute();
														$stmt->store_result();
														$stmt->bind_result($fee_name_id,$fee_name,$fee_amount);
														$count=$stmt->num_rows;
														
														$counter=1;
														while($data = $stmt->fetch())
														{
													?>	
													
													<tr id="tablerows">
															<td> <button id="delbtn<?php echo $counter;?>" type="button" onClick="delfeecol(this);" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
														 	</td>
															<td> 
															<select style="width:150px;" class="form-control  select2" name="rows[<?php echo $counter;?>][feename]">
																	<?php 
																	$stmt1 = $mysqli->prepare("select fee_name,fee_name_id from fee_name_master");
																	$result1 = $stmt1->execute();
																	$stmt1->store_result();
																	$stmt1->bind_result($fee_name1,$fee_name_id1);
																	while($data1 = $stmt1->fetch()){
																	?>
																	<option value="<?php echo $fee_name_id1;?>" <?php if($fee_name_id==$fee_name_id1) echo "selected";?> ><?php echo $fee_name1;?></option>

																	<?php }
																		$stmt1->close();
																		?>
																	
																	</select>		
															
														</td>
															<td> 
												<div class="input-group spinner">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" data-dir="dwn" id="dnbtn<?php echo $counter;?>" type="button" >
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input  type="number" class="form-control text-center" value="1" 
                                                             min="1" max="1" name="rows[<?php echo $counter;?>][month]" readonly id="tamt<?php echo $counter.'0';?>"> <span class="input-group-btn">
                                                            <button class="btn btn-default" data-dir="up" id="upbtn<?php echo $counter;?>"  type="button">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
															</td>
															<td> <input   type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="rows[<?php echo $counter;?>][amount]" class="form-control" value="<?php echo $fee_amount;?>" id="tamt<?php echo $counter;?>" onblur="multiply(this);" /> </td>
															 <td> <input type="text"   style="font-weight:bold" name="rows[<?php echo $counter;?>][tamount]"  readonly class="form-control" id="tamt<?php echo $counter.'1';?>"  /> </td>

														</tr>
														<?php 
														$counter++;
														}
														$stmt->close();
													}	?>
													</tbody>
													<hr>
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th>Total Amount</th>
														<th><label style="font-size:18px;font-weight:bold" class="control-label" id="lbltotal" ></label></th>
													</tr>
											</table>	
										</div>

										<div class="form-actions">
											<div class="row text-center" >
												<div class="col-md-12">
													<button type="submit" name="feecollect" class="btn btn-primary m-r-20">Submit</button>
													<button type="button" class="btn btn-default">Cancel</button>
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
			
			
			<script  type='text/javascript'>
			var rows_count="";
			var rows_count1="";
			$(document).ready(function(){

				rows_count = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
				var total=0;
				var t1,t2,t3;
				var i=2;				
                for (i = 1; i <=rows_count; i++){
					t1=document.getElementById('tamt'+i).value;
             		t2=document.getElementById('tamt'+i+'0').value;
                	t3=t1*t2;
                	document.getElementById('tamt'+i+'1').value=t3;
					total=total+parseInt(t3);
				}
				document.getElementById('lbltotal').innerHTML=total;

			});


			/***Spinner*** */
			$(document).on('click', '.spinner button', function() {
			
			var btn = $(this);
			if($(this).attr('id') != undefined){
			var p1=$(this).attr('id').substring(5,6);
				var t1,t2,t3;
            var input = btn.closest('.spinner').find('input');
            var step = 1;
            if (input.attr('step') != undefined) {
                step = parseInt(input.attr('step'),10);
            }
			
			var flag=0;
			
			
            if (btn.attr('data-dir') == 'up') {
                if (input.attr('max') == undefined || parseInt(input.val(),10) < parseInt(input.attr('max'),10)) {
					input.val(parseInt(input.val(), 10) + step);
					t1=input.val();
					t2=document.getElementById('tamt'+p1).value;
					t3=t1*t2;
					document.getElementById('tamt'+p1+'1').value=t3;
					document.getElementById('lbltotal').innerHTML=total;
					flag=1;
                } else {
                    btn.next("disabled", true);
                }
            } else {
                if (input.attr('min') == undefined || parseInt(input.val(),10) > parseInt(input.attr('min'),10)) {
					input.val(parseInt(input.val(), 10) - step);
					t1=input.val();
					t2=document.getElementById('tamt'+p1).value;
					t3=t1*t2;
					document.getElementById('tamt'+p1+'1').value=t3;
					flag=1;
					
                } else {
                    btn.prev("disabled", true);
                }
			}
			
			if(flag)
			{
				var element='';
				var famt, total,i;
				famt = total = i= 0;
				for (i = 1; i <=rows_count; i++){
				element = document.getElementById('tamt'+i+'1');
				if(element){
				famt=document.getElementById('tamt'+i+'1').value;
				total=total+parseInt(famt);
				
				}
				document.getElementById('lbltotal').innerHTML=total; 
				
			
			}
				
			}
			
		}
		});
		

			</script>
			
			 
			
			<script src="../assets/plugins/select2/js/select2.js"></script>
    		<script src="../assets/js/pages/select2/select2-init.js"></script>
			<script src='script.js' type='text/javascript'></script>
	 