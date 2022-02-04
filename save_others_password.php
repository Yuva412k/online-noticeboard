<?php
if (!isset($_SESSION)) session_start();

if (($_SESSION['userlevel'] === NULL) OR ($_SESSION['userlevel'] == 0)) {
    die ("<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Haha</span>! C'mon you can do better!</h3><form style='text-align: center' action=\"logout.php\" method=\"post\"><button style='font-size: larger' class=\"form1 btn btn-info btn-block\">Back</button><br/><br/></form>");
}
?>

    <?php
        require 'connect.php';
        function Redirect($url, $permanent = false)
        {
            header('Location: ' . $url, true, $permanent ? 301 : 302);

            exit();
        }
        $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $redirect_url = str_replace($url,'save_others_password.php', '');

        if (isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['password2'])) {
            if(empty($_POST['password']) || empty($_POST['password1'] || empty($_POST['password2']))){
               return Redirect($redirect_url.'edit_others_account.php?departmentid='.$departmentID.'&stat=4', false);
            }
            $password = md5($_POST['password']);
            $password1 = md5($_POST['password1']);
            $password2 = md5($_POST['password2']);
            $pass = $_SESSION['password'];
            $departmentID = $_SESSION['departId'];

            if ($password === $pass) {
                $query2 = "SELECT * FROM login_details WHERE departmentId='$departmentID'";
                $result2 = mysqli_query($mysql, $query2) or die ('<h3>Sorry! Couldn\'t connect!.1</h3>');
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $user = $row2['username'];
                    $name = $row2['name'];

                    if ($password1 === $password2) {

                        $query = "SELECT * FROM login_details WHERE username='$user'";
                        $result = mysqli_query($mysql, $query) or die ('<h3>Sorry! Couldn\'t connect!.1</h3>');

                        $query1 = "UPDATE login_details SET password='$password2' WHERE username='$user'";
                        $result1 = mysqli_query($mysql, $query1) or die ("<form action=\"edit_others_password.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
                    
                        Redirect($redirect_url.'edit_others_profile.php?'.'stat=0', false);
                        // echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Dear <span style='color: dodgerblue'>" . $_SESSION['name'] . "</span>, you've updated <span style='color: dodgerblue'>".$name."</span>'s password successfully!</h3>";
                        
                    } else {
                        // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Your new <span style='color: red'>passwords</span>  don't match!</h3>";
                        // include 'edit_password.php';x
                        Redirect($redirect_url.'edit_others_account.php?departmentid='.$departmentID.'&stat=1', false);
                    }
                }
            } else {
                Redirect($redirect_url.'edit_others_account.php?departmentid='.$departmentID.'&stat=2', false);
                // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Your <span style='color: red'>password</span> is incorrect!</h3>";
                // include 'edit_password.php';
            }

        } else {
            Redirect($redirect_url.'edit_others_account.php?departmentid='.$departmentID.'&stat=3', false);
            // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Sorry</span>! Couldn't read data.</h3>";
            // include "edit_password.php";
        }

    ?>

</body>
</html>