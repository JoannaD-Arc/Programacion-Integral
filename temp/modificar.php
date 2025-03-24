<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Entrada</title>
</head>
<body>
    <?php
        include("conexion.php");

        // Obtener el ID de la solicitud
        $id = $_REQUEST['id'];

        // Consulta preparada para evitar SQL Injection
        $stmt = $conexion->prepare("SELECT * FROM renders WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" significa entero
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
        } else {
            echo "No se encontraron datos para el ID proporcionado.";
            exit();
        }
    ?>
    <div class="main_container">
    
    <h1>Actualización de Datos</h1>
        <form action="actualizar.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="nombre_proyecto">Nombre del Proyecto:</label>
            <input type="text" name="nombre_proyecto" value="<?php echo $row['nombre_proyecto']; ?>"><br><br>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>"><br><br>

            <label for="estilo_diseño">Estilo de Diseño:</label>
            <input type="text" name="estilo_diseño" value="<?php echo $row['estilo_diseño']; ?>"><br><br>

            <label for="cliente">Cliente:</label>
            <input type="text" name="cliente" value="<?php echo $row['cliente']; ?>"><br><br>

            <label for="motor_render">Motor de Render:</label>
            <input type="text" name="motor_render" value="<?php echo $row['motor_render']; ?>"><br><br>

            <label for="software_modelado">Software de Modelado:</label>
            <input type="text" name="software_modelado" value="<?php echo $row['software_modelado']; ?>"><br><br>

            <label for="fecha_creacion">Fecha de Creación:</label>
            <input type="text" name="fecha_creacion" value="<?php echo $row['fecha_creacion']; ?>"><br><br>

            <label for="imagen">Cambiar Imagen:</label>
            <input type="file" name="imagen" accept="image/*"><br><br>

            <?php
                // Mostrar la imagen actual si existe
                if ($row['imagen_render']) {
                    echo "<p><strong>Imagen Actual:</strong><br><img src='data:image/jpg;base64," . base64_encode($row['imagen_render']) . "' height='100px'></p>";
                }
            ?>

            <input type="submit" value="Actualizar">
        </form>
    </div>
        
</body>
</html>
