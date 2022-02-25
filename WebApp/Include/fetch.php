<?php
require("config.php");
$val;
$query= "SELECT  * FROM waterlevel where Id='1'";
if($result= mysqli_query($conn,$query)){
	$data=mysqli_num_rows($result);
	$r=mysqli_fetch_assoc($result);
	$val["SystemState"]=$r['SystemState'];
	$val["PumpState"]=$r['PumpState'];
	$val["WaterLevel"]=$r['WaterLevel'];
	echo json_encode($val);
	}
?>