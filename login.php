<?php
//Getting the username nad password from the html
$Username1 = $_POST["Username"];
$Password1 = $_POST["pwd"];

require "connect.php";
//connecting to the databse with the correct cridentials
$conn = mysqli_connect(servername, username, password, dbname, port);
if (!$conn){
    die ("connection failed: " . mysqli_connect_error());
}

$sql1 = "SELECT salt FROM users WHERE uname = '" . $Username1 . "'";
//putting this into a variable result
$query = mysqli_query($conn, $sql1);
$row = mysqli_fetch_row($query);
$result1 = $row[0];

$Password1 .= $result1;

//an sql query to select all from login where the username and hashed passsword match
$sql = "SELECT passwd FROM users WHERE uname = '" . $Username1 . "'";
//putting this into a variable result
$query1 = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_row($query1);

//a loop which if there is an output from the sql query it sets the cookie for the user with an expiry time of an hour and takes the user to the home page
if (mysqli_num_rows($query1) > 0){
    if (password_verify($Password1, $row1[0])){
        setcookie("uname", $Username1, time()+ 1800,'/');
        header('Location: HomePage.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header('Location: Login.html');
    } 
} else {
    header('Location: Login.html');
}

//closing the connection to the database
mysqli_close($conn);
?>