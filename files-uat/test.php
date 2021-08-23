<?php
ob_start();
require 'db.php';


$marksobtained='0';
$subjectid=16;
$grade='A1';
$max=0;
$stmt = $mysqli->prepare("select  a.student_term_id,a.term_id from student_term_master a, class_stud_master b  where a.cs_id=b.cs_id and b.fy_id=5");
$result = $stmt->execute();
$stmt->store_result();
$stmt->bind_result($stermid,$termid);
$count=$stmt->num_rows;
while($data = $stmt->fetch()) {
    if($termid==1){
        $counter=1;
        for($counter=1;$counter < 5;$counter++){
            $stmt1 = $mysqli->prepare("insert into student_marks_obtain_master (marks_name_id,marks_obtained,subject_id,student_term_id,grade,max_marks) values (?,?,?,?,?,?)");
            $stmt1->bind_param("dsddsd",$counter,$marksobtained,$subjectid,$stermid,$grade,$max);
            $result1 = $stmt1->execute();
            $stmt1->close();
        }
    }
    else{
        $counter=5;
        for($counter=5;$counter < 9;$counter++){
            $stmt1 = $mysqli->prepare("insert into student_marks_obtain_master (marks_name_id,marks_obtained,subject_id,student_term_id,grade,max_marks) values (?,?,?,?,?,?)");
            $stmt1->bind_param("dsddsd",$counter,$marksobtained,$subjectid,$stermid,$grade,$max);
            $result1 = $stmt1->execute();
            $stmt1->close();
        }

    }
    

}
?>


