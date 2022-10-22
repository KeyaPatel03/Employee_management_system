<!--<html>
    <head>
        <title>File Uplaod</title>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="resume"><br>
            <input type="submit" name="submit" value="Uplaod File">
        </form>
</html>-->

<?php
    include("connection.php"); 
    error_reporting(0);
    
   /* $file = $_FILES["file"];
    // Saving filr in uploads folder
    move_uploaded_file($file["tmp_name"], "uploads/" . $file["name"]);
    //Redirecting back to home
    header("Location: Resume/".$file); */

    /* $filename = $_FILES["resume"]["name"];
    $tempname = $_FILES["resume"]["tmp_name"];
    $folder = "Resume/".$filename; 
    move_uploaded_file($tempname, $folder); */
    
    
    if(isset($_POST["save"])) {
        $error = array();
        if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $file_name = time() . '_' . $_FILES['resume']['name'];
            $file_tmp = $_FILES['resume']['tmp_name'];
            $file_type = $_FILES['resum']['type'];
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

            $extension = array("pdf", "docx");

            if(in_array($file_ext, $extension) === false) {
                $errors[] = "Extension are not allowed, please choose PDF or DOCs file only!";
            }

            if(empty($errors) == true) {
                move_upload_file($file_tmp, "Resume/" .$file_name);
                $full_name = $db->real_escape_string($_POST["full_name"]);
                $sqlInsert = "insert into candidate_data(resume) values('".$resume."')";
                $result = $db-->query($sqlInsert);

            if($result) {
                echo "Success!!";
            }
            else {
                echo "Error in file uploading";
            }
            }
        }
        else {
            print_r($errors);
        }
    } 
?>

 