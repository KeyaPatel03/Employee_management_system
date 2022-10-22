<?php
    require("connection1.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Login Page</title>
</head>
<body>
    <div class="header">
        <center><img src = "samrat.png" style="width:25%"></center>
        </div>
    </div><b><hr></b>
    <form id="f2" action="#" method="POST"> 
    <table align="center" cellspacing="30">
        <tr> <th colspan="2"><div class="head">Welcome to Samrat Electronics!</div></th></tr>
        <div class="form-box">

        <tr><td><p class="label">Username</p></td></tr>
        <tr> <td align="left"><input type="email" name="username" id="input" placeholder="Username" size="50"></tr>

        <tr><td><p class="label">Password</p></td></tr>
        <tr> <td align="left"><input type="password" name="password" id="input" placeholder="Password" size="50"></tr>
        <br><br>
        <tr><td colspan="2" align="center">
                <br><input type="submit" name="login" value="LOGIN" class="login save" size="30">
        </td></tr>
</div>
    </table>
    </form>

    <?php
        if(isset($POST['login'])) {
            $query = "SELECT * FROM `admin_login` WHERE `username`='$POST[username]' AND `password`='$POST[password]'";
            $result = mysql_query($con, $query);
            if(mysqli_num_rows($result)) { 
                session_start();
                $_SESSION[AdminLogininId] = $_POST['username'];
                header("location: DataStorage.php");
            }
            else
                echo "<script>alert('Incorrect password')</script>";
        }
    ?>
</body>
</html>