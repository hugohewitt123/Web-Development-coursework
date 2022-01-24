<?php
$Date = $_POST["Date"];
$Time = $_POST["Time"];
$uname = $_COOKIE["uname"];

if (DateTime::createFromFormat('Y-m-d', $Date) && DateTime::createFromFormat('H:i:s', $Time)){
    require "connect.php";
    //connecting to the databse with the correct cridentials
    $conn = mysqli_connect(servername, username, password, dbname, port);
    if (!$conn){
        die ("connection failed: " . mysqli_connect_error());
    }

    //an sql query to select all from login where the username and hashed passsword match
    $sql = "INSERT INTO infections (uname, date, time) VALUES ('" . $uname . "', '" . $Date . "', '" . $Time . "')";
    
    if (mysqli_query($conn, $sql)){
        //header('Location: ReportInfection.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        //header('Location: ReportInfection.php');
    }
    
    $sql1 = "SELECT * FROM visits WHERE uname = '" . $uname . "'";
    //putting this into a variable result
    $result = mysqli_query($conn, $sql1);
    while($row = mysqli_fetch_array($result)){
        
        $arr = array("x" => (int) $row['x'],
                     "y" => (int) $row['y'],
                     "date" => $row['date'],
                     "time" => $row['time'],
                     "duration" => (int) $row['duration']);
        $data = json_encode($arr);
        
        $ch = curl_init('http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/report.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type:application/json');

        $result = curl_exec($ch);
        curl_close($ch);
    }
    

    //closing the connection to the database
    mysqli_close($conn);
    
    header('Location: ReportInfection.php');
} else {
    echo "Format incorrect: date must be yyyy-mm-dd or time must be hh:mm:ss.";
}
?>