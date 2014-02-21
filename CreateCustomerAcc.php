#!/usr/local/bin/php
<html lang= 'en'>

<head>
	<title>Create Account</title>   
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <script type = "text/javascript" charset="utf-8" src="cordova/cordova.js"></script>
</head>
        
 
        <body>
        	
        	   <script>
				function checkInput()
				{
										name=document.forms[0].name.value;
										lastname=document.forms[0].lastname.value;
										dob=document.forms[0].dob.value;
										email=document.forms[0].email.value;
										password = document.forms[0].password.value;
					
					alert("Hello " + name +" "+ lastname+ "Your email is"+  email + " password is: " + password + " and DOB is " + dob);

						
												                        
	          <?php
                           $myServer = "quikshop.co";
                            $myUser = "cx300_cen3031";
                            $myPass = "[cEn..3031!]";
                            $myDB = "cx300_quikshop"; 
                        
                        //connection to the database
                        $dbhandle =  mysqli_connect($myServer, $myUser, $myPass, $myDB);
                          //or die("Couldn't connect to SQL Server on $myServer"); 
                    
					// Test if connection occured
					if (mysqli_connect_errno()) {
						die("connection failed: " .
							mysqli_connect_error() .
							" (" . mysqli_connect_errno() ." )" );
					}
					else {
						?>
							alert( "Successfully connected to database!!!!!" +name+" This is the  name ");	
					<?php
					}
                        
					  
					  
					  
			
					  
					   $query = "INSERT INTO users VALUES (?>'{$id}', {$email}' {$password}<?php)";
					 
				       
						//$result = mysqli_query($myDB, $query);
						
						//Test for query error
						//if ($result) {
						//die ("Database query failed. " . mysqli_error($connection));	
						//}
					//  **************************************************************************** 
					 //  ?>	
					 <?php
					
					 /*    $test = "SELECT * FROM users";
						 $result = mysqli_query($dbhandle, $test);
						  echo "it works";
						  if (!$result){
							die("database query failed.");  
						  }

		*/
					
					
					?> 
					   
					   
									
			
				}
				</script>
        	
	            <div data-role="page" data-theme="b">
				<div data-role="header" data-theme="b">
					<h1><img src="logo.png" width="126" height="26" align="middle" /></h1>
        			<a href="help.html" data-icon="info" class="ui-btn-right" position:absolute top:50% data-transition="slide">Help</a>
       				<a href="http://www.quikshop.co" class="ui-btn-left" data-icon="arrow-l" data-iconpos="left" data-transition="slide">Back</a>
				</div>
                
    			<div data-role="content">  
     
    	<div id="landmark-1" data-landmark-id="1">
                       
						<form method="checkInput()">
                        	<div data-role="fieldcontain" class="ui-hide-label">
                            
								<input type="text" name="name" id="name" maxlength ='25' placeholder="First Name" /> 
                                 	<br />
                    				<br />
                                <input type="text" maxlength ='25' id="lastname" name="lastname"  placeholder="Last Name" /> 
                                    <br />
                    				<br />
								<input type="date" name="date1"pattern="\d{2}-\d{2}-\d{4}" title="MM-DD-YYYY"  placeholder="DOB" maxlength ='25' id="dob" /> 
                                    <br />
                    				<br />
								<input type="email" maxlength ='35' name="email" id="email" placeholder="Email"/>
                                    <br />
                    				<br />
                                <input type="password" name="password" maxlength ='25' id="password " placeholder="Password"/> 
                                     <br />
                    				 <br />
                                <input type="password" name="re-enter" maxlength ='25' id="re-enter " placeholder="Re-Enter Password"/> 
                                 	<br />
							 	
                                </div>
								
							<!--	<input type="submit" name="cancel" value="Cancel" style="width: 250px;" onClick="location.href='default.html';"/>  
								 <input type="submit" name="submit" value="Create" style="width: 250px;" onClick="checkInput()"/> -->
                                 <div style="text-align:left">  
									<input type="submit" style="width: 250px;" data-inline="false" value="Submit" >
                                 </div>
						</form>
			
					

                </div>
                <!-- /page -->
 						<!-- footer -->
                        
                        <div data-role="footer" data-position="fixed"  data-theme="b" data--tap-toggle="false">
                                <h4>&copy; 2013 QuikShop</h4>
                        </div>
                        <!-- /footer -->
        </body>
        
        
        
		                        <!-- footer -->
                       
                        <!-- /footer -->
</html>
<?php
mysqli_close($dbhandle);
?>
