<?php 
    if(empty($_SESSION['signedin']))
    {
      $display_modal_window = 'signin';
      include('startpage.php');
      exit();
    }
?>
<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

// AWS configuration
$awsConfig = [
    'region' => 'us-east-2',
    'version' => 'latest',
    'credentials' => [
        'key' => 'key',
        'secret' => 'secret',
    ]
];

// Create a DynamoDB client
$dynamodb = new DynamoDbClient($awsConfig);

// Query DynamoDB to get the orderdate for 'user0002'
$params = [
    'TableName' => 'DHT11_data',  
];
$params0 = [
  'TableName' => 'Btemp_data',  
];
$params2 = [
    'TableName' => 'Flame_data',  
];
$params3 = [
    'TableName' => 'Gas_data',  
];
$params4 = [
  'TableName' => 'Move_data',
]

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap"
      rel="stylesheet"
    />
    <link 
      rel="stylesheet"
      href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function goToLambdaWebsite() {
            var lambdaURL = 'https://pjmm4fqo6jmfkprlriue2jeemy0gflrx.lambda-url.us-east-2.on.aws/';
            window.open(lambdaURL, '_blank').focus();
            }
        
        function goToLambdaWebsiteBad() {
        var lambdaURL = 'https://q6u7tzuhnzqeqnlawz2ho6ojj40czata.lambda-url.us-east-2.on.aws/';
        window.open(lambdaURL, '_blank').focus();
        }
    </script>
  </head>
  <style>
    html {
      font-size: 75%;
      font-family: "Poppins", sans-serif;
      scroll-behavior: smooth;
    }
    * {
      box-sizing: border-box;
    }
    body {
      width: 100%;
      height: 100vh;
      background-color: white;
      font-family: "Poppins", sans-serif;
    }
    .heading {
      text-align: center;
      font-size: 5rem;
      margin-bottom: 1rem;
      font-weight: bold;
      margin: 50px 0;
    }
    .heading2{
      text-align: center;
      font-size: 3rem;
      margin-bottom: 0.5rem;
      font-weight: bold;
      margin: 40px auto;
    }
    .heading3{
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 5rem;
      margin: 1rem 0;
    }
    .container{
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      margin: 1rem auto;
    }
    .content {
      height: 100vh;
    }
    .menu-icon {
      background-color: white;
      font-size: 400;
      height: 5rem;
      width: 5rem;
      padding: 1rem;
      border: none;
      border-radius: 3px;
      position: fixed;
      padding: 12px 16px;
      font-size: 30px;
      top: 20px;
      left: 20px;
      transition: transform 0.3s ease-in-out;
      z-index: 9999;
    }

    .menu-icon.active {
      transform: translate(440px);
      outline: 2px solid black;
    }
    .navbar {
      overflow-y: auto;
      background-color: white;
      border: black;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      transform: translate(-500px);
      transition: transform 0.3s ease-in-out;
      outline: 2px solid black;
      z-index: 9998;
    }
    .navbar.active {
      transform: translate(0);
    }
    .label {
      font-size: 5rem;
      font-weight: 500;
    }
    .check-btn{
      border-radius: 1rem;
      display: flex;
      text-align: center;
      justify-content: center;
      align-items: center;
      margin: 3rem auto;
      padding: 1rem;
      font-size: 1.5rem;
      font-weight: 500;
      cursor: pointer;
      outline: none;
      transition: 0.5s ease-in-out;
    }
    .check-btn:hover{
      transition: 0.5s ease-in-out;
      background: #4F95DA;
    }
    .btn {
      border-radius: 1rem;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      margin: 3rem 0;
      padding: 1rem;
      font-size: 1.5rem;
      font-weight: 500;
      cursor: pointer;
      outline: none;
      transition: 0.5s ease-in-out;
    }
    .btn:hover {
      transition: 0.5s ease-in-out;
      background: #4F95DA;
    }
    .btn span {
      color: black;
      font-size: 18px;
      font-weight: 100;
    }
    .profile {
      margin: 0 auto;
      padding: 10px 0 0 0;      
    }
    .navbtn {
      transform: translate(60px);
    }
    .username {
      /* display: block; */
      margin: 0 auto;
      padding: 10px 0 0 0;
      line-height: 150%;
      font-size: 2rem;
    }
    .container {
      margin: 0px;
      position: relative;
      color: #FFF;
      padding: 50px;
      width: 1000px;
      max-width: 100%;
      margin: 0 auto;
    }
    .button-container {
      width: 150px;
      height: 150px;
      position: relative;
      float: left;
      text-align: center;
    }
    .card {
      position: absolute;
      width: 150px;
      height: 150px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      transition: .3s;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      color: #FFF;
      text-decoration: none;
      background-color: black;
    }
    .card:hover {
      background-color: #FFF;
      border-radius: 5px;
      transition: .3s;
      width: 180px;
      height: 180px;
      -webkit-box-shadow: -17px 15px 45px -2px rgba(0,0,0,0.32);
      -moz-box-shadow: -17px 15px 45px -2px rgba(0,0,0,0.32);
      box-shadow: -17px 15px 45px -2px rgba(0,0,0,0.32);
      z-index: 1001;
    }
    .card-icon {
      color: #FFF;
      font-size: 60px;
      transition: .3s;
    }
    .card:hover .card-icon {
      color: black;
      font-size: 80px;
      transition: .3s;
    }
    .card-title {
      color: black;
      opacity: 0;
      font-weight: bold;
      position: absolute;
      text-transform: uppercase;
      bottom: 0;
      transition: .3s;
    }
    .card:hover .card-title {
      opacity: 1;
      transition: .3s;
    }
    .text-center{
      color: black;
      font-size: large;
    }
    hr {
      margin-top: 1rem;
      margin-bottom: 1rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
      color: black;
      font-size: bold;
    }
    .item-display{
      font-size: bold;
      margin: auto;
    }

    .centered-container {
  text-align: center;
}

