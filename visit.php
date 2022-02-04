<?php
if (!isset($_SESSION)) session_start();

$_SESSION['current_page'] = 'department';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View post : CCNB</title>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="./style.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
</head>
    <body>
    <?php include_once "header.php"?>
    <?php
        $department = addslashes($_GET['department']);
    ?>

        <?php
            require 'connect.php';

            if (isset($_GET['department'])) {
                $date = date_default_timezone_set('Asia/Kolkata');

                //If you want Day,Date with time AM/PM
                $today = date("Y-m-d H:i:s");
                GLOBAL $department;
                $query = "SELECT * FROM departments WHERE department='$department'";
                $result = mysqli_query($mysql, $query) or die('<h3>Sorry! Couldn\'t connect.</h3>');
                while ($row = mysqli_fetch_assoc($result)) {
                    $departmentID = $row['departmentId'];
                    $department = $row['department'];


                    GLOBAL $departmentID;
                    $query1 = "SELECT * FROM login_details WHERE departmentId='$departmentID'";
                    $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect.1</h3>');
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $username = $row1['username'];

                        GLOBAL $username;
                        $query2 = "SELECT * FROM notification WHERE username='$username' And (disappear_time IS NULL OR  disappear_time>='$today') ORDER BY notificationId DESC";
                        $result2= mysqli_query($mysql, $query2) or die('<h3>Sorry! Couldn\'t connect.</h3>');
                    if(mysqli_num_rows($result2)!=0){

                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $time = $row2['time_stamp'];
                            $heading = $row2['heading'];
                            $description = $row2['description'];
                            $dispMsg = '';
                            $postType = $row2['post_type'];
                            if($postType == 1){
                                $dispMsg = '<span title="Disappear Message" style="float:left;background-color: crimson;padding: 5px 5px;color: #fff;border-radius: 10px;margin-right:5px;"><i class="fas fa-clock"></i></span>'.$row2['disappear_time'];
                            }

                            // echo '<div class="row" style="padding: 10px; border-radius: 10px; overflow: scroll; margin: 20px; background-color: dimgrey; text-align: center"><div style="overflow: scroll; padding: 15px; border-radius: 5px; background-color: dimgrey; text-align: center"><span style="color: orange"><i class="fa fa-calendar" style="color: oldlace"></i> ' . $time . '</span><h4 style="color: #333333;  background-color: azure; padding: 10px; border-radius: 5px; font-size: 16px;">' . $heading . '</h4><p style="color: aliceblue; white-space: pre-line">' . $description . '</p></div></div>';
                            echo '<div class="paper-shadow showPost">
                            <div>
                                <img src="img/paper-pin.png" width="60px">
                            </div>
                            
                            <span>
                                <i>: '.$time.'</i><br><i>: '.$department.'</i>
                            </span>
                            <span><strong>Date</strong><br>
                                <strong>Department</strong></span>'.$dispMsg.'
                            <br><br>
                            <h1 class="heading-post">'.$heading.'</h1><br>
                            <p class="description">'.$description.'</p>
                        </div>';
                        }
                    }else{
                        echo '
                        <div class="title-container text-center">
                        <h1 style="font-size: 30px;font-weight:bolder"> No Post Found!!</h1>
                        </div>
                        ';
                    }

                    }
                }
            } else {
                echo '
                <div class="title-container text-center">
                <h1 style="font-size: 30px;font-weight:bolder"> No Post Found!!</h1>
                </div>
                ';
                // echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Please <span style='color: red'>try</span> again.</h3>";
            }

        ?>

<a href="#" id="showPost" data-toggle="modal" data-target="#showPostModal"></a>

<div class="modal fade" id="showPostModal" tabindex="-1" role="dialog" aria-labelledby="showPostModalLabel" aria-hidden="true">
<div class="modal-dialog" style="max-width: 700px;" role="document">
  <div class="modal-content">
  <h1 class="modal-title text-center" style="margin-top: 20px;font-weight:bold" id="modal-title"></h1>
<br><br>
    <div class="modal-body" id="modal-body" style="white-space: pre-line;"></div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div> 


<?php include 'footer.php'?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){
      $('.showPost').click(function(e){
        heading = $(this).find('.heading-post').text();
        description = $(this).find('.description').text();

        $('.modal-title').html(heading);
        $('.modal-body').html(description);
        $('#showPost').trigger('click');
      })
    })
  </script>
</body>
</html>