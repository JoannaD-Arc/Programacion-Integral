<?php
// Incluir la conexión a la base de datos
include("conexion.php");

// Verificar si se ha recibido un ID válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID no válido.";
    exit();
}

$id = $_GET['id'];

// Verificar si se han recibido los datos del formulario
if (!isset($_POST['nombre_proyecto'])) {
    echo "No se recibieron datos.";
    exit();
}

$nombre_proyecto = $_POST['nombre_proyecto'];
$descripcion = $_POST['descripcion'];
$estilo_diseño = $_POST['estilo_diseño'];
$cliente = $_POST['cliente'];
$motor_render = $_POST['motor_render'];
$software_modelado = $_POST['software_modelado'];
$fecha_creacion = $_POST['fecha_creacion'];

// Verificar si se subió una nueva imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $consulta = "UPDATE renders SET nombre_proyecto = ?, descripcion = ?, estilo_diseño = ?, cliente = ?, motor_render = ?, software_modelado = ?, fecha_creacion = ?, imagen_render = ? WHERE id = ?";
} else {
    $consulta = "UPDATE renders SET nombre_proyecto = ?, descripcion = ?, estilo_diseño = ?, cliente = ?, motor_render = ?, software_modelado = ?, fecha_creacion = ? WHERE id = ?";
}

// Preparar la consulta
if ($stmt = $conexion->prepare($consulta)) {
    if (isset($imagen)) {
        $stmt->bind_param("ssssssssi", $nombre_proyecto, $descripcion, $estilo_diseño, $cliente, $motor_render, $software_modelado, $fecha_creacion, $imagen, $id);
    } else {
        $stmt->bind_param("sssssssi", $nombre_proyecto, $descripcion, $estilo_diseño, $cliente, $motor_render, $software_modelado, $fecha_creacion, $id);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: ../catalogo.php"); // Redirigir al catálogo
        exit();
    } else {
        echo "Error al actualizar la entrada: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
