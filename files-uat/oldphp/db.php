<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'saipooja';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);



if (function_exists('date_default_timezone_set'))
{
  date_default_timezone_set('Asia/Kolkata');
}

?>      
