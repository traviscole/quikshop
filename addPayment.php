<?php 
 session_start(); 
?>
!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

<title>Quikshop Mobile</title>   
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
<meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" refresh="true" />

</head>

<body>
	<div data-role="page" data-theme="b">

	<div data-role="header" data-theme="b">
		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>
		<a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>
		<a href="checkout.php" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>

	<div data-role="content">  

		<div id="landmark-1" data-landmark-id="1">

<html lang= 'en'>


	<head>
	<body>
	<pre>
	<?php
    
	
//print_r($_POST);
$userId = $_SESSION['userId'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$expDate = $_POST['expDate'];
$cardNumber = $_POST['cardNumber'];
$streetAddress = $_POST['streetAddress'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipCode = $_POST['zipCode'];
$cardType = $_POST['cardType'];
$pcId = "0";
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

		
		$sqlcredit = "Select procId from CreditCards";
		$resultcredit = $mysqli->query($sqlcredit) or die( $mysqli->error );
		while($rowcredit = mysqli_fetch_row($resultcredit)){
		
			if($rowcredit[0] > $pcId){
				$pcId = $rowcredit[0];
			
			}
		}
		$pcId = $pcId.'2';
	

		//$sqlp  = "Insert INTO CreditCards VALUES ($pcId, 34, 'visa', 23456, 09/09/3432, 'sfghjk', "city", "state", 789, 0000-00-00)";
		$sqlp  = "Insert INTO CreditCards VALUES ('$pcId',$userId, '$cardType', $cardNumber, $expDate, '$streetAddress', '$city', '$state', $zipCode, 0000-00-00)";
		$resultp = $mysqli->query($sqlp) or die( $mysqli->error );
		//$rowp = mysqli_fetch_row($resultp);
		
		
				?>
        <font size="18">
       <center>
Congratulations  </p> New Payment Method Added
       
        </center>
        </font>
         <?php
	
	
		$mysqli->close();
	?>
