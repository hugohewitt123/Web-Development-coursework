<!--checking to see if there are cookies stored under Username for this computer and if not, linking to the login page-->
<?php    
if(!isset($_COOKIE[uname])) {
    header('Location: Login.html');
} else {}
//echo $_COOKIE["uname"];
?>

<html>
<head>
    <!--The title of the page that displays in the browser-->
    <title>Covid - 19 Contact Tracing</title>
    <link href="style.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="super">

<div class="titleh">
        <center><h1>COVID - 19 Contact Tracing</h1></center>
<div class="vertical-menu">
    <a href="HomePage.php">Home</a>
    <a href="Overview.php" class="active">Overview</a>
    <a href="VisitsOverview.php">Add Visit</a>
    <a href="ReportInfection.php">Report</a>
    <a href="Settings.php">Settings</a>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <a href="logout.php">Logout</a>
</div>
</div>

<!--The info on overview-->    
<div class="child">
    <div class="map1">
        <div class="text">
            <br>
            <br>
        <?php
            require "connect.php";
            //connecting to the databse with the correct cridentials
            $conn = mysqli_connect(servername, username, password, dbname, port);
            if (!$conn){
                die ("connection failed: " . mysqli_connect_error());
            }
            
            $sql1 = "SELECT * FROM visits WHERE uname = '" . $_COOKIE[uname] . "'";
            //putting this into a variable result
            $result = mysqli_query($conn, $sql1);
        
            echo "<table id='datatable' border='0'><tr><th class='thead'>Date</th><th class='thead'>Time</th><th class='thead'>Duration</th><th class='thead'>X</th><th class='thead'>Y</th><th> </th></tr>";
            
            $i=0;
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td class='tdata'>" . $row['date'] . "</td>";
                echo "<td class='tdata'>" . $row['time'] . "</td>";
                echo "<td class='tdata'>" . $row['duration'] . "</td>";
                echo "<td class='tdata'>" . $row['x'] . "</td>";
                echo "<td class='tdata'>" . $row['y'] . "</td>";
                echo "<td class='tdata'><img id='".$i."' type='image' src='cross.png' style='top:center; left:center; width:20; height:auto; border:0px;' onclick='remove(".$i.");'></td>";
                echo "</tr>";
                $i=$i+1;
            }
            echo "</table>";
            
            //closing the connection to the database
            mysqli_close($conn);
        ?>
        </div>
    </div>
</div>
    
<br>
<br>
<div class="wrap2">
    <div  class="forms">
    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
</div>
</div> 
</body>
<script>
    function remove(row) {
        row+=1;
        var x = document.getElementById("datatable").rows[row].cells;
        //x[0].innerHTML = "NEW CONTENT";
        document.getElementById("datatable").deleteRow(row);
        location.replace("removevisit.php?date="+x[0].innerHTML+"&time="+x[1].innerHTML+"&duration="+x[2].innerHTML+"&x="+x[3].innerHTML+"&y="+x[4].innerHTML);
    }
</script>
</html>