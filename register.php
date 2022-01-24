<?php
//Getting the username nad password from the html
$Username1 = $_POST["Username"];
$Password1 = $_POST["pwd"];
$Name = $_POST["Name"];
if($_POST["Surname"]){
    $Surname = $_POST["Surname"];
}

if (strlen($Password1) > 7 && preg_match('/[a-z]/', $Password1) == true && preg_match('#[0-9]#', $Password1) == true){
    require "connect.php";
    //connecting to the databse with the correct cridentials
    $conn = mysqli_connect(servername, username, password, dbname, port);
    if (!$conn){
        die ("connection failed: " . mysqli_connect_error());
    }
    
    $sql1 = "SELECT uname FROM users";
    //putting this into a variable result
    $query = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_row($query);
    $bool = true;
    foreach ($row as &$value) {
        if ($Username1 == $value){
            $bool = false;
        }
    }
    
    if ($bool){
        $salt = substr(str_shuffle("12378162743abcdefghijklmnopqrstuvwxyz"), 0, 10);;
        $Password1 .= $salt;
    
        $options = ['cost' => 12,];
        $Password12 = password_hash($Password1, PASSWORD_BCRYPT, $options);
    
        $sql = "INSERT INTO users (name, surname, uname, passwd, salt) VALUES ('" . $Name . "', '" . $Surname . "', '" . $Username1 . "', '" . $Password12 . "', '" . $salt . "')";
    
        if (mysqli_query($conn, $sql)){
            setcookie("uname", $Username1, time()+ 1800,'/');
            header('Location: HomePage.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            header('Location: Registration.html');
        }
    } else {
        echo "username already exists, please choose a unique username";
    }
    //closing the connection to the database
    mysqli_close($conn);
} else {
    echo "The password must be at least 8 characters and have upper and lower case with numbers";
}
?>