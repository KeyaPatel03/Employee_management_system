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
    <title>Payroll Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
        <center><img src = "samrat.png" style="width:25%"></center>
    </div>

    <div id="navbar">
        <a href="DataStorage.php">ADD</a>
        <a href="display.php">DISPLAY</a>
        <a href="search.php">SEARCH</a>
        <a class="active" href="payroll.php">PAYROLL</a>
        <div id="for_user">
    </div>
    </div>
    
        <form action="" method="POST" name="f1">
    <?php
        echo "<br><h1 align='left' class='head'>Employee Payroll System</h1>";
    ?>
    <input type="text" size="90" name="get_data" required value="<?php if(isset($_POST['get_data'])) {echo $_POST['get_data'];}?>" placeholder="Search by firstname / lastname / position / phone number">
    <input type="submit" name="search" value="Search" class='btn save'>
    </form>
    <br><br>
    <?php   
        if(isset($_POST['get_data'])) {
        $da = $_POST['get_data']; 
        $query = "SELECT * FROM candidate_data WHERE CONCAT(firstname,lastname,email,phno,position) LIKE '%$da%' ";
        //$query = "SELECT * from candidate_data where id = '$da' or firstname = '$da' or lastname = '$da'";
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);

        /*
        if($total > 0) {
            while($row = mysqli_fetch_array($data)) {
                echo $row['id'];
                echo $row['firstname'];
            }
        }
        else {
            echo "Data Not Found!";
        }
    }
    */
    if($total > 0) {
        $filename = $_FILES["resume"]["name"];
        $tempname = $_FILES["resume"]["tmp_name"];
        $folder = "Resume/".$filename;
        move_uploaded_file($tempname, $folder); 
        echo "<a href = '".$filename."'>".$filename."</a>";
        $cnt = 0;
        while($row = mysqli_fetch_assoc($data)) {
            if($cnt == 0) {
    echo "<table align='center' border='0' cellspacing='1' cellpadding='9' >
                <tr><th width = '4%'>FIRST NAME</th> 
                    <th width = '4%'>LAST NAME</th> 
                    <th width = '4%'>PHONE NUMBER</th>
                    <th width = '5%'>POSITION</th> 
                    <th width = '3%' align = 'right'>DAILY WAGES</th> 
                    <th width = '10%' colspan = '2'>DAYS WORKED</th> 
                    <th width = '2%'>MONTHLY PAY</th> 
                    </tr>";
                    $cnt++;
            }
        //if($total > 0) {
                echo "<tr id='row'> <td align='center'>".$row['firstname']."</td> 
                           <td align='center'>".$row['lastname']."</td> 
                           <td align='center'>".$row['phno']."</td>
                           <td align='center'>".$row['position']."</td> 
                           <td align='right'><input type='text' id='pdsal' size='6' min='1'></td> 
                           <td align='right'><input type='text' id='mday' size='8' placeholder='Days Worked' min='1'></td>
                           <td align='left'><button type='button' onclick='calcSalary()'>Calc Salary</button></td>
                           <td align='center'><span id='res'></span></td>
                            </tr>";
            }
        }
        else {
            echo "Data Not Found!";
        }
    }
        ?>
    </table>
    <script>
    function calcSalary() {
 //get the value of base & power
 var b = document.getElementById("pdsal").value;
 var e = document.getElementById("mday").value;
 var res1;
 res1 = Salary(b,e);      
 document.getElementById("res").innerHTML = res1;
}

function Salary(b,e) {
 //loop exponent times
 ans = b*e;
 return ans;
}
    </script>
</body>
</html>
<!--
    <td align='center'><a href = '".$row['resume']."' target='xyz'><i class='fa fa-download'></i></a></td>
-->