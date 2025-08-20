<?php
session_start(); 
include 'menu.php';
include 'conexion.php';

// 1) Testeo la conexión al arrancar
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/Estilos.css">
    <link rel="shortcut icon" href="Imagenes/icono.png" type="image/jpg">
    <title>Digital Universe</title>
</head>
<body>

/div>
            </div>

        <?php else: ?>
            <h1>Bienvenidos a la Biblioteca Digital Universe</h1>
            <p>Nuestra biblioteca digital permite a lectores y administradores gestionar libros, realizar préstamos y acceder a una amplia colección de títulos desde cualquier dispositivo.</p>

            <div class="gallery-container">
                <div class="gallery">
                    <a target="_blank" href="login.php">
                        <img src="Imagenes/login.png" alt="Iniciar sesión">
                    </a>
                    <div class="desc">Iniciar sesión</div>
                </div>

                <div class="gallery">
                    <a target="_blank" href="registro.php">
                        <img src="Imagenes/registrarse.jpg" alt="Registrarse">
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
        <?php endif; ?>
    </div>
</div> 



</body>
</html>
