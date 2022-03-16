<?php
ob_start();
require 'db.php'; 
session_start();
$fy_id=$_SESSION["fy_id"];
$class_id="";

if(isset($_POST["editload"]))	
{
	$stud_term_id=$_POST["editload"];
	$term_id=$_POST["term_id"];
	if($term_id ==1){
					$stmt = $mysqli->prepare("select s.subject_name,s.subject_id,b.marks_name_id,b.marks_obtained,b.grade from student_term_master a,student_marks_obtain_master b ,subject_master s  where b.subject_id= s.subject_id and a.student_term_id=b.student_term_id and a.student_term_id=?");
					$stmt->bind_param("d",$stud_term_id);
					$result = $stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($subject_name,$subject_id,$marks_name,$marks_obt,$grade);
					$numberofrows = $stmt->num_rows;
					$marks_arr=array();
					$marks_arr[0][0]=$numberofrows;
					$i=1;
					$j=2;
					while($data = $stmt->fetch()){
						if($marks_name == 1)
						{
							$marks_arr[$i][0]=$subject_id;
							$marks_arr[$i][1]=$subject_name;
							$marks_arr[$i][6]=$grade;
						}
						$marks_arr[$i][$j]=$marks_obt;

						if($marks_name == 4){
							$j=1; 
							$i++;
						}
						$j++;
						


					}
					$marks_arr[0][1]=$i-1;

					echo json_encode($marks_arr);
					}
					else if($term_id==2){

						$stmt = $mysqli->prepare("select s.subject_name,s.subject_id,b.marks_name_id,b.marks_obtained,b.grade from student_term_master a,student_marks_obtain_master b ,subject_master s  where b.subject_id= s.subject_id and a.student_term_id=b.student_term_id and a.cs_id=(select cs_id from student_term_master where student_term_id=?) and a.term_id in (1,2) order by b.subject_id,b.marks_name_id");
						$stmt->bind_param("d",$stud_term_id);
						$result = $stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($subject_name,$subject_id,$marks_name,$marks_obt,$grade);
						$numberofrows = $stmt->num_rows;
						$marks_arr=array();
						$marks_arr[0][0]=$numberofrows;
						$i=1;
						$j=2;
						while($data = $stmt->fetch()){
							
								
							
							$marks_arr[$i][$j]=$marks_obt;
	
							if($marks_name == 8){
								$marks_arr[$i][0]=$subject_id;
								$marks_arr[$i][1]=$subject_name;
								$marks_arr[$i][10]=$grade;
								$j=1; 
								$i++;
							}
							$j++;
							
	
	
						}
						$marks_arr[0][1]=$i-1;
	
						echo json_encode($marks_arr);
					}

}

