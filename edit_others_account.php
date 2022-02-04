<?php
if (!isset($_SESSION)) session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Others Account </title>
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
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        @media (min-width:1150px) {
            
        .wrap-login100 {
            width: 80%;
        }
        .wrap-input100 {
            width: 40%;
        }
        .container-login100-form-btn {
            margin-top: 20px;
            justify-content: center;
        }
        }
    </style>
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
						Edit Other Account
					</span>
				</div>
                <div class="error">
                <?php 
            if(isset($_GET['stat'])){

                $stat = $_GET['stat'];
                $str = "";
                switch($stat){
                    case 1: $str = '<div class="alert alert-danger alert-dismissible fade show" role="alert">New Password doesn\'t match with confirm password!';
                        break;
                    case 2: $str = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Current Password is Incorrect!';
                        break;
                    case 3: $str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Sorry! We couldn\'t Read Data!';
                    break;
                    case 4: $str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Passwords! Can\'t be Empty!';
                    break;
                    case 5: $str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Process couldn\'t perform.!';
                    break;
                    case 6: $str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Username already in use.!';
                    break;
                    case 7: $str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Department Name! already in use!';
                    break;
                    case 8: $str = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Current passwords! does\'t match!';
                    break;
                    case 9: $str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Please! make sure all the fileds are filled!';
                    break;
                    case 10: $str = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Your session has expired please login again!';
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
                <?php
        require 'connect.php';
        $department=$dep_description=$link=$username=$name=$userlevel=$designation=$website=$phone=$email='';
        if (isset($_SESSION['username']) AND $_GET['departmentid']) {
            $departmentID =$_GET['departmentid'];
            $_SESSION['departId'] = $departmentID;

            $query = "SELECT * FROM departments WHERE departmentId='$departmentID'";
            $result = mysqli_query($mysql, $query) or die ("<h3>Sorry! Couldn't connect!</h3>");
            while ($row = mysqli_fetch_assoc($result)) {
                $department = $row['department'];
                $link = $row['linked'];
                $dep_description = $row['dep_description'];
                $_SESSION['depart'] = $department;

                $query1 = "SELECT * FROM login_details WHERE departmentId='$departmentID'";
                $result1 = mysqli_query($mysql, $query1) or die ("<h3>Sorry! Couldn't connect!</h3>");
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $name = $row1['name'];
                    $userlevel = $row1['userlevel'];
                    $username = $row1['username'];

                    // echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Hello <span style='color: dodgerblue'>" . $_SESSION['name'] . "</span>, welcome to profile of <span style='color: dodgerblue'>" . $_SESSION['anonymous'] . "</span> from <span style='color: dodgerblue'>" . $_SESSION['depart'] . "</span>.</h3>";
                    echo '<h4 style="text-align: center;width:100%;font-weight:bolder;font-size:20px;background-color:#5161ce" class="btn btn-primary">'.$name.'</h4>';
                }
                $query2 = "SELECT * FROM contact_info WHERE departmentId='$departmentID'";
                $result2 = mysqli_query($mysql, $query2) or die ("<h3>Sorry! Couldn't connect!</h3>");
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $designation = $row2['designation'];
                    $website = $row2['website'];
                    $phone = $row2['phone'];
                    $email = $row2['email'];
                }
            }
        } 
        ?>
                <br>
                <br>
                <div style="width: 100%;margin-bottom:-25px" >
                    <h5 style="margin-left:4% ;">Account Info</h5>
                    <hr>
                <form class="validate-form"  action="save_account.php" method="post">
                    <div class="login100-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username" value="<?=$username?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 m-b-26" style="border:none">
						<span class="label-input100">Change Password</span>
                        <a href="#" id="passwordPost" class="btn btn-outline-primary" style="margin-top: 10px;" data-toggle="modal" data-target="#passwordModal">Change Password</a>  
					</div>
                    </div>
                </div>
                    <div style="width: 95%;margin:auto;margin-bottom:-25px">
                    <h5>Other Info</h5>
                    <hr>
                    </div>

				<div id="add-new-account" class="login100-form">
		
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Department is required">
						<span class="label-input100">Department Name</span>
						<input class="input100" type="text" name="department" placeholder="Enter department name" value="<?=$department?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Description is required">
						<span class="label-input100"> Description</span>
						<input class="input100" type="text" name="description" placeholder="About department" value="<?=$dep_description?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Department Website is required">
						<span class="label-input100"> Department Website</span>
						<input class="input100" type="text" name="link" placeholder="Department Website" value="<?=$link?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Profile Name is required">
						<span class="label-input100"> Profile Name</span>
						<input class="input100" type="text" name="name" placeholder="Profile Name" value="<?=$name?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "User Type is required">
					<br>
						<span class="label-input100" style="margin-top:15px;">User Type</span>
                        <select name="userlevel" class="form-control select" style="width: 100%;" required>
                        <?php
                         $admin=$user='';
                         if($userlevel==1){
                             $admin = 'selected';
                         }else{
                            $user = 'selected';
                         }
                        ?>
                            <option <?=$user?> value="NULL">User</option>
                            <option <?=$admin?> value="1">Admin</option>
                        </select>
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Designation is required">
						<span class="label-input100"> Designation</span>
						<input class="input100" type="text" name="designation" placeholder="Designation" value="<?=$designation?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Profile Holder's Wesite is required">
						<span class="label-input100">Your Website</span>
						<input class="input100" type="text" name="website" placeholder="Profile Holder's Wesite" value="<?=$website?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Phone Number is required">
						<span class="label-input100">Phone Number</span>
						<input class="input100" type="text" name="phone" placeholder="Phone Number" value="<?=$phone?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Email id" value="<?=$email?>">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Your password is required">
                        <span class="label-input100">Current Password</span>
                        <input class="input100" type="password" name="password1" placeholder="Current account password">
                        <span class="focus-input100"></span>
                    </div>
                
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="add_account">
							Save
						</button>
                        <a href="profile.php" style="margin-left: 20px;text-decoration:none;color:#fff" class="login100-form-btn">Cancel</a>
					</div>
                </div>
				</form>
			</div>
		</div>
	</div>


<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5161ce;">
        <h5 class="modal-title" id="passwordModalLabel" style="color: #fff">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="save_others_password.php" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">New Password:</label>
            <input type="password" name="password1" class="form-control">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Confirm New Password:</label>
            <input type="password" name="password2" class="form-control">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Your Password:</label>
            <input type="password" name="password" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
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
        $('.select').select2();
    </script>

</body>
</html>
