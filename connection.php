<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "myshop"; 

$con = new mysqli($server, $user, $pass, $db);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
