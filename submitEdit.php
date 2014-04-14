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
  				<script>
						
                      if (localStorage.getItem("email") == "signOut") {
                          alert("You are not logged in");
                          window.location.assign("http://www.quikshop.co/")
                      }
					  
                  </script>
  		<div data-role="content">  
  
  		<div id="landmark-1" data-landmark-id="1">
  		
  			<?php
  		
  			// Allow for errors
  			
  
  			// Various Includes --getting the userId and cartId from the current logged in user
  
  			$userID = $_SESSION['userID'];
  			$_SESSION['userID'] = $userID;
			
			$first_name = $_POST['fname'];
			$last_name = $_POST['lname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
  			$password2 = $_POST['password2'];
			if(isset($_POST['submit'])) { 
				if($password == $password2){
					error_reporting(E_ALL);
					ini_set('display_errors', '1');
		  
					// Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
					$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
					
					if($password ==''){
						$sqlCart  = "UPDATE Users set firstName = '$first_name', lastName ='$last_name', email = '$email' where userID = $userID";
						$resultCart = $mysqli->query($sqlCart) or die( $mysqli->error );
					}
					else if ($password != ''){
						$hashPassword = password_hash($password, PASSWORD_DEFAULT);
						$sqlPass = "UPDATE Users set firstName = '$first_name', lastName ='$last_name', email = '$email', password = '$hashPassword' where userID = $userID";
						$resultPass = $mysqli->query($sqlPass) or die($mysqli->error);
					}
					?>
					
					<center>
		  
					<font size="18">Your account has been updated
					
					</font>
					</center>
					<?php
					}
				
				else{
						?>
					<center>
		  
		  
					<font size="18">Wrong password! Please enter same password
					
					</font>
					</center>
		 
				<?php
				}
			
			}
				
			?>	
				
 		
  
  
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