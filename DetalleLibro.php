    <?php
    session_start(); 
    include 'menu.php';
    include 'conexion.php'; 

    $id_libro = $_GET['id']; 

    $result = mysqli_query($conexion, "SELECT ID, titulo, autor, isbn, categoria, anio, descripcion, estado FROM libros WHERE ID = $id_libro");

    $libro = mysqli_fetch_assoc($result);

    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Detalle Libro</title>
    <link rel="shortcut icon" href="Imagenes/Libros.png" type="image/jpg">
    </head>
    <body>
    <div class="container">
        <img src="Imagenes/Libro.png" alt="Fondo" class="imagen-fondo">

        <div class="Texto">
        <h1>Detalles del Libro</h1>
        <table>
            <tr>
            <td>
                <img src="Imagenes/Libro.png" alt="Portada del libro" class="imagen-fondo">
            </td>
            <td>
                <form>
                <input type="text" value="<?= htmlspecialchars($libro['ID']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['titulo']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['autor']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['ISBN']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['Categoria']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['anio']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['Descripcion']) ?>" disabled><br>
                <input type="text" value="<?= htmlspecialchars($libro['Estado']) ?>" disabled><br>
                <button type="button">Acción</button>
                </form>
            </td>
            </tr>
        </table>
        </div>
    </div>
    </body>
    </html>
