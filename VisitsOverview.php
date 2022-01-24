<!--checking to see if there are cookies stored under Username for this computer and if not, linking to the login page-->
<?php    
if(!isset($_COOKIE[uname])) {
    header('Location: Login.html');
} else {}
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
<img id="marker" style="position:absolute; top:-175px; left:-615px; width:20px; height:20px; z-index:6; border:0px;" src="marker_black.png">
    
<div class="titleh">
        <center><h1>COVID - 19 Contact Tracing</h1></center>
<div class="vertical-menu">
    <a href="HomePage.php">Home</a>
    <a href="Overview.php">Overview</a>
    <a href="VisitsOverview.php" class="active">Add Visit</a>
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
<div class="child">
    <center><h2>Add a new Visit</h2></center>
    <hr>
    <div class="map1">
        <div class="text">
        <form action="addvisit.php" method="post">
            <input class="input1" type="text" placeholder="Date" name="Date" required>
            <br>
            <br>
            <input class="input1" type="text" placeholder="Time" name="Time" required>
            <br>
            <br>
            <!--Making the username entry so that it is required-->
            <input class="input1" type="text" placeholder="Duration" name="Duration" required>
            <br>
            <br>
            <style>
                .imagex{
                    z-index: 5;
                    position:absolute;
                    overflow: auto;
                    right:0;
                    top:78;
                    width: 350px;
                    height: auto;
                    border: 3px solid black;
                }
            </style>
            <img class="imagex" type="image" id="exeter" src="exeter.jpg" onclick="clickImage(event);">
            <input class="hidei" type="text" id="x" name="x" required>
            <input class="hidei" type="text" id="y" name="y" required>
            <br>
            <br>
            <input class="Register" type="submit" value="  Add  ">
            <br>
            <br>
            <input class="Register" type="reset" value="Cancel">
        </form>
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
    function clickImage(event) {
        var xOffset = document.getElementById('exeter').offsetLeft;
        var xCoordinate = event.clientX;
        var yOffset = document.getElementById('exeter').offsetTop;
        var yCoordinate = event.clientY;
        var hotspotlist = document.getElementById('exeter').value;
        xCoordinate = xCoordinate - 615;
        yCoordinate = yCoordinate - 175;
        document.getElementById('x').value = xCoordinate;
        document.getElementById('y').value = yCoordinate;
        xCoordinate = xCoordinate + 615 - 10;
        yCoordinate = yCoordinate + 175 - 20;
        document.getElementById('marker').style.top=yCoordinate + "px";
        document.getElementById('marker').style.left=xCoordinate + "px";
    }
</script>
</html>