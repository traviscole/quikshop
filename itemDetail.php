<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

	<title>Item Detail</title>   
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
        <a href="cart.php" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

	</div>
    
    <?php 
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
	$itemID = $_GET["itemID"]; 
	$query = "SELECT * FROM items WHERE itemID = $itemID";
	$result = $mysqli->query($query) or die("Unable to get item data".$mysqli->error);
	$row = $result->fetch_assoc();
	$itemName = $row["name"];
	$price = $row["price"];
	$description = $row["description"];
	?>
    
    
	<div data-role="content">  
        
        <div data-role="filedcontain"> 
            <center><b><?php echo ucwords($itemName); ?></b></center>
        	</br>
        	<ul data-role="listview" data-inset="true" data-divider-theme="a" data-theme="c">
                    <li data-role="list-divider">Price</li>
						<li> $<?php echo $price; ?></li>
                    <li data-role="list-divider">Description</li>
						<li>  <?php echo $description; ?></li>
			</ul>
            
        </div>
        
    </div>


	<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
		<h1>&copy; Quikshop 2014</h1>
	</div>

</div>

</body>
</html>
