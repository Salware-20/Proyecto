<?php

include "conexion.php";

$sql = "select * from Person";

$resultado = mysqli_query($conexion, $sql);

echo "<table>";

     echo "<tr>";
          echo "<th>id</th>";
          echo "<th>Nombre</th>";
          echo "<th>Apellido</th>";
          echo "<th>Correo</th>";
          echo "<th>Clave</th>";
          echo "<th>Confirmar</th>";
    echo "</tr>";

    while($fila = mysqli_flecth_asoc($resultado)){

    echo "<tr>";
         echo "<td>$fila['id']</td>";
        echo "<td>$fila['Nombre']</td>";
        echo "<td>$fila['Apellido']</td>";
        echo "<td>$fila['Correo']</td>";
         echo "<td>$fila['Clave']</td>";
        echo "<td>$fila['Confirmar']</td>";
    echo "</tr>";
        
    }

    echo "</table>";


?>

