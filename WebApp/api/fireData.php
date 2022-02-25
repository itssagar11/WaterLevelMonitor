<?php
 header("Access-Control-Allow-Origin: *");
 header("Content-Type:application/json;charset-UTF-8");
 require("../Include/config.php");
 $response=array();
 if(isset($_GET['PumpState']) && isset($_GET['SystemState']) && isset($_GET['WaterLevel'])){

 	$system=$_GET['SystemState'];
 	$pump=$_GET['PumpState'];
 	$water=$_GET['WaterLevel'];
 	$query= "UPDATE  waterlevel SET SystemState='$system',PumpState='$pump',WaterLevel='$water' where Id=1";
 	if(mysqli_query($conn,$query)){
 	    $response['SystemState']=$system;
 	    $response['PumpState']=$pump;
 	    $response['WaterLevel']=$water;
 		echo json_encode($response);
 	}else{
 		echo mysqli_error($conn);
 	}
 }else{
 	echo "No data";
 	}

//echo "hii";
?>