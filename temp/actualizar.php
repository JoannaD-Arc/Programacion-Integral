<?php
    // Incluir la conexión a la base de datos
    include("conexion.php");

    // Verificar si se ha recibido un ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo "ID no válido.";
        exit();
    }

    // Obtener los datos del formulario
    if (isset($_POST['nombre_proyecto'])) {
        $nombre_proyecto = $_POST['nombre_proyecto'];
        $descripcion = $_POST['descripcion'];
        $estilo_diseño = $_POST['estilo_diseño'];
        $cliente = $_POST['cliente'];
        $motor_render = $_POST['motor_render'];
        $software_modelado = $_POST['software_modelado'];
        $fecha_creacion = $_POST['fecha_creacion'];

        // Verificar si se ha subido una nueva imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            // Subir la nueva imagen
            $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
            $imagen_sql = ", imagen_render = ?";
        } else {
            // Mantener la imagen actual si no se ha subido una nueva
            $imagen = null;
            $imagen_sql = "";
        }

        // Consulta SQL para actualizar los datos en la base de datos
        $consulta = "UPDATE renders SET nombre_proyecto = ?, descripcion = ?, estilo_diseño = ?, cliente = ?, motor_render = ?, software_modelado = ?, fecha_creacion = ? $imagen_sql WHERE id = ?";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($consulta)) {
            // Si se subió una nueva imagen
            if ($imagen) {
                $stmt->bind_param("ssssssssi", $nombre_proyecto, $descripcion, $estilo_diseño, $cliente, $motor_render, $software_modelado, $fecha_creacion, $imagen, $id);
            } else {
                // Si no se subió una nueva imagen
                $stmt->bind_param("ssssssss", $nombre_proyecto, $descripcion, $estilo_diseño, $cliente, $motor_render, $software_modelado, $fecha_creacion, $id);
            }

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Entrada actualizada correctamente.";
                header("Location: ../catalogo.php"); // Redirigir al catálogo
                exit();
            } else {
                echo "Error al actualizar la entrada: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        echo "No se recibieron datos.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
?>
