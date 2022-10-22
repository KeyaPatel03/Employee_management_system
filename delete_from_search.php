<?php
    include("connection.php");
    $id = $_GET['id'];
    $query = "Delete from candidate_data where id = '$id'";
    $data = mysqli_query($conn, $query);

    if($data) {
        echo "<script>alert('Record Deleted from Database')</script>";
        ?>
        <meta http-equiv = "Refresh" content = "0; url=http://localhost/ResumeWebsite-Copy/search.php">
<?php
    }
    
    else {
        echo "<font color = 'red'> Failed To Delete Data.";
    }
?>