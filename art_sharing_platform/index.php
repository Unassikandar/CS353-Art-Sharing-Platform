

<?php
include 'db_connection.php';
//
// $conn = OpenCon();
//
// echo "Connected Successfully";
//
// CloseCon($conn);
    session_start();
?>


<!DOCTYPE HTML>

<html>
    <head>
        <title>Login page </title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body style="background-color:#f7f1e3">
        <div id="main-wrapper">
            <center>
                <h2>Login Form</h2>
                <img src="imgs/avatar.png" class="avatar"/>
            </center>

            <form class="myform" action="index.php" method="post">
                <label><b>Username:</b></label><br>
                <input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
                <label><b>Password:</b></label><br>
                <input name="password" type="password" class="inputvalues" placeholder="Type your password" required/><br>
                <input name="login" type="submit" id="login_btn" value="Login"/><br>
                <a href="register.php"><input type="button" id="register_btn" value="Register"/><br>
            </form>

            <?php
                if(isset($_POST['login'])){
                    $conn = OpenCon();
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $query = "select * from user WHERE email='$username' AND password='$password'";
                    $query_run = mysqli_query($conn, $query);
                    if(mysqli_num_rows($query_run) > 0){
                        $_SESSION['username'] = $username;
                        $query = "select user_id from user WHERE email='$username'";
                        $query_run = mysqli_query($conn, $query);
                        if(mysqli_num_rows($query_run) > 0){
                            $userid = mysqli_fetch_assoc($query_run);
                            $_SESSION['user_id'] = $userid['user_id'];
                            header('location:homepage.php');
                        }
                        else{
                            echo '<script type="text/javascript"> alert("Could not get user id") </script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
                    }
                    CloseCon($conn);
                }

             ?>



        </div>


        <!-- <form action="index.html" method="post">
            Username:<br/>
            <input type="text" name="username"></br>
            Password<br/>
            <input type="password" name="password"><br/>
            <input type="submit" value="Login!">
        </form> -->
    </body>

</html>