if(isset($_POST["term_change"]))	{

	$term_id=$_POST["term_change"];
	$student_id=$_POST["student_id"];
	$count=1;

	$stmt = $mysqli->prepare("SELECT c.class_id   FROM student_term_master a,stud_regist_master b,class_stud_master c where a.cs_id=c.cs_id and c.student_id=b.registration_id and c.fy_id=? and a.term_id=? and b.registration_id=?");
	$stmt->bind_param("ddd",$fy_id,$term_id,$student_id);
	$result = $stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($class_id);
	$numberofrows = $stmt->num_rows;
	$d=array();
	$d[0][0]=$numberofrows;
	while($data = $stmt->fetch()){}
	$d[0][3]=$count;
		if($numberofrows == 0 ){
			
			if($term_id ==2){

				// $stmt = $mysqli->prepare("select count(*)  from student_term_master a, class_stud_master b where a.cs_id=b.cs_id and b.student_id=? and a.term_id=1");


				$stmt = $mysqli->prepare("						
					SELECT
					count(student_term_id)
					FROM
					student_term_master a
					WHERE
					cs_id = (
						SELECT
							cs_id
						FROM
							class_stud_master
						WHERE
							student_id = ?
							and fy_id = ?) and term_id = 1
				");
				$stmt->bind_param("dd",$student_id,$fy_id);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($count);
				$norws = $stmt->num_rows;
				while($data = $stmt->fetch()){}
				$d[0][3]=$count;
				
			}


		




				$subject_id="";
				$subject_name="";
				$class_id=1;
				/* codechanges in code : march2022
				 $stmt = $mysqli->prepare("SELECT a.subject_id,b.subject_name FROM class_subject_master a,subject_master b where a.subject_id=b.subject_id and a.fy_id=? and a.class_id=?"); */
				$stmt = $mysqli->prepare("SELECT a.subject_id,b.subject_name FROM class_subject_master a,subject_master b where a.subject_id=b.subject_id and a.fy_id=? and a.is_delete=1 and b.is_delete=1 and a.class_id=(select b.class_id from stud_regist_master a,class_stud_master b where b.is_delete = 1 and a.registration_id=b.student_id and b.fy_id=? and a.registration_id=?)");
				$stmt->bind_param("ddd",$fy_id,$fy_id,$student_id);
				$result = $stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($subject_id,$subject_name);
				$numberofrows = $stmt->num_rows;
				$counter=1;
				$marks_obt=0;
				$counter1=2;
				while($data = $stmt->fetch())
					{

						$d[$counter][0]=$subject_id;
						$d[$counter][1]=$subject_name;

						if($term_id ==2 ){

								$counter1=2;
								$stmt1 = $mysqli->prepare("SELECT a.marks_obtained FROM student_marks_obtain_master a, marks_name_master b where a.marks_name_id=b.marks_name_id and student_term_id=(select student_term_id from student_term_master where term_id=1 and cs_id=(select cs_id from class_stud_master where student_id=? and fy_id=? )) and a.subject_id=?");
								$stmt1->bind_param("ddd",$student_id,$fy_id,$subject_id);
								$result1 = $stmt1->execute();
								$stmt1->store_result();
								$stmt1->bind_result($marks_obt);
								$d[0][3]= $stmt1->num_rows;

								while($data1 = $stmt1->fetch())
								{
									$d[$counter][$counter1]=$marks_obt;
									$counter1++;
							
								}
								if($d[0][3] == 0 ){
									$d[$counter][2]='';
									$d[$counter][3]='';
									$d[$counter][4]='';
									$d[$counter][5]='';


								}

						}
						

						$counter++;
					}
					
					$d[0][1]=$numberofrows;
					$d[0][2]=$class_id;

		}

	echo json_encode($d);




}








if(isset($_POST["marksvalues"]))	{
	//$fy_id=5;
	$first_name="";
	$father_name="";
	$mother_name="";
	$class_name="";
	$cs_id="";
	$regno="";
	$class_id="";
	$regid=$_POST["marksvalues"];
	$stmt = $mysqli->prepare("SELECT b.cs_id,a.first_name,a.father_name,a.mother_name,c.class_name,a.regno,c.class_id FROM stud_regist_master a,class_stud_master b,class_master c where a.registration_id=b.student_id and b.class_id=c.class_id and a.registration_id=? and b.fy_id=?");
	$stmt->bind_param("dd",$regid,$fy_id);
	$result = $stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($cs_id,$first_name,$father_name,$mother_name,$class_name,$regno,$class_id);
	$d=array();
	$d[0][0]="Something has gone wrong. Contact your website administrator";
		$d[0][1]="Something has gone wrong. Contact your website administrator";
		$d[0][2]="Something has gone wrong. Contact your website administrator";
		$d[0][3]="Something has gone wrong. Contact your website administrator";
		$d[0][4]="Something has gone wrong. Contact your website administrator";
	while($data = $stmt->fetch())
		{
		$d[0][0]=$first_name;
		$d[0][1]=$father_name;
		$d[0][2]=$mother_name;
		$d[0][3]=$class_name;
		$d[0][4]=$regno;
		$d[0][5]=$cs_id;
		}
		echo json_encode($d);
		$stmt->close();
	
}
	














?>

