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
        $this->citas->especialidad = $_POST['especialidad'];
        $this->citas->doctorID = $_POST['doctorID'];
        $this->citas->fechaHora = $_POST['fechaCita'];

        // Registrar la cita y redirigir según el resultado
        if ($this->citas->registrar_cita()) {
            header('Location: ./solicitarCitaP?success=1');
            exit();
        } else {
            echo "Error al registrar la cita";
            exit();
        }
    } else {
        // Cargar la vista del formulario de registro de citas si la solicitud no es POST
        require_once 'views/solicitarCitaP.php';
    }
}


    public function citasPendientes() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
           if (isset($_SESSION['user_id'])) {
                $cedulaPaciente = $_SESSION['user_id'];

            // Consulta las citas filtradas
            $citas = $this->citas->consultarCitasPaciente($cedulaPaciente);

            // Depuración opcional

            // Carga la vista con las citas
            require_once 'views/verCitasP.php';
        } else {
            echo "No se ha encontrado la cédula en la sesión.";
        }
    } else {
        require_once 'views/pacienteDashBoard.php';
    }
    }

    public function citasPendientesDoctor($estado)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_SESSION['user_id'])) {
                $cedulaDoctor = $_SESSION['user_id'];

                // Consulta las citas filtradas
                $citas = $this->citas->consultarCitasDoctor($cedulaDoctor, $estado);

                require_once 'views/citasPendientesMedico.php';
            } else {
                echo "No se ha encontrado la cédula en la sesión.";
            }
        } else {
            require_once 'views/citasPendientesMedicos.php';
        }
    }

}
?>
