<?php

/*Clase Database que manejará nuestra conexión a MySQL */
class Database {
    // [Parámetros públicos/privados de la clase]
        private $servidor = "localhost";
        private $database = "jpo";
        private $port = 3306;
        private $charset = "utf8";
        private $usuario = "root";
        private $contrasena = "";
        private $unix_socket = "/var/run/mysql/mysql.sock"; // Ruta del Socket para Conexiones Locales
        public $pdo = null; //Variable que almacena el objeto PDO
    //[Parámetros públicos/privados de la clase/]


    //[Configuracion de las opciones PDO]
    private $opciones = [
        PDO::ATTR_CASE => PDO::CASE_LOWER,                  //[Convertir nombres de columnas a minusculas]
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION         //[Habilita manejo de errores mediante excepciones]
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,   //[Cadenas vacias a null]
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ      //[Configura el metodo de obtencion por defecto a OBJ]
    ];

     // Constructor de la clase - se ejecuta al crear una nueva instancia de la clase DataBase
    function __construct(){
        try {
            // Crear nueva instancia de PDO (conexión a la base de datos)
                // Cadena DSN (Data Source Name) con:
                // - Socket UNIX (en lugar de host:port)
                // - Nombre de la base de datos
                // - Codificación de caracteres
                $this->pdo = new PDO(
                    "mysql:unix_socket={$this->unix_socket};dbname={$this->database};charset={$this->charset}", 
                    $this->usuario, 
                    $this->contrasena, 
                    $this->opciones
                );
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>