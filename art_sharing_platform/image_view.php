<?php
include 'db_connection.php';
$conn = OpenCon();
if(iseet($_GET['image_id'])) {
    $sql = "SELECT image FROM creation WHERE creation_id=" . $_GET['image_id'];
    $result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>") . mysqli_error($conn);
    $row = mysqli_fetch_array($result);
    // header("Content-type: image/png");
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
    // echo $row["image"];
}
CloseCon();
?>
