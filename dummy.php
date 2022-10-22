<?php 
    include("connection.php");
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Login Pages</title>
    <script>
    function checkValidity() {
        var u_name = f2.uname.value;
        var pat = "tec";
        var reg  new RegExp(pat);
        var pass_w = f2.passw.value;
        if(u_name == "" || reg.test(u_name)) {
            document.getElementById("msguname").innerHTML="Incorrect Username!";
            f2.uname.focus();
        }
        else if(!pass_w || pass_w != p) {
            document.GetElementById("msgpass").innerHTML="Incorrect Password";
        }
    }
</script>
</head>
<body>
    <div class="header">
        <center><img src = "tecunique.png" style="width:25%"></center>
        </div>
    </div><b><hr></b>
    <div class="content_login">
    <form id="f2" action="#" method="POST"> 
    <table align="center" cellspacing="30">
        <tr> <th colspan="2"><h1>Welcome to TecUnique!</h1></th></tr>
        
        <tr> <td align="right">Username : </td> <td align="left"><input type="text" name="uname" placeholder="Username" size="30">
             <font color="red"><span id="msguname"> </span></font></td></tr>
        
        <tr> <td align="right">Password : </td> <td align="left"><input type="text" name="passw" placeholder="Password" size="30">
             <font color="red"><span id="msgpass"> </span></font></td></tr>
        
        <tr> <td colspan="2" align="center">
            <a href="DataStorage.php"> 
                <input type='button' value='LOGIN' class="login save" onblur="checkValidity()" >
            </a>
        </td></tr>
    </table>
    </form>
    </div>
</body>
</html>
<!--
    <input type='submit' value='LOGIN' class='login save'>
    <button><a href="DataStorage.php"> Hello Click Here </a></button>
-->