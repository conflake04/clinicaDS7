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
        // Asignar los datos del formulario al objeto paciente
        $this->paciente->cedula = $_POST['cedula'];
        $this->paciente->nombre = $_POST['nombre'];
        $this->paciente->apellido = $_POST['apellido'];
        $this->paciente->fechaNacimiento = $_POST['fechaNacimiento'];
        $this->paciente->telefono = $_POST['telefono'];
        $this->paciente->correo = $_POST['email'];
        $this->paciente->direccion = $_POST['direccion'];

        // Asignar los datos del formulario al objeto usuario
        $usuario = new User($this->db);
        $usuario->cedula = $_POST['cedula'];
        $usuario->nombre = $_POST['nombre'];
        $usuario->apellido = $_POST['apellido'];
        $usuario->email = $_POST['email'];
        $usuario->telefono = $_POST['telefono'];
        $usuario->direccion = $_POST['direccion'];
        $usuario->password = $_POST['password']; // Encriptar la contraseña
        $usuario->idRol = $_POST['idRol'];  // Asumimos que el formulario incluye un campo para el rol

        // Iniciar la transacción
        $this->db->beginTransaction();

        try {
            // Registrar al paciente
            if (!$this->paciente->registrarPaciente()) {
                throw new Exception('Error al registrar paciente');
            }

            // Registrar al usuario
            if (!$usuario->registarUsuarioAdministrador()) {
                throw new Exception('Error al registrar usuario');
            }

            // Confirmar la transacción si ambas inserciones son exitosas
            $this->db->commit();

            // Redirigir al éxito
            header('Location: ./crearUsuarioPaciente?success=1');
        } catch (Exception $e) {
            // Si hay algún error, revertir la transacción
            $this->db->rollBack();
            $_SESSION['error_message'] = $e->getMessage();
            header('Location: ./creacionUsuario?error=1');
        }
    } else {
        // Cargar la vista del formulario de registro si la solicitud no es POST
        require_once 'views/crearUsuarioPaciente.php';
    }
    }


    /**
     * Método para consultar todos los pacientes.
     */
    public function consultarPacientes() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obtener la lista de pacientes
            $pacientes = $this->paciente->consultarPacientes(); 

            // Pasar los pacientes a la vista
            require_once 'views/verPacientes.php';
        } else {
        // Si no es GET, redirigir a la vista principal
        require_once 'views/GestionUsuario.php'; 
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
