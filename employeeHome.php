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

<div data-role="content">  
        
        <div data-role="filedcontain"> 
    <form id ="changeCustomer" method="post" action="search.php"> 
 		<center>
        <input type="int" name="cart" id="cart" placeholder="Enter Customer ID" />
	    <input type="submit" name="search" id="search" value="Search" />
     	</center>
    </form>
        
        
        	</br>
        	<ul data-role="listview" data-filter="true" data-filter-placeholder="Search Cart..." data-inset="true" data-divider-theme="a" data-theme="c"> 	

            	<li data-role="list-divider">Publix</li>
                	<?php

					//creating connection 
					$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

			
			
			//I am updating UserId and cartId with the session variables (global variables)			
			if(isset($_SESSION['customerCart'])) {
					$customerCart = $_SESSION['customerCart'];
							
					$query = "SELECT * FROM Carts WHERE cartID = $customerCart";
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
							
							$query2 = "Select quantity FROM Carts WHERE itemID = $itemId";
							$result2 = $mysqli->query($query2) or die("Unable to get result".$mysqli->error);
							$row1 = mysqli_fetch_row($result2);
							
							$qt = $row1[0];
							$price = $rowr[2];
							$price *= $qt;
							$total = $total + $price;
							
							
							echo "<li data-transition='slide'><a href='details.php?ID=$itemId&quant=$qt&SWAG=$ID'>$itemName	(Qty): $qt</a></li>";
						}
					?>

                <li data-role="list-divider"><center>Total: $<?php echo $total; ?></center></li>
			</ul>
            
        </div>

		

        
    </div>

</div>

	<?php
		$mysqli->close();
	}
	?>

</body>
</html>
