<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/estilos_registro.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="Imagenes/icono.png" type="image/jpg">
    <title>REGISTRO</title>
</head>
<body>
    <?php include("menu.php"); ?>
    
    <form action="insertar.php" method="post">

         <span>Nombre:</span> <input type="text" name="nombre">
         <span>Apellido:</span> <input type="text" name="apellido">
         <span>Correo:</span> <input type="email" name="correo">
         <span>Clave:</span> <input type="password" name="clave">
         <span>Confirmar:</span> <input type="password" name="Confirmar">
         <input type="submit" value = "Registrar">
    </form>
   
</body>
</html>