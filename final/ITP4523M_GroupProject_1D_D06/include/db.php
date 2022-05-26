<?php
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";

function getDBconnection() {
    global $hostname, $username, $pwd, $database;
    $conn = mysqli_connect($hostname,$username,$pwd,$database) or die(mysqli_connect_error());
    return $conn;
}
?>