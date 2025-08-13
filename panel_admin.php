<?php
include 'conexion.php';

$mensaje = '';
// Guardado de libros en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $isbn = $_POST['isbn'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $anio = $_POST['anio'] ?? '';
    $estado = isset($_POST['estado']) ? 1 : 0; // 1 para disponible, 0 para no disponible
    
    $check_sql = "SELECT * FROM libros WHERE isbn = '$isbn'";
    $check_result = mysqli_query($conexion, $check_sql); // Hacer la consulta para verificar el ISBN

    if (mysqli_num_rows($check_result) > 0) {
        $mensaje = "Error: El ISBN '$isbn' ya existe.";
    } else {
        $sql_insert = "INSERT INTO libros (titulo, autor, isbn, categoria, descripcion, anio, estado) VALUES ('$titulo', '$autor', '$isbn', '$categoria', '$descripcion', '$anio', $estado)";
        if (mysqli_query($conexion, $sql_insert)) {
            $mensaje = "Libro registrado correctamente.";
        } else {
            $mensaje = "Error al registrar el libro: " . mysqli_error($conexion);
        }
    }
}
// Consulta para obtener todos los libros
$sql = "SELECT * FROM libros";
$resultado = mysqli_query($conexion, $sql);


if (isset($_GET['delete'])) { // Codigo para eliminar un libro
    $idEliminar = (int)$_GET['delete'];
    $sqlEliminar = "DELETE FROM libros WHERE id_libro = $idEliminar";
    mysqli_query($conexion, $sqlEliminar);
    header("Location: panel_admin.php");
    exit(); 
}

$libroEditar = null;

if (isset($_GET['edit'])) { // Codigo para editar un libro
    $idEditar = (int)$_GET['edit'];
    $sqlEditar = "SELECT * FROM libros WHERE id_libro = $idEditar";
    $resEditar = mysqli_query($conexion, $sqlEditar);
    if ($resEditar && mysqli_num_rows($resEditar) > 0) {
        $libroEditar = mysqli_fetch_assoc($resEditar);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_libro'])) {
        $idLibro = (int)$_POST['id_libro'];
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $isbn = $_POST['isbn'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $anio = $_POST['anio'] ?? '';
        $estado = isset($_POST['estado']) ? 1 : 0;

        $sqlActualizar = "UPDATE libros SET titulo = '$titulo', autor = '$autor', isbn = '$isbn', categoria = '$categoria', descripcion = '$descripcion', anio = '$anio', estado = $estado WHERE id_libro = $idLibro";

        if (mysqli_query($conexion, $sqlActualizar)) {
            $mensaje = "Libro actualizado correctamente.";
            header("Location: panel_admin.php");
            exit();
        } else {
            $mensaje = "Error al actualizar el libro: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Panel de administrador</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="fondo"></div>
    <h1 class="titulo_panel_admin">Area administrativa</h1>
    <div class="catalogo_adimin">
        <table class="tabla_libros">
            <!-- Parte de los titulos, para ubicar cada apartado -->
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Año</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Parte del cuerpo donde se encuentran todos los libros -->
             <tbody>
                <?php
                // Mostrar todos los libros con un while
                while ($libro = mysqli_fetch_assoc($resultado)) {
                    // Mostrar "Disponible" o "No disponible" según el estado
                    $estado_texto = $libro['estado'] == 1 ? 'Disponible' : 'No disponible';

                    echo "<tr class='__select'>";
                    echo "<td>" . htmlspecialchars($libro['titulo']) . "</td>"; // htmlspecialchars para evitar problemas y mostra el texto en formato plano
                    echo "<td>" . htmlspecialchars($libro['autor']) . "</td>";
                    echo "<td>" . htmlspecialchars($libro['isbn']) . "</td>";
                    echo "<td>" . htmlspecialchars($libro['categoria']) . "</td>";
                    echo "<td class='__descripcion'>" . htmlspecialchars($libro['descripcion']) . "</td>";
                    echo "<td>" . htmlspecialchars($libro['anio']) . "</td>";
                    echo "<td>" . $estado_texto . "</td>";
                    echo "<td><div class='Buttons__select'>
                            <a href='panel_admin.php?edit=" . $libro['id_libro'] . "'><button>✏️</button></a>
                            <a href='panel_admin.php?delete=" . $libro['id_libro'] . "'><button>🗑️</button></a>
                          </div></td>";
                    echo "</tr>";
                }
                ?>
             </tbody>
        </table>
    </div>
    <div class="boton_agregar_libro">
        <a href="#Abir_form_libro"><button>📚</button></a>
    </div>
    <div class="formulario_agregar_libro" id="Abir_form_libro">
        <h2>Agregar Libro</h2>
        <?php if ($mensaje): ?>
            <p style="color: red; font-weight: bold;"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        <form action="panel_admin.php" method="post" class="form_agregar_libro">
            <label>Título</label><input type="text" name="titulo" required class="titulo_int"> 
            <label>Autor</label>
            <input type="text" name="autor" required class="autor_int"> 
            <label>ISBN</label>
            <input type="number" name="isbn" required class="isbn_int"> 
            <label>Categoría</label>
            <input type="text" name="categoria" required class="categoria_int"> 
            <label>Descripción</label>
            <textarea name="descripcion" required class="descripcion_int"></textarea> 
            <label>Año</label>
            <input type="date" name="anio" required class="date_int"> 
            <label>Estado</label>
            <input type="checkbox" name="estado" class="Estado">¿Disponible? 
            <input type="submit" value="Registrar Libro" id="__btn_adimn">
        </form>
    </div>
    <div class="formulario_editar">
        <form action="panel_admin.php" method="post" class="form_editar_libro">
            <h2>Editar Información</h2>
            <?php if ($libroEditar): ?>
                <input type="hidden" name="id_libro" value="<?= $libroEditar['id_libro'] ?>">
            <?php endif; ?>

            <label>Título</label>
            <input type="text" name="titulo" required value="<?= htmlspecialchars($libroEditar['titulo'] ?? '') ?>">

            <label>Autor</label>
            <input type="text" name="autor" required value="<?= htmlspecialchars($libroEditar['autor'] ?? '') ?>">

            <label>ISBN</label>
            <input type="number" name="isbn" required value="<?= htmlspecialchars($libroEditar['isbn'] ?? '') ?>">

            <label>Categoría</label>
            <input type="text" name="categoria" required value="<?= htmlspecialchars($libroEditar['categoria'] ?? '') ?>">

            <label>Descripción</label>
            <textarea name="descripcion" required class="descripcion_int"><?= htmlspecialchars($libroEditar['descripcion'] ?? '') ?></textarea>

            <label>Año</label>
            <input type="date" name="anio" required value="<?= htmlspecialchars($libroEditar['anio'] ?? '') ?>">

            <label>Estado</label>
            <input type="checkbox" name="estado" class="Estado" <?= (isset($libroEditar['estado']) && $libroEditar['estado'] == 1) ? 'checked' : '' ?>> ¿Disponible?

            <input type="submit" value="Actualizar datos" id="__btn_adimn">
        </form>
    </div>
</body>
</html>