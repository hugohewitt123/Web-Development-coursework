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
    <a href="ReportInfection.php">Report</a>
    <a href="Settings.php" class="active">Settings</a>
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
    <center><h2>Alert Settings</h2></center>
    <hr>
    <div class="map1">
        <div class="text2">
        <center><a>Here you may change the alert distance and the time span for which the contact tracing will be performed.</a></center>
        <br><br>
        </div>
        <center>
        <form action="updatesettings.php" method="post">
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
                .input3{
                    text-align: center;
                    font-size:  20px;
                    background-color: transparent;
                    padding-left: 120px;
                    padding-right: 120px;
                    padding-top: 5px;
                    padding-bottom: 5px;
                    border: 1px solid black;
                }
            </style>
            <label for="window">window</label>
            <select id="window" class="input3" type="text" name="Window" required>
                <option value="1">1 Week</option>
                <option value="2">2 Weeks</option>
                <option value="3">3 Weeks</option>
                <option value="4">4 Weeks</option>
            </select>
            <br>
            <br>
            <label for="distance">distance</label>
            <input id="distance"class="input2" type="text" name="Distance" required>
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