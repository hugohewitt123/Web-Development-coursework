<?php
$Window = $_POST["Window"];
$Distance = $_POST["Distance"];

if(is_numeric($Distance)){
    setcookie("window", $Window, time()+ 60*60*24*365,'/');
    setcookie("distance", $Distance, time()+ 60*60*24*365,'/');
    header('Location: Settings.php');
} else {
    echo "incorrect format, must be a number";
}
?>