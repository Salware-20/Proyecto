<?php
include "conexion.php";

$id = $_GET['id'] ?? 0;

$sql = "SELECT l.titulo, l.isbn, a.nombre AS autor, e.nombre AS editorial,
               l.anio_publicacion, l.genero
        FROM library l
        JOIN autores a ON l.id_autor = a.id_autor
        JOIN editoriales e ON l.id_editorial = e.id_editorial
        WHERE l.id_libro = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$libro = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Libro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php if ($libro): ?>
        <h1><?= htmlspecialchars($libro['titulo']) ?></h1>
        <p><strong>Autor:</strong> <?= htmlspecialchars($libro['autor']) ?></p>
        <p><strong>Editorial:</strong> <?= htmlspecialchars($libro['editorial']) ?></p>
        <p><strong>ISBN:</strong> <?= htmlspecialchars($libro['isbn']) ?></p>
        <p><strong>Año:</strong> <?= htmlspecialchars($libro['anio_publicacion']) ?></p>
        <p><strong>Género:</strong> <?= htmlspecialchars($libro['genero']) ?></p>
        <a href="catalogo.php">Volver</a>
    <?php else: ?>
        <p>No se encontró el libro.</p>
        <a href="catalogo.php">Volver</a>
    <?php endif; ?>
</body>
</html>
