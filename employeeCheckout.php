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
  		
  			// Allow for errors
  			error_reporting(E_ALL);
  			ini_set('display_errors', '1');
  
  			// Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
  			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
  
  			// Various Includes --getting the userId and cartId from the current logged in user
  			if(isset($_SESSION['customerID']) &&  $_SESSION['customerID'] != ''){
					$userID = $_SESSION['customerID'];
					
					
					print ("UserID:	$userID");
					
					
					$sqlCart  = "select cartID from Logins where userID = $userID";
					$resultCart = $mysqli->query($sqlCart) or die( $mysqli->error );
					$rowCart = mysqli_fetch_row($resultCart);
					$cartID = $rowCart[0];
					
					
					$sql  = "SELECT itemID, quantity From Carts where cartID = $cartID";
		  
					//	Call the database, save the result in the variable RESULT
					$result = $mysqli->query($sql) or die( $mysqli->error );
		  
					//	Extract the row data of the result. Save as ROQ
		  
		  
					$sum = 0;
					$quantity = 0;
					//while loop will look in the customer's cart all the items	
				
					while($row = mysqli_fetch_row($result)){
					//save the quantity of the current item
					$itemID = $row[0];
					$quantity = $row[1];
					
					//look for the items price using 
					$sqlr  = "SELECT price From Items where itemID = $itemID ";
					$resultr = $mysqli->query($sqlr) or die( $mysqli->error );
					$rowr = mysqli_fetch_row($resultr);
		  
					$sum = $sum + $quantity*$rowr[0];
						
					}
					
					?>
		<br />
		<center>
		  
		  
		  <font size="18">Amount Due 
			  <?php
							print("$$sum");
						?>
		  </font>
		  </center>
		 
					<?php
						$sqlcard  = "SELECT Type,ID From CreditCards where userID = $userID ";
						$resultcard = $mysqli->query($sqlcard) or die( $mysqli->error );
								
							
									$sqlemail  = "SELECT email from Users where userID = $userID ";
  				$resultemail = $mysqli->query($sqlemail) or die( $mysqli->error );				
				$rowemail = mysqli_fetch_row($resultemail);
				
				$email = $rowemail[0];
  			?>
			
					
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="platnosci">
		 
		 
		   <input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="bonilla.robinsonrod@gmail.com">
			<input type="hidden" name="notify_url" value="http://www.google.pl/paypal.php">
			<input type="hidden" name="item_name_1" value="Quikshop Cart Total">
			<input type="hidden" name="amount_1" value=<?php echo $sum ?>>
			<input type="hidden" name="currency_code" value="PLN">
			<input type="hidden" name="shopping_url" value="http://www.quikshop.co/scanner.html">
			<input type="hidden" name="email" value=<?php echo $email?>>
			
			<input type="submit" value = "PayPal">
		</form>
				<form id ="payNow" method="post" action="employeePay.php">
				<div data-role="fieldcontain" class="ui-hide-label">  
					<div style="text-align:center">  
		
						<select name="Cards">
							<?php
																
								print($rowcard[0]);
								$x = 0;
									$cardValue = 1;
								while($rowcard = mysqli_fetch_row($resultcard)){
									
							?>
						 
							<option  value=<?php echo("$rowcard[1]");?>><?php echo($rowcard[0]);?></option>
							<?php
								$x = $x+1;
								}
  					?>
                      
                        </select>
                            <input type="hidden" name="total" value= <?php echo $sum;?>>
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
          
                <form id="addCard" method="post"  action="employeeAddPayment.html">
                    <div data-role="fieldcontain" class="ui-hide-label">  
                        <div style="text-align:center">  
                            <input type="submit"  value="Add Card" >
                        </div>
                    </div>
                </form>
                <?php
			}//end if
			else{
				?>
                    <font size="18">
                   <center>Please select a customer
                    </p>
                    </center>
                    </font>
                  <?php
			}
			?>
</body>
</html>
