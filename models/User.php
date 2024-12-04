<?php
/**
 * Clase User para manejar las operaciones CRUD con los usuarios.
 */
class User {
    private $conn;
    private $table = 'usuario'; // Nombre de la tabla de usuarios

    public $cedula;   // Cedula del usuario (clave primaria)
    public $nombre;   // Nombre del usuario
    public $apellido; // Apellido del usuario
    public $password; // Contraseña del usuario
    public $email;    // Correo electrónico del usuario
    public $telefono; // Teléfono del usuario
    public $direccion; // Dirección del usuario
    public $idRol;    // Rol del usuario

    /**
     * Constructor de la clase que recibe la conexión a la base de datos.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Método para registrar un nuevo usuario.
     */
    public function registarUsuarioAdministrador() {
        // Consulta SQL para insertar un nuevo usuario
        $query = "INSERT INTO " . $this->table . " 
          (cedula, nombre, apellido, password, email, telefono, direccion, idRol) 
          VALUES (:cedula, :nombre, :apellido, :password, :email, :telefono, :direccion, :idRol)";
        $stmt = $this->conn->prepare($query);

        // Limpiar y preparar los datos
        $this->limpiar();
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Enlazar los parámetros
        $stmt->bindParam(':cedula', $this->cedula);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':idRol', $this->idRol);

        // Ejecutar la consulta
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error al registrar el usuario: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Método para iniciar sesión.
     */
    public function login() {
        // Consulta SQL para buscar el usuario por email
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email); // Enlazar el parámetro de email
        $stmt->execute();

        // Obtener los resultados
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si la contraseña proporcionada coincide con la almacenada
        if ($user && password_verify($this->password, $user['password'])) {
            $this->cedula = $user['cedula']; // Guardar la cédula del usuario
            $this->idRol  = $user['idRol']; // Guardar el rol del usuario
            $this->nombre = $user['nombre']; // Guardar el nombre del usuario
            return true;
        }
        return false;
    }

    /**
     * Método para consultar todos los usuarios.
     */
    public function consultarUsuarios() {
        try {
            $query = "SELECT usuario.cedula, usuario.nombre, usuario.apellido, usuario.email, usuario.telefono, usuario.direccion, rol.name_rol 
                      FROM " . $this->table . " 
                      INNER JOIN rol ON usuario.idRol = rol.idRol WHERE rol.name_rol='administrador'";
            $statement = $this->conn->prepare($query);
            $statement->execute();

            return $statement;
        } catch (PDOException $e) {
            echo "Error al consultar los usuarios: " . $e->getMessage();
            return [];
        }
    }




    /**
     * Método privado para limpiar datos.
     */
    private function limpiar() {
        // Sanitizar atributos
        $this->cedula = htmlspecialchars(strip_tags($this->cedula));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->password = htmlspecialchars(strip_tags($this->password)); 
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->idRol = htmlspecialchars(strip_tags($this->idRol));
    }
}
?>
