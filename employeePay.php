<?php 
 session_start(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php


	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	
	
   
	
	if(isset($_POST['submit'])) { 
	$total = $_POST['total'];

		if($total > 0){
		if( isset($_POST['Cards']))	{
		?>
                    <font size="18">
                   <center>
Submit Payment<p>Sending Email
                    </p>
                    </center>
                    </font>
                  <?php

                    

                
                    error_reporting(E_ALL);
                    
                    ini_set('display_errors', '1');
                    $mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
                    
					$userID = $_SESSION['customerID'];
					$sqlCart  = "select * from Logins where userID = $userID";
					$resultCart = $mysqli->query($sqlCart) or die( $mysqli->error );
					$rowCart = mysqli_fetch_row($resultCart);
							
					$cartID = $rowCart[0];
					$storeID = $rowCart[2];
					$time = $rowCart[3];
					
					
					
						
						
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
                    
  
            	
                   
                    
                    function clean_string($string) {
                    
                        $bad = array("content-type","bcc:","to:");
                    
                        return str_replace($bad,"",$string);
                    
                    }
					
					$sqlStore  = "select name, address, zip from Stores where storeID = $storeID";
					$resultStore = $mysqli->query($sqlStore) or die( $mysqli->error );
					$rowStore = mysqli_fetch_row($resultStore); 
					
				
				    $message = '<html><body>';
					$message .= '<h1>Thank you for choosing Quikshop<p><p><p></h1>';
					$message .= "Thank you for visiting $rowStore[0] on $rowStore[1] $rowStore[2] at $time<p><p><p>";
					$message .= '</body></html>';
					
					$message .= '<html><body>';
					$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
					$message .= "<tr style='background-color: lightblue';><td><strong>Items</strong> </td>";
					$message .= "<td><strong>Quantity</strong> </td>";
					$message .= "<td><strong>Price</strong></td>";
					
                    $sqlinit  = "Select itemID, quantity from Carts WHERE cartID = $cartID";
                    $resultinit = $mysqli->query($sqlinit) or die( $mysqli->error );
                   
                    while($rowinit = mysqli_fetch_row($resultinit)){
                        $sql  = "Select name, price from Items WHERE itemID = $rowinit[0]";
                        $result = $mysqli->query($sql) or die( $mysqli->error );
                        $row = mysqli_fetch_row($result);
                                    
                    	$message .= "<tr><td>$row[0] </td><td><center>$rowinit[1]</center> </td><td><center>$row[1] </center></td></tr>";

                     }
							 
					$message .= "<tr style='background-color: orange';><td><strong></strong> </td>";
					$message .= "<td><strong>Total</strong> </td>";
					$message .= "<td><strong>$total</strong></td>";
			
                    $message .= "</table>";
					$message .= "</body></html>";
					
					$headers = 'From: '.$email_from."\r\n";
                    
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					 
					'Reply-To: '.$email_from."\r\n" .
					 
					'X-Mailer: PHP/' . phpversion();
					 
					@mail($email_to, $email_subject, $message, $headers);   
				
					
					/*$sql  = "INSERT into Logins values('', $userID, $storeID, 0000-00-00)";
   					$result = $mysqli->query($sql) or die( $mysqli->error );
					
					
					$sql  = "DELETE from Logins where cartID = $cartID";
   					$result = $mysqli->query($sql) or die( $mysqli->error );*/
					
		}
		else{
			print("Please add a credit card");	
		}
		
	}
	else{
	?>
                    <font size="18">
                   <center>Current cart is empty
                    </p>
                    </center>
                    </font>
                  <?php
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

</body>
</html>