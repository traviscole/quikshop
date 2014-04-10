<?php 
 session_start(); 
?>
!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
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
		<a href="checkout.php" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>

	<div data-role="content">  

		<div id="landmark-1" data-landmark-id="1">

<html lang= 'en'>


	<head>
	<body>
	<pre>
	<?php


	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	
	

					$email = $_POST['email'];


					print("EMAIL: $email");
					
                
                    error_reporting(E_ALL);
                    ini_set('display_errors', '1');
                    $mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
                    
				
					$sqlCart  = "SELECT * from Users where email = '$email'";
						
					$resultCart = $mysqli->query($sqlCart) or die( $mysqli->error );
				
					$rowCart = mysqli_fetch_row($resultCart);
						
					print("email address is $rowCart[4]");
					$pass = decryptIt($rowCart[4);
               		print("Password $pass");
                    $email_to = $email;
            
                    $email_from = "quikshopproject@yahoo.com";
                    
                    $email_subject = "Thank you for your purchase";
                    
                    
                    $error_message = "";
                    
                    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                    
  
            	
                    
                    
                    function clean_string($string) {
                    
                        $bad = array("content-type","bcc:","to:");
                    
                        return str_replace($bad,"",$string);
                    
                    }

					$message = "password is 1234";
					$headers = 'From: '.$email_from."\r\n";
                    
									 
					'Reply-To: '.$email_from."\r\n" .
					 
					'X-Mailer: PHP/' . phpversion();
					 
					@mail($email_to, $email_subject, $message, $headers);   
				
					
					/*$sql  = "INSERT into Logins values('', $userID, $storeID, 0000-00-00)";
   					$result = $mysqli->query($sql) or die( $mysqli->error );
					
					
					$sql  = "DELETE from Logins where cartID = $cartID";
   					$result = $mysqli->query($sql) or die( $mysqli->error );*/
					



		$mysqli->close();
	?>





