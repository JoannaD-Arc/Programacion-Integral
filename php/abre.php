<?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $db = "aeromexico_db";
    
    
    
    $conexion = new mysqli($servidor,$usuario,$password,$db);
    
    if($conexion->connect_error){
        die("Error de conexión." . $conexion->connect_error);
    }else{
        echo "La operación fue un éxito.";
    }
?>