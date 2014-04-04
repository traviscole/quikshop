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
    
	
//print_r($_POST);
/*
$cardNumber = $_POST['Cards'];
$userID = $_POST['userId'];
$cartID = $_POST['cartId'];
$price = $_POST['price'];
*/

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	
	

	
	if(isset($_POST['submit'])) {
		if( isset($_POST['Cards']))	{
		?>
                    <font size="18">
                   <center>
Submit Payment<p>Sending Email
                    </p>
                    </center>
                    </font>
                  <?php
                // If we know the userID then we need to look at the loging table and find storeID and cartID so we can search the cart and create a receipt 
                /*
                $userID = $_SESSION('userID');
                
                $storeID = $SESSION('storeID');
                
                $total = $_SESSION('total')
                    
            */
                    
                    $userID = $_POST['userId'];
                    $cartID = $_POST['cartId'];
                    $total = $_POST['total'];
                    error_reporting(E_ALL);
                    
                    ini_set('display_errors', '1');
                    $mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
                    
                    $sql  = "Select firstName, lastName, email from Users WHERE userID = $userID";
                    $result = $mysqli->query($sql) or die( $mysqli->error );
                    $row = mysqli_fetch_row($result);
                    
                    $firstName = $row[0];
                    
                    $lastName = $row[1];
                    
                    $email_to = $row[2];
            
                    $email_from = "quikshopproject@yahoo.com";
                    
                    $email_subject = "Thank you for your purchase";
                    
                    
                    $error_message = "";
                    
                    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                    
                    $email_message = "Thank you for your purchase $firstName $lastName";
                    
                    $email_message .= "\n\n\nCart\n\nItems\t\t\t\t\tQuantity\tPrice\n\n";
            
                    
                    
                    function clean_string($string) {
                    
                        $bad = array("content-type","bcc:","to:");
                    
                        return str_replace($bad,"",$string);
                    
                    }
                    
                    $sqlinit  = "Select itemID, quantity from Carts WHERE cartID = $cartID";
                    $resultinit = $mysqli->query($sqlinit) or die( $mysqli->error );
                    
                    while($rowinit = mysqli_fetch_row($resultinit)){
                        $sql  = "Select name, price from Items WHERE itemID = $rowinit[0]";
                        $result = $mysqli->query($sql) or die( $mysqli->error );
                        $row = mysqli_fetch_row($result);
                                    
                        $email_message .= "$row[0]\t\t\t\t\t$rowinit[1]\t$$row[1]\n";
            
                    }
                    
                    $email_message .= "\n\t\t\t\t\t\tTotal: $$total\n\n\nWe appreciate your business please come back soon\nhttp://www.quikshop.co/";
                    
                    $headers = 'From: '.$email_from."\r\n".
                    
                    'Reply-To: '.$email_from."\r\n" .
                    
                    'X-Mailer: PHP/' . phpversion();
                    
                    @mail($email_to, $email_subject, $email_message, $headers);  
		}
		else{
			print("Please add a credit card");	
		}
		
	}
	else if(isset($_POST['delete'])){
		
	
		
		if(isset($_POST['Cards'])){
			$cardID = $_POST['Cards'];
		$sql  = "DELETE from CreditCards WHERE ID = $cardID";
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
		print ("No credit cards deleted at this time");
		}
	
	}
	else{
		print ("IDK what to do");	
	}
		$mysqli->close();
	?>
