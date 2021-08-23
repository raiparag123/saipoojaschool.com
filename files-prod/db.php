<?php
/* Database connection settings */
$host = '182.50.133.81';
$user = 'saipoojaprod'; 
$pass = 'qwer123$';
$db = 'saipoojaprod';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);



if (function_exists('date_default_timezone_set'))
{
  date_default_timezone_set('Asia/Kolkata');
}

?>      
