<?php
/**
 * Clase User para manejar las operaciones CRUD con los usuarios.
 */
class User {
    private $conn;
    private $table = 'usuario'; // Nombre de la tabla de usuarios

    public $idUsuario;
    public $name;
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
        $query = "INSERT INTO " . $this->table . " (name, username, password, email, direction, idRol) 
          VALUES (:name, :username, :password, :email, :direction, :idRol)";
        $stmt = $this->conn->prepare($query);

        // Encriptar la contraseña antes de guardarla
      
        $this->limpiar();

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Enlazar los parámetros
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':direction', $this->direction);
        $stmt->bindParam(':idRol', $this->idRol);
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
            $this->id = $user['id']; // Guardar el ID del usuario
            return true;
        }
        return false;
    }

    private function limpiar() {
    // Sanitizar atributos
    $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario)); // Si idUsuario es un entero, considera validarlo como tal
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags($this->password)); // Generalmente, no se necesita sanitizar aquí, ya que se encripta
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->direction = htmlspecialchars(strip_tags($this->direction));
    $this->idRol = htmlspecialchars(strip_tags($this->idRol)); // Si idRol es un entero, considera validarlo como tal
}
}
