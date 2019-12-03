<?php
include 'db_connection.php';
session_start();

// if(isset($_POST["submit"])){
//     $check = getimagesize($_FILES["image"]["tmp_name"]);
//     if($check !== false){
//         $image = $_FILES['image']['tmp_name'];
//         $imgContent = addslashes(file_get_contents($image));
//
//         /* Insert Image into database */
//         $conn = OpenCon();
//         $dateTime = date("Y-m-d H:i:s");
//         $ownerId = $_SESSION['user_id'];
//         $picName = $_POST['name'];
//
//         $query = "INSERT INTO creation (owner_id, name, image) VALUES ('$ownerId', '$picName', '$imgContent')";
//         if(mysqli_query($conn, $query)){
//             echo '<script type="text/javascript"> alert("Image uploaded successfully") </script>';
//             header('location:homepage.php');
//         }
//         else{
//             echo '<script type="text/javascript"> alert("Error: upload failed") </script>';
//         }
//         CloseCon($conn);
//     }
// }
if(isset($_POST["submit"])){

    $conn = OpenCon();
    $name = $_POST['name'];
    // $img = $_FILES['image']['name'];
    $ownerId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $allowed_ext = array("jpg", "png");

    if(($_FILES['image']['name']) != ''){ // check file selected or not
        $temp = explode('.', $_FILES['image']['name']);
        $ext = end($temp); // get file extension

        if(in_array($ext, $allowed_ext)) { // check if file extention is valid
            $newfilename = $_POST['name'] . '.' . $ext;
            $img_path = "data/$username/" . $newfilename;

            $sql = "INSERT INTO creation (owner_id, name, image) VALUES ('$ownerId', '$name', '$img_path')";
            if(mysqli_query($conn, $sql)){
                move_uploaded_file($_FILES['image']['tmp_name'], $img_path);
                echo '<script type="text/javascript"> alert("Image uploaded successfully") </script>';
                header('location:homepage.php');
            }
            else {
                echo '<script type="text/javascript"> alert("Error: upload failed") </script>';
            }
            CloseCon($conn);
        }
        else {
            echo '<script type="text/javascript"> alert("Invalid file type") </script>';
        }
    }
    else{
        echo '<script type="text/javascript"> alert("Please select file") </script>';
    }
}

?>
