<?php
$host="localhost";
$user="u682919420_Sagar";
$pass="0135India";
$db="u682919420_WaterLevelMoni";
if($conn= mysqli_connect($host,$user,$pass,$db)){
  //  echo "success";
}else{
    echo mysqli_error($conn);
}
// or die(mysqli_error($conn));
?>