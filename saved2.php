<?php
if (!isset($_SESSION)) session_start();

?>

<?php
    require 'connect.php';

    if (!empty($_POST['heading']) and !empty($_POST['description'])) {

        function Redirect($url, $permanent = false)
        {
            header('Location: ' . $url, true, $permanent ? 301 : 302);

            exit();
        }
        $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $redirect_url = str_replace($url,'saved.php', 'profile.php?');

        if (isset($_SESSION['username']) and isset($_POST['heading']) and isset($_POST['description']) and isset($_SESSION['notID'])) {
            $username = $_SESSION['username'];
            $heading = addslashes($_POST['heading']);
            $description = addslashes($_POST['description']);
            $notificationID = $_SESSION['notID'];
            if(isset($_POST['disappear']) && $_POST['disappear']=='true'){
                if(!empty($_POST['disappear-msg-value'])){
                    $disappearTime = $_POST['disappear-msg-value'];
                $insert = "UPDATE notification SET heading='$heading', description='$description', post_type='1', disappear_time='$disappearTime' WHERE notificationId='$notificationID'";
            }            
            }else{
                $insert = "UPDATE notification SET heading='$heading', description='$description', post_type=NULL WHERE notificationId='$notificationID'";
            }
            $result = mysqli_query($mysql, $insert) or die ("<h5 style=\"margin-bottom: 100px; text-align: center; color: coral\">Something went <span style=\"color: red\">wrong</span>! (<span style=\"color: red\">Database or Server issue</span>)</h5><form action=\"edit_post.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
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
