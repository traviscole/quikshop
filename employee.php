<?php 
   session_start(); 
  ?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee</title>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script type="text/javascript" src="scannerFunctions.js"></script>
    <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    
        <script>
		  if (localStorage.getItem("email") == "signOut") {
              alert("You are not logged in");
              window.location.assign("http://www.quikshop.co/")
          }
      </script>
    
</head>

<body>
<div data-role="page" data-theme="b">
	<div data-role="header" data-theme="b">
		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>

		<a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>

		<a href="https://quikshop.co/employee.php" class="ui-btn-left" data-icon="home" data-iconpos="left" data-transition="pop">Home</a>
	</div>
    <form>
        <div id="menu">
            <center>
            		<a href="https://quikshop.co/scanner.html" class="ui-btn-left"><input type="submit" name="home" id="home" value="Switch " /></a>
                    <a href="employee.php?page=home" class="ui-btn-left"><input type="submit" name="home" id="home" value="Home" /></a>
                   	<a href="employee.php?page=pay"class="ui-btn-right"><input type="submit" name="search" id="search" value="Payment" /></a>
                    <a href="employee.php?page=search"class="ui-btn-right"><input type="submit" name="search" id="search" value="Search" /></a>
                    <a href="employee.php?page=search"class="ui-btn-right"><input type="submit" name="search" id="search" value="Add Employee" /></a>
                    
            </center>
        </div>
    </form>

    <?php
		$options = $_GET['page'];
		
		switch($options){
			
			case "home":
				include('employee/employeeHome.php');
			break;
			case "search":
				include('employee/employeeSearch.php');
			break;
			case "pay":
				include('employeeCheckout.php');
			break;
			case "switch":
				include('https://quikshop.co/scanner.html');
			break;
			default:
				include('employee/employeeHome.php');
			break;	
		}
		
	?>
   
    <div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
        <h1>&copy; Quikshop 2014</h1>
    </div>
</div>

</body>
</html>

 
