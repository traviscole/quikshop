<?php 
 session_start(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml"> 
<head>

	<title>Cart</title>   
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
        <a href="https://quikshop.co/scanner.html" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>
    	<script>
		if (localStorage.getItem("email") === "signOut") {
			alert("you are not logged in");
			
			window.location.assign("http://www.quikshop.co/")
		}
	</script>
	<div data-role="content">  
        
        <div data-role="filedcontain"> 
        	</br>
        	<ul data-role="listview" data-filter="true" data-filter-placeholder="Search Cart..." data-inset="true" data-divider-theme="a" data-theme="c">
            	<li data-role="list-divider">Publix</li>
                	<?php
			if(isset($_SESSION['userID']) &&  $_SESSION['userID'] != ''){
					//creating connection 
					$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

					$userEmail = "<script>document.write(localStorage.getItem('userId'));</script>";
			
			//I am updating UserId and cartId with the session variables (global variables)			
			$userID = $_SESSION['userID'];
			
			$query1 = "SELECT cartID FROM Logins WHERE userID = $userID";
			$result1 = $mysqli->query($query1) or die("Unable to get result".$mysqli->error);
			$row1 =  mysqli_fetch_row($result1);
			$cartID = $row1[0];
			
	
			

					
					
					$query = "SELECT * FROM Carts WHERE cartID = $cartID";
					$result = $mysqli->query($query) or die("Unable to get result".$mysqli->error);
					$total = 0;

						//var_dump($row);
						//creating the list
						while($row = mysqli_fetch_row($result))
						{
							$ID = $row[0];
						
							$sqlr  = "SELECT itemID, name, price FROM Items WHERE itemID = $row[2]";
							$resultr = $mysqli->query($sqlr) or die( $mysqli->error );
							$rowr = mysqli_fetch_row($resultr);
							
							$itemId = $rowr[0];
							$itemName = $rowr[1];
							
							$query2 = "Select quantity FROM Carts WHERE itemID = $itemId and cartID = $cartID";
							$result2 = $mysqli->query($query2) or die("Unable to get result".$mysqli->error);
							$row1 = mysqli_fetch_row($result2);
							
							$qt = $row1[0];
							$price = $rowr[2];
							$price *= $qt;
							$total = $total + $price;
							
							
							echo "<li data-transition='slide'><a href='itemDetail.php?ID=$itemId&quant=$qt&SWAG=$ID'>$itemName										Quantity: $qt</a></li>";
						}
					?>

                <li data-role="list-divider"><center>Total: $<?php echo $total; ?></center></li>
			</ul>
            
        </div>

		

        
    </div>


	<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
		<h1>&copy; Quikshop 2014</h1>
	</div>

</div>

	<?php
		$mysqli->close();
			}
			else{
				
			?>
				<script>
                {	
                	alert("You are not logged in");
					window.location.assign("http://www.quikshop.co/")
                }				  
                </script>	
			<?php	
			}
	?>

</body>
</html>
