<?php
if (!isset($_SESSION)) session_start();
$department = $_SESSION['department'];
?>

        <!-- <div style="margin: 20px">
            <form action="loggedin.php" method="post">
                <button class="form1 btn btn-success btn-block">Back</button>
            </form>
        </div> -->


    <!-- <div class="container-fluid" style="overflow: scroll; max-width: 80%"> -->
        <?php
            // require 'connect.php';

            // if (isset($_SESSION['username'])) {
            //     $username = $_SESSION['username'];

            //         $query1 = "SELECT * FROM notification WHERE username='$username' ORDER BY notificationId DESC ";
            //         $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect.</h3>');
            //         while ($row1 = mysqli_fetch_assoc($result1)) {
            //             $notificationID = $row1['notificationId'];
            //             $heading = $row1['heading'];
            //             $description = $row1['description'];
            //             $time = $row1['time_stamp'];

            //             echo '<div class="row" style="padding: 10px; border-radius: 10px; overflow: scroll; margin: 20px; background-color: dimgrey; text-align: center"><div style="overflow: scroll; padding: 15px; border-radius: 5px; background-color: dimgrey; text-align: center"><span style="color: orange"><i class="fa fa-calendar" style="color: oldlace"></i> ' . $time . '</span><h4 style="color: #333333;  background-color: azure; padding: 10px; border-radius: 5px; font-size: 16px;">' . $heading . '</h4><p style="color: aliceblue; white-space: pre-line">' . $description . '</p></div><form action="edit_post.php" method="post"><button class="form1 btn btn-warning btn-block" name="edit" value="'.$notificationID.'">Edit</button></form><form action="delete_post.php" method="post"><button name="delete" class="form1 btn btn-danger btn-block" value="'.$notificationID.'">Delete</button></form></div>';
            //         }
            // } else {
            //     echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Please <span style='color: red'>try</span> again.</h3>";
            // }

        ?>
    <!-- </div>
    <div style="margin: 20px">
        <form action="loggedin.php" method="post">
            <button class="form1 btn btn-success btn-block">Back</button>
        </form>
    </div> -->


    <div class="posts-section">
    <?php
            require 'connect.php';

            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];

                    $query1 = "SELECT * FROM notification WHERE username='$username' ORDER BY notificationId DESC ";
                    $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect.</h3>');
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $notificationID = $row1['notificationId'];
                        $heading = $row1['heading'];
                        $description = $row1['description'];
                        $time = $row1['time_stamp'];
                        $dispMsg = '';
                        $postType = $row1['post_type'];
                        if($postType == 1){
                            $dispMsg = '<span style="background-color: #e2e2e2;border-radius: 20px;padding: 2px 5px;">Disappear Message</span>';
                        }
                        // echo '<div class="row" style="padding: 10px; border-radius: 10px; overflow: scroll; margin: 20px; background-color: dimgrey; text-align: center"><div style="overflow: scroll; padding: 15px; border-radius: 5px; background-color: dimgrey; text-align: center"><span style="color: orange"><i class="fa fa-calendar" style="color: oldlace"></i> ' . $time . '</span><h4 style="color: #333333;  background-color: azure; padding: 10px; border-radius: 5px; font-size: 16px;">' . $heading . '</h4><p style="color: aliceblue; white-space: pre-line">' . $description . '</p></div><form action="edit_post.php" method="post"><button class="form1 btn btn-warning btn-block" name="edit" value="'.$notificationID.'">Edit</button></form><form action="delete_post.php" method="post"><button name="delete" class="form1 btn btn-danger btn-block" value="'.$notificationID.'">Delete</button></form></div>';
                        echo '   
                        <div class="post-bar">
                        <div class="post_topbar">
                        <div class="usy-dt">
                        <img src="img/profile.png" height="50px" style="margin-top: -5px;" alt="">
                        <div class="usy-name">
                        <h3>'.$username.'</h3>'.$dispMsg.'
                        <span><img src="images/clock.png" alt="">'.$time.'</span>
                        </div>
                        </div>
                        <div class="dropdown-container">
                        <div class="dropdown">
                        <a href="#" title="" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item edit_post" href="#" data-id='.$notificationID.'>Edit Post</a>
                            <a class="dropdown-item delete_post" href="#" data-id='.$notificationID.'>Delete</a>
                        </ul>
                        </div>
                        </div>
                        </div>
                        <div class="job_descp">
                            <br>
                        <h3>'.$heading.'</h3>
                        <p>'.$description.'</p>
                        </div>
                        </div>';
                    }
            } else {
                echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Please <span style='color: red'>try</span> again.</h3>";
            }

    ?>
    </div>
</body>
</html>