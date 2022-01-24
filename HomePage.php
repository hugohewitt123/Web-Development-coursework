<!--checking to see if there are cookies stored under Username for this computer and if not, linking to the login page-->
<?php    
if(!isset($_COOKIE[uname])) {
    header('Location: Login.html');
} else {}
//echo $_COOKIE["uname"];

if (isset($_COOKIE[window])){
    $data = json_decode(file_get_contents('http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/infections.php?ts='.$_COOKIE[window]), true);
}else {
    $data = json_decode(file_get_contents('http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/infections.php?ts=2'), true);
}
//echo $data[0]['date'];
//xCoordinate = xCoordinate + 615 - 10;left
//yCoordinate = yCoordinate + 175 - 20;top
//x=361	y=320       pow(base,exp), sqrt(stuff)

require "connect.php";
//connecting to the databse with the correct cridentials
$conn = mysqli_connect(servername, username, password, dbname, port);
if (!$conn){
    die ("connection failed: " . mysqli_connect_error());
}

$sql1 = "SELECT * FROM visits WHERE uname = '" . $_COOKIE[uname] . "'";

//$row = mysqli_fetch_array($result);

if (isset($_COOKIE[distance])){
    $distance = $_COOKIE[distance];
}else {
    $distance = 30;
}
$k=0;

for($i=0; $i < count($data); ++$i){
    $bool=false;
    if($data[$i]['y'] < 320 && $data[$i]['x'] < 361 && $data[$i]['x'] > 10 && $data[$i]['y'] > 23){
        $result = mysqli_query($conn, $sql1);
        while($row = mysqli_fetch_array($result)){
            $eq1 = ((int)$data[$i]['x']-(int)$row['x'])*((int)$data[$i]['x']-(int)$row['x']);
            $eq2 = ((int)$data[$i]['y']-(int)$row['y'])*((int)$data[$i]['y']-(int)$row['y']);
            $sum = sqrt($eq1+$eq2);
            if( $sum <= $distance ){
                $bool=true;
            }
        }
        if($bool){
            echo "<img id='";
            echo $k;
            echo "' style='position:absolute; top:";
            echo $data[$i]['y']+175-20;
            echo "; left:";
            echo $data[$i]['x']+615-10;
            echo "; width:20px; height:20px; z-index:10; border:0px;' src='marker_red.png' onclick=show('".$data[$i]['date']."','".$data[$i]['time']."','".$data[$i]['duration']."');>";
            $k++;
        } elseif (!$bool) {
            echo "<img id='";
            echo $k;
            echo "' style='position:absolute; top:";
            echo $data[$i]['y']+175-20;
            echo "; left:";
            echo $data[$i]['x']+615-10;
            echo "; width:20px; height:20px; z-index:6; border:0px;' src='marker_black.png' onclick=show('".$data[$i]['date']."','".$data[$i]['time']."','".$data[$i]['duration']."');>";
            $k++;
        }
    }
}
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
    <a href="HomePage.php" class="active">Home</a>
    <a href="Overview.php">Overview</a>
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
<div class="child">
    <center><h2>Status</h2></center>
    <hr>
    <div class="map1">
        <div class="text">
        <a>Hi <?php echo $_COOKIE["uname"];?>, you might have had a connection to an infected person at the locations shown in red.</a>
        <br><br><br><br><br>
        <br><br><br>
        <a>Click on the marker to see details about the infection.</a>
        </div>
        <style>
        .exeter {
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
        <img class="exeter" src="exeter.jpg">
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
    function show(date, time, duration) {
        alert(" Date: " + date + "\n Time: " + time + "\n Duration: " + duration);
    }
</script>
</html>