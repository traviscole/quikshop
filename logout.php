
<html>

</head>

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


<body>
</body>
<?php header('Location: https://quikshop.co/logout.html');
$mysqli->close();
?>

</html>
