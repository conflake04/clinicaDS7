<?php
/**
 * Clase User para manejar las operaciones CRUD con los usuarios.
 */
class User {
    private $conn;
    private $table = 'usuario'; // Nombre de la tabla de usuarios

    public $idUsuario;
    public $username;
    public $password;
    public $email;
    public $direction;
    public $idRol;

    /**
     * Constructor de la clase que recibe la conexión a la base de datos.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Método para registrar un nuevo usuario.
     */
    public function register() {
        // Consulta SQL para insertar un nuevo usuario
        $query = "INSERT INTO " . $this->table . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        // Encriptar la contraseña antes de guardarla
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Enlazar los parámetros
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        // Ejecutar la consulta y devolver true si fue exitosa
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Método para iniciar sesión.
     */
    public function login() {
        // Consulta SQL para buscar el usuario por nombre de usuario
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username); // Enlazar el parámetro del nombre de usuario
        $stmt->execute();

        // Obtener los resultados
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si la contraseña proporcionada coincide con la almacenada
        if ($user && password_verify($this->password, $user['password'])) {
            $this->idUsuario     = $user['id']; // Guardar el ID del usuario
            return true;
        }
        return false;
    }
}
