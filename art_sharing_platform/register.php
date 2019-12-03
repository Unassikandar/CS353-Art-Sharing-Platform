

<?php
    include 'db_connection.php';
?>

<!DOCTYPE HTML>

<html>
    <head>
        <title>Sign-up page </title>
        <link rel="stylesheet" href="css/style.css"
    </head>

    <body style="background-color:#f7f1e3">
        <div id="main-wrapper">
            <center>
                <h2>Sign-up Form</h2>
                <img src="imgs/avatar.png" class="avatar"/>
            </center>



            <form class="myform" action="register.php" method="post">
                <label><b>Username:</b></label><br>
                <input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
                <label><b>Password:</b></label><br>
                <input name="password" type="password" class="inputvalues" placeholder="Type your password" required/><br>
                <label><b>Confirm Password:</b></label><br>
                <input name="cpassword" type="password" class="inputvalues" placeholder="Confirm password" required/><br>
                <input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
                <a href="index.php"><input type="button" id="back_btn" value="Back"/><br>
            </form>

            <?php
                if(isset($_POST['submit_btn'])){
                    //echo '<script type="text/javascript"> alert("Signup button clicked") </script>';
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];

                    if($password == $cpassword && strlen($password)>0 && strlen($username)>0){
                        $conn = OpenCon();
                        $query = "select * from user WHERE email='$username'";

                        $query_run = mysqli_query($conn, $query);
                        if(mysqli_num_rows($query_run) > 0){
                            echo '<script type="text/javascript"> alert("Email already registered") </script>';
                        }
                        else {
                            $query = "insert into user values(NULL, NULL, '$username', '$password', NULL, NULL, NULL)";
                            $query_run = mysqli_query($conn, $query);
                            if($query_run){
                                mkdir("data/$username", 0755);
                                echo '<script type="text/javascript"> alert("User registered. Proceed to the login page") </script>';
                            }
                            else {
                                echo '<script type="text/javascript"> alert("Error.") </script>';
                            }
                        }
                        CloseCon($conn);
                    }
                    else {
                        echo '<script type="text/javascript"> alert("Error: please try again") </script>';
                    }
                }
             ?>
        </div>
    </body>
</html>
