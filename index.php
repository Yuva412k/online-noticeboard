<?php
    if (!isset($_SESSION)) session_start();
    $_SESSION['current_page'] = 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notice Board</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="./style.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">   
    <link rel="stylesheet" type="text/css" href="css/util.css">
</head>
<body>
    <!-- header -->
    <?php
        include 'header.php';
    ?>
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/slide1.jpeg" alt="" width="100%">
      <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
        <h1>Rajiv Gandhi Arts & Science College</h1>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/slide2.jpg" alt="" width="100%">
      <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
        <h1>Rajiv Gandhi Arts & Science College</h1>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/slide3.jpg" alt="" width="100%">
      <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
        <h1>Rajiv Gandhi Arts & Science College</h1>
          </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
    <!-- Title -->
    <div class="title-container" style="width:30%;height:150px">
        <div class="title-image" style="background-image: url(img/recent.jpg);">
            <span class="title-text">
                Recent Post 
            </span>
        </div>
    </div>
    <br>
    <!-- content -->
    <div class="container-fluid" id="recent-post" style="max-width: 95%;margin:auto;">
            <?php
                require "connect.php";
                $date = date_default_timezone_set('Asia/Kolkata');

                //If you want Day,Date with time AM/PM
                $today = date("Y-m-d H:i:s");
                    $query = "SELECT * FROM notification ORDER BY notificationId DESC LIMIT 10";
                    $result = mysqli_query($mysql, $query) or die('<h3>Sorry! Couldn\'t connect. (0)</h3>');
                    while ($row = mysqli_fetch_assoc($result)) {
                        $notificationID = $row['notificationId'];

                        $query1 = "SELECT * FROM notification WHERE notificationId='$notificationID' And (disappear_time IS NULL OR  disappear_time>='$today')";

                        $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect. (1)</h3>');

                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $username = $row1['username'];
                            $heading = $row1['heading'];
                            $description = $row1['description'];
                            $time_stamp = $row1['time_stamp'];

                            $query2 = "SELECT * FROM login_details WHERE username='$username'";
                            $result2 = mysqli_query($mysql, $query2) or die('<h3>Sorry! Couldn\'t connect. (2)</h3>');

                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $departmentID = $row2['departmentId'];

                                $query3 = "SELECT * FROM departments WHERE departmentId='$departmentID'";
                                $result3 = mysqli_query($mysql, $query3) or die('<h3>Sorry! Couldn\'t connect. (3)</h3>');

                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $department = $row3['department'];

                                    // echo '<div class="row" style="padding: 10px; min-height: 200px; border-radius: 10px; overflow: auto; margin: 20px; background-color: dimgrey; text-align: center"><div class="col-lg-2"><span style="color: orange;"><i class="fa fa-calendar" style="color: oldlace"></i> ' . $time_stamp . '</span><h4 class="form1" id="head" style="color: white;">' . $department . '</h4></div><div class="col-lg-8"><h4 style="color: #333333; background-color: azure; padding: 10px; border-radius: 5px;font-size: 16px;">' . $heading . '</h4><p style="color: aliceblue; white-space: pre-line; margin-top: 20px">' . $description . '</p></div><div class="col-lg-2"><form style="text-align: center; margin: 30px" method="post" action="visit.php"><button name="department" value="' . $department . '" type="submit" class="form btn btn-info">Visit other posts</button><br/></form></div></div>';
                                     echo '   
                                        <div class="post-bar" style="width:30%;margin:10px 10px;height: 350px;">
                                        <div class="post_topbar">
                                        <div class="usy-dt">
                                        <img src="img/profile.png" height="50px" style="margin-top: -5px;" alt="">
                                        <div class="usy-name">
                                        <h3>'.$username.'</h3>
                                        <span><i style="font-size:12px" class="fas fa-clock"></i> '.$time_stamp.'</span>
                                        </div>
                                        <div class="usy-name" style="float:right;text-align:right;">
                                        <h3 style="color:rgb(123, 125, 125);">Department</h3>
                                        <span>'.$department.'</span>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="job_descp">
                                            <br>
                                        <fieldset class="showPost" style="height: 210px">
                                        <div style="padding:20px 10px 10px;cursor:pointer">
                                        <h3 class="heading-post" style="text-align:center;width:100%;">'.$heading.'</h3> 
                                        <p class="description" style="white-space: pre-line;">'.$description.'</p></div>
                                        </fieldset>
                                        <a href="visit.php?department='.$department.'" class="btn btn-outline-primary btn-block">View More</a>
                                        </div>
                                        </div>';

                                }
                            }
                        }
                    }
            ?>
    </div>

  <a href="#" id="showPost" data-toggle="modal" data-target="#showPostModal"></a>

  <div class="modal fade" id="showPostModal" tabindex="-1" role="dialog" aria-labelledby="showPostModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 700px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="modal-title"></h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body" style="white-space: pre-line;"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div> 
    <!-- footer -->
    <?php
        include 'footer.php';
    ?>



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