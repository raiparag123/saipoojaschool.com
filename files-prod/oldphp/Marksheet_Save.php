<?php
ob_start();
session_start();
require 'db.php';
$fy_id=$_SESSION["fy_id"];  



if(isset($_POST['MarksUpdate'])){
	
	$cs_id=$_POST['cs_id'];
	$stud_term_id=$_POST['stud_term_id'];
	$term_id=$_POST['term_id'];
	$marks_obtained=$_POST['txtmarksobtain'];
	$total_marks=$_POST['txtmaxmarks'];
	$percentage=$_POST['txtpercent'];
	$result=$_POST['selectresult'];
	
	//print_r(array_keys($item1));

	

	$stmt = $mysqli->prepare("delete from student_marks_obtain_master where student_term_id=?");
	$stmt->bind_param("d",$stud_term_id);
	if ($stmt->execute()) { 
	$marks_name = array('NA','ut1','act1','int1','sa1','ut2','act2','int2','sa2');
	$max_marks=0;
	$flag=0;
	foreach ($_POST['rows'] as $item) { 
	
	
		if($term_id==1){
			$stmt = $mysqli->prepare("insert into  student_marks_obtain_master (marks_name_id,marks_obtained,subject_id,grade,max_marks,student_term_id) values (?,?,?,?,?,?)");
			for($j=1;$j<5;$j++){
			$stmt->bind_param("dsdsdd",$j,$item[$marks_name[$j]],$item['subj'],$item['grade'],$max_marks,$stud_term_id);
			if (!$stmt->execute()) 
			$flag=1;
			

			}
		}
		else if($term_id ==2){
			$stmt = $mysqli->prepare("insert into  student_marks_obtain_master (marks_name_id,marks_obtained,subject_id,grade,max_marks,student_term_id) values (?,?,?,?,?,?)");
			for($j=5;$j<9;$j++){
			$stmt->bind_param("dsdsdd",$j,$item[$marks_name[$j]],$item['subj'],$item['grade'],$max_marks,$stud_term_id);
			//echo $item[$marks_name[$j]]." || ".$item['subj']." || ".$item['grade']." || ".$max_marks." || ".$stud_term_id."<br> ";
			if (!$stmt->execute()) 
			$flag=1;
			

			}


		}

	}
					$stmt = $mysqli->prepare("update student_term_master set total_marks_obtained=? ,total_marks=?,percentage=?,result=? where student_term_id=?");
					$stmt->bind_param("ddddd",$marks_obtained,$total_marks,$percentage,$result,$stud_term_id);
					if (!$stmt->execute())
					$flag=1;
					
					if($flag==0)
					header("Location:marksheet.php?cs=".$cs_id."&term=".$term_id."");
				}  
					else
					{
						
					echo "Error found at deletion";

					}
					



}
if(isset($_POST['MarksSave'])){
	

	$cs_id=$_POST['cs_id'];
	$term_id=$_POST['termdrp'];
	$marks_obtained=$_POST['txtmarksobtain'];
	$total_marks=$_POST['txtmaxmarks'];
	$percentage=$_POST['txtpercent'];
	$result=$_POST['selectresult'];
	$item1=$_POST['rows'];
	print_r(array_keys($item1));
	$stmt = $mysqli->prepare("insert into  student_term_master (term_id,cs_id,total_marks_obtained,total_marks,percentage,result) values (?,?,?,?,?,?)");
			$stmt->bind_param("dddddd",$term_id,$cs_id,$marks_obtained,$total_marks,$percentage,$result);
			if (!$stmt->execute()) { 
				trigger_error('Error executing MySQL query: ' . $stmt->error);
				$status = 0;
				}else
				{
					$stud_term_id=$mysqli->insert_id; 
					$maxmarks=0;
					$max_marks=array();
					$stmt = $mysqli->prepare("SELECT max_marks from marks_name_master where fy_id=?");
					$stmt->bind_param("d",$fy_id);
					$result = $stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($maxmarks);
					$i=1;		
					$numberofrows = $stmt->num_rows;
					//echo $numberofrows."<br>";
					//echo $fy_id;		
					while($data = $stmt->fetch()){
						$max_marks[$i]=$maxmarks;
	//					echo $max_marks[$i]."<br>";
						//echo $i;
						$i++;
					}
					$marks_name = array('NA','ut1','act1','int1','sa1','ut2','act2','int2','sa2');
				 $flag=0;
					foreach ($_POST['rows'] as $item) {
	
	
						if($term_id==1){
							$stmt = $mysqli->prepare("insert into  student_marks_obtain_master (marks_name_id,marks_obtained,subject_id,grade,max_marks,student_term_id) values (?,?,?,?,?,?)");
							for($j=1;$j<5;$j++){
							$stmt->bind_param("dsdsdd",$j,$item[$marks_name[$j]],$item['subj'],$item['grade'],$max_marks[$j],$stud_term_id);
							$stmt->execute();

						}
					}  
						else {
							//echo $item['subj']."<br>";
							//echo "hello$$";
						$stmt = $mysqli->prepare("insert into  student_marks_obtain_master (marks_name_id,marks_obtained,subject_id,grade,max_marks,student_term_id) values (?,?,?,?,?,?)");
							for($j=5;$j<9;$j++){
							$stmt->bind_param("dsdsdd",$j,$item[$marks_name[$j]],$item['subj'],$item['grade'],$max_marks[$j],$stud_term_id);
							if (!$stmt->execute()) { 
								$flag=1;
								trigger_error('Error executing MySQL query: ' . $stmt->error);
								//$status = 0;
								}else
								{
									
									//echo 'Inserted';
								}
							 }



							

							
						}
					}
					if($flag == 0 )
					header("Location:marksheet.php?cs=".$cs_id."&term=".$term_id."");	
	




				}	
	
	
			}
	



?>