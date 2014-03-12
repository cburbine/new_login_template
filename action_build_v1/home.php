<!-- 
File: home.php 
Author: cburbine
Course: 91.462 - GUI II Programming
Email: christopher_burbine@student.uml.edu
Description: A profile page for the currently logged in user. Hub 
for removing books from personal lists and changing password atm.
Possible add-ons: Link to search page, move change password stuff
to another page.
-->
<?php
include 'connect_test.php'; //connect the connection page

if (empty($_SESSION)) { // if the session not yet started
    session_name('newLogin');
    session_set_cookie_params(2 * 7 * 24 * 60 * 60);
    session_start();
}

if (!isset($_SESSION['username'])) { //if not yet logged in
    header("Location: login.php"); // send to login page
    exit;
}
?>
<html>
    <body>
        Welcome <?php echo $_SESSION['username']; ?>,
        <a href="logout.php">logout</a> 
        <!-- Password change input boxes, should either be placed on a separate
            page to the home/user page or hidden with JavaScript.
        -->
        <form action="change_pswrd_v2.php" method="post">
            Old Password: <input type="password" name="old_password" /><br />
            New Password: <input type="password" name="new_password" /><br />
            Re-enter New Password: <input type="password" name="re_new_password" /><br />
            <input type = "submit" name="submit" value="Change Password" />
        </form>

        <?php
        echo '<br>';
        if ($_SESSION['id']) {
            $user = $_SESSION['username'];
            $sale_data = mysql_query("SELECT * FROM books_for_sale WHERE seller LIKE'%$user%'") or die('Error: ' . mysql_error());
            //creates a form which holds all entiries of bother wanted list and selling list
            //needed for item remove function(s)
            echo '<form method="post" value="Delete" action="remove_book_v2.php">';
            echo '<input type="submit" name="delete" value="Delete Selected" id="delKey"><br>';
            echo '<h3><strong>Books for Sale</strong></h3>';
            while ($result = mysql_fetch_array($sale_data)) {
                $isbn = $result['isbn'];
                //atm the adding functions do not set asking price will be updated later
                $asking_price = $result['asking_price'];
                echo '<strong>Asking Price</strong>: $' . $asking_price . '<br>';
                $slice_data = mysql_query("SELECT * FROM bookslice1 WHERE isbn LIKE'%$isbn%'") or die('Error: ' . mysql_error());
                while ($result_inner = mysql_fetch_array($slice_data)) {
                    echo '<strong>Title</strong>: ' . $result_inner['title'];
                    echo '<br>';
                    echo '<strong>Edition</strong>: ' . $result_inner['edition'];
                    echo '<br>';
                    echo '<strong>Author(s)</strong>: ' . $result_inner['author'];
                    echo '<br>';
                    echo '<strong>Class Number</strong>: ' . $result_inner['subject_number'] . '.' . $result_inner['class_number'];
                    echo '<br>';
                    echo '<strong>ISBN</strong>: ' . $result_inner['isbn'];
                    echo '<br>';
                    //radio button for remove funtion, passes isbn to function
                    echo '<input type="radio" name="pass_val" value="' . $result_inner['isbn'] . '">';
                }
                echo '<br>';
            }
            echo '<h3><strong>Wanted Books</strong></h3>';
            $wanted_data = mysql_query("SELECT * FROM wanted_books WHERE buyer LIKE '%$user%'") or die('Error: ' . mysql_error());

            while ($result = mysql_fetch_array($wanted_data)) {
                $isbn2 = $result['isbn'];
                $slice_data = mysql_query("SELECT * FROM bookslice1 WHERE isbn LIKE'%$isbn2%'") or die('Error slice: ' . mysql_error());
                while ($result_inner = mysql_fetch_array($slice_data)) {
                    echo '<strong>Title</strong>: ' . $result_inner['title'];
                    echo '<br>';
                    echo '<strong>Edition</strong>: ' . $result_inner['edition'];
                    echo '<br>';
                    echo '<strong>Author(s)</strong>: ' . $result_inner['author'];
                    echo '<br>';
                    echo '<strong>Class Number</strong>: ' . $result_inner['subject_number'] . '.' . $result_inner['class_number'];
                    echo '<br>';
                    echo '<strong>ISBN</strong>: ' . $result_inner['isbn'];
                    echo '<br>';
                    //radio button for remove funtion, passes isbn to function; major differnce with
                    //buttons above is that the name is different, changed so removal function can tell 
                    //the difference between books on the wanted list and books on the selling list
                    echo '<input type="radio" name="pass_val_W" value="' . $result_inner['isbn'] . '">';
                }
                echo'<br>';
            }
        }
        ?>
    </form>
</body>
</html> 
