<?php
if (!isset($_SESSION)) session_start();
$_SESSION['current_page'] = 'contact';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact us : CCNB</title>
    <meta charset="utf-8">
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
                Contact 
            </span>
        </div>
    </div>
    <!-- content -->
    <section class="flipcard">
        <div class="row">
            <?php
            require "connect.php";

            
            $query = "SELECT * FROM contact_info";
            $result = mysqli_query($mysql, $query) or die('<h3>Sorry! Couldn\'t connect. (0)</h3>');
            while ($row = mysqli_fetch_assoc($result)) {
                $departmentID = $row['departmentId'];

                $query1 = "SELECT * FROM login_details WHERE departmentId='$departmentID'";
                $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect. (1)</h3>');
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $name = $row1['name'];

                    $query2 = "SELECT * FROM departments WHERE departmentId='$departmentID'";
                    $result2 = mysqli_query($mysql, $query2) or die('<h3>Sorry! Couldn\'t connect. (2)</h3>');
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $department = $row2['department'];

                        $query3 = "SELECT * FROM contact_info WHERE departmentId='$departmentID'";
                        $result3 = mysqli_query($mysql, $query3) or die('<h3>Sorry! Couldn\'t connect. (3)</h3>');
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $designation = $row3['designation'];
                            $website = $row3['website'];
                            $phone = $row3['phone'];
                            $email = $row3['email'];

                            // echo '<div class="col-lg-3" style="padding: 10px;"><div style="padding: 15px; border-radius: 5px; text-align: center; overflow: scroll; max-height: 400px; min-height: 400px; background-color: dimgrey;"><h4 class="form2" style="color: white">'.$department.'</h4><h4 class="form-control" style="color: #333333">'.$name.'</h4><h6 class="form-control" style="color: #333333">'.$designation.'</h6><p style="color: aliceblue"><a style="color: aliceblue" href="'.$website.'" target="_blank"><i class="fa fa-globe fa-lg"></i></a><br/></p><p style="color: aliceblue"><i class="fa fa-phone-square fa-lg"></i> : '.$phone.'<br/></p><p style="color: aliceblue"><i class="fa fa-envelope-o fa-lg"></i> : '.$email.'</p></div></div>';
                            echo '<div class="col-md-3" style="max-width: 350px;margin-top: 20px;">
                            <div class="card-flipper effect__hover" data-id="1">
                              <div class="card__front">
                                <div class="card card-01">
                                  <div class="card-body text-center">
                                      <fieldset>
                                          <legend>'.$department.'</legend>
                                          <span class="card-title text-center"><strong>Name</strong></span>
                                          <div>
                                              <p class="card-text">'.$name.'</p>
                                          </div>
                                      </fieldset>
                                  </div>
                                  <div class="card-footer text-center">
                                      <div>
                                          <h4>Email</h4>
                                          <p>'.$email.'</p>
                                      </div>
                                      <div>
                                          <h4>Phone No:</h4>
                                          <p>'.$phone.'</p>
                                      </div>
                                  </div>
                                </div>
                              </div>
                  
                              <div class="card__back">
                                <div class="card card-01">
                                  <div class="card-body text-center">
                                    <h1 class="card-title">'.$name.'</h1>
                                    <p class="card-text">'.$designation.'</p>
                                    <strong>Department</strong><p>'.$department.'</p>
                                    <strong>Email</strong><p>'.$email.'</p>
                                    <strong>Phone</strong><p>'.$phone.'</p>
                                    <a href="'.$website.'" class="btn btn-default" target="_blank">Visit Website</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>';
                        }
                    }
                }

            }

            ?>
        </div>
  </section>
    <!-- footer -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>

