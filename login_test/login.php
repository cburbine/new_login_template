<?php
include 'connect_test.php'; //connect the connection page
if(empty($_SESSION)){ // if the session not yet started 
   session_start();
}

if(isset($_SESSION['username'])) { // if already login
   header("location: home.php"); // send to home page
   exit; 
}

?>
<html>
<head></head>
<body>
<form action = "login_pro.php" method = "post">
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
<input type = "submit" name="submit" value="login" />
</form>
</body>
</html>