.centered-container{
  margin-left: 440px;
}


    #logout:hover{
      transition: 0.5s ease-in-out;
      background: red;
    }
  </style>

  <body>
    <div class="row">
      <div class="content container-fluid">
        <h2 class="heading">Real Time Information from database</h2>
        <div class="container">
          <div class="button-container">
            <a href="#" id="user-display" class="card" style="z-index: 1000;">
              <p><i class="fa fa-user-circle-o card-icon"></i></p>
              <p class="card-title">User</p>
            </a>
          </div>
          
          <div class="button-container">
            <a href="#temp" class="card">
              <p><i class="fa fa-thermometer-0 card-icon"></i></p>
              <p class="card-title">Temperature and Humidity</p>
            </a>
          </div>

          <div class="button-container">
            <a href="#gas" class="card">
              <p><i class="fa fa-solid fa-fire-extinguisher card-icon"></i></p>
              <p class="card-title">Gas</p>
            </a>
          </div>
          
          <div class="button-container">
            <a href="#flame" class="card">
              <p><i class="fa fa-solid fa-fire card-icon"></i></p>
              <p class="card-title">Flame</p>
            </a>
          </div>
          
          <div class="button-container">
    <a href="#motion" class="card">
     
    <img src="image/door_open.webp" alt="Description of the image" width="200" height="150">

     
        <p class="card-title">Motion</p>
    </a>
</div>

          <br>
          <br>
        </div>
      </div>

      <div class="centered-container">
  <h1 class="heading3">Working State</h1>
  <button class="check-btn" onclick="goToLambdaWebsite()">On work</button>
  <button class="check-btn" onclick="goToLambdaWebsiteBad()">Off Work</button>
