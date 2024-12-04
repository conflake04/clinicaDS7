<?php

class Diagnosticos {
    private $conn;
    private $table = 'Diagnosticos';

    public $diagnosticoID;
    public $citaID;
    public $descripcion;
    public $tratamiento;
    public $observaciones;

    public function __construct($db) {
        $this->conn = $db;
    }
    

    // Registrar un nuevo diagnóstico
    public function registrarDiagnostico() {
        $query = "INSERT INTO " . $this->table . " (citaID, descripcion, tratamiento, observaciones)
                  VALUES (:citaID, :descripcion, :tratamiento, :observaciones)";
        
        $statement = $this->conn->prepare($query);

        // Limpiar los datos antes de insertarlos
        $this->limpiar();

        // Asignar los valores de los parámetros
        $statement->bindParam(':citaID', $this->citaID);
        $statement->bindParam(':descripcion', $this->descripcion);
        $statement->bindParam(':tratamiento', $this->tratamiento);
        $statement->bindParam(':observaciones', $this->observaciones);

        try {
            // Ejecutar la consulta
            if ($statement->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error al registrar el diagnóstico: " . $e->getMessage();
            return false;
        }
    }

     public function consultarCitasPendientesPorCedula($cedulaPaciente) {
    $query = "SELECT c.citaID, c.cedulaPaciente, c.fechaHora, c.especialidad, d.nombre, d.apellido 
              FROM Citas c
              INNER JOIN doctores d ON c.doctorID = d.id_doctor 
              INNER JOIN usuario u ON c.cedulaPaciente = u.cedula
              WHERE c.cedulaPaciente = :cedulaPaciente AND c.estado = 'pendiente'";

    $statement = $this->conn->prepare($query);

    // Asignar los valores de los parámetros
    $statement->bindParam(':cedulaPaciente', $cedulaPaciente);

    try {
        // Ejecutar la consulta
        $statement->execute();
        
        // Retornar los resultados
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al consultar las citas pendientes: " . $e->getMessage();
        return false;
    }
}



    // Limpiar los datos antes de insertarlos
    private function limpiar() {
        $this->diagnosticoID = htmlspecialchars(strip_tags($this->diagnosticoID));
        $this->citaID = htmlspecialchars(strip_tags($this->citaID));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->tratamiento = htmlspecialchars(strip_tags($this->tratamiento));
        $this->observaciones = htmlspecialchars(strip_tags($this->observaciones));
    }




}

?>