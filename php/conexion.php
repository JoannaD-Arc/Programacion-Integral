<?php

    $conexion = new mysqli("localhost", "root", "", "lilianadb");

    if ($conexion->connect_error) {
        echo "Sucedió un error de conexión a la base de datos: " . $conexion->connect_error;
    } else {
        echo "<script>console.log('Conexión Exitosa');</script>";
    }
?>
