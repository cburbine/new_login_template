<?php
include 'connect_test.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
  session_start();
if(!isset($_POST['submit'])) { // if the form not yet submitted
  header("Location: home.php");
  exit;
  echo 'Name not set.  ';
}

$test_query = "SELECT * FROM tz_members WHERE usr = '".$_SESSION['username']."'";
$query_result = mysql_query($test_query)or die(mysql_error());
while($row_query = mysql_fetch_array($query_result)) {
  //echo '<p>While.</p>';
  if($_POST['new_password'] == $_POST['re_new_password']){
    //echo  'new == re_new ';
    if($row_query['pass'] == $_POST['old_password']){
      //echo ' old = pass ';
      $change_query = "UPDATE tz_members SET pass = '".$_POST['new_password']."' WHERE usr = '".$_SESSION['username']."'";
      $change_result = mysql_query($change_query)or die(mysql_error());
      //echo ' info is fine ';
      header('Location: home.php');

    } else {
      echo 'Invalid Password';
    }
  } else {
    echo 'Passwords to not match.';
  }
}

//echo '<p>End.</p>';
?>
