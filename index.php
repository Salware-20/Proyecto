<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Digital Universe</title>
    <link rel="shortcut icon" href="Imagenes/Icono.png" type="image/jpge">
</head>
<body>
<?php include 'menu.php'; ?>

  <div class="Container">
    <img src="Imagenes/fondoindex.png" alt="Fondo" class="imagen-fondo">

    <div class="Texto">
      <h1>Bienvenidos a la Biblioteca Digital Universe</h1>
      <p>“Nuestra biblioteca digital permite a
lectores y administradores gestionar libros, realizar préstamos y acceder a una amplia
colección de títulos desde cualquier dispositivo.</p>

    </div>
  </div>


<div class="gallery-container">
  <div class="gallery">
    <a target="_blank" href="login.php">
      <img src="Imagenes/login.png" alt="Iniciar sesión">
    </a>
    <div class="desc">Iniciar sesión</div>
  </div>

  <div class="gallery">
    <a target="_blank" href="registro.php">
      <img src="Imagenes/registrarse.png" alt="Registrarse">
    </a>
    <div class="desc">Registrarse</div>
  </div>

  <div class="gallery">
    <a target="_blank" href="catalogo.php">
      <img src="Imagenes/catalogo.png" alt="Ver catálogos de libros">
    </a>
    <div class="desc">Ver catálogos de libros</div>
  </div>
</div>

<?php 
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "biblioteca";

$conexion = new mysqli($host, $usuario, $contrasena, $basededatos);
 
?>



</body>
</html>

