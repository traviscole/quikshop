<?php
	// If we know the userID then we need to look at the loging table and find storeID and cartID so we can search the cart and create a receipt 
	/*
	$userID = $_SESSION('userID');
	
	$storeID = $SESSION('storeID');
	
	$total = $_SESSION('total')
	
	
	
	
*/
	$storeID = 1;
	$userID = 7;
	error_reporting(E_ALL);

	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	
	$sql  = "Select firstName, lastName, email from Users WHERE userID = $userID";
	$result = $mysqli->query($sql) or die( $mysqli->error );
	$row = mysqli_fetch_row($result);
	
	$firstName = $row[0];
	
	$lastName = $row[1];
	
	$email_to = $row[2];
 
 	print ("Hello $firstName $lastName\n");
 
    $email_from = "quikshopproject@yahoo.com";
 
    $email_subject = "Thank you for your purchase";
	
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	
	 $email_message = "Thank you for your purchase $firstName $lastName";

    $email_message .= "\n\n\nCart\n\nItems\t\t\tQuantity\t\tPrice\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:");
 
      return str_replace($bad,"",$string);
 
    }
 	$item = "Coca-Cola";
	$quantity = 24;
	$price = 1.29;
     $i = 0;
	
	$sql  = "Select name, storeID, price from Items WHERE storeID = 1";
	$result = $mysqli->query($sql) or die( $mysqli->error );

 	while($row = mysqli_fetch_row($result)){
    $email_message .= "$row[0]\t\t\t$row[1]\t\t$row[2]\n";
	 
	$i = $i+1;
	}

	$email_message .= "\n\n\nWe appreciate your business please come back soon\nhttp://www.quikshop.co/";
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  

$mysqli->close();
 
?>
