<?php
    $servidor = "sql213.infinityfree.com";
    $usuario = "if0_38313208";
    $password = "Overtaken2025";
    $db = "if0_38313208_radiodb";

    $conexion = new mysqli($servidor, $usuario, $password, $db);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        echo "Conexión exitosa a la base de datos.";
    }
?>