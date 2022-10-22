<?php
    include("connection.php");
    error_reporting(0);
?>
<html>
<head>
    <title>Display Candidate's Data</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
        <center><img src = "samrat.png" style="width:25%"></center>
    </div>

    <div id="navbar">
        <a href="DataStorage.php">ADD</a>
        <a class="active" href="display.php">DISPLAY</a>
        <a href="search.php">SEARCH</a>
        <a href="payroll.php">PAYROLL</a>

    </div>
    </div>
<?php

    $query = "SELECT * FROM CANDIDATE_DATA";  
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    $filename = $_FILES["resume"]["name"];
    $tempname = $_FILES["resume"]["tmp_name"];
    $folder = "Resume/".$filename;
    move_uploaded_file($tempname, $folder); 
    
    
    echo "<br><h1 align='left' class='head'> Employee Data</h1>";
    if($total >= 0) { ?>
            <table align = "center" class="table-bg" border="2" cellspacing="1" cellpadding="5" width = "100%">
                <tr><th width = "8%">FIRST NAME</th> 
                    <th width = "8%">LAST NAME</th> 
                    <th width = "5%">E-MAIL</th> 
                    <th width = "9%">PHONE NUMBER</th>
                    <th width = "12%">POSITION</th> 
                    <th width = "3%">GENDER</th> 
                    <th width = "12%">ADDRESS</th> 
                    <th width = "2%">RESUME</th> 
                    <th width = "10%" colspan="2">OPERATIONS</th></tr>
        <?php
        while($result = mysqli_fetch_assoc($data)) {

            echo "<tr id='row'> <td>".$result['firstname']."</td> 
                       <td>".$result['lastname']."</td> 
                       <td>".$result['email']."</td> 
                       <td>".$result['phno']."</td>
                       <td>".$result['position']."</td> 
                       <td>".$result['gender']."</td> 
                       <td>".$result['address']."</td> 
                       <td align='center'><a href = '".$result['resume']."' target='xyz'><i class='fa fa-download'></i></a></td> 
                       <td align='center'><a href = 'update_design.php?id=$result[id]&fn=$result[firstname]&ln=$result[lastname]&em=$result[email]&ph=$result[phno]&pos=$result[position]&gen=$result[gender]&adr=$result[address]&resume=$result[resume]'>
                            <input type='submit' value='Update' class='btn save'></a></td>
                            &nbsp &nbsp &nbsp &nbsp &nbsp

                        <td align='center'><a href = 'delete.php?id=$result[id]'>
                            <input type='button' value='Delete' class='btn cancel' onclick = 'return checkdelete()'> 
                            </a></td>
                        </tr>"; 
        }
    }
    else {
        echo "No records found!";
    }
?>
</table>
    <script>
    function checkdelete() {
        return confirm('Are you sure you want to delete this record?');
    }
    </script>

</body>
</html>

<!--
    <a href='".$result['resume']."'></a>
-->