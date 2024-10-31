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
    public function eliminarEspecialidad($id_especialidad) {
        $this->especialidad->id_especialidad = $id_especialidad;

        if ($this->especialidad->eliminar()) {
            return "Especialidad eliminada exitosamente.";
        } else {
            return "Error al eliminar la especialidad.";
        }
    }

    // Método para consultar todas las especialidades
    public function consultarEspecialidades() {
        $especialidades = $this->especialidad->consultarTodos();

        if (!empty($especialidades)) {
            return $especialidades;
        } else {
            return "No se encontraron especialidades.";
        }
    }

    // Método para editar una especialidad
    public function editarEspecialidad($id_especialidad, $nombre_especialidad, $descripcion) {
        $this->especialidad->id_especialidad = $id_especialidad;
        $this->especialidad->nombre_especialidad = $nombre_especialidad;
        $this->especialidad->descripcion = $descripcion;

        if ($this->especialidad->editar()) {
            return "Especialidad actualizada exitosamente.";
        } else {
            return "Error al actualizar la especialidad.";
        }
    }
}
