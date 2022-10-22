<?php  
    include("connection.php"); 
    error_reporting(0);
    $id = $_GET['id'];
    $fn = $_GET['fn'];
    $ln = $_GET['ln'];
    $em = $_GET['em'];
    $ph = $_GET['ph'];
    $pos = $_GET['pos'];
    $gen = $_GET['gen'];
    $adr = $_GET['adr'];
    $resume = $_GET['resume'];
    $query = "SELECT * FROM candidate_data where id = '$id'";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);
    $result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Client's Data</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function checkFname() {
            var fnam = f1.fna.value;
            if(!fnam) 
                document.getElementById("msgfnam").innerHTML="Please enter first name!";
            else
                document.getElementById("msgfnam").innerHTML="";
        }
        function checkLname() {
            var lnam = f1.lna.value;
            if(!lnam) 
                document.getElementById("msglnam").innerHTML="Please enter last name!";
            else
                document.getElementById("msglnam").innerHTML="";
        }
        function checkEmail() {
            var em = f1.email.value;
            if(!em)
                document.getElementById("msgem").innerHTML="Please enter E-mail!"; 
            else
                document.getElementById("msgem").innerHTML="";
        }

        function checkPhno() {
            var ph = f1.ph_no.value;
            var vad = "^[0-9]{10}$";
            var reg = new RegExp(vad);
            if(reg.test(ph) || !ph) 
                document.getElementById("msgph").innerHTML=" ";
            else
                document.getElementById("msgph").innerHTML="Please Enter 10-digit Phone Number!";
                f1.ph_no.focus;
        }
    </script>
</head>
<body>
<div class="header">
        <center><img src = "samrat.png" style="width:25%"></center>
    </div>

    <div id="navbar">
        <a href="DataStorage.php">ADD</a>
        <a href="display.php">DISPLAY</a>
        <a class="active" href="search.php">SEARCH</a>
        <a href="payroll.php">PAYROLL</a>

    </div>
    </div>
    <br><h1 class="head">Update Employee Data</h1>
    <form action="#" name="f1" method="post" enctype="multipart/form-data">
        <fieldset> <legend><i>*Required Data*</i></legend>
            <table align="left" cellspacing="20">
                <tr> <td>FIRST NAME : </td> <td> <input type="text" name="fna" value="<?php echo "$fn" ?>" placeholder="FIRST NAME" onblur="checkFname()" required> 
                    <font color="red"> <span id="msgfnam"> </span> </font></td></tr>
                <tr> <td>LAST NAME : </td> <td> <input type="text" value="<?php echo "$ln" ?>" name="lna" placeholder="LAST NAME" onblur="checkLname()" required> 
                    <font color="red"> <span id="msglnam"> </span></font></td></tr>
                <tr> <td>E-MAIL : </td> <td> <input type="text" name="email" value="<?php echo "$em" ?>" placeholder="E-MAIL" onblur="checkEmail()" required> 
                    <font color="red"> <span id="msgem"> </span></font></td></tr>
                <tr> <td>PHONE NUMBER : </td> <td> <input type="text" maxlength="10" value="<?php echo "$ph" ?>" name="ph_no" placeholder="PHONE NUMBER" onblur="checkPhno()" required> 
                <font color="red"><span id="msgph"></span></font></td></tr>
            </table>
        </fieldset>
        <br>

        <fieldset>
            <table align="left" cellspacing="20">
                <tr> <td>POSITION : </td> <td> <select name="position">
                <?php echo "$pos" ?>
                                               <option value="select"><?php echo "$pos" ?></option>
                                               <option value="Manager" 
                                               <?php if($pos == 'Manager') 
                                                echo "selected"; ?>>Manager</option>
                                               <option value="Sales Manager"
                                               <?php if($pos == 'Sales Manager') 
                                                echo "selected"; ?>>Sales Manager</option>
                                               <option value="Electronic Design Engineer"
                                               <?php if($pos == 'Electronic Design Engineer') 
                                                echo "selected"; ?>>Electronic Design Engineer</option>
                                               <option value="Instrument Engineer"
                                               <?php if($pos == 'Instrument Engineer') 
                                                echo "selected"; ?>>Instrument Engineer</option>
                                               <option value="Delivery Boy"
                                               <?php if($pos == 'Delivery Boy') 
                                                echo "selected"; ?>>Delivery Boy</option> </select>
                </td></tr>
                <br>
                <tr> <td rowspan="3"> GENDER : </td> <td> <input type="radio" name="gen" value="male"
                                                            <?php if($gen == 'male')
                                                                echo "checked";
                                                            ?>> MALE </td>
                                        <tr><td> <input type="radio" name="gen" value="female"
                                                    <?php if($gen == 'female') 
                                                        echo "checked";
                                                    ?>> FEMALE </td> </tr>
                                        <tr><td> <input type="radio" name="gen" value="other"
                                        <?php if($gen == 'other') 
                                                        echo "checked";
                                                    ?>> OTHER </td> </tr>
                </tr> 
                <br>
                <tr> <td>ADDRESS : </td> <td> <textarea name="addr" rows="5" value="<?php echo "$adr" ?>" col="10"><?php echo "$adr"; ?>
                    </textarea></td></tr>
                <br>
                <tr> <td> UPLOAD RESUME : </td> <td> <input type="file" value="<?php echo "$resume" ?>" name="resume" accept=".pdf, .doc"></td></tr>
                <tr> <td></td> <td><span style="color : #f00; font-size: 25px";><b>Note:</b>Only PDF or DOCs file are allowed.Maximum upload size is 50kb </span></td></tr>
                <br>
            </table>
        </fieldset>
        <br>  &nbsp
        <input type="submit" name="save" value="UPDATE" class='btn save'>
        &nbsp; &nbsp; &nbsp;
        <!--<input type="reset" name="res" value="CANCEL" id="delbtn"> <BR>-->
    </form>
</body>
</html>

<?php

if($_POST['save']) {
    // Here
        $filename = $_FILES["resume"]["name"];
        $tempname = $_FILES["resume"]["tmp_name"];
        $folder = "Resume/".$filename;
        move_uploaded_file($tempname, $folder);
    //$id = $_POST['id'];
    $firstname = $_POST['fna'];
    $lastname = $_POST['lna'];
    $email = $_POST['email'];
    $phno = $_POST['ph_no'];
    $position = $_POST['position'];
    $gender = $_POST['gen'];
    $address = $_POST['addr'];
    $resume = $_POST['resume'];

        $query = "UPDATE candidate_data set firstname='$firstname', lastname='$lastname', email='$email', 
        phno='$phno', position='$position', gender='$gender', address='$address', resume='$folder' where id='$id'";
        $data = mysqli_query($conn, $query);

        if($data) {
            echo "Data Updated!!";
            //echo "<script>alert('Data submitted succesfully')</script>";
            ?>
                <meta http-equiv = "refresh" content = "0; url =http://localhost/ResumeWebsite-Copy/search.php" />
            <?php 
        }
        else {
            echo "Data Failed to update :(";
        }
    }
?>