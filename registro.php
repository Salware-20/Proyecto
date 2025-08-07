<?php
$conexion = new mysqli("localhost", "root", "", "biblioteca");

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"] ?? '';
    $apellido = $_POST["apellido"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $clave = $_POST["clave"] ?? '';
    $confirmar = $_POST["confirmar"] ?? '';

    
    if (!$nombre || !$apellido || !$correo || !$clave || !$confirmar) {
        $errores[] = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Correo inválido.";
    } elseif ($clave !== $confirmar) {
        $errores[] = "Las contraseñas no coinciden.";
    } else {
      
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errores[] = "El correo ya está registrado.";
        } else {
           
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $insertar = $conexion("INSERT INTO usuarios (nombre, apellido, correo, password)");
            $insertar( $nombre, $apellido, $correo, $hash);

            if ($insertar->execute()) {
                echo "<p>Registro exitoso. <a href='login.php'>Inicia sesión</a>.</p>";
                exit;
            } else {
                $errores[] = "Error al registrar. " . $insertar->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="registro">
    <?php include 'menu.php';?>
<h2>Registro de Usuarios</h2>
<form method="POST" class="registro-form">
    <input type="text" name="nombre" placeholder="Nombre" class="intput-registro" required>
    <input type="text" name="apellido" placeholder="Apellido" class="intput-registro" required>
    <input type="email" name="correo" placeholder="Correo" class="intput-registro" required>
    <input type="password" name="clave" placeholder="Contraseña" class="intput-registro" required>
    <input type="password" name="confirmar" placeholder="Confirmar Contraseña" class="intput-registro" required>
    <button type="submit" class="intput-registro">Registrarse</button>
</form>

<?php
if (!empty($errores)) {
    foreach ($errores as $e) {
        echo "<p style='color:red;'>$e</p>";
    }
}
?>
</body>
</html>


