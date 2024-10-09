<?php


require_once 'config/database.php';
require_once 'models/Rol.php';


class RolController {

    private $db;
    private $rol;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rol = new Rol($this->db);
    }


    public function registrar_rol() {
        // Verificar si la solicitud es POST (formulario enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto User
            $this->rol->nombre_rol = $_POST['nombre_rol'];
            $this->rol->descripcion_rol = $_POST['descripcion_rol'];

            // Registrar al usuario y redirigir a la página de inicio de sesión si tiene éxito
            if ($this->rol->registrar_rol()) {
                header('Location: ./createRoll');
            } else {
                echo "Error en el registro.";
            }
        }else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/crearRol.php';
        }
    }

    public function consultar_roles() {
     $this->rol->consultar_roles();
        require_once 'views/consultaRoles.php'; // Llama a la vista para mostrar los roles
    }
    

    public function mostrar_roles_para_eliminar() {
        // Consultar roles desde la base de datos
        $roles = $this->rol->consultar_roles();
        
        // Si se ha enviado el formulario para eliminar un rol
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_rol'])) {
            $nombre_rol = $_POST['nombre_rol'];
            
            // Intentar eliminar el rol
            if ($this->rol->eliminar_rol($nombre_rol)) {
                header('Location: ' .  './createRoll' . '?action=eliminarRol');
                exit(); // Redirigir para evitar reenvío del formulario
            } else {
                echo "Error al eliminar el rol.";
            }
        }

        // Cargar la vista pasando los roles
        require_once 'views/eliminarRol.php';
    }
}

?>