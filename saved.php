<?php
if (!isset($_SESSION)) session_start();
?>

    <?php
        require 'connect.php';

        function Redirect($url, $permanent = false)
        {
            header('Location: ' . $url, true, $permanent ? 301 : 302);

            exit();
        }
        $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $redirect_url = str_replace($url,'saved.php', 'profile.php?');


        if (!empty($_POST['heading']) and !empty($_POST['description'])) {

            if (isset($_SESSION['username']) and isset($_POST['heading']) and isset($_POST['description'])) {
                $username = $_SESSION['username'];
                $heading = addslashes($_POST['heading']);
                $description = addslashes($_POST['description']);
                if(isset($_POST['disappear']) && $_POST['disappear']=='true'){
                    if(!empty($_POST['disappear-msg-value'])){
                        $disappearTime = $_POST['disappear-msg-value'];
                    $insert = "INSERT INTO notification (username, heading, description, time_stamp,post_type,disappear_time) VALUES ('$username', '$heading', '$description', CURRENT_TIME, 1, '$disappearTime')";
                    }
                }else{
                    $insert = "INSERT INTO notification (username, heading, description, time_stamp) VALUES ('$username', '$heading', '$description', CURRENT_TIME)";
                }
                $result = mysqli_query($mysql, $insert) or die ("<form action=\"write_post.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
                if ($result === TRUE) {
                    $_SESSION['heading'] = $heading;
                    $_SESSION['description'] = $description;

                    Redirect($redirect_url.'stat=0', false);

                } else {
                    // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure your <span style='color: red'>username</span> is correct and try again.</h3>";
                    // include 'write_post.php';
                    Redirect($redirect_url.'stat=1', false);
                }

            } else {
                // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure you've <span style='color: red'>filled</span> all the entries.</h3>";
                // include 'write_post.php';
                Redirect($redirect_url.'stat=2', false);
            }
        } else {
            // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure you've <span style='color: red'>filled</span> all the entries.</h3>";
            // include 'write_post.php';
            Redirect($redirect_url.'stat=2', false);
        }

    ?>
