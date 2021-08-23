<?php require 'header.php';
$fy_id=$_SESSION["fy_id"];

if(isset($_GET['cs'])){ 
	

$cs_id=$_GET['cs'];
$term_id=$_GET['term'];

					$stmt = $mysqli->prepare("SELECT regno,first_name,mother_name,father_name,dob,class_name FROM stud_regist_master a,class_stud_master b,class_master c where b.class_id=c.class_id and a.registration_id=b.student_id and cs_id=?");
					$stmt->bind_param("d",$cs_id);
					$result = $stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($regno,$name,$mname,$fname,$dob,$class_name);		
					$numberofrows = $stmt->num_rows;
					while($data = $stmt->fetch()){}
					




}


?>

			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Student Marksheet</div>
							</div>
							
							
							<div class="text-right">
									
									<button onclick="javascript:window.print();" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
									<button  class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i><a href="marksheet_edit.php?cs_id=<?php echo $cs_id?>&term_id=<?php echo $term_id?>"     > Modify</a></span> </button>
							</div>
						</div>
					</div>
					<div class="white-box">
					<!--<div class="border" style="border:1px solid #000;">-->
						<div class="row">
							<div class="col-md-3 text-left">
							<img src="../assets/img/logo.png" alt="logo" class="img-responsive" style="height: 200px; border: 2px solid #000; padding: 10px;"/>
							</div>
							<div class="col-md-9 text-left">
								<div class="row" style="border: 2px solid #000">
									<div class="col-md-8">
										<p style="margin: 23px 0 16px; font-size: 16px">NAME OF THE PUPIL - <?php echo $name;?></p>
									</div>
									<div class="col-md-4 text-right">
										<p style="margin: 23px 0 16px; font-size: 16px">REG NO: <?php echo $regno;?></p>
									</div>
									<div class="col-md-6">
										<p style="margin: 23px 0 16px; font-size: 16px">FATHER'S NAME - <?php echo $fname;?></p>
									</div>
									<div class="col-md-6 text-right">
										<p style="margin: 23px 0 16px; font-size: 16px">MOTHER'S NAME - <?php echo $mname;?></p>
									</div>
									<div class="col-md-4 text-left">
										<p style="margin: 23px 0 16px; font-size: 16px">DOB - <?php echo $dob;?></p>
									</div>
									<div class="col-md-4 center">
										<p style="margin: 23px 0 16px; font-size: 16px"></p>
									</div>
									<div class="col-md-4 text-right">
										<p style="margin: 23px 0 16px; font-size: 16px">Class: <?php echo $class_name;?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<h3>Academic Performance</h3>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="table-repsonsive-md">
								<table class="table table-bordered text-center">
									<thead>

									<?php if($term_id==1){?>
										<tr>
											<th rowspan="4" style="vertical-align: middle">Subject</th>
											<th colspan="4">First Term</th>
											<th> </th>
											
											<th rowspan="3">Grade</th>
										</tr>
										<tr>
											<th colspan="4">Mark Obtained</th>
											
							
											<th></th>
										</tr>
										<tr>
											<th>UT-I</th>
											<th>ACT</th>
											<th>INT</th>
											<th>SA-I</th>
											<th>TOTAL</th>
										</tr>
										<tr>
											<th>10</th>
											<th>5</th>
											<th>5</th>
											<th>80</th>
											<th>100</th>
											<th></th>
											
										</tr>
										</thead>
									<?php }else{ ?>
										<thead>
										<tr>
											<th rowspan="4" style="vertical-align: middle">Subject</th>
											<th colspan="4">First Term</th>
											<th colspan="4">Second Term</th>
											<th> </th>
											
											<th rowspan="3">Grade</th>
										</tr>
										<tr>
											<th colspan="4">Mark Obtained</th>
											
											<th colspan="4">Mark Obtained</th>
											<th></th>
										</tr>
										<tr>
											<th>UT-I</th>
											<th>ACT</th>
											<th>INT</th>
											<th>SA-I</th>
											<th>UT-II</th>
											<th>ACT</th>
											<th>INT</th>
											<th>SA-II</th>
											<th>TOTAL</th>
										</tr>
										<tr>
											<th>10</th>
											<th>5</th>
											<th>5</th>
											<th>80</th>
											<th>10</th>
											<th>5</th>
											<th>5</th>
											<th>80</th>
											<th>200</th>
											<th></th>
											
										</tr>
									</thead>

									<?php } ?>

									
									<tbody>
										
					<?php 
				if($term_id ==1){	
					$stmt = $mysqli->prepare("select a.total_marks_obtained,a.percentage,a.result,a.total_marks,s.subject_name,b.marks_name_id,b.marks_obtained,b.grade from student_term_master a,student_marks_obtain_master b ,subject_master s  where b.subject_id= s.subject_id and a.student_term_id=b.student_term_id and a.cs_id=? and a.term_id=?");
					$stmt->bind_param("dd",$cs_id,$term_id);
					$result = $stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($total_mo,$percent,$passfail,$mm,$subj,$marks_id,$marks_obtain,$grade);		
					$numberofrows = $stmt->num_rows;
					//$i=1;
					$total=0;
					while($data = $stmt->fetch()){
						if($marks_id == 1)
							echo "<tr><td>".$subj."</td>";

						echo "<td>".$marks_obtain."</td>";
						$total=$total+ $marks_obtain;
						if($marks_id == 4)
						{
							echo "<td width=200>".$total."</td>";
							echo "<td width=200>".$grade."</td></tr>";
							$total=0;
						}
					}

				}
				else if($term_id ==2)
				{
					$stmt = $mysqli->prepare("select a.total_marks_obtained,a.percentage,a.result,a.total_marks,s.subject_name,b.marks_name_id,b.marks_obtained,b.grade from student_term_master a,student_marks_obtain_master b ,subject_master s  where b.subject_id= s.subject_id and a.student_term_id=b.student_term_id and a.cs_id=? and a.term_id in (1,2) order by b.subject_id,b.marks_name_id");
					$stmt->bind_param("d",$cs_id);
					$result = $stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($total_mo,$percent,$passfail,$mm,$subj,$marks_id,$marks_obtain,$grade);		
					$numberofrows = $stmt->num_rows;
					//$i=1;
					$total=0;
					while($data = $stmt->fetch()){
						if($marks_id == 1)
							echo "<tr><td>".$subj."</td>";

						echo "<td>".$marks_obtain."</td>";
						$total=$total+ $marks_obtain;
						if($marks_id == 8)
						{
							echo "<td>".$total."</td>";
							echo "<td>".$grade."</td></tr>";
							$total=0;
						}
					}

				}

				
					?>
										<!--<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td> 
										</tr>-->
										
										
										<tr>
											<td rowspan="2">Grand Total</td>
											
											<td colspan="3">Percentage</td>
										<td <?php if($term_id ==2) echo 'colspan="2" ';?> >M.M</td>
											<td <?php if($term_id ==2) echo 'colspan="2" ';?>>M.O</td>
									

											<td colspan="5" rowspan="2">FINAL RESULT - <?php if($passfail ==1) echo "FAIL"; else if($passfail ==0) echo "PASS"; else echo "PROMOTE"; ?></td>
										</tr>
										<tr>
											
											<td colspan="3"><?php echo $percent; ?></td>
											<td <?php if($term_id ==2) echo 'colspan="2" ';?>><?php echo $mm;?></td>
											<td <?php if($term_id ==2) echo 'colspan="2" ';?>><?php echo $total_mo;?></td>
										</tr>					
									</tbody>
								</table>
								</div>
							</div>




							<div class="col-md-12">
								<div class="row" style="border: 2px solid #000">
									<div class="col-md-4 text-center">
									<br>
									<br>
									<br>
										Class Teacher Sign
									</div>
									<div class="col-md-4 text-center">
									<br>
									<br>
									<br>
										Vice Principal Sign
									</div>
									<div class="col-md-4 text-center">
									<br>
									<br>
									<br>
										Principal Sign
									</div>
									<div class="col-md-12 text-left" style="margin-top: 10px;">
										
									</div>
								</div>

							</div>
						</div>


						<!--</div>Border div-->
					</div>
					
				</div>
			</div>
			<!-- end page content -->
				<?php include 'footer.html';?>













