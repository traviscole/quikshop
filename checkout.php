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
                    if (localStorage.getItem("userId") === null) {
                        alert("you are not logged in");
                        
                        window.location.assign("http://www.quikshop.co/")
                    }
                </script>
		<div data-role="content">  

		<div id="landmark-1" data-landmark-id="1">
		
			<?php
		
			// Allow for errors
			error_reporting(E_ALL);
			ini_set('display_errors', '1');

			// Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

			// Various Includes --getting the userId and cartId from the current logged in user

			$userID = 34;//$_SESSION['name'];

			$cartID = 1;// $_SESSION['cartId'];
			
			$sql  = "SELECT itemid, quantity From cart where cartid = $cartID";

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
			$sqlr  = "SELECT price From items where itemID = $itemid ";
			$resultr = $mysqli->query($sqlr) or die( $mysqli->error );
			$rowr = mysqli_fetch_row($resultr);

			$sum = $sum + $quantity*$rowr[0];
				
			}

			?>
			<center>


			<font size="18">Amound Due 
				<?php
					print("$$sum");
				?>
			</font>
			</center>


		<form id ="payNow" method="post" action="pay.php">
		<div data-role="fieldcontain" class="ui-hide-label">  
			<div style="text-align:center">  
				<select name="Cards">
					<?php
						$sqlcard  = "SELECT cardName, cardNum From CreditCards where userId = $userID ";
						$resultcard = $mysqli->query($sqlcard) or die( $mysqli->error );
														
						print($rowcard[0]);
						$x = 0;
							$cardValue = 1;
						while($rowcard = mysqli_fetch_row($resultcard)){
							
					?>
               
					<option  value=<?php echo("$rowcard[1]");?>><?php echo($rowcard[0]."   ".$rowcard[1]);?></option>
					<?php
						$x = $x+1;}
					?>
                    
				</select>

				<input type="hidden" name="userId" value= <?php echo $userID;?>>
                <input type="hidden" name="cartId" value= <?php echo $cartID;?>>
				<br />
                <br />
				
				<input type="submit" name="submit" value="Pay Now">
               	<br />
				<br />
                <input type="submit"  name="delete" value="Delete Card">
                <br />
			</div>
		</div>
		</form>

		<form id="addCard" method="post"  action="AddPayment.html">
			<div data-role="fieldcontain" class="ui-hide-label">  
				<div style="text-align:center">  
					<input type="submit"  value="Add Card" >
				</div>
			</div>
		</form>
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