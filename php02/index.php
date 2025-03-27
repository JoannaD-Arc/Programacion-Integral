<?php
/* */
require_once("conexion.php");
$database = new Database();  // Cambiado de 'conexion' a 'Database' para coincidir con la clase anterior
/* */

/*
    PDO::FETCH_NUM      --- Devuelve un array númerico
    PDO::FETCH_ASSOC    --- Devuelve un array asociativo
    PDO::FETCH_BOTH     --- NUM y ASSOC combinados, dos arrays en uno.
    PDO::FETCH_OBJ      --- Devuelve una clase/objeto
    PDO::FETCH_LAZY     --- Devuelve NUM, ASSOC Y OBJ dentro de un array. 
*/

/* */
try {
    $datos = $database->pdo->query("SELECT * FROM usuarios");  // Cambiado 'conexion->jpo' por '$database->pdo'
    $usuarios = $datos->fetchAll(PDO::FETCH_OBJ);  // Cambiado 'JPO' por 'PDO'
    print_r($usuarios);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
/* */
?>