<?php
    require 'abre.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST" ){

        /*Se obtienen los datos requeridos y se "sanitizan". */
        $boleto = $conexion->real_escape_string($_POST['boleto']);
        $cliente = $conexion->real_escape_string($_POST['cliente']);
        $destino = $conexion->real_escape_string($_POST['destino']);

        $stmt = $conexion->prepare("INSERT INTO boletos (boleto, cliente, destino) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$boleto,$cliente,$destino);

        if($stmt->execute()){
            echo " Boleto registrado correctamente.";
            header("Location: http://pi-uacj-211283.infinityfreeapp.com/gracias.html");
            exit(); // Detener ejecución
        }else
        {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    }
    $conexion->close();
?> 