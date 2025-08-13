<?php
$host = "localhost";
$user = "root";
$pass = "";     
$basedatos   = "biblioteca";

$conn = new mysqli($host, $user, $pass, $basedatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
