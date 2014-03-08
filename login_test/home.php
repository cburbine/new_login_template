<?php
include 'connect_test.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
} 
?>
<html>
<body>
Welcome <?php echo $_SESSION['username']; ?>,
 <a href="logout.php">logout</a> 
</body>
</html> 