</div>


      <div class="container-fluid content">
        <div class="info-content">
        <?php
        
            $result0 = $dynamodb->scan($params0);
             
            if ($result0['Count'] > 0) { // Gas Sensor
             
              $orderdate = array();
              function sortByTimestamp($a, $b) {
                $timestampA = strtotime($a['timestamp']['S']);
                $timestampB = strtotime($b['timestamp']['S']);
                return $timestampB - $timestampA;
            }

              usort($result0['Items'], 'sortByTimestamp');
              
              foreach ($result0['Items'] as $item) {
                  $timestamp = $item['timestamp']['S'];
                  $user = $item['user']['S'];
                  $temp = $item['temp']['N'];
                  $status = $item['status']['S'];
                  
                  if($status == 'G') {
                    $imageTemp = '<img src="image/fever_off.png" alt="Image1" width="170" height="170">';
                } else if($status == 'N') {
                    $imageTemp = '<img src="image/fever_on.png" alt="Image2" width="170" height="170">';
                } else {
                    $imageTemp = '';
                }
                
                $a = "<h1 class='heading3'>Check in User: $user</h1> <h2 class='heading2'>$timestamp, Temperature: $temp °C</h2> $imageTemp";

                  // Use $timestamp, $tf, and $temperature for further processing
                    $a = "<h1 class='heading3'>Check in User: $user</h1> <h2 class='heading2'>$timestamp, Temperature: $temp °C $imageTemp</h2>";

                  array_push($orderdate, $a);
              } 

              $firstItem = array_shift($orderdate);
              echo $firstItem;

              echo '<button id="showMoreButton0" class="check-btn" onclick="toggleShowMore0()">Show More</button>';
              // Hidden div to hold the remaining items
              echo '<div id="moreItems0" style="display:none;">';  
              
              $count = 0;
              foreach($orderdate as $item){
                if($count == 0){
                  
                }
                $count += 1;
                echo "<table class='table'>";
                echo "<tr>";            
                echo "<td class='item-display' style='font-size:15px; margin: auto;'>$item</td>";
                echo "</tr>";
                echo "</table>"; 
                echo "<br>";
                if($count == 10)
                {
                  break;
                }
              };
              echo '</div>';
            }
          ?>
          <hr/>
          
          <div class="container" id="temp">
              <p class="text-center heading2" style="font-size: 5rem;">Temperature and Humidity</p>
          </div>
          <?php

            $result = $dynamodb->scan($params);

            if ($result['Count'] > 0) { // DHT_11 with Temperature and Humidity
              $orderdate = array();

              

              usort($result['Items'], 'sortByTimestamp');

              foreach ($result['Items'] as $item) {
                  $timestamp = $item['timestamp']['S'];
                  $temperature = $item['temp']['N']; // Assuming 'temp' is a number attribute
                  $humidity = $item['hu']['N'];
                  $condition = $item['condition']['S'];
                  // $condition = "LT";

                  
                  $imageTag = '';
                  $imageTagH = '';
                  switch ($condition) {
                    case "LH":
                        // If temperature is greater than 20 and humidity is high, add an image tag
                        $imageTag = '<h2>Good temperature</h2><img src="image/good_temperature.png" alt="Hot Temperature and High Humidity Image width="200" height="200">';
                        $imageTagH = '<h2>Low Humidity</h2><img src="image/low_humidity.png" alt="Low Humidity Image" width="200" height="200">';
                        break;
                    case "LT":
                        $imageTag = '<h2>Low Temperature</h2><img src="image/low_temperature.png" alt="Low Temperature Image" width="200" height="200">';
                        $imageTagH = '<h2>Good Humidity</h2><img src="image/good_humidity.png" alt="Low Temperature Image" width="200" height="200">';

                        break;
                    case "HH":
                        $imageTag = '<h2>Good Temperature</h2><img src="image/good_temperature.png" alt="High Humidity Image" width="200" height="200">';
                        $imageTagH = '<h2>High Humidity</h2><img src="image/high-humidity.png" alt="Low Humidity Image" width="180" height="180">';
                        break;
                    case "HT":
                        $imageTag = '<h2>High Temperature</h2><img src="image/high_temperature.png" alt="High Temperature Image" width="200" height="200">';
                        $imageTagH = '<h2>Good Humidity</h2><img src="image/good_humidity.png" alt="High Temperature Image" width="200" height="200">';
                        break;
                    case "LTH":
                      $imageTag = '<h2>Low Temperature</h2><img src="image/low_temperature.png" alt="High Temperature Image" width="200" height="200">';
                      $imageTagH = '<h2>Low Humidity</h2><img src="image/low_humidity.png" alt="High Temperature Image" width="200" height="200">';
                        break;
                    case "HTH":
                      $imageTag = '<h2>High Temperature</h2><img src="image/high_temperature.png" alt="High Humidity Image" width="200" height="200">';
                      $imageTagH = '<h2>High Humidity</h2><img src="image/high-humidity.png" alt="Low Humidity Image" width="180" height="180">';
                      break;
                    case "N":
                      $imageTag = '<h2>Good Temperature</h2><img src="image/good_temperature.png" alt="High Humidity Image" width="200" height="200">';
                      $imageTagH = '<h2>Good Humidity</h2><img src="image/good_humidity.png" alt="Low Temperature Image" width="200" height="200">';
                    default:
                        break;
                }

                  // Use $timestamp, $humidity, and $temperature for further processing
                  $temperature_humidity = "<div style='display: flex; justify-content: space-between; margin: 0 20px;'>"
                      . "<div style='margin-left: 200px; margin-right: 50px;'>"
                      . "<h3><strong>$timestamp</strong></h3>"
                      . "<h2 style='margin-left: 20px;'>Temperature: $temperature °C</h2>"
                      . "<div style='margin-top: 20px; margin-left: 20px;'>$imageTag</div>"
                      . "</div>"
                      . "<div style='margin-left: 50px; margin-right: 300px;'>"
                      . "<h3><br></h3>"
                      . "<h2 style='margin-left: 20px;'>Humidity: $humidity %</h2>"
                      . "<div style='margin-top: 20px; margin-left: 20px;'>$imageTagH</div>"
                      . "</div>"
                      . "</div>";
                  array_push($orderdate, $temperature_humidity);
              }
              $count = 0; 
              $firstItem = array_shift($orderdate);
              echo $firstItem;

              echo '<button id="showMoreButton" class="check-btn" onclick="toggleShowMore()">Show More</button>';
              // Hidden div to hold the remaining items
              echo '<div id="moreItems" style="display:none;">';  
              
              $count = 0;
              foreach($orderdate as $item){
                if($count == 0){
                  
                }
                $count += 1;
                echo "<table class='table'>";
                echo "<tr>";            
                echo "<td class='item-display' style='font-size:15px; margin: auto;'>$item</td>";
                echo "</tr>";
                echo "</table>"; 
                echo "<br>";
                if($count == 10)
                {
                  break;
                }
              };
              echo '</div>';
            }
            ?>
            <hr/>

          <div class="container" id="gas">
              <Gas class="text-center heading2" style="font-size: 5rem;">Gas Sensor</p>
          </div>
          <?php
            $result3 = $dynamodb->scan($params3);
            if ($result3['Count'] > 0) { // Gas Sensor

              $orderdate = array();

              usort($result3['Items'], 'sortByTimestamp');
              
              foreach ($result3['Items'] as $item) {
                  $timestamp = $item['timestamp']['S'];
                  $tf = $item['status']['S'];

                  $imageTagGas = '';
                  if($tf == "H")
                  {
                    $imageTagGas = '<h2 style="color: red; font-size: 34px; font-weight: bold;">Danger</h2><img src="image/gas.png" alt="Low Temperature Image" width="300" height="300">';
                  }

                  else if($tf = "N")
                  {
                    $imageTagGas = '<h2 style="color: black; font-size: 24px; font-weight: bold;">No Gas</h2><img src="image/no_gas.png" alt="Low Temperature Image" width="200" height="100">';
                  }

                  // Use $timestamp, $tf, and $temperature for further processing
                  $a = "<h3 style='text-align: center;'>$timestamp</h3><div style='text-align: center;'>$imageTagGas</div>";

                  array_push($orderdate, $a);
              } 

              $firstItem = array_shift($orderdate);
              echo $firstItem;

              echo '<button id="showMoreButton2" class="check-btn" onclick="toggleShowMore2  ()">Show More</button>';
              // Hidden div to hold the remaining items
              echo '<div id="moreItems2"style="display:none;">';  
              
              $count = 0;
              foreach($orderdate as $item){
                if($count == 0){
                  
                }
                $count += 1;
                echo "<table class='table'>";
                echo "<tr>";            
                echo "<td class='item-display' style='font-size:15px; margin: auto;'>$item</td>";
                echo "</tr>";
                echo "</table>"; 
                echo "<br>";
                if($count == 10)
                {
                  break;
                }
              };
              echo '</div>';
            }
          ?>
          <hr/>

          <div class="container" id="flame">
              <p class="text-center heading2" style="font-size: 5rem;">Flame Sensor</p>
          </div>
          <?php

            $result2 = $dynamodb->scan($params2);

            if ($result2['Count'] > 0) { // Flame Sensor
              usort($result2['Items'], 'sortByTimestamp');

              $orderdate = array();
              foreach ($result2['Items'] as $item) {
                  $timestamp = $item['timestamp']['S'];
                  $flame = $item['fire']['S']; // Assuming 'booleanField' is a boolean attribute

                  $imageTagFlame = '';
                  if($flame == "false")
                  {
                    $imageTagFlame = '<h2 style="color: black; font-size: 24px; font-weight: bold;">No Flame</h2><img src="image/flame_off.png" alt="Low Temperature Image" width="150" height="120">';
                  }

                  else if($flame == "true")
                  {
                    $imageTagFlame = '<h2 style="color: red; font-size: 34px; font-weight: bold;">Danger</h2><img src="image/flame_on.gif" alt="Low Temperature Image" width="200" height="230">';
                  }

                  // Use $timestamp, $tf, and $temperature for further processing
                  $a = "<h3 style='text-align: center;'> $timestamp</h3><div style='text-align: center;'>$imageTagFlame</div>";
                  array_push($orderdate, $a);
              }
              $firstItem = array_shift($orderdate);
              echo $firstItem;

              echo '<button id="showMoreButton3" class="check-btn" onclick="toggleShowMore3()">Show More</button>';
              // Hidden div to hold the remaining items
              echo '<div id="moreItems3" style="display:none;">';  
              
              $count = 0;
              foreach($orderdate as $item){
                if($count == 0){
                  
                }
                $count += 1;
                echo "<table class='table'>";
                echo "<tr>";            
                echo "<td class='item-display' style='font-size:15px; margin: auto;'>$item</td>";
                echo "</tr>";
                echo "</table>"; 
                echo "<br>";
                if($count == 10)
                {
                  break;
                }
              };
              echo '</div>';
            }
          ?>
          <hr/>
          <div class="container" id="motion">
              <p class="text-center heading2" style="font-size: 5rem;">Proximity Sensor</p>
          </div>
          <?php

            $result4 = $dynamodb->scan($params4);

            if ($result4['Count'] > 0) { // Flame Sensor
              usort($result4['Items'], 'sortByTimestamp');

              $orderdate = array();
              foreach ($result4['Items'] as $item) {
                  $timestamp = $item['timestamp']['S'];
                  $flame = $item['move']['S']; // Assuming 'booleanField' is a boolean attribute

                  $imageTagFlame = '';
                  if($flame == "false")
                  {
                    $imageTagFlame = '<h2 style="color: black; font-size: 24px; font-weight: bold;">No Motion</h2><img src="image/motion_off.avif" alt="Low Temperature Image" width="200" height="200">';
                  }

                  else if($flame == "true")
                  {
                    $imageTagFlame = '<h2 style="color: black; font-size: 34px; font-weight: bold;">Motion Detected</h2><img src="image/motion_on.webp" alt="Low Temperature Image" width="200" height="200">';
                  }

                  // Use $timestamp, $tf, and $temperature for further processing
                  $a = "<h3 style='text-align: center;'> $timestamp</h3><div style='text-align: center;'>$imageTagFlame</div>";
                  array_push($orderdate, $a);
              }
              $firstItem = array_shift($orderdate);
              echo $firstItem;

              echo '<button id="showMoreButton4" class="check-btn" onclick="toggleShowMore4 ()">Show More</button>';
              // Hidden div to hold the remaining items
              echo '<div id="moreItems4" style="display:none;">';  
              
              $count = 0;
              foreach($orderdate as $item){
                if($count == 0){
                  
                }
                $count += 1;
                echo "<table class='table'>";
                echo "<tr>";            
                echo "<td class='item-display' style='font-size:15px; margin: auto;'>$item</td>";
                echo "</tr>";
                echo "</table>"; 
                echo "<br>";
                if($count == 10)
                {
                  break;
                }
              };
              echo '</div>';
            }
          ?>
          <hr/>


      <div class="menu">
        <button type="button" class="menu-icon" id="hamburgerBtn">
           <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="navbar" id="navbar">
        <div class="container-fluid">
          <form class="form-horizontal profile">
            <div class="form-group">
              <h5 class="heading2">Menu</h5>
              
              <button type="button" class="btn" id="DHT" name="DHT" value="DHT11">
                <span href="#temp">Temperature and Humidity</span>
              </button>
              <button type="button" class="btn" id="gas" name="gas" value="gas">
                <span>Gas</span>
              </button>
              <button type="button" class="btn" id="flame" name="flame" value="flame">
                <span>Flame</span>
              </button>
              <button type="button" class="btn" id="motion" name="motion" value="motion">
                <span>Motion</span>
              </button>
          </div>
          </form>
        </div>

        <div class="container-fluid">
          <form class="form-horizontal profile">
            <div class="form-group">
                <label for="username" class="username"></label>
            </div>
            <div class="logout form-group">
              <button type="button" class='btn form-profile' id="logout" name="command" value="LogOut">Log Out</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </body>
  <script>
    var hamBtn = document.getElementById("hamburgerBtn");
    var navbar = document.getElementById("navbar");
    var userdisplay = document.getElementById("user-display");

    userdisplay.addEventListener("click", displayMenu);
    hamBtn.addEventListener("click", displayMenu);

    function displayMenu() {
      navbar.classList.toggle("active");
      hamBtn.classList.toggle("active");
    }
    </script>

