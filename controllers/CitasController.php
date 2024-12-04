<?php

// Incluir los archivos necesarios
require_once 'config/database.php';
require_once 'models/Citas.php';

/**
 * Clase CitasController para manejar las acciones relacionadas con las citas.
 */
class CitasController {
    private $db;
    private $citas;

    /**
     * Constructor que inicializa la conexión a la base de datos y el modelo de citas.
     */
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->citas = new Citas($this->db);
    }

    /**
     * Método para registrar una nueva cita.
     */
    public function registrarCita() {
        // Verificar si la solicitud es POST (formulario enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los datos del formulario al modelo Citas
            $this->citas->cedulaPaciente = $_POST['cedulaPaciente'];
            $this->citas->fechaHora = $_POST['fechaHora'];
            $this->citas->especialidad = $_POST['especialidad'];
            $this->citas->doctorID = $_POST['doctorID'];
            $this->citas->estado = $_POST['estado'];

            // Registrar la cita y redirigir según el resultado
            if ($this->citas->registrar_cita()) {
                header('Location: ./registrarCita?success=1');
            } else {
                header('Location: ./registrarCita?error=1');
            }
        } else {
            // Cargar la vista del formulario de registro de citas si la solicitud no es POST
            require_once 'views/registrarCita.php';
        }
    }

    /**
     * Método para consultar todas las citas.
     */
    public function consultarCitas() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $citas = $this->citas->consultar_citas();
            require_once 'views/consultarCitas.php';
        } else {
            require_once 'views/GestionCitas.php';
        }
    }

    /**
     * Método para consultar una cita específica por su ID.
     */
    public function consultarCitaPorId() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $cita = $this->citas->consultar_cita_por_id($_GET['id']);
            require_once 'views/consultarCita.php';
        } else {
            header('Location: ./consultarCitas?error=1');
        }
    }

    /**
     * Método para editar una cita existente.
     */
    public function editarCita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['citaID'])) {
            $this->citas->fechaHora = $_POST['fechaHora'];
            $this->citas->especialidad = $_POST['especialidad'];
            $this->citas->doctorID = $_POST['doctorID'];
            $this->citas->estado = $_POST['estado'];

            if ($this->citas->editar_cita($_POST['citaID'])) {
                header('Location: ./editarCita?success=1');
            } else {
                header('Location: ./editarCita?error=1');
            }
        } else {
            require_once 'views/editarCita.php';
        }
    }

    /**
     * Método para eliminar una cita.
     */
    public function eliminarCita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['citaID'])) {
            if ($this->citas->eliminar_cita($_POST['citaID'])) {
                header('Location: ./consultarCitas?success=1');
            } else {
                header('Location: ./consultarCitas?error=1');
            }
        }
    }
}
?>
