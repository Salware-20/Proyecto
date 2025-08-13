<?php

include "conexion.php";

$Nombre = $_POST['nombre'];
$Correo = $_POST['correo'];
$Apellido = $_POST['Apellido'];
$Clave = $_POST['Clave'];
$confirmar = $_POST['Confirmar'];

$sql = "insert into Person (nombre,correo,apellido,Clave,confirmar) values ('$Nombre','$Correo','$Apellido','$Clave','$confirmar')";

if(mysqli_query($conexion,$sql)){
    echo "Registro exitoso. Serás redirigido a login...";
    header("refresh:2; url=login.php");
    exit;
} else {
    echo "Error: ". mysqli_error($conexion);
}

?>
