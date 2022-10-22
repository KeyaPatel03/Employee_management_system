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
    <title>Search Page</title>
    <link rel="stylesheet" href="style.css">
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
        <div id="for_user">

    </div>
    </div>
    
        <form action="" method="POST">
    <?php
        echo "<br><h1 align='left' class='head'>Search For Employee Data</h1>";
    ?>
    <input type="text" size="90" name="get_data" required value="<?php if(isset($_POST['get_data'])) {echo $_POST['get_data'];}?>" placeholder="Search by firstname / lastname / email / position / phone number">
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
    //if($total > 0) {
        $filename = $_FILES["resume"]["name"];
        $tempname = $_FILES["resume"]["tmp_name"];
        $folder = "Resume/".$filename;
        move_uploaded_file($tempname, $folder); 
        echo "<a href = '".$filename."'>".$filename."</a>";
        $cnt = 0;
        while($row = mysqli_fetch_assoc($data)) {
            if($cnt == 0) {
    echo "<table align='center' border='0' cellspacing='1' cellpadding='9' >
                <tr><th width = '8%'>FIRST NAME</th> 
                    <th width = '8%'>LAST NAME</th> 
                    <th width = '5%'>E-MAIL</th> 
                    <th width = '9%'>PHONE NUMBER</th>
                    <th width = '12%'>POSITION</th> 
                    <th width = '3%'>GENDER</th> 
                    <th width = '12%'>ADDRESS</th> 
                    <th width = '2%'>RESUME</th> 
                    <th width = '10%' colspan='2'>OPERATIONS</th></tr>";
                    $cnt++;
            }
        //if($total > 0) {
                echo "<tr id='row'> <td align='center'>".$row['firstname']."</td> 
                           <td align='center'>".$row['lastname']."</td> 
                           <td align='center'>".$row['email']."</td> 
                           <td align='center'>".$row['phno']."</td>
                           <td align='center'>".$row['position']."</td> 
                           <td align='center'>".$row['gender']."</td> 
                           <td align='center'>".$row['address']."</td> 
                           <td align='center'><a href = '".$row['resume']."' target='xyz'><i class='fa fa-download'></i></a></td> 
                           <td align='right'> <a href = 'update_from_search.php?id=$row[id]&fn=$row[firstname]&ln=$row[lastname]&em=$row[email]&ph=$row[phno]&pos=$row[position]&gen=$row[gender]&adr=$row[address]&resume=$row[resume]'>
                                <input type='submit' value='Update' class='btn save'></a></td>
                                &nbsp &nbsp &nbsp &nbsp &nbsp
    
                            <td><a href = 'delete_from_search.php?id=$row[id]'>
                                <input type='button' value='Delete' class='btn cancel' onclick = 'return checkdelete()'> 
                                </a></td>
                            </tr>";
            }
        }
        else {
            //echo "Data Not Found!";
        }
    //}
        ?>
    </table>
    <script>
    function checkdelete() {
        return confirm('Are you sure you want to delete this record?');
    }
    </script>
</body>
</html>