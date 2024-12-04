<?php
// Incluir los archivos necesarios
require_once 'config/database.php';
require_once 'models/Paciente.php';

/**
 * Clase PacienteController para manejar las acciones relacionadas con los pacientes.
 */
class PacienteController {
    private $db;
    private $paciente;

    /**
     * Constructor que inicializa la conexión a la base de datos y el modelo Paciente.
     */
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->paciente = new Paciente($this->db);
    }

    /**
     * Método para registrar un nuevo paciente.
     */
    public function agregarPaciente() {
        // Verificar si la solicitud es POST (formulario enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto Paciente
            $this->paciente->cedula = $_POST['cedula'];
            $this->paciente->nombre = $_POST['nombre'];
            $this->paciente->apellido = $_POST['apellido'];
            $this->paciente->fechaNacimiento = $_POST['fechaNacimiento'];
            $this->paciente->telefono = $_POST['telefono'];
            $this->paciente->correo = $_POST['email'];
            $this->paciente->direccion = $_POST['direccion'];

            // Registrar al paciente y redirigir si tiene éxito
            if ($this->paciente->registrarPaciente()) {
                header('Location: ./agregarPaciente?success=1');
            } else{
                header('Location: ./agregarPaciente');
            }
        } else {
            // Cargar la vista del formulario de registro si la solicitud no es POST
            require_once 'views/agregarPaciente.php';
        }
    }

    /**
     * Método para consultar todos los pacientes.
     */
    public function consultarPacientes() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $pacientes = $this->paciente->consultarPacientes(); // Obtener la lista de pacientes
            require_once 'views/consultarPacientes.php';
        } else {
            require_once 'views/GestionPacientes.php'; // Cargar la vista principal si no hay acción específica
        }
    }

    /**
     * Método para consultar un paciente por cédula.
     */
    public function consultarPacientePorCedula() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cedula'])) {
            $this->paciente->cedula = $_GET['cedula'];
            $paciente = $this->paciente->consultarPacientePorCedula(); // Obtener información del paciente
            require_once 'views/consultarPaciente.php';
        } else {
            header('Location: ./consultarPacientes'); // Redirigir si no se proporciona cédula
        }
    }

    /**
     * Método para actualizar los datos de un paciente.
     */
    public function actualizarPaciente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al objeto Paciente
            $this->paciente->cedula = $_POST['cedula'];
            $this->paciente->nombre = $_POST['nombre'];
            $this->paciente->apellido = $_POST['apellido'];
            $this->paciente->fechaNacimiento = $_POST['fechaNacimiento'];
            $this->paciente->telefono = $_POST['telefono'];
            $this->paciente->correo = $_POST['correo'];
            $this->paciente->direccion = $_POST['direccion'];

            // Actualizar al paciente y redirigir si tiene éxito
            if ($this->paciente->actualizarPaciente()) {
                header('Location: ./consultarPacientes?success=1');
            } else {
                header('Location: ./consultarPacientes?error=1');
            }
        } else {
            require_once 'views/editarPaciente.php'; // Cargar la vista de edición si no es POST
        }
    }

    /**
     * Método para eliminar un paciente por cédula.
     */
    public function eliminarPaciente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cedula'])) {
            $this->paciente->cedula = $_POST['cedula'];

            // Eliminar al paciente y redirigir
            if ($this->paciente->eliminarPaciente()) {
                header('Location: ./consultarPacientes?success=1');
            } else {
                header('Location: ./consultarPacientes?error=1');
            }
        } else {
            header('Location: ./consultarPacientes'); // Redirigir si no hay cédula
        }
    }
}
?>
