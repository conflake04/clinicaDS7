<?php
// Incluir el controlador de usuarios
require_once 'controllers/UserController.php';
require_once 'controllers/RolController.php';
require_once 'controllers/EspecialidadController.php';
require_once 'controllers/MedicosController.php';

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
        $rolcontroller = new RolController();
        $especialidadcontroller = new EspecialidadController();
        $medicoscontroller = new DoctorController();

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

            case 'crearUsuario':
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
                require_once 'views/GestionUsuario.php';
                break;

            case 'createRoll':
                require_once 'views/createRoll.php';
                break;

            case 'crearRol':
                require_once 'views/crearRol.php';
                break;
            
            case 'registrarRol':
                $rolcontroller->registrar_rol();
                break;

            case 'consultarRoles':
                $rolcontroller->consultar_roles();
                break;

            case 'eliminarRol':
                $rolcontroller->mostrar_roles_para_eliminar();
                break;

            case 'consultarUsuario':
                $controller->consultarUsuarios();
                break;

            case 'GestionEspecialidad':
                require_once 'views/GestionEspecialidad.php';
                break;

            case 'GestionMedicos':
                require_once 'views/GestionMedicos.php';
                break;

            case 'crearEspecialidad':
                $especialidadcontroller->agregarEspecialidad();
                break;

            case 'consultarEspecialidad':
                $especialidadcontroller->consultarEspecialidades();
                break;

            case 'eliminarEspecialidad':
                $especialidadcontroller->eliminarEspecialidad();
                break;

            case 'editarEspecialidad':
                $especialidadcontroller->editarEspecialidad();
                break;
            
            case 'agregarMedico':
                $medicoscontroller->agregarDoctor();
                break;

                case 'editarDoctor':
                    $medicoscontroller->editarDoctor();
                    break;
    
                 case 'eliminarDoctor':
                    $medicoscontroller->eliminarDoctor();
                    break;
                case 'consultarDoctor':
                    $medicoscontroller->consultarDoctores();
                    break;

            default:
                echo "Página no encontrada"; // Mostrar error si la ruta no existe
                break;
        }
    }
}
