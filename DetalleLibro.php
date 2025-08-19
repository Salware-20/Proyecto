<?php
session_start(); 
include 'conexion.php'; 

$id_libro = (int)$_GET['id']; 

$result = mysqli_query($conexion, "SELECT id_libro, titulo, autor, isbn, categoria, anio, descripcion, estado FROM libros WHERE id_libro = $id_libro");
$libro = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/Estilos.css">
<link rel="stylesheet" href="styles/style.css">
<title>Detalle Libro</title>
<link rel="shortcut icon" href="Imagenes/icono.png" type="image/jpg">
</head>
<body>
    <?php include 'menu.php'; ?>
<div class="container">
    <img src="imagenes/Libros-estantes.jpg" alt="Fondo" class="imagen-fondo">

    <div class="Texto">
    
    <h1>Detalles del Libro</h1>
    <table>
        <tr>
        <td>
            <img src="Imagenes/Libros-estantes.jp" alt="Portada del libro" class="imagen-fondo">
        </td>
        <td>
            <form>
            <input type="text" value="<?= htmlspecialchars($libro['id_libro']) ?>" disabled><br>
            <input type="text" value="<?= htmlspecialchars($libro['titulo']) ?>" disabled><br>
            <input type="text" value="<?= htmlspecialchars($libro['autor']) ?>" disabled><br>
            <input type="text" value="<?= htmlspecialchars($libro['isbn']) ?>" disabled><br>
            <input type="text" value="<?= htmlspecialchars($libro['categoria']) ?>" disabled><br>
            <input type="text" value="<?= htmlspecialchars($libro['anio']) ?>" disabled><br>
            <input type="text" value="<?= htmlspecialchars($libro['descripcion']) ?>" disabled><br>
            <input type="text" value="<?= ($libro['estado'] == 1 ? 'Disponible' : 'No disponible') ?>" disabled><br>
            <button type="button">Acción</button>
            </form>
        </td>
        </tr>
    </table>
    </div>
</div>
</body>
</html>
