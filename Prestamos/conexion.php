<?php
$host = "localhost";
$user = "root"; // Cambia según tu configuración
$pass = "";     // Cambia según tu configuración
$basedatos   = "prestamos";

$conn = new mysqli($host, $user, $pass, $basedatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
