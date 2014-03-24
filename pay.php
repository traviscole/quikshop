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

$cardNumber = $_POST['Cards'];
$userID = $_POST['userId'];
$cartID = $_POST['cartId'];
$price = $_POST['price'];
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	
	if(isset($_POST['submit']) && isset($cardNumber)) {
		?>
        <font size="18">
       <center>
Submit Payment<p>Sending Email
        </p>
        </center>
        </font>
         <?php
	/*	 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
 
    function clean_string($string) {
 
      $bad = array("Name:","Payment Method:","Items Purchased:","Total:");
 
      return str_replace($bad,"",$string);
 
    }
	
 
     // here is to prepare what the user will see

	//produce query and attached the list of items purchased and price
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Last Name: ".clean_string($cardNumber)."\n";
 
 	$sqlp  = "Select * from cart WHERE cartID = $cartID";
	$resultp = $mysqli->query($sqlp) or die( $mysqli->error );
	$email_message .= "Quantiy	Item	Description	Price\n";
	
	While($rowp = mysqli_fetch_row($resultp)){
		$sqlq  = "Select quantity from cart WHERE itemsID = $rowp[0]";
		$resultq = $mysqli->query($sqlq) or die( $mysqli->error );
		$rowq = mysqli_fetch_row($resultq)
		
   
	
	}
	$email_message .= "Products".clean_string($price)."\n";
    $email_message .= "Purchased Items: ".clean_string($price)."\n";
 
     
 
     $email_to ="abelalvarez89@ufl.edu";
	 $email_from="abelalvarez89@hotmail.com
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  

 
*/
		
	}
	else if(isset($_POST['delete'])){
		
		$sqlp  = "Select procId, cardName from CreditCards WHERE cardNum = $cardNumber and userId = $userID";
		$resultp = $mysqli->query($sqlp) or die( $mysqli->error );
		$rowp = mysqli_fetch_row($resultp);
		
		$sql  = "DELETE from CreditCards WHERE cardNum = $cardNumber and userId = $userID and procId = $rowp[0]";
		$result = $mysqli->query($sql) or die( $mysqli->error );
		?>
        <font size="18">
        <?php
		//print "The:$rowp[1] credit card:$cardNumber was deleted";
		?>
        <meta http-equiv="refresh" content="0" />
        </font>
        <?php
		//$row = mysqli_fetch_row($result);
	
	}
	else{
		print ("IDK what to do");	
	}
		$mysqli->close();
	?>
