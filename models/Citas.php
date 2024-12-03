<?php

class Citas {
    private $conn;
    private $table = 'Citas';

    public $citaID;
    public $cedulaPaciente;
    public $fechaHora;
    public $especialidad;
    public $doctorID;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar una nueva cita
    public function registrar_cita() {
        try {
            $query = "INSERT INTO " . $this->table . " (cedulaPaciente, fechaHora, especialidad, doctorID, estado) 
                      VALUES (:cedulaPaciente, :fechaHora, :especialidad, :doctorID, :estado)";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':cedulaPaciente', $this->cedulaPaciente);
            $statement->bindParam(':fechaHora', $this->fechaHora);
            $statement->bindParam(':especialidad', $this->especialidad);
            $statement->bindParam(':doctorID', $this->doctorID);
            $statement->bindParam(':estado', $this->estado);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al registrar la cita: " . $e->getMessage();
            return false;
        }
    }

    // Consultar todas las citas
    public function consultar_citas() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $statement = $this->conn->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar citas: " . $e->getMessage();
            return false;
        }
    }

    // Consultar una cita por ID
    public function consultar_cita_por_id($citaID) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE citaID = :citaID";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':citaID', $citaID);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar la cita: " . $e->getMessage();
            return false;
        }
    }

    // Editar una cita existente
    public function editar_cita($citaID) {
        try {
            $query = "UPDATE " . $this->table . " SET fechaHora = :fechaHora, especialidad = :especialidad, 
                      doctorID = :doctorID, estado = :estado WHERE citaID = :citaID";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':fechaHora', $this->fechaHora);
            $statement->bindParam(':especialidad', $this->especialidad);
            $statement->bindParam(':doctorID', $this->doctorID);
            $statement->bindParam(':estado', $this->estado);
            $statement->bindParam(':citaID', $citaID);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al editar la cita: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar una cita
    public function eliminar_cita($citaID) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE citaID = :citaID";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':citaID', $citaID);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar la cita: " . $e->getMessage();
            return false;
        }
    }
}
?>
