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
        // Asignar los datos del formulario al objeto usuario
        $usuario = new User($this->db);
        $usuario->cedula = $_POST['cedula'];
        $usuario->nombre = $_POST['nombre'];
        $usuario->apellido = $_POST['apellido'];
        $usuario->email = $_POST['email'];
        $usuario->telefono = $_POST['telefono'];
        $usuario->direccion = $_POST['direccion'];
        $usuario->password = $_POST['password']; 
        $usuario->idRol = $_POST['idRol'];

        // Asignar los datos del formulario al objeto doctor
        $this->doctor->numero_licencia = $_POST['numero_licencia'];
        $this->doctor->anio_esperiencia = $_POST['anio_esperiencia'];
        $this->doctor->turno = $_POST['turno'];
        $this->doctor->id_especialidad = $_POST['id_especialidad'];
        $this->doctor->cedula = $_POST['cedula'];  // Relacionado con la tabla usuario

        // Iniciar la transacción
        $this->db->beginTransaction();

        try {
            // Registrar al usuario
            if (!$usuario->registarUsuarioAdministrador()) {
                throw new Exception('Error al registrar usuario');
            }

            // Registrar al doctor
            if (!$this->doctor->registrar_doctor()) {
                throw new Exception('Error al registrar doctor');
            }

            // Confirmar la transacción si ambas inserciones son exitosas
            $this->db->commit();

            // Redirigir al éxito
            header('Location: ./creacionUsuario');
        } catch (Exception $e) {
            // Si hay algún error, revertir la transacción
            $this->db->rollBack();
            $_SESSION['error_message'] = $e->getMessage();
            header('Location: ./creacionUsuario');
        }
    } else {
        // Cargar la vista del formulario de registro si la solicitud no es POST
        require_once 'views/crearUsuarioMedico.php';
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
            $this->doctor->anio_esperiencia = $_POST['anio_esperiencia'];
            $this->doctor->turno = $_POST['turno'];
    
            // Editar el doctor y redirigir a la página de éxito si tiene éxito
            if ($this->doctor->editar_doctor($id_doctor)) {
                header('Location: ./editarDoctor?success=1');
            } else {
                header('Location: ./editarDoctor?error=1');
            }
        } else {
            // Cambié esto para que llame a la función correcta
            $doctores = $this->doctor->consultar_doctor_editar(); // Usa la función que definiste anteriormente
            require_once 'views/editarDoctor.php';
        }
    }
}
?>  