<script>
    function toggleShowMore() {
        var moreItemsDiv = document.getElementById("moreItems");
        var showMoreButton = document.getElementById("showMoreButton");
        if (moreItemsDiv.style.display === "none") {
            moreItemsDiv.style.display = "block";
            showMoreButton.innerText = "Show Less";
        } else {
            moreItemsDiv.style.display = "none";
            showMoreButton.innerText = "Show More";
        }
    }
    function toggleShowMore0() {
        var moreItemsDiv0 = document.getElementById("moreItems0");
        var showMoreButton0 = document.getElementById("showMoreButton0");
        if (moreItemsDiv0.style.display === "none") {
            moreItemsDiv0.style.display = "block";
            showMoreButton0.innerText = "Show Less";
        } else {
            moreItemsDiv0.style.display = "none";
            showMoreButton0.innerText = "Show More";
        }
    }
    function toggleShowMore2() {
        var moreItemsDiv2 = document.getElementById("moreItems2");
        var showMoreButton2 = document.getElementById("showMoreButton2");
        if (moreItemsDiv2.style.display === "none") {
            moreItemsDiv2.style.display = "block";
            showMoreButton2.innerText = "Show Less";
        } else {
            moreItemsDiv2.style.display = "none";
            showMoreButton2.innerText = "Show More";
        }
    }
    function toggleShowMore3() {
        var moreItemsDiv3 = document.getElementById("moreItems3");
        var showMoreButton3 = document.getElementById("showMoreButton3");
        if (moreItemsDiv3.style.display === "none") {
            moreItemsDiv3.style.display = "block";
            showMoreButton.innerText = "Show Less";
        } else {
            moreItemsDiv3.style.display = "none";
            showMoreButton.innerText = "Show More";
        }
    }
    function toggleShowMore4() {
        var moreItemsDiv4 = document.getElementById("moreItems4");
        var showMoreButton4 = document.getElementById("showMoreButton4");
        if (moreItemsDiv4.style.display === "none") {
            moreItemsDiv4.style.display = "block";
            showMoreButton.innerText = "Show Less";
        } else {
            moreItemsDiv4.style.display = "none";
            showMoreButton.innerText = "Show More";
        }
    }
    </script>
</html> 