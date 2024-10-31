<?php

class Doctor {

    private $conn;
    private $table = 'doctores';

    public $numero_licencia;
    public $ano_experiencia;
    public $turno;
    public $id_especialidad;
    public $id_usu;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar doctor
    public function registrar_doctor() {
        try {
            $query = "INSERT INTO " . $this->table . " (numero_licencia, año_esperiencia, turno, id_especialidad, id_usu) 
                      VALUES (:numero_licencia, :ano_experiencia, :turno, :id_especialidad, :id_usu)";
            $statement = $this->conn->prepare($query);
    
            $statement->bindParam(':numero_licencia', $this->numero_licencia);
            $statement->bindParam(':ano_experiencia', $this->ano_experiencia);
            $statement->bindParam(':turno', $this->turno);
            $statement->bindParam(':id_especialidad', $this->id_especialidad);
            $statement->bindParam(':id_usu', $this->id_usu);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al registrar doctor: " . $e->getMessage();
            return false;
        }
    }

    // Consultar doctor por ID
    public function consultar_doctor() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $statement = $this->conn->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar doctor: " . $e->getMessage();
            return false;
        }
    }

    public function consultarDatos() {
        try {
            // Seleccionar solo las columnas necesarias
            $query = "SELECT id_doctor, año_esperiencia, turno FROM " . $this->table; 
            $statement = $this->conn->prepare($query);
            $statement->execute();
    
            // Retornar todos los resultados como un arreglo asociativo
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar doctor: " . $e->getMessage();
            return false; // En caso de error, retornar false
        }
    }
    

    // Editar doctor
    public function editar_doctor($id_doctor) {
        try {
            $query = "UPDATE " . $this->table . " SET año_esperiencia = :ano_experiencia, turno = :turno  WHERE id_doctor = :id_doctor";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':ano_experiencia', $this->ano_experiencia);
            $statement->bindParam(':turno', $this->turno);
            $statement->bindParam(':id_doctor', $id_doctor);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al editar doctor: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar doctor
    public function eliminar_doctor($id_doctor) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id_doctor = :id_doctor";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':id_doctor', $id_doctor);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar doctor: " . $e->getMessage();
            return false;
        }
    }
}

?>
