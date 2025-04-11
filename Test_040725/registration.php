<?php
include("config.php");
session_start();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];  
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Verifica si el correo ya existe
    $query = $connect->prepare("SELECT * FROM usuarios WHERE EMAIL = :email");
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class="error">¡El correo ya existe!</p>';
    } else {
        // Si no existe, insertar nuevo usuario
        $insert = $connect->prepare("INSERT INTO usuarios (USERNAME, PASSWORD, EMAIL) VALUES (:username, :password, :email)");
        $insert->bindParam(":username", $username, PDO::PARAM_STR);
        $insert->bindParam(":password", $password_hash, PDO::PARAM_STR);
        $insert->bindParam(":email", $email, PDO::PARAM_STR);

        $result = $insert->execute();

        if ($result) {
            echo '<p class="success">¡Registro exitoso!</p>';
        } else {
            echo '<p class="error">Error al registrar. Intenta de nuevo.</p>';
        }
    }
}
?>
