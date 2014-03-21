
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
	
	$createDbSql = "CREATE TABLE IF NOT EXISTS cart(user VARCHAR(100), item VARCHAR(50))";
	
	$mysqli->query($createDbSql) or die("Unable to create table");
	
	//delete dummy data
	$deleteItem = "DELETE FROM cart WHERE user = 'nshiver21@yahoo.com'";
	
	$mysqli->query($deleteItem) or die("Item not deleted!");
	
	//insert dummy data
	
	$insertItems0 = "INSERT INTO cart(user, item) VALUES('nshiver21@yahoo.com', 'Milk')";
	$insertItems1 = "INSERT INTO cart(user, item) VALUES('nshiver21@yahoo.com', 'Cereal')";
	
	$mysqli->query($insertItems0) or die("Unable to insert Milk");
	$mysqli->query($insertItems1) or die("Unable to insert Cereal");
	
	
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
						$query = "SELECT item FROM cart WHERE user = 'nshiver21@yahoo.com'";
						$result = $mysqli->query($query) or die("UNABLE TO GET RESULT");
						while($row = $result->fetch_assoc())
						{
							$item = $row["item"];
							echo "<li data-transition='slide'><a href='itemDetail.html'>$item</a></li>";
						}
					?>

                <li data-role="list-divider"><center>Total: $9.43</center></li>
			</ul>
            
        </div>
        
    </div>


	<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
		<h1>&copy; Quikshop 2014</h1>
	</div>

</div>

</body>
</html>
