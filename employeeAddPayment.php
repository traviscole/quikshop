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
    
  			$userID = $_SESSION['customerID'];
  			$cardNumber = $_POST['cardNumber'];
			$cardType = $_POST['cardType'];
			$cardShown = substr($cardNumber, -4);
			$card = "$cardType - $cardShown";
			
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
		
		
				$sqlcard  = "insert into CreditCards values('', $userID, '$card')";
				$resultcard = $mysqli->query($sqlcard) or die( $mysqli->error );
				
						?>
				<font size="18">
			   <center>
		  </p> New Payment Method Added
			<meta http-equiv="refresh" content="0" />

				</center>
				</font>
				 <?php
			
				$mysqli->close();
			?>


</body>
</html>
