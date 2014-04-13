<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>

<title>Item Detail</title>
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
        <a href="https://quikshop.co/employee.php" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>

</div>
    
    <?php
		$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");
		
		$userID = $_SESSION['userID'];
		$ID = $_GET['customerID'];
		$itemID = $_GET['ID'];
		
		$queryQ = "SELECT quantity FROM Carts WHERE ID = $ID";
		$resultQ = $mysqli->query($queryQ) or die("Unable to get item data".$mysqli->error);
		$rowQ = mysqli_fetch_row($resultQ);
		
		$quant = $rowQ[0];
		
		$query = "SELECT * FROM Items WHERE itemID = $itemID";
		$result = $mysqli->query($query) or die("Unable to get item data".$mysqli->error);
		$row = mysqli_fetch_row($result);
		$itemName = $row[2];
		$price = $row[5];
		$description = $row[3];
	?>
    <div data-role="content">
        <div data-role="filedcontain">
        <center><b><?php echo ucwords($itemName); ?></b></center>
        </br>
            <ul data-role="listview" data-inset="true" data-divider-theme="a" data-theme="c">
                <li data-role="list-divider">Price</li>
                <li> $<?php echo $price; ?></li>
                <li data-role="list-divider">Description</li>
                <li> <?php echo $description; ?></li>
                
                <li> 
                    <form id = "Update Quantity" method = "post" action = "quantity.php">
                    <center>
                        <input type = "int" name = "quantity" value = <?php echo $quant; ?>>
                        <input type = "hidden" name = "ID" value = <?php echo $ID; ?>>
                        <input type = "hidden" name = "itemID" value = <?php echo $itemID; ?>>
                        <input type = "submit" name = "submit" value = "Update">
                    </center>
                    </form>
                </li>
            </ul>
        </div>
    </div>

<div data-role="footer" data-position="fixed" data-theme="b" data--tap-toggle="false">
<h1>&copy; Quikshop 2014</h1>
</div>

</div>

</body>
</html>

