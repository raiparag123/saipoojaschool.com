<?php
ob_start();
require 'db.php'; 
session_start();
$fy_id=5;
$fy_id=$_SESSION["fy_id"];
if(isset($_POST["del_user"]))	{
						$userid=$_POST['del_user'];
						$stmt = $mysqli->prepare("delete from user_master where user_id=?");
						$stmt->bind_param("d",$userid);
						if (!$stmt->execute()) { 
								trigger_error('Error executing MySQL query: ' . $stmt->error);
								$status=0;
						
						}else {
							$status=1;
							
						}
						$stmt->close();
						
						echo $status;
						exit;
		
		
		
	}
	
if(isset($_POST["marksdisp"]))	{
	
foreach ($_POST['rows'] as $item) {
	
	echo $item['subj'];
	
}


$fname=$_POST["father_name1"];

echo $fname;
	
	
}




if(isset($_POST["marksvalues"]))	{
	$fy_id=5;
	$first_name="";
	$father_name="";
	$mother_name="";
	$class_name="";
	$regno="";
	$class_id="";
	$regid=$_POST["marksvalues"];
	$stmt = $mysqli->prepare("SELECT a.first_name,a.father_name,a.mother_name,c.class_name,a.regno,c.class_id FROM stud_regist_master a,class_stud_master b,class_master c where a.registration_id=b.student_id and b.class_id=c.class_id and a.registration_id=? and b.fy_id=?");
	$stmt->bind_param("dd",$regid,$fy_id);
	$result = $stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($first_name,$father_name,$mother_name,$class_name,$regno,$class_id);
	$d=array();
	$d[0][0]="error";
		$d[0][1]="error";
		$d[0][2]="error";
		$d[0][3]="error";
		$d[0][4]="error";
	while($data = $stmt->fetch())
		{
		$d[0][0]=$first_name;
		$d[0][1]=$father_name;
		$d[0][2]=$mother_name;
		$d[0][3]=$class_name;
		$d[0][4]=$regno;
		}
		$subject_id="";
		$subject_name="";
		$stmt = $mysqli->prepare("SELECT a.subject_id,b.subject_name FROM class_subject_master a,subject_master b where a.subject_id=b.subject_id and a.fy_id=? and a.class_id=?");
		$stmt->bind_param("dd",$fy_id,$class_id);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($subject_id,$subject_name);
		$numberofrows = $stmt->num_rows;
		$counter=1;
		while($data = $stmt->fetch())
			{
				$d[$counter][0]=$subject_id;
				$d[$counter][1]=$subject_name;
				$counter++;
			}
			
			$d[0][5]=$numberofrows;
		echo json_encode($d);
		$stmt->close();
	
}
	














?>

