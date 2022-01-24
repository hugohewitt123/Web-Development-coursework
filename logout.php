<!--deleting the users cookies which will log them out as it deletes their session which the website checks for-->
<?php    
    setcookie("uname", "", time()- 3600,'/');
    header('Location: Login.html');
?>