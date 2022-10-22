<?php
    include("connection.php");
    error_reporting(0);
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Storage Page</title>
    <link rel="stylesheet" href="style.css">
    <script>

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
        }
        window.onscroll = function() {myFunction()};

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
                //document.getElementById("msgem").innerHTML="";
                var a = document.createElement('a');
                a.title = "Click here";

        }
        function checkPhno() {
            var ph = f1.ph_no.value;
            var vad = "^[0-9]{10}$";
            var reg = new RegExp(vad);
            if(reg.test(ph) || !ph) 
                document.getElementById("msgph").innerHTML=" ";
            else
                document.getElementById("msgph").innerHTML="Please Enter 10-digit Number Only!";
                f1.ph_no.focus;
        }
    </script>
</head>
<body>
    <div class="header">
        <center><img src = "samrat.png" style="width:25%"></center>
    </div>

    <div id="navbar">
        <a class="active" href="DataStorage.php">ADD</a>
        <a href="display.php">DISPLAY</a>
        <a href="search.php">SEARCH</a>
        <a href="payroll.php">PAYROLL</a>

    </div>
    </div>

    <div class="content">
    <form action="#" name="f1" method="post" enctype="multipart/form-data">
    
    <br><h1 class = "head">Add Employee Data</h1>
        <fieldset> <legend><i></i></legend>
            <table align="left" cellspacing="20">
                <tr> <td>FIRST NAME* : </td> <td> <input type="text" name="fna" placeholder="FIRST NAME" onblur="checkFname()" required> 
                    <font color="red"> <span id="msgfnam"> </span> </font></td></tr>
                <tr> <td>LAST NAME* : </td> <td> <input type="text" name="lna" placeholder="LAST NAME" onblur="checkLname()" required> 
                    <font color="red"> <span id="msglnam"> </span></font></td></tr>
                <tr> <td>E-MAIL* : </td> <td> <input type="text" name="email" placeholder="E-MAIL" onblur="checkEmail()" required> 
                    <font color="red"> <span id="msgem"> </span></font></td></tr>
                <tr> <td>PHONE NUMBER* : </td> <td> <input type="text" maxlength="10" name="ph_no" placeholder="PHONE NUMBER" onblur="checkPhno()" required> 
                <font color="red"><span id="msgph"></span></font></td></tr>
            </table>
        </fieldset>
        <br>

        <fieldset>
            <table align="left" cellspacing="20">
                <tr> <td>POSITION : </td> <td> <select name="position">
                                               <option value="select"></option>
                                               <option value="Manager">Manager</option>
                                               <option value="Sales Manager">Sales Manager</option>
                                               <option value="Electronic Design Engineer">Electronic Design Engineer</option>
                                               <option value="Instrument Engineer">Instrument Engineer</option>
                                               <option value="Delivery Boy">Delivery Boy</option> </select>
                </td></tr>
                <br>
                <tr> <td rowspan="3"> GENDER : </td> <td> <input type="radio" name="gen" value="male"> MALE </td>
                                        <tr><td> <input type="radio" name="gen" value="female"> FEMALE </td> </tr>
                                        <tr><td> <input type="radio" name="gen" value="other"> OTHER </td> </tr>
                </tr> 
                <br>
                <tr> <td>ADDRESS : </td> <td> <textarea name="addr" rows="5" col="10"></textarea></td></tr>
                <br>
                <tr> <td> UPLOAD RESUME : </td> <td> <input type="file" name="resume" accept=".pdf, .docx" enctype="multipart/form-data"></td></tr>
                <tr> <td></td> <td><span style="color : #f00; font-size:25px";><b>Note : </b>Only PDF or DOCs file are allowed. Maximum upload size is 50kb </span></td></tr>
                <br>

            </table>
        </fieldset>
        <br> 
        <input type="submit" name="save" value="SAVE" class='btn save'>&nbsp; &nbsp; &nbsp;
        <input type="reset" name="res" value="CANCEL" class='btn cancel'> <BR>
    </form><?php echo $_SESSION["username"] ?></div>
</body>
</html>

<?php
    /* $file = scandir("Resume"); 
    for($a = 2; $a < count($file); $a++) {
        ?>
        <p>
            <a download="<?php echo $file[$a] ?>" href = "Resume/<?php echo $file[$a] ?>"><?php echo $file[$a] ?></a>
        </p>
        <?php
    } */
    //error_reporting(0);   ||  action="fileupload.php" "

    if($_POST['save']) { 
        $filename = $_FILES["resume"]["name"];
        $tempname = $_FILES["resume"]["tmp_name"];
        $folder = "Resume/".$filename;
        move_uploaded_file($tempname, $folder); 
        echo "<a href = '".$folder."' target = 'xyz'>".$filename."</a>";

        $firstname = $_POST['fna'];
        $lastname = $_POST['lna'];
        $email = $_POST['email'];
        $phno = $_POST['ph_no'];
        $position = $_POST['position'];
        $gender = $_POST['gen'];
        $address = $_POST['addr'];
        $resume = $_POST['resume'];
        
        //if($position != "" && $gender != "" && $address != "" && $resume != "") {

            $query = "insert into candidate_data(id, firstname, lastname, email, phno, position, gender, address, resume) values(UUID(), '$firstname', '$lastname', 
            '$email', '$phno', '$position', '$gender', '$address', '$folder')";
            $data = mysqli_query($conn, $query);
            
            //echo "$address<br>$folder<br>$firstname<br>";
            
            if($data)
                echo " Data Submitted Successfully!!";
            else
                echo "Data Failed To Send";
        }
        /*else 
            echo "Data Failed To Send.";
    else {
        echo "<script>alert('Please fill the form first.');</script>";
    }*/
?>
<!--(id, firstname, lastname, email, phno, position, gender, 
        address, resume)
    action
    enctype="multipart/form-data"
    (id, firstname, lastname, email, ohno, position, gender, address, folder)
    (id, firstname, lastname, email, phno, position, gender, address, resume) 
    action="fileupload.php"-->