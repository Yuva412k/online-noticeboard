<?php
if (!isset($_SESSION)) session_start();
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
$url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$redirect_url = str_replace($url,'add.php', '');

if(!isset($_SESSION['username'])){
  Redirect($redirect_url.'login.php');
}

if($_SESSION['userlevel']==0){
    Redirect($redirect_url.'profile.php');
  }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Account : CCNB</title>
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
						Add New Account
					</span>
				</div>
                <div class="error"></div>

				<form id="add-new-account" class="login100-form" action="add_save.php" method="post">
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
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Department is required">
						<span class="label-input100">Department Name</span>
						<input class="input100" type="text" name="department" placeholder="Enter department name">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Description is required">
						<span class="label-input100"> Description</span>
						<input class="input100" type="text" name="description" placeholder="About department">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Department Website is required">
						<span class="label-input100"> Department Website</span>
						<input class="input100" type="text" name="link" placeholder="Department Website">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Profile Name is required">
						<span class="label-input100"> Profile Name</span>
						<input class="input100" type="text" name="name" placeholder="Profile Name">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "User Type is required">
					<br>
						<span class="label-input100" style="margin-top:15px;">User Type</span>
                        <select name="userlevel" class="form-control select" style="width: 100%;" required>
                            <option value="NULL">User</option>
                            <option value="1">Admin</option>
                        </select>
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Designation is required">
						<span class="label-input100"> Designation</span>
						<input class="input100" type="text" name="designation" placeholder="Designation">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Profile Holder's Wesite is required">
						<span class="label-input100">Your Website</span>
						<input class="input100" type="text" name="website" placeholder="Profile Holder's Wesite">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Phone Number is required">
						<span class="label-input100">Phone Number</span>
						<input class="input100" type="text" name="phone" placeholder="Phone Number">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Email id">
						<span class="focus-input100"></span>
					</div>

                    <br>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Your password is required">
						<span class="label-input100">Your password</span>
						<input class="input100" type="password" name="password1" placeholder="Current account password">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="add_account">
							Proceed
						</button>
                        <input type="reset" id="reset-form" style="display: none;" value="Reset">
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

$('#add_account').click(function(e){
    
e.preventDefault();

// Check checkbox checked or not
input = $('.input100');
if(!validateForm(input)){return;}

if(confirm("Are you sure ?")){
    data = new FormData($('#add-new-account')[0]);
    $.ajax({
    type: 'POST',
    url: 'add_save.php', 
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: function(result){
        result=result.trim();
//alert(result);return;
        if(result==0)
        {
            $('.error').html("<div class='alert alert-success'>Congratulations! New ADMIN has been added successfully.</div>");
            $('#reset-form').trigger('click');
        }
        else if(result=='1')
        {
          $('.error').html("<div class='alert alert-success'>Congratulations! New USER has been added successfully.</div>");
          $('#reset-form').trigger('click');

        }
        else if(result=='2')
        {
          $('.error').html("<div class='alert alert-warning'>Department Name already in use.</div>");
        }
        else if(result=="3")
        {
          $('.error').html("<div class='alert alert-warning'>Password cannot be empty.</div>");
        }
        else if(result=="4")
        {
          $('.error').html("<div class='alert alert-warning'>Username already in use.</div>");
        }
        else if(result=="5")
        {
          $('.error').html("<div class='alert alert-warning'>Make sure you password is correct!!.</div>");
        }
        else if(result=="6")
        {
          $('.error').html("<div class='alert alert-warning'>Make sure all the entries are filled with constraints!!.</div>");
        }
        else if(result=="7")
        {
          $('.error').html("<div class='alert alert-warning'>Make sure you logged in!!.</div>");
        }
        else
        {
          $('.error').html(result);
        }
   }
   });
}
else{
$('.error').html("<div class='alert alert-danger'>Sorry! We Couldn't Complete the process</div>");
}

});
    </script>

</body>
</html>
