<?php
if (!isset($_SESSION)) session_start();

?>
<?php
    require 'connect.php';

    if (isset($_SESSION['username']) AND isset($_POST['edit'])) {
        $username = $_SESSION['username'];
        $notificationID = $_POST['edit'];

        $query1 = "SELECT * FROM notification WHERE notificationId='$notificationID'";
        $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect.</h3>');
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $heading = $row1['heading'];
            $description = $row1['description'];
            $_SESSION['notID'] = $notificationID;
            $postType = $row1['post_type'];
            $disappearTime = $row1['disappear_time'];
            if($postType ==1){
                echo "success<<&&>>".$heading."<<&&>>".$description."<<&&>>".$postType."<<&&>>".$disappearTime;
            }else{
                echo "success<<&&>>".$heading."<<&&>>".$description."<<&&>>".$postType;
            }
        }
    } else {
        echo "failed";
        die ('');
    }

?>
