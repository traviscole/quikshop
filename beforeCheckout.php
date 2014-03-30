<?php 
 session_start(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

<title>Quikshop Mobile</title>   
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
<meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

</head>
	
<body>
	<div data-role="page" data-theme="b">

	<div data-role="header" data-theme="b">
		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>
		<a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>
		<a href="scanner.html" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>
	<script>
		if (localStorage.getItem("userId") === "signOut") {
			alert("you are not logged in");
			
			window.location.assign("http://abelalvarez.info/quikshop/www/")
		}
	</script>
    	
		<div data-role="content">  

		<div id="landmark-1" data-landmark-id="1">
		
			<?php	
			// Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
			//$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
			$mysqli = new mysqli("ec2-54-186-201-14.us-west-2.compute.amazonaws.com","quikshop","quikshop2014uf","quikshop");	
			// Allow for errors
			error_reporting(E_ALL);
			ini_set('display_errors', '1');

			
			$userID = 34;//$_SESSION['userId'];

			$cartID = 1;//$_SESSION['currCartId'];
			
			$sql  = "SELECT itemID, quantity From Cart where cartID = $cartID";

			//	Call the database, save the result in the variable RESULT
			$result = $mysqli->query($sql) or die( $mysqli->error );

			//	Extract the row data of the result. Save as ROQ


			$sum = 0;
			$quantity = 0;
			//while loop will look in the customer's cart all the items	
			while($row = mysqli_fetch_row($result)){
			//save the quantity of the current item
			$itemid = $row[0];
			$quantity = $row[1];
			//look for the items price using 
			$sqlr  = "SELECT price From Items where itemID = $itemid ";
			$resultr = $mysqli->query($sqlr) or die( $mysqli->error );
			$rowr = mysqli_fetch_row($resultr);

			$sum = $sum + $quantity*$rowr[0];
				
			}

			?>
			<center>


			<font size="18">Amount Due 
				<?php
					print("$$sum");
				?>
			</font>
			</center>



				
					<?php
						$cardID = 2;
					
						//print("I am here before it does the while loop");
						$sqlcard  = "SELECT type, cardNumber From CreditCard where cardID = $cardID ";
						//print ("I am here after the query");
						$resultcard = $mysqli->query($sqlcard) or die( $mysqli->error );
													
						
						$x = 0;
						
						while($rowcard = mysqli_fetch_row($resultcard)){
							$arrayNumber[] = $rowcard[0];
							$arrayType[] = $rowcard[1];
		
						}
							print_r($arrayNumber);
							print_r($arrayType);
							$_SESSION['userID'] = $userID;
							$_SESSION['cartID'] = $cartID;
							$_SESSION['total'] = $sum;
							$_SESSION['number'] = $arrayNumber;
							$_SESSION['type'] = $arrayType;
								
					?>
                    <div data-role="content">  
                    	<div id="landmark-1" data-landmark-id="1">
                    		<form id ="Continue" method="post" action="checkout_html.php">
                            	    <input type="submit" name="submit" value="Continue">
                            </form>
                            <br />
                        
                            <form id ="Cancel" method="post" action="scanner.html">
                            	    <input type="submit" name="cancel" value="Cancel">
                            </form>
                    	<div data-role="fieldcontain" class="ui-hide-label">  
                    <div style="text-align:center">  


			
				
	</div> 
</div>


		<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
			<h1>&copy; Quikshop 2014</h1>
		</div>

</div>
		<?php
		$mysqli->close();	

		?>

</body>
</html>
