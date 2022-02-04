<?php
if (!isset($_SESSION)) session_start();

    if (($_SESSION['userlevel'] === NULL) OR ($_SESSION['userlevel'] == 0)) {
        die ("<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Haha</span>! C'mon you can do better!</h3><form style='text-align: center' action=\"logout.php\" method=\"post\"><button style='font-size: larger' class=\"form1 btn btn-info btn-block\">Back</button><br/><br/></form>");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Others' Profile (Admin) : CCNB</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

</head>
<body>
    <!-- header -->
    <?php include 'header.php'?>
        <!-- Title -->
    <div class="title-container">
        <div class="title-image" style="background-image: url(img/bg-01.jpg);">
            <span class="title-text">
                Manage Other Accounts 
            </span>
        </div>
    </div>
    <br>
    <div class="container" style="background-color:#fff;padding:10px;">
    <div class="error">
    <?php 
            if(isset($_GET['stat'])){

                $stat = $_GET['stat'];
                $str = "";
                switch($stat){
                    case 0: $str = '<div class="alert alert-success alert-dismissible fade show" role="alert">Successfully!!! saved record!';
                        break;
                
                }
                
                echo $str.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            
        ?>
    </div>
    <table id="account-list" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
            require 'connect.php';
            $i = 1;
            $query = "SELECT * FROM contact_info";
            $result = mysqli_query($mysql, $query) or die('<h3>Sorry! Couldn\'t connect. (0)</h3>');
            while ($row = mysqli_fetch_assoc($result)) {
                $departmentID = $row['departmentId'];

                if ($departmentID != $_SESSION['departmentId']) {

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

                                // echo '<div class="col-lg-3" style="padding: 20px; overflow: scroll"><div style="padding: 25px; border-radius: 5px; text-align: center; max-height: 500px; min-height: 500px; overflow: scroll; background-color: dimgrey;"><h4 class="form2" style="color: white">'.$department.'</h4><h4 class="form-control" style="color: #333333">'.$name.'</h4><h6 class="form-control" style="color: #333333">'.$designation. '</h6><form action="edit_others_user.php" method="post"><button value="' .$departmentID.'" type="submit" name="departmentid" class="form1 btn btn-info btn-block">Edit profile</button></form><form action="delete_others_user.php" method="post"><button value="' .$departmentID.'" type="submit" name="departmentid" class="form1 btn btn-danger btn-block">Delete account</button></form></div></div>';
                                echo "<tr>
                                <td>".$i++."</td>
                                <td>$name</td>
                                <td>$designation</td>
                                <td>$department</td>
                                <td><a style='margin: 0 10px;' class='btn btn-outline-primary' href='edit_others_account.php?departmentid=$departmentID'>Edit</a><a href='#' class='btn btn-outline-danger delete_account' data-id='$departmentID' >Delete</a></td>
                                </tr>";
                            }
                        }
                    }
                }
            }

        ?>
    </tbody>
    </table>
    </div>

    <?php include_once "footer.php"?>

    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/datatable/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#account-list').DataTable();

    $('.delete_account').click(function(){

    id = $(this).attr('data-id');
    // Check checkbox checked or not
    if(id != null || id != undefined){
        data = new FormData();
        data.append('department_id',id);
    if(confirm("Are you sure ?")){
        $.ajax({
        type: 'POST',
        url: 'confirm_delete.php', 
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result){
            result=result.trim();
    //alert(result);return;
            if(result==='success')
            {
                $('.error').html("<div class='alert alert-success'>Account has been successfully Deleted!</div>");    
            }
            else if(result==='failed')
            {
            $('.error').html("<div class='alert alert-danger'>Sorry! We Couldn't Complete the process</div>");
            }
            else
            {
            $('.error').html(result);
            }
    }
    });
    }
    }else{
    $('.error').html("<div class='alert alert-danger'>Sorry! We Couldn't Complete the process</div>");
    }
    //e.preventDefault

    });
        } );
    </script>
</body>
</html>