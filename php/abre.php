<?php
    $servidor = "sql108.infinityfree.com";
    $usuario = "if0_38223498";
    $password = "FarnhamUCA2025";
    $db = "if0_38223498_aeromexico_db";
    
    
    
    $conexion = new mysqli($servidor,$usuario,$password,$db);
    
    if($conexion->connect_error){
        die("Error de conexión." . $conexion->connect_error);
    }else{
        echo "La operación fue un éxito.";
    }
?>