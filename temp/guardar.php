<?php
    // Incluir la conexión a la base de datos
    include("conexion.php");

    // Verificar si se ha enviado el formulario
    if (isset($_POST['nombre_proyecto'])) {
        // Obtener los datos del formulario
        $nombre_proyecto = $_POST['nombre_proyecto'];
        $descripcion = $_POST['descripcion'];
        $estilo_diseño = $_POST['estilo_diseño'];
        $cliente = $_POST['cliente'];
        $motor_render = $_POST['motor_render'];
        $software_modelado = $_POST['software_modelado'];
        $fecha_creacion = $_POST['fecha_creacion'];

        // Verificar si se ha subido una imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            // Subir la imagen
            $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        } else {
            // Si no se sube imagen, establecer la variable $imagen como NULL
            $imagen = NULL;
        }

        // Consulta SQL para insertar la nueva entrada en la tabla 'renders'
        $consulta = "INSERT INTO renders (nombre_proyecto, descripcion, estilo_diseño, cliente, motor_render, software_modelado, fecha_creacion, imagen_render)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la consulta para evitar SQL Injection
        if ($stmt = $conexion->prepare($consulta)) {
            // Vincular los parámetros a la consulta
            $stmt->bind_param("ssssssss", $nombre_proyecto, $descripcion, $estilo_diseño, $cliente, $motor_render, $software_modelado, $fecha_creacion, $imagen);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Entrada guardada correctamente.";
                // Redirigir al catálogo después de guardar la nueva entrada
                header("Location: ../catalogo.php");
                exit();
            } else {
                echo "Error al guardar la entrada: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        echo "Faltan datos para guardar la entrada.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
?>
