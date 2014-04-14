<?php 

 session_start(); 

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"> 

<head>



	<title>Cart</title>   
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

    

</head>

			<script>

				function confirmInput()

				{

					fname = document.forms[0].fname.value;

					lname = document.forms[0].lname.value;

					email = document.forms[0].email.value;

					password = document.forms[0].password.value;

					password2 = document.forms[0].password2.value;



					if(password == null || password == "" || password2 == null || password2 == "" )

					

					alert("you didnt change password");



					else if(password == password2)

					

					alert("you didnt changing password");



					

				}

			</script>

</head>



<?php



	//creating connection 

	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");





	//I am updating UserId and cartId with the session variables (global variables)			

	$userID = $_SESSION['userID'];

	//$cartID = $_SESSION['currCartId'];



				

	//here we are querying the db				

	$query = "SELECT firstName, lastName, email From Users where userID = '$userID'";

	//here we are making the call

	$result = $mysqli->query($query) or die($mysqli->error);

	//here we are going to use something like a hashmap to store the variables

	$row = mysqli_fetch_assoc($result);



	//creating variables

	$fName = $row['firstName'];

	$lName = $row['lastName'];

	$email = $row['email'];




	// Close the connection



	$mysqli->close();



?>		



<body>



<div data-role="page" data-theme="b">



	<div data-role="header" data-theme="b">

    

		<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>

        <a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>

        <a href="scanner.html" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide" data-direction="reverse">Back</a>



	</div>







	<form id="editAccount" action="submitEdit.php" method = "post">

               

	    	 First Name <input type="text" name="fname" id="fname" class="required"  value="<?php echo $fName; ?>"/>

           	 <br />

           	 <br />

        	Last Name<input type="text" name="lname" id="lname" class="required"  value="<?php echo $lName; ?>"/>  

             	<br />

        	<br />

        	Email <input type="text" name="email" id="email" class="required"  value="<?php echo $email; ?>"/>

             	<br />

            	<br />

        	Password<input type="password" name="password" id="password"  value=""/> 

             	<br />

              <br />

        	Re-Enter Password<input type="password" name="password2" id="password2"  value=""/>  

                 		

           	<input type = "submit" value="Edit Account" name="submit"></td></tr>

							

	</form>









</div>









<!-- Footer -->



<div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">



	<h1>&copy; Quikshop 2014</h1>



</div>





	





</body>

</html>