<?php

require_once 'models/Especialidad.php';
require_once 'config/database.php';

class EspecialidadController {

    private $especialidad;
    private $db; 

    // Constructor que recibe la conexión de la base de datos
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->especialidad = new Especialidad($this->db);
    }

    // Método para agregar una nueva especialidad
    public function agregarEspecialidad() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto especialidad
            $this->especialidad->nombre_especialidad = $_POST['nombre_especialidad'];
            $this->especialidad->descripcion = $_POST['descripcion'];

            // Registrar al usuario y redirigir a la página de inicio de sesión si tiene éxito
            if ($this->especialidad->agregar()) {
                header('Location: ./crearEspecialidad?success=1');
            } else {
                header('Location: ./crearEspecialidad?error=1');
            }
        }else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/crearEspecialidad.php';
        }
    }

    // Método para eliminar una especialidad por su ID
    public function eliminarEspecialidad() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto especialidad
            $this->especialidad->nombre_especialidad = $_POST['nombre_especialidad'];

            // Registrar al usuario y redirigir a la página de inicio de sesión si tiene éxito
            if ($this->especialidad->eliminar()) {
                header('Location: ./eliminarEspecialidad?success=1');
            } else {
                header('Location: ./eliminarEspecialidad?error=1');
            }
        }else {
            $especialidades = $this->especialidad->consultarTodos();
            require_once 'views/eliminarEspecialidad.php';
        }
    }

    // Método para consultar todas las especialidades
    public function consultarEspecialidades() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $especialidades = $this->especialidad->consultarTodos();
            require_once 'views/consultarEspecialidad.php';
        } else {
            'views/consultarEspecialidad.php'; // Si no hay acción, cargar la vista principal
        }
        
    }

    // Método para editar una especialidad
    public function editarEspecialidad() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto especialidad
            $this->especialidad->id_especialidad = $_POST['id_especialidad'];
            $this->especialidad->nombre_especialidad = $_POST['nombre_especialidad'];
            $this->especialidad->descripcion = $_POST['descripcion'];

            // Registrar al usuario y redirigir a la página de inicio de sesión si tiene éxito
            if ($this->especialidad->editar()) {
                header('Location: ./editarEspecialidad?success=1');
            } else {
                header('Location: ./editarEspecialidad?error=1');
            }
        }else {
            $especialidades = $this->especialidad->consultarTodos();
            require_once 'views/editarEspecialidad.php';
        }
    }
}
