<?php
    if (!isset($_SESSION)) session_start();
    $_SESSION['current_page']='department';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clubs : CCNB</title>
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
    
    <!-- Title -->
    <div class="title-container">
        <div class="title-image" style="background-image: url(img/bg-01.jpg);">
            <span class="title-text">
                Departments 
            </span>
        </div>
    </div>
    <!-- content -->
        <section class="flipcard">
        <div class="row">
            <?php
                require "connect.php";

                $query = "SELECT a.*, b.username FROM departments as a, login_details as b WHERE a.departmentId=b.departmentId";
                $result = mysqli_query($mysql, $query) or die('<h3>Sorry! Couldn\'t connect. (0)</h3>');
                while ($row = mysqli_fetch_assoc($result)) {
                    $departmentID = $row['departmentId'];

                            $department = $row['department'];
                            $description = $row['dep_description'];
                            $link = $row['linked'];
                            $name = $row['username'];

                            // echo '<div class="col-lg-3" style="padding: 10px;"><div style="overflow: scroll; padding: 15px; text-align: center; border-radius: 5px; max-height: 700px; min-height: 700px; background-color: dimgrey;"><h3 class="form2"><a id="link" style="color: aliceblue" href="' . $link . '" target="_blank">' . $department . '</a></h3><p style="color: white; white-space: pre-line">' . $description . '</p><form style="margin-top: 80px" method="post" action="visit2.php"><button name="department" value="' . $department . '" type="submit" class="form1 btn btn-primary btn-block">Visit posts</button></form></div></div>';
                            echo '<div class="col-md-3" style="max-width: 350px;margin-top: 20px;">
                            <div class="card-flipper effect__hover" data-id="1">
                              <div class="card__front">
                                <div class="card card-01">
                                  <div class="card-body text-center">
                                      <fieldset>
                                          <legend>'.$department.'</legend>
                                          <span class="card-title"><strong>About Department</strong></span>
                                          <div>
                                              <p class="card-text">'.$description.'</p>
                                          </div>
                                      </fieldset>
                                  </div>
                                  <div class="card-footer text-center">
                                      <div>
                                          <h4>Staff Name</h4>
                                          <p>'.$name.'</p>
                                      </div>
                                  </div>
                                </div>
                              </div>
                  
                              <div class="card__back">
                                <div class="card card-01">
                                  <div class="card-body text-center">
                                    <h1 class="card-title">'.$department.'</h1>
                                    <p class="card-text">'.$description.'</p>
                                    <a href="visit.php?department='.$department.'" class="btn btn-default">View More</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>';
                }
            ?>
            </div>
  </section>
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="http://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>

</html>
    <!-- footer -->
    <?php
        include 'footer.php';
    ?>


</body>
</html>

