<?php
require("include/config.php");
if(isset($_GET['PumpState']) && isset($_GET['SystemState']) && isset($_GET['WaterLevel'])){

	$system=$_GET['SystemState'];
	$pump=$_GET['PumpState'];
	$water=$_GET['WaterLevel'];
	$query= "UPDATE  waterlevel SET SystemState='$system',PumpState='$pump',WaterLevel='$water' where Id=1";
	if(mysqli_query($conn,$query)){
		echo "success";
	}else{
		echo mysqli_error($conn);
	}
}else{
	echo "No data";
}


?>