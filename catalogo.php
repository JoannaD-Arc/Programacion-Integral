<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liliana Olivares | Catálogo de Renders</title>
</head>
<body>
    <div class="main_container">
        <h2>Catálogo de Renders</h2>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre del Proyecto</th>
                    <th>Descripción</th>
                    <th>Estilo de Diseño</th>
                    <th>Cliente</th>
                    <th>Motor de Render</th>
                    <th>Software de Modelado</th>
                    <th>Fecha de Realización</th>
                    <th>Render</th>
                    <th>Modificar</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    /*Conexión y Consulta*/
                    include("php/conexion.php");
                    $consulta = "SELECT * FROM renders";
                    $resultado = $conexion->query($consulta);

                    /*Llenado de la tabla*/
                    while($row = $resultado->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre_proyecto'] . "</td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['estilo_diseño'] . "</td>";
                        echo "<td>" . $row['cliente'] . "</td>";
                        echo "<td>" . $row['motor_render'] . "</td>";
                        echo "<td>" . $row['software_modelado'] . "</td>";
                        echo "<td>" . $row['fecha_creacion'] . "</td>";
                        echo "<td><img src='data:image/jpg;base64," . base64_encode($row['imagen_render']) . "' height='50px'></td>";
                        
                        /*Botones*/
                        echo '<th><a href="php/modificar.php?id=' . $row['id'] . '"><img height="35px" src="img/cam.png"></a></th>';
                        echo '<th><a href="php/eliminar.php?id=' . $row['id'] . '"><img height="35px" src="img/borrar.png"></a></th>';

                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>