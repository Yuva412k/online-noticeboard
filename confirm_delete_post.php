<?php
if (!isset($_SESSION)) session_start();
?>

<?php
    require 'connect.php';

    if (isset($_SESSION['username']) AND $_POST['delete']) {
        $notificationID = $_POST['delete'];

        $query = "DELETE FROM notification WHERE notificationId='$notificationID'";
        $result = mysqli_query($mysql, $query) or die ("<h3>Sorry! Couldn't connect!</h3>");
        echo "success";
    } else {
        echo "failed";
    }
?>
