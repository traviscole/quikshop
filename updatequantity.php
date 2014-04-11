<?php 
   session_start(); 
  ?>
  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="https://www.w3.org/1999/xhtml"> 

  <head>
  
  <title>Quikshop Checkout</title>   
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
  		<a href="scanner.html" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>
  
  	</div>
  				
  		<div data-role="content">  
  
  		<div id="landmark-1" data-landmark-id="1">

		
		<?php
			
			error_reporting(E_All);
			ini_set('display_errors', '1');
			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
			
			$s = $_POST['submit'];
			if(isset($_POST['submit'])){
			$ID = $_POST['ID'];
			$quant = $_POST['quantity'];
			

			
			if($quant <= 0){
				$query = "DELETE FROM Carts WHERE ID = $ID";
				$result = $mysqli->query($query) or die("Unable to get item data".$mysqli->error);
				//$row = mysqli_fetch_row($result);
				print("Item was removed");
			}
			else{
				$query = "UPDATE Carts SET quantity = $quant WHERE ID = $ID";
				$result = $mysqli->query($query) or die("Unable to get item data".$mysqli->error);
				//$row = mysqli_fetch_row($result);
				print("Quantity updated");
			}

			}
			$mysqli->close();
			?>

  		
  	</div> 
  </div>
  
  
  		<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
  			<h1>&copy; Quikshop 2014</h1>
  		</div>
  
  </div>

  	 
  </body>
  </html>
