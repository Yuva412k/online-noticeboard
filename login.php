<?php
	function Redirect($url, $permanent = false)
	{
		header('Location: ' . $url, true, $permanent ? 301 : 302);

		exit();
	}
    if (!isset($_SESSION)){
	 session_start();
	if(isset($_SESSION['username'])){
		Redirect('profile.php',false);	
	}
	}		
	$_SESSION['current_page'] = 'login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login : CCNB</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="../../img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="./style.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- header -->
    <?php
        include 'header.php';
    ?>

    <!-- content -->
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>
				<div class="error">
                <?php 
            if(isset($_GET['stat'])){

                $stat = $_GET['stat'];
                $str = "";
                switch($stat){
                    case 1: $str = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username Or Password Incorrect! and make sure to select your department';
                        break;
                }
                
                echo $str.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            
        ?>
                </div>
                <br>
				<form class="login100-form validate-form" action="dashboard.php" method="post">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
					<br>
						<span class="label-input100" style="margin-top:15px;">Department</span>
                        <select name="departmentId" class="form-control select" style="width: 100%;" required>
                            <?php
                                require "connect.php";

                                $query = "SELECT * FROM departments";
                                $result = mysqli_query($mysql, $query) or die('<h3>Sorry! Couldn\'t connect. (0)</h3>');
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $departmentID = $row['departmentId'];

                                    $query1 = "SELECT * FROM departments WHERE departmentId='$departmentID'";
                                    $result1 = mysqli_query($mysql, $query1) or die('<h3>Sorry! Couldn\'t connect. (1)</h3>');
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                        $department = $row1['department'];

                                        echo '<option value="' . $departmentID . '">' . $department . '</option>';
                                    }
                                }
                            ?>
                        </select>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <!-- footer -->
    <?php
        include 'footer.php';
    ?>
    <script>
        $('.select').select2();
    </script>
</body>
</html>

