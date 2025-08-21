<?php
session_start(); 
include 'conexion.php'; 

$id_libro = (int)$_GET['id']; 

$result = mysqli_query($conexion, "SELECT id_libro, titulo, autor, isbn, categoria, anio, descripcion, estado FROM libros WHERE id_libro = $id_libro");
$libro = mysqli_fetch_assoc($result);
if ($libro['estado'] == 1) {
  $btn = '<button id="btn_login">Tomar prestado</button>';
} else {
  $btn = '<button id="btn_login" disabled>Libro no disponible</button>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/Estilos.css">
<title>Detalle Libro</title>
<link rel="shortcut icon" href="Imagenes/icono.png" type="image/jpg">
</head>
    <?php include 'menu.php'; ?>


<div>
    <img src="Imagenes/Libros-estantes.jpg" alt="Fondo" class="imagen-fondo">

    <div class="Texto">
        <div class="book-details">
      <div class="book-image">
        <img src="Imagenes/PortadaLibro.jpg" alt="Portada del libro">
      </div>
      <div class="details">
        <h2>Detalles del Libro</h2>
        <table>
          <tr>
            <th>Título:</th>
            <td><?= htmlspecialchars($libro['titulo']) ?></td>
          </tr>
          <tr>
            <th>Autor:</th>
            <td><?= htmlspecialchars($libro['autor']) ?></td>
          </tr>
          <tr>
            <th>ISBN:</th>
            <td><?= htmlspecialchars($libro['isbn']) ?></td>
          </tr>
          <tr>
            <th>Categoría:</th>
            <td><?= htmlspecialchars($libro['categoria']) ?></td>
          </tr>
          <tr>
            <th>Año:</th>
            <td><?= htmlspecialchars($libro['anio']) ?></td>
          </tr>
          <tr>
            <th>Descripción:</th>
            <td><?= htmlspecialchars($libro['descripcion']) ?></td>
          </tr>
          <tr>
            <td>
              <?php echo $btn ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
    </div>
</div> 

</body>
</html>
