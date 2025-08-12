<?php
include "conexion.php";


$buscar = $_GET['buscar'] ?? '';
$genero = $_GET['genero'] ?? '';


$sql = "SELECT l.id_libro, l.titulo, a.nombre AS autor, l.genero,
               (SELECT e.estado FROM ejemplares e WHERE e.id_libro = l.id_libro LIMIT 1) AS estado
        FROM library l
        JOIN autores a ON l.id_autor = a.id_autor
        WHERE 1=1";

$params = [];
$types = "";

if (!empty($buscar)) {
    $sql .= " AND (l.titulo LIKE ? OR a.nombre LIKE ?)";
    $like = "%$buscar%";
    $params[] = &$like;
    $params[] = &$like;
    $types .= "ss";
}


if (!empty($genero)) {
    $sql .= " AND l.genero = ?";
    $params[] = &$genero;
    $types .= "s";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Lista de géneros para el filtro
$generos = $conn->query("SELECT DISTINCT genero FROM library");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body>
    <h1>Catálogo de Libros</h1>

    <!-- Formulario de búsqueda -->
    <form method="GET" class="filtros">
        <input type="text" name="buscar" placeholder="Buscar por título o autor" value="<?= htmlspecialchars($buscar) ?>">
        <select name="genero">
            <option value="">Todos los géneros</option>
            <?php while($g = $generos->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($g['genero']) ?>" <?= ($genero == $g['genero']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($g['genero']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()):
                    $estadoClass = (strtolower($row['estado']) == "disponible") ? "disponible" : "no-disponible";
                ?>
                    <tr>
                        <td><img src="img/<?= $row['id_libro'] ?>.jpg" alt="Portada" class="img-libro"></td>
                        <td class="hover-text"><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><?= htmlspecialchars($row['autor']) ?></td>
                        <td><?= htmlspecialchars($row['genero']) ?></td>
                        <td class="<?= $estadoClass ?>"><?= htmlspecialchars($row['estado'] ?? "Desconocido") ?></td>
                        <td><a href="detalles.php?id=<?= $row['id_libro'] ?>" class="btn-detalles">Ver detalles</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-resultados">No se encontraron libros.</p>
    <?php endif; ?>

</body>
</html>
