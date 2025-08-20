<?php
session_start();
include "conexion.php";

// Simulación de sesión //
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['id_usuario'] = 1;
}

$id_usuario = $_SESSION['id_usuario'];
$id_libro = $_GET['id'] ?? 0;

// Obtener datos del libro //
$sql = "SELECT * FROM Libros WHERE id_libro = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_libro);
$stmt->execute();
$result = $stmt->get_result();
$libro = $result->fetch_assoc();

// Procesar préstamo //
if (isset($_POST['prestar']) && $libro['disponible'] == 1) {
    $fecha = date("Y-m-d");
    $sqlInsert = "INSERT INTO Prestamos (id_usuario, id_libro, fecha_prestamo) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($sqlInsert);
    $stmt2->bind_param("iis", $id_usuario, $id_libro, $fecha);
    $stmt2->execute();

    // Actualizar estado del libro //
    $sqlUpdate = "UPDATE Libros SET disponible = 0 WHERE id_libro = ?";
    $stmt3 = $conn->prepare($sqlUpdate);
    $stmt3->bind_param("i", $id_libro);
    $stmt3->execute();

    header("Location: mis_prestamos.php"); // Redirigir a préstamos //
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Libro</title>
</head>
<body>
    <h1><?= htmlspecialchars($libro['titulo']) ?></h1>
    <p><strong>Género:</strong> <?= htmlspecialchars($libro['genero']) ?></p>
    <p><strong>Estado:</strong> <?= $libro['disponible'] ? "Disponible" : "Prestado" ?></p>

    <?php if ($libro['disponible']): ?>
        <form method="POST">
            <button type="submit" name="prestar">Prestar libro</button>
        </form>
    <?php else: ?>
        <p>Este libro ya está prestado.</p>
    <?php endif; ?>

    <p><a href="catalogo.php">Volver al catálogo</a></p>
</body>
</html>

