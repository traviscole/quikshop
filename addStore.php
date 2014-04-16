<?php 
 session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="https://www.w3.org/1999/xhtml"> 
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>


<head>

<title>Quikshop Mobile</title>   
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  

</head>

<body>
	<div data-role="page" data-theme="b">

	<div data-role="header" data-theme="b">
		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>
		<a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>
		<a href="https://quikshop.co/checkout.php" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>

	<div data-role="content">  

		<div id="landmark-1" data-landmark-id="1">

<html lang= 'en'>


	<head>
	<body>
	<pre>
	
	
 <?php
 
 $userID = $_SESSION['userID'];
 $_SESSION['userID'] = $userID;
 
 
 $name = $_POST['storeName'];
 $latitude = $_POST['latitude'];
 $longitude = $_POST['longitude'];
 
 $address = $_POST['address'];
 $city= $_POST['city'];
 $state = $_POST['state'];
 
 $zip = $_POST['zip'];
// print_r($_POST);
			

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");


		$sqlcard  = "insert into Stores values('', '$name', '$address', '$city', '$state', $zip, $latitude, $longitude)";
		
  		$resultcard = $mysqli->query($sqlcard) or die( $mysqli->error );
		

		
		
				?>
				</pre>
        <font size="18">
       <center>
  </p> New Store Added
       
        </center>
        </font>
         <?php
	
	
		$mysqli->close();
	?>
<meta http-equiv="refresh" content="0" />
</body>
</html>
