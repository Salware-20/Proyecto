<?php

include "conexion.php";

$Nombre = $_POST['nombre'];
$Correo = $_POST['correo'];
$Apellido = $_POST['apellido'];
$Clave = $_POST['clave'];
$confirmar = $_POST['Confirmar'];

$sql = "INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `clave`, `Administrador`) values (NULL, '$Nombre', '$Apellido', '$Correo', '$Clave', '0')";

if(mysqli_query($conexion,$sql)){
    echo "Registro exitoso. Serás redirigido a login...";
    header("refresh:2; url=login.php");
    exit;
} else {
    echo "Error: ". mysqli_error($conexion);
}

?>
