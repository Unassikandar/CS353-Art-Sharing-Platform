<?php
    include 'db_connection.php';
    session_start();
    if(isset($_SESSION['username'])){
        $conn = OpenCon();
        $userid = $_SESSION['user_id'];
        $sql = "SELECT * FROM creation WHERE owner_id='$userid'";
        $result = mysqli_query($conn, $sql);
        CloseCon($conn);
    }
    else{
        echo '<script type="text/javascript"> alert("Please login first") </script>';
        header('location:index.php');
    }
?>

<!DOCTYPE HTML>

<html>
    <head>
        <title>Home page </title>
        <link rel="stylesheet" href="css/style_hp.css">
    </head>

    <body><!-- <body style="background-color:#f7f1e3"> -->
        <header>
            <div class="container">
                <nav>
                    <h1 class="asp"><a href="homepage.php">a<span>s</span>p</a></h1>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Feed</a></li>
                        <li><a href="#">Browse</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div id="main-wrapper">
            <center>
                <h2 style="color:#eee">
                    Welcome <?php echo $_SESSION['username'] ?>
                </h2>
                <h2 style="color:#eee">
                    user Id: <?php echo $_SESSION['user_id'] ?>
                </h2>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="text" name="name" placeholder="Image Name"/>
                    <input type="file" name="image"/>
                    <input type="submit" name="submit" value="UPLOAD"/>
                </form>
            </center>
        </div>
        <div id="gallery-wrapper">
            <center>
                <table class="img_table">
                    <?php
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)) {
                        if($i % 3 == 0){
                            echo "<tr>";
                        }
                        echo "<td class='table_cell'><img src='{$row['image']}' alt='placeholder' style='width:200px;height:150px;'></td>";
                        if($i % 3 == 2) {
                            echo "</tr>";
                        }
                        $i++;
                    }
                    ?>
                </table>
            </center>
        </div>
    </body>
</html>
