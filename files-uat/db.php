<?php
/* Database connection settings */
$host = '182.50.133.81';
$user = 'saipoojapreprod'; 
$pass = 'qwer123$';
$db = 'saipoojapreprod';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);



if (function_exists('date_default_timezone_set'))
{
  date_default_timezone_set('Asia/Kolkata');
}

?>      
