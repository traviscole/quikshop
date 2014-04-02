<?php
	// If we know the userID then we need to look at the loging table and find storeID and cartID so we can search the cart and create a receipt 
	/*
	$userID = 
	
	$total = 
	
	
*/
	$email_to = "abelalvarez89@hotmail.com";
 
    $email_from = "quikshopproject@yahoo.com";
 
    $email_subject = "Thank you for your purchase";
	
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    $email_message = "Cart.\n\nItems-------Quantity---Price\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:");
 
      return str_replace($bad,"",$string);
 
    }
 	$item = "Coca-Cola";
	$quantity = 24;
	$price = 1.29;
     $i = 0;
 	while($i < 3){
    $email_message .= "$item---$quantity---------$price\n";
	 
	$i = $i+1;
	}

	$email_message .= "\n\n\nWe appreciate your business please come back soon\nhttp://www.quikshop.co/";
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  

 
?>
