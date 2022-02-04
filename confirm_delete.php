<?php
    if (!isset($_SESSION)) session_start();

    if (($_SESSION['userlevel'] === NULL) OR ($_SESSION['userlevel'] == 0)) {
        die ("<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Haha</span>! C'mon you can do better!</h3><form style='text-align: center' action=\"logout.php\" method=\"post\"><button style='font-size: larger' class=\"form1 btn btn-info btn-block\">Back</button><br/><br/></form>");
    }
?>

    <?php
        require 'connect.php';

        if (isset($_SESSION['username']) AND isset($_POST['department_id'])) {
            $departID= $_POST['department_id'];

            $query = "DELETE FROM departments WHERE departmentId='$departID'";
            $result = mysqli_query($mysql, $query) or die ('<h3>Something went wrong!.</h3>');

                $query4 = "DELETE FROM contact_info WHERE departmentId='$departID'";
                $result4 = mysqli_query($mysql, $query4) or die ('<h3>Something went wrong!.4</h3>');

                    $query1 = "SELECT * FROM login_details WHERE departmentId='$departID'";
                    $result1 = mysqli_query($mysql, $query1) or die ('<h3>Something went wrong!.1</h3>');
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $username = $row1['username'];

                        $query2 = "DELETE FROM notification WHERE username='$username'";
                        $result2 = mysqli_query($mysql, $query2) or die ('<h3>Something went wrong!.2</h3>');

                            $query3 = "DELETE FROM login_details WHERE username='$username'";
                            $result3 = mysqli_query($mysql, $query3) or die ('<h3>Something went wrong!.3</h3>');
                    }

            echo 'success';
            die();
        }
    ?>

</body>
</html>