<?php
session_start(); // Iniciar sesión para manejar el inicio de sesión y autenticación

// Incluir los archivos necesarios
require_once 'config/database.php';
require_once 'models/User.php';

/**
 * Clase UserController para manejar las acciones del usuario.
 */
class UserController {
    private $db;
    private $user;

    /**
     * Constructor que inicializa la conexión a la base de datos y el modelo de usuario.
     */
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    /**
     * Método para manejar el registro de un nuevo usuario.
     */
    public function register() {
        // Verificar si la solicitud es POST (formulario enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto User
            $this->user->cedula = $_POST['cedula'];
            $this->user->nombre = $_POST['nombre'];
            $this->user->apellido = $_POST['apellido'];
            $this->user->password = $_POST['password'];
            $this->user->email = $_POST['email'];
            $this->user->telefono = $_POST['telefono'];
            $this->user->direccion = $_POST['direccion'];
            $this->user->idRol = $_POST['idRol'];

            // Registrar al usuario y redirigir a la página de inicio de sesión si tiene éxito
            if ($this->user->register()) {
                header('Location: ./crearUsuario?success=1');
            } else {
                header('Location: ./crearUsuario?error=1');
            }
        } else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/crearUsuario.php';
        }
    }

    /**
     * Método para manejar el inicio de sesión del usuario.
     */
    public function login() {
        // Verificar si la solicitud es POST (formulario enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto User
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            // Intentar iniciar sesión y redirigir al panel de administración si tiene éxito
            if ($this->user->login()) {
                $_SESSION['user_id'] = $this->user->cedula; // Guardar la cédula del usuario en la sesión
                header('Location: ./admin');
            } else {
                echo "Credenciales incorrectas.";
            }
        } else {
            // Cargar la vista del formulario de inicio de sesión si la solicitud no es POST
            require_once 'views/login.php';
        }
    }

    /**
     * Método para consultar todos los usuarios.
     */
    public function consultarUsuarios() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $users = $this->user->consultarUsuarios(); // Consultar los usuarios registrados
            require_once 'views/consultarUsuario.php';
        } else {
            require_once 'views/GestionUsuarios.php'; // Si no hay acción, cargar la vista principal
        }
    }

    /**
     * Método para cerrar sesión.
     */
    public function logout() {
        session_destroy(); // Destruir la sesión actual
        header('Location: ./login'); // Redirigir al formulario de inicio de sesión
    }
}
?>
