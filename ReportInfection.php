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
    <a href="Overview.php">Overview</a>
    <a href="VisitsOverview.php">Add Visit</a>
    <a href="ReportInfection.php" class="active">Report</a>
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
<div class="child">
    <center><h2>Report an Infection</h2></center>
    <hr>
    <div class="map1">
        <div class="text2">
        <center><a>Please report the date and time when you were tesed positive for COVID - 19.</a></center>
        <br><br>
        </div>
        <center>
        <form action="report.php" method="post">
            <!--Making the username entry so that it is required-->
            <style>  
                .input2{
                    text-align: center;
                    font-size:  20px;
                    background-color: transparent;
                    padding-left: 50px;
                    padding-right: 50px;
                    padding-top: 5px;
                    padding-bottom: 5px;
                    border: 1px solid black;
                }
            </style>
            <input class="input2" type="text" placeholder="Date" name="Date" required>
            <br>
            <br>
            <!--Making the password entry also so that it is required-->
            <input class="input2" type="text" placeholder="Time" name="Time" required>
            <br>
            <br>
            <input class="button1" style="float:left;" type="submit" value="Report">
            <input class="button1" style="float:right;" type="reset" value="Cancel">
        </form>
        </center>
    </div>
</div>

<br>
<br>
<div class="wrap2">
    <div class="forms">
    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
</div>
</div> 
</body>
</html>