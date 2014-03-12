<!-- 
File: login.php
Author: cburbine
Course: 91.462 - GUI II Programming
Email: christopher_burbine@student.uml.edu
Description: Login page for build, user redirects here if they try
to go to home.php.
-->
<?php
include 'connect_test.php'; //connect the connection page
if (empty($_SESSION)) { // if the session not yet started
    session_name('newLogin');
    session_set_cookie_params(2 * 7 * 24 * 60 * 60);
    session_start();
}

if (isset($_SESSION['username'])) { // if already login
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
