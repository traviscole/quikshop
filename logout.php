<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

	<title>Quikshop Mobile</title>   
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  
    <script>
		localStorage.setItem("userId", "signOut");
	</script>
</head>

<body>

<div data-role="page" data-theme="b">

	<div data-role="header" data-theme="b">
		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>
        	<a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>
	</div>
    
	<div data-role="content">  
    	<div id="landmark-1" data-landmark-id="1">
            	<center> You have been logged out. </center>
            	<center><a href="https://quikshop.co/default.html" data-role="button">Return To Login</a></center>
	</div> 
        </div>

<?php
			error_reporting(E_ALL);
  			ini_set('display_errors', '1');
  
  			// Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
  			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
  
  			// Various Includes --getting the userId and cartId from the current logged in user
  
  			//$userID = 7;//$_SESSION['name'];
  
  			$cartID = 3;// $_SESSION['cartId'];

  			$sql  = "DELETE from Logins where cartID = $cartID";
  
  			//	Call the database, save the result in the variable RESULT
  			$result = $mysqli->query($sql) or die( $mysqli->error );
 			 
			
			
?>
	<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
		<h1>&copy; Quikshop 2014</h1>
	</div>

</div>


</body>
<?php 
$mysqli->close();
?>
</html>










