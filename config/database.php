<?php
/**
 * Clase Database para manejar la conexión a la base de datos.
 */
class Database {
    private $host = '127.0.0.1';       // Dirección del servidor
    private $db_name = 'clinica'; // Nombre de la base de datos
    private $username = 'myuser';        // Usuario de la base de datos
    private $password = 'mypassword';            // Contraseña de la base de datos
    public $conn;

    /**
     * Método que obtiene la conexión a la base de datos utilizando PDO.
     */
    public function getConnection() {
        $this->conn = null;
        try {
            // Crear una nueva conexión PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8"); // Establecer el juego de caracteres a UTF-8
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error en la conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>