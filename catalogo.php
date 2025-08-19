
<?php
include "conexion.php";

// Búsqueda y filtro
$buscar = $_GET['buscar'] ?? '';
$genero = $_GET['genero'] ?? '';

// Consulta principal usando la tabla 'libros'
$sql = "SELECT id_libro, titulo, autor, categoria AS genero, estado, anio FROM libros WHERE 1";
$params = [];
$types = "";

if (!empty($buscar)) {
    $sql .= " AND (titulo LIKE ? OR autor LIKE ?)";
    $like = "%$buscar%";
    $params[] = &$like;
    $params[] = &$like;
    $types .= "ss";
}

if (!empty($genero)) {
    $sql .= " AND categoria = ?";
    $params[] = &$genero;
    $types .= "s";
}

$stmt = $conexion->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Lista de géneros para el filtro
$generos = $conexion->query("SELECT DISTINCT categoria FROM libros");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="styles/Styles_catalogo.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>
    <h1>Catálogo de Libros</h1>

    <!-- Formulario de búsqueda -->
    <form method="GET" class="filtros">
        <input type="text" name="buscar" placeholder="Buscar por título o autor" value="<?= htmlspecialchars($buscar) ?>">
        <select name="genero">
            <option value="">Todos los géneros</option>
            <?php while($g = $generos->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($g['categoria']) ?>" <?= ($genero == $g['categoria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($g['categoria']) ?>
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
                    $estadoTexto = ($row['estado'] == 1) ? "Disponible" : "No disponible";
                    $estadoClass = ($row['estado'] == 1) ? "disponible" : "no-disponible";
                ?>
                    <tr>
                        <td><img src="img/<?= $row['id_libro'] ?>.jpg" alt="Portada" class="img-libro"></td>
                        <td class="hover-text"><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><?= htmlspecialchars($row['autor']) ?></td>
                        <td><?= htmlspecialchars($row['genero']) ?></td>
                        <td class="<?= $estadoClass ?>"><?= $estadoTexto ?></td>
                        <td><a href="DetalleLibro.php?id=<?= $row['id_libro'] ?>" class="btn-detalles">Ver detalles</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-resultados">No se encontraron libros.</p>
    <?php endif; ?>

</body>
</html>