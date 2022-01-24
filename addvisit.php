<?php
$Date = $_POST["Date"];
$Time = $_POST["Time"];
$Duration = $_POST["Duration"];
$x = $_POST["x"];
$y = $_POST["y"];
$uname = $_COOKIE["uname"];

if (DateTime::createFromFormat('Y-m-d', $Date) && DateTime::createFromFormat('H:i:s', $Time) && is_numeric($Duration) && is_numeric($x) && is_numeric($y)){
    require "connect.php";
    //connecting to the databse with the correct cridentials
    $conn = mysqli_connect(servername, username, password, dbname, port);
    if (!$conn){
        die ("connection failed: " . mysqli_connect_error());
    }

    //an sql query to select all from login where the username and hashed passsword match
    $sql = "INSERT INTO visits (uname, date, time, duration, x, y) VALUES ('" . $uname . "', '" . $Date . "', '" . $Time . "', '" . $Duration . "', '" . $x . "', '" . $y . "')";
    
    if (mysqli_query($conn, $sql)){
        header('Location: VisitsOverview.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header('Location: VisitsOverview.php');
    }
    
    //closing the connection to the database
    mysqli_close($conn);
} else {
    echo "Format incorrect: date must be yyyy-mm-dd or time must be hh:mm:ss or duration must be integer.";
}
?>