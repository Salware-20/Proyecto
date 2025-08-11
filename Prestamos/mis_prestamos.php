<?php
session_start();
include "conexion.php";

// 🔹 Simulamos que el usuario ya inició sesión
// (En un sistema real, esto se haría al iniciar sesión)
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['id_usuario'] = 1; // Usuario de ejemplo
}

$id_usuario = $_SESSION['id_usuario'];

// Consulta de préstamos
$sql = "SELECT l.titulo, p.fecha_prestamo, p.fecha_devolucion
        FROM Prestamos p
        JOIN Libros l ON p.id_libro = l.id_libro
        WHERE p.id_usuario = ?
        ORDER BY p.fecha_prestamo DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Préstamos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Mis Préstamos</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Título del Libro</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()):
                    $estado = is_null($row['fecha_devolucion']) ? "Activo" : "Devuelto";
                    $clase_estado = ($estado == "Activo") ? "activo" : "devuelto";
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><?= htmlspecialchars($row['fecha_prestamo']) ?></td>
                        <td><?= $row['fecha_devolucion'] ?? "—" ?></td>
                        <td class="<?= $clase_estado ?>"><?= $estado ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-prestamos">No tienes préstamos activos.</p>
    <?php endif; ?>

</body>
</html>
