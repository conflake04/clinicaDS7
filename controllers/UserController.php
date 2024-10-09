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
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            // Registrar al usuario y redirigir a la página de inicio de sesión si tiene éxito
            if ($this->user->register()) {
                header('Location: ./login');
            } else {
                echo "Error en el registro.";
            }
        }else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/register.php';
        }
    }

    /**
     * Método para manejar el inicio de sesión del usuario.
     */
    public function login() {
        // Verificar si la solicitud es POST (formulario enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto User
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            // Intentar iniciar sesión y redirigir al panel de administración si tiene éxito
            if ($this->user->login()) {
                $_SESSION['user_id'] = $this->user->id; // Guardar el ID del usuario en la sesión
                header('Location: ./admin');
            } else {
                echo "Credenciales incorrectas.";
            }
        }else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/login.php';
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
