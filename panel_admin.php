<?php



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
    <h1 class="titulo_panel_admin">Area administrativa</h1>
    <div class="catalogo_adimin">
        <table class="tabla_libros">
            <!-- Parte de los titulos, para ubicar cada apartado -->
            <thead class="__fixed">
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
                <tr class="__select">
                    <!-- <td><?php echo $libro['titulo']; ?></td>
                    <td><?php echo $libro['autor']; ?></td>
                    <td><?php echo $libro['isbn']; ?></td>
                    <td><?php echo $libro['categoria']; ?></td>
                    <td><?php echo $libro['descripcion']; ?></td>
                    <td><?php echo $libro['anio']; ?></td>
                    <td><?php echo $libro['estado']; ?></td>
                    <td><a href="#"><button>✏️</button></a><a href=""><button>🗑️</button></a></td> -->
                </tr>
                <tr class="__select">
                    <td>deyvid</td>
                    <td>Sala</td>
                    <td>123123</td>
                    <td>Romantica</td>
                    <td>TE QQUIERO MUCHO RABANITO TE QUIERE TU COMPA PESITO</td>
                    <td>2025</td>
                    <td>Disponible</td>
                    <td><a href="#"><button>✏️</button></a><a href=""><button>🗑️</button></a></td>
                </tr>
             </tbody>
        </table>
    </div>
    <div class="boton_agregar_libro">
        <a href="#Abir_form_libro"><button>📚</button></a>
    </div>
    <div class="formulario_agregar_libro" id="Abir_form_libro">
        <h2>Agregar Libro</h2>
        <form action="" method="post" class="form_agregar_libro">
            <label>Título</label><input type="text" name="titulo" required class="titulo_int"> 
            <label>Autor</label>
            <input type="text" name="autor" required class="autor_int"> 
            <label>ISBN</label>
            <input type="number" name="isbn" required class="isbn_int"> 
            <label>Categoría</label>
            <input type="text" name="categoria" required class="categoria_int"> 
            <label>Descripción</label>
            <input type="text" name="descripcion" required class="descripcion_int"> 
            <label>Año</label>
            <input type="date" name="anio" required class="date_int"> 
            <label>Estado</label>
            <input type="checkbox" name="estado" required class="Estado">¿Disponible? 
            <input type="submit" value="Registrar Libro" id="__btn_adimn">
        </form>
    </div>
</body>
</html>