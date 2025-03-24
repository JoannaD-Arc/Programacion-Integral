<?php
    include('conexion.php');
    $id = $_REQUEST['id'];
    echo $id;
    $consulta = "DELETE FROM renders WHERE id = '$id' ";
    echo $consulta;
    $resultado = $conexion->query($consulta);

    if($conexion->query($consulta)){
        header("Location: ../catalogo.php");
        
    }else{
        echo "Error: " .$consulta . "<br>" . $conexion->conexion->error;
    }
?>