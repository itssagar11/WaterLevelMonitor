<?php
require("config.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // echo "hi";
$username=mysqli_real_escape_string($conn,$_POST['user']);	
$password=$_POST['password']; 
//echo "0";
 if ($username != "" && $password != ""){

        $query= "SELECT * FROM login WHERE 	User='$username' And Pass='$password'";
          if(!$result = mysqli_query($conn,$query)) echo mysqli_error();
          if (mysqli_num_rows($result)>0){
          	 session_start();
            $row= mysqli_fetch_assoc($result);
            $_SESSION['login_user']= $row;
             echo 1;
          }else{
          	echo 0;
          }
}
}
?>