<?php

$servername = "localhost";
$username = "fernando";
$password = "1234";
$dbname = "bd";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset('utf8');
if ($conn->connect_error) {
    die("Conexión fallida!! :(:" . $conn->connect_error);
}
?>