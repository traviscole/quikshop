<!--Create the form in jQuery:-->

<form id="loginForm">
    <div data-role="fieldcontain" class="ui-hide-label">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="" placeholder="Username" />
    </div>

    <div data-role="fieldcontain" class="ui-hide-label">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="" placeholder="Password" />
    </div>

    <input type="submit" value="Login" id="submitButton">
</form>


<!--Package and send it to your php call using Ajax-->


$('#loginForm').submit(function(e){
  e.preventDefault();
  jQuery.support.cors = true; 
    $.ajax({ 
      url: 'http://quikshop.co:11080/auth.php',
      crossDomain: true,
      type: 'post',
      data: $("#loginForm").serialize(), 
      success: function(data){
        if(data.status == 'success'){
          window.location.href = 'http://quikshop.co:11080/app.html'; 
        }
        else if(data.status == 'error'){
          alert("Authentication Invalid. Please try again!");
          return false;        
        }
      }
    }); 
 }); 
 
 
 
 <!--Receive it in your PHP call-->
 
 
 
<?php
 <!--Allow for errors-->
error_reporting(E_ALL);
ini_set('display_errors', '1');

 <!--Connect to the database NOTE: Hostgator may need another connection route than 'localhost'-->
$mysqli = new mysqli("localhost","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

 <!--Various Includes-->
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS");
header("access-control-allow-credentials: true");
header("access-control-allow-headers: Content-Type, *");
header("Content-type: application/json");

 <!--Implementation-->
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

       <!--Assign the passed entry to variables-->
      $username = $_POST['username'];
      $password = $_POST['password'];

       <!--Find the correct table and row. Limit this to 1 result-->
      $sql = "SELECT user_id, user_password, username FROM users WHERE username='$username' LIMIT 1";
       <!--Assign this result to another veriable-->
      $result = $mysqli->query($sql) or die( $mysqli->error() );
      $row = mysqli_fetch_assoc($result);

       <!--See if the password matches-->
      if ($password == $row['user_password']) {
           <!--If so, write success to the response aray-->
          $response_array['status'] = 'success'; 
      } else {
           <!--If not, write error to response-->
          $response_array['status'] = 'error'; 
      }
 <!--Encode the response in JSON, it is auto matically passed back to the caller. Also echo this to the console-->
echo json_encode($response_array);

}
 <!--Close the connection-->
$mysqli->close();
?>
