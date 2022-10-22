<?php
    error_reporting(0);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testing";

    session_start();
    $data = mysqli_connect($servername, $username, $password, $dbname);

    /* if($data)
        echo "Connection Ok!!";
    else
        echo "Connection Failed".mysqli_connect_error(); */
    //error_reporting(0);
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
    
    $sql = "select * from login where username='".$username."' AND password='".$password."' ";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    if($row["usertype"]=="user") {
        $_SESSION["username"] = $username;
        header("location:DataStorage.php");
    }
    else if($row["usertype"]=="admin") {
        header("location:DataStorage.php");
    }
    else { 
        echo "username or password incorrect!";
        header("location:DataStorage.php");
    }
}
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
                <br><input type="submit" value="LOGIN" class="login save" size="30">
        </td></tr>
</div>
    </table>
    </form>
</body>
</html>
<!--
    include
    <input type='submit' value='LOGIN' class='login save'>
    <button><a href="DataStorage.php"> Hello Click Here </a></button>
    header("location:DataStorage.php");
-->