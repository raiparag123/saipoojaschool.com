<?php
ob_start();
require 'db.php'; 
session_start();
if(!isset($_SESSION["loginid"])){
	header('Location:login.php');	
}

$fy_id=$_SESSION["fy_id"];

?>

	<?php require 'header.php';?>
	<!-- start page content -->
	
	
				<!-- end page content -->
			<?php include 'footer.html';?>