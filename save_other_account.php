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
            $redirect_url = str_replace($url,'save_other_account.php', 'edit_other_account.php?');
            if (isset($_SESSION['password']) || isset($_SESSION['departId'])) {
                $pass = $_SESSION['password'];
                $departmentID = $_SESSION['departId'];
                
                if (isset($_POST['username']) AND isset($_POST['department']) AND isset($_POST['description']) AND isset($_POST['link']) AND isset($_POST['name']) AND isset($_POST['userlevel']) AND isset($_POST['designation']) AND isset($_POST['website']) AND isset($_POST['phone']) AND isset($_POST['email']) AND isset($_POST['password1'])) {
                    $password1 = md5($_POST['password1']);

                    if ($pass === $password1) {
                        $username = addslashes($_POST['username']);
                        $department = addslashes($_POST['department']);
                        $description = addslashes($_POST['description']);
                        $link = $_POST['link'];
                        $name = addslashes($_POST['name']);
                        $userlevel = $_POST['userlevel'];
                        $designation = addslashes($_POST['designation']);
                        $website = $_POST['website'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];

                        $insert = "UPDATE departments SET department='$department', dep_description='$description', linked='$link' WHERE departmentId='$departmentID'";
                        $res = mysqli_query($mysql, $insert) or die ("<h5 style=\"margin-bottom: 100px; text-align: center; color: coral\">Something went <span style=\"color: red\">wrong</span>! (<span style=\"color: red\">Database or Server issue</span>)</h5><form action=\"add.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
                        if ($res === TRUE) {

                            $query = "SELECT * FROM departments WHERE department='$department'";
                            $result = mysqli_query($mysql, $query)  or die ("<h5 style=\"margin-bottom: 100px; text-align: center; color: coral\">Something went <span style=\"color: red\">wrong</span>! (<span style=\"color: red\">Database or Server issue</span>)</h5><form action=\"add.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
                           
                                if($userlevel == 1){

                                    $insert1 = "UPDATE login_details SET username='$username', name='$name', userlevel='$userlevel' WHERE departmentId='$departmentID'";
                                }else{
                                    $insert1 = "UPDATE login_details SET username='$username', name='$name' WHERE departmentId='$departmentID'";

                                }
                                $result1 = mysqli_query($mysql, $insert1) or die ("<h5 style=\"margin-bottom: 100px; text-align: center; color: coral\">Something went <span style=\"color: red\">wrong</span>! (<span style=\"color: red\">Database or Server issue</span>)</h5><form action=\"add.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
                                if ($result1 === TRUE) {
                                    $insert2 = "UPDATE contact_info SET designation='$designation', website='$website',phone='$phone', email='$email' WHERE departmentId='$departmentID'";
                                    $result2 = mysqli_query($mysql, $insert2) or die ("<h5 style=\"margin-bottom: 100px; text-align: center; color: coral\">Something went <span style=\"color: red\">wrong</span>! (<span style=\"color: red\">Database or Server issue</span>)</h5><form action=\"add.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");
                                    if ($result2 === TRUE) {

                                            // echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Congratulations! New <span style='color: dodgerblue'>ADMIN</span> has been added successfully.</h3>";
                                            // include 'add.php';
                                        $redirect_to = str_replace($url,'save_other_account.php', 'edit_others_profile.php?');
                                            Redirect($redirect_to.'stat=0', false);
                                            // echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Congratulations! New <span style='color: dodgerblue'>USER</span> has been added successfully.</h3>";
                                            // include 'add.php';
                                    } else {
                                        // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Sorry! Couldn't enter <span style='color: red'>details</span>!.3</h3>";
                                        // include 'add.php';
                                        Redirect($redirect_url.'stat=5', false);

                                    }
                                } else {
                                    // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Sorry! Couldn't enter <span style='color: red'>details</span>!.2</h3>";
                                    // include 'add.php';
                                    Redirect($redirect_url.'stat=6', false);
                                }
                        } else {
                            // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Sorry! Couldn't enter <span style='color: red'>details</span>!.1</h3>";
                            // include 'add.php';
                            Redirect($redirect_url.'stat=7', false);                            
                        }
                    } else {
                        // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure your <span style='color: red'>password</span> is correct!</h3>";
                        // include 'add.php';
                        Redirect($redirect_url.'stat=8', false);                            
                    }
                } else {
                    // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure all <span style='color: red'>entries</span> are filled with constraints!</h3>";
                    // include 'add.php';
                        Redirect($redirect_url.'stat=9', false);                            
                }
            } else {
                // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure you're <span style='color: red'>logged in</span>!</h3>";
                // include 'add.php';
                Redirect($redirect_url.'stat=10', false);                            
            }
    ?>