
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

	<title>Cart</title>   
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    
</head>

<?php
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	
	//drop cart table
	$dropCart = "DROP TABLE cart";
	
	$mysqli->query($dropCart) or die("Cart table not dropped");
	
	//create cart table
	$createCart = "CREATE TABLE IF NOT EXISTS cart(cartID INT, itemID INT, ownerID INT, quantity INT, timeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
	
	$mysqli->query($createCart) or die("Unable to create table");
	
	//populate cart table
	$insertCart0 = "INSERT INTO cart(cartID, itemID, ownerID, quantity) VALUES(1, 1, 1, 1)";
	$insertCart1 = "INSERT INTO cart(cartID, itemID, ownerID, quantity) VALUES(1, 2, 1, 1)";
	$insertCart2 = "INSERT INTO cart(cartID, itemID, ownerID, quantity) VALUES(1, 3, 1, 1)";
	
	$mysqli->query($insertCart0) or die("Unable to insert data into Cart");	
	$mysqli->query($insertCart1) or die("Unable to insert data into Cart");	
	$mysqli->query($insertCart2) or die("Unable to insert data into Cart");	
	
	//drop items table
	$dropItems = "DROP TABLE items";
	
	$mysqli->query($dropItems) or die("Items table not dropped");
	
	//create items table
	$createItems = "CREATE TABLE IF NOT EXISTS items(itemID INT AUTO_INCREMENT PRIMARY KEY, storeID INT, itemName VARCHAR(100), price FLOAT, quantity INT, description VARCHAR(500), timeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
	
	$mysqli->query($createItems) or die("Unable to create items");
	
	//populate items table
	$insertItems0 = "INSERT INTO items(storeID, itemName, price, quantity, description) VALUES(1, 'Milk', 3.99, 1, 'It\'s a dairy product from cows')";
	$insertItems1 = "INSERT INTO items(storeID, itemName, price, quantity, description) VALUES(1, 'Cereal', 2.99, 1, 'You should eat it with your milk in the morning')";
	$insertItems2 = "INSERT INTO items(storeID, itemName, price, quantity, description) VALUES(1, 'Chicken', 5.99, 1, 'It\'s not dairy. It\'s a chicken')";
	
	$mysqli->query($insertItems0) or die("Unable to insert Milk");
	$mysqli->query($insertItems1) or die("Unable to insert Cereal");
	$mysqli->query($insertItems2) or die("Unable to insert Chicken");	
	
?>
<body>
<div data-role="page" data-theme="b">

	<div data-role="header" data-theme="b">
    
		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>
        <a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>
        <a href="scanner.html" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>
    
	<div data-role="content">  
        
        <div data-role="filedcontain"> 
        	</br>
        	<ul data-role="listview" data-filter="true" data-filter-placeholder="Search Cart..." data-inset="true" data-divider-theme="a" data-theme="c">
            	<li data-role="list-divider">Publix</li>
                	<?php
						$query = "SELECT itemName, price, cart.itemID FROM items, cart WHERE cart.itemID = items.itemID AND cartID = 1";
						$result = $mysqli->query($query) or die("Unable to get result".$mysqli->error);
						$total = 0;
						while($row = $result->fetch_assoc())
						{
							$itemID = $row["itemID"];
							$itemName = $row["itemName"];
							$price = $row["price"];
							$total += $price;
							echo "<li data-transition='slide'><a href='itemDetail.php?ID=$itemID'>$itemName</a></li>";
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

</body>
</html>
