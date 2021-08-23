<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect("148.72.232.171","dbuser","qwer123$","saipooja");
    $query=mysqli_query($con, "select * from stud_regist_master where first_name LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['first_name'];
    }
    echo json_encode($array);
    mysqli_close($con);
?>
