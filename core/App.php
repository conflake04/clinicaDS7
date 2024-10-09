<?php
// Incluir el controlador de usuarios
require_once 'controllers/UserController.php';

/**
 * Clase App para manejar las rutas de la aplicación.
 */
class App {
    public function __construct() {
        // Obtener la URL solicitada
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : null;
        $url = explode('/', $url);

        // Instanciar el controlador de usuarios
        $controller = new UserController();

        // Si no hay una URL, cargar la página de inicio de sesión por defecto
        if (empty($url[0])) {
            require_once 'views/login.php';
            return;
        }

        // Controlar las diferentes rutas según la URL
        switch ($url[0]) {
            case 'login':
                $controller->login(); // Cargar el método de inicio de sesión
                break;
            case 'register':
                $controller->register(); // Cargar el método de registro
                break;
            case 'admin':
                // Verificar si el usuario está autenticado antes de mostrar el panel de administración
                if (isset($_SESSION['user_id'])) {
                    require_once 'views/admin.php';
                } else {
                    require_once 'views/admin.php'; // Redirigir al inicio de sesión si no está autenticado
                }
                break;
            case 'logout':
                $controller->logout(); // Cerrar sesión
                break;

            case 'GestionUsuario':
                // Si se accede a /users, se carga la vista de usuarios
                    require_once 'views/GestionUsuario.php';
                break;

            case 'createRoll':
                // Si se accede a /users, se carga la vista de usuarios
                    require_once 'views/createRoll.php';
                break;

            case 'crearUsuario':
                // Si se accede a /users, se carga la vista de usuarios
                    require_once 'views/CrearUsuario.php';
                break;

            default:
                echo "Página no encontrada"; // Mostrar error si la ruta no existe
                break;
        }
    }
}
