<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'abre.php';

// Obtener datos del formulario
$nombre_cabina = $_POST['nombre_cabina'];
$ubicacion = $_POST['ubicacion'];
$capacidad = $_POST['capacidad'];
$banda = $_POST['banda'];
$frecuencia = $_POST['frecuencia'];
$estacion = $_POST['estacion'];
$nombre_locutor = $_POST['nombre_locutor'];
$apellido_locutor = $_POST['apellido_locutor'];
$experiencia = $_POST['experiencia'];
$titulo_musica = $_POST['titulo_musica'];
$artista = $_POST['artista'];
$genero = $_POST['genero'];
$duracion = $_POST['duracion'];

// Insertar en la tabla Cabina
$sql_cabina = "INSERT INTO cabina (nombre, ubicacion, capacidad) VALUES ('$nombre_cabina', '$ubicacion', $capacidad)";
if ($conexion->query($sql_cabina) === TRUE) {
    $id_cabina = $conexion->insert_id;
} else {
    die("Error al insertar en la tabla cabina: " . $conexion->error);
}

// Insertar en la tabla Frecuencia
$sql_frecuencia = "INSERT INTO frecuencia (banda, frecuencia, estacion) VALUES ('$banda', $frecuencia, '$estacion')";
if ($conexion->query($sql_frecuencia) === TRUE) {
    $id_frecuencia = $conexion->insert_id;
} else {
    die("Error al insertar en la tabla frecuencia: " . $conexion->error);
}

// Insertar en la tabla Locutores
$sql_locutor = "INSERT INTO locutores (nombre, apellido, experiencia, id_cabina, id_frecuencia) VALUES ('$nombre_locutor', '$apellido_locutor', $experiencia, $id_cabina, $id_frecuencia)";
if ($conexion->query($sql_locutor) === TRUE) {
    echo "Locutor insertado correctamente.";
} else {
    die("Error al insertar en la tabla locutores: " . $conexion->error);
}

// Insertar en la tabla Musica
$sql_musica = "INSERT INTO musica (titulo, artista, genero, duracion, id_frecuencia) VALUES ('$titulo_musica', '$artista', '$genero', '$duracion', $id_frecuencia)";
if ($conexion->query($sql_musica) === TRUE) {
    echo "Música insertada correctamente.";
} else {
    die("Error al insertar en la tabla musica: " . $conexion->error);
}

// Cerrar la conexión
$conexion->close();
?>