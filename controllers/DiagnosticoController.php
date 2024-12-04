<?php

require_once 'models/Especialidad.php';
require_once 'config/database.php';

class EspecialidadController {

    private $diagnostico;
    private $db; 

    // Constructor que recibe la conexión de la base de datos
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->diagnostico = new Diagnosticos($this->db);
    }
}
