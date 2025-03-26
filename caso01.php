<?php
/*--[Parámetros de Conexión a la DataBase]--*/
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'viajeberlindb');
/*--[Parámetros de Conexión a la DataBase\]--*/
    
/*--[Intento de Recolección de Datos]--*/
    try {
        // Variable Conexión con Parámetros Incluidos.
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Vemos si hay errores de conexión.
        if ($connection->connect_error) {
            throw new Exception("Error de conexión: " . $connection->connect_error);
        }
        
        // Consulta a la Base de Datos
        $sql = "SELECT nombre, apellido , fotografia FROM boletos";
        $result = $connection->query($sql);
        
        // Verificar si hay filas
        if ($result && $result->num_rows > 0) {
            echo "<h2>Lista de Pasajeros</h2>";
            echo "<ul>";
            
            // Mostramos resultados mientras haya filas
            while($row = $result->fetch_assoc()) {
                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row["nombre"]) . "</p>";
                echo "<p><strong>Apellido:</strong> " . htmlspecialchars($row["apellido"]) . "</p>";
            
            // Condicional para ver si hay imagne en la DB.
            if (!empty($row["fotografia"])) {
                // Convertir el BLOB a imagen base64
                $imagenData = base64_encode($row["fotografia"]);
                echo "<img src='data:image/jpeg;base64,{$imagenData}' style='max-width: 200px;' alt='Foto del pasajero' />";
            } else {
                // Si no hay imagen disponible mostramos este mensaje.
                echo "<p>No hay imagen disponible.</p>";
            }
            }
            echo "</ul>";
        } else {
            // Si no encontramos resultados mostramos este mensaje.
            echo "<p>No se encontraron resultados.</p>";
        }
        
    } catch (Exception $e) {
        // En caso de que no se puedan recuperar los datos anunciamos el error.
        error_log("Error en la aplicación: " . $e->getMessage());
        echo "<p>Ocurrió un error al procesar su solicitud. Por favor, intente más tarde.</p>";
    } finally {
        // Cerramos la conexión.
        if (isset($connection)) {
            $connection->close();
        }
    }
/*--[Intento de Recolección de Datos\]--*/
?>