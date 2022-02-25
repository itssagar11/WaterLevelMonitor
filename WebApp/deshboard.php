<?php
  session_start();
    if(!isset($_SESSION['login_user'])){
      echo "<b>Access denied.</b><a href='http://localhost/WaterLevelMonitor/index'> Goto Login Page</a>";
    die();
  }

?>
<!DOCTYPE>
<html>
  <head>
    <meta data-rh="true" name="theme-color" content="#000000" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
  </head>
<style>
  body{
   
    margin:auto;
    border: 2px solid blue;
  }
  .main{
    font-family: 'Abril Fatface', cursive;
font-family: 'Roboto Condensed', sans-serif;
    width:90%;
    overley:fixed;
    height:90%;
    display:flex;
    
    padding:5px;
    flax-wrap:nowrap;
    margin:auto;
    justify-content:space-around;
    
  }
  .left,.right{
    border:1px solid red;
    
  }
  .chart-container{
    margin:auto;
    
  }
  .chart{
    width:50%;
    height:50%;
    display: flex;
    flex-wrap: nowrap;
  }
  #pump{
       box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #b30000;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #008000;
}

input:focus + .slider {
  box-shadow: 0 0 1px #008000;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
  .chart_div{
    width: 100%; height: 100%;
   
  }
  @media only screen and (max-width: 380px){
    .chart-container{
      border: 1px solid orange;
      height: 100%;
      overflow: hidden;
    }
     .chart{
        width: 80%;
      height:80%;
     // display: flex;
    flex-wrap: wrap;
  }
  .chart_div{
    width:79%; height:79%;
    margin: auto;
   
  }
  .chart-reading{
      margin:auto;
  }


  }
  
  </style>
<body>
  <div class="main">
    <div class="left">
      <center>
        <h2 >
        Water Level Monitor
      </h2>
      </center>
      
      <h1>
        <div style="display:flex; margin:auto;">
        
      </h1>
      <div class="chart-container">
        
        <div class="chart">
           <div id="chart_div" style=""></div>
        </div>
        <div class="chart-reading">
         <!--
         Pump State
          <div id="pump" id="ps"style="width:40px; height:40px; background-color:green; border-radius:50%;">
          -->
            
          </div>
        </div>
        
      </div>
     
      
    </div>
   
  </div>
  
</body>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      $(document).ready(function(){
        chart();
         
      });
      function chart(){
      $.ajax({
         url:'Include/fetch.php',
          success:function(response){
            var d=JSON.parse(response)
            console.log(d.WaterLevel);
            var p=parseInt(d.PumpState);
              var di=parseInt(d.WaterLevel);
              
           
             google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
         function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Water', di],
          
        ]);

        var options = {
          width: 300, height: 330,
          yellowFrom: 0, yellowTo: 20,
          greenFrom:20, greenTo: 80,
          redFrom:80, redTo: 100,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

       
      }
      if(p==1){
                   document.getElementById("ps").style.color = "red";
              }else{
                   document.getElementById("ps").style.color = "green";
              }

    }   
    });
    }
           

     
     
      setInterval(function(){
          chart();
        },2000);
      
    </script>
</html>