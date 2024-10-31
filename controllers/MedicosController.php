<?php

require_once 'models/Medicos.php';
require_once 'config/database.php';

class DoctorController {

    private $doctor;
    private $db;

    // Constructor que recibe la conexión de la base de datos
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->doctor = new Doctor($this->db);
    }

    // Método para agregar un nuevo doctor
    public function agregarDoctor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto doctor
            $this->doctor->numero_licencia = $_POST['numero_licencia'];
            $this->doctor->ano_experiencia = $_POST['ano_experiencia'];
            $this->doctor->turno = $_POST['turno'];
            $this->doctor->id_especialidad = $_POST['id_especialidad'];
            $this->doctor->id_usu = $_POST['id_usu'];

            // Registrar al doctor y redirigir a la página de éxito si tiene éxito
            if ($this->doctor->registrar_doctor()) {
                header('Location: ./crearDoctor?success=1');
            } else {
                header('Location: ./crearDoctor?error=1');
            }
        } else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/crearDoctor.php';
        }
    }

    // Método para eliminar un doctor por su ID
    public function eliminarDoctor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener el ID del doctor a eliminar
            $id_doctor = $_POST['id_doctor'];

            // Eliminar el doctor y redirigir a la página de éxito si tiene éxito
            if ($this->doctor->eliminar_doctor($id_doctor)) {
                header('Location: ./eliminarDoctor?success=1');
            } else {
                header('Location: ./eliminarDoctor?error=1');
            }
        } else {
            $doctores = $this->doctor->consultar_doctor();
            require_once 'views/eliminarDoctor.php';
        }
    }

    // Método para consultar todos los doctores
    public function consultarDoctores() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $doctores = $this->doctor->consultar_doctor();
            require_once 'views/consultarDoctor.php';
        } else {
            require_once 'views/consultarDoctor.php'; // Cargar la vista principal si no hay acción
        }
    }

    // Método para editar un doctor
    public function editarDoctor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto doctor
            $id_doctor = $_POST['id_doctor'];
            $this->doctor->ano_experiencia = $_POST['año_experiencia'];
            $this->doctor->turno = $_POST['turno'];
    
            // Editar el doctor y redirigir a la página de éxito si tiene éxito
            if ($this->doctor->editar_doctor($id_doctor)) {
                header('Location: ./editarDoctor?success=1');
            } else {
                header('Location: ./editarDoctor?error=1');
            }
        } else {
            // Cambié esto para que llame a la función correcta
            $doctores = $this->doctor->consultarDatos(); // Usa la función que definiste anteriormente
            require_once 'views/editarDoctor.php';
        }
    }
}

?>
