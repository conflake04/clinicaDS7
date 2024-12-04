<?php

class Paciente {
    private $conn;
    private $table = 'paciente';

    // Propiedades del Paciente
    public $cedula;
    public $nombre;
    public $apellido;
    public $fechaNacimiento;
    public $telefono;
    public $correo;
    public $direccion;

    // Constructor para la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un paciente
    public function registrarPaciente() {
        try {
            $query = "INSERT INTO " . $this->table . " (cedula, nombre, apellido, fechaNacimiento, telefono, correo, direccion) 
                      VALUES (:cedula, :nombre, :apellido, :fechaNacimiento, :telefono, :correo, :direccion)";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':cedula', $this->cedula);
            $statement->bindParam(':nombre', $this->nombre);
            $statement->bindParam(':apellido', $this->apellido);
            $statement->bindParam(':fechaNacimiento', $this->fechaNacimiento);
            $statement->bindParam(':telefono', $this->telefono);
            $statement->bindParam(':correo', $this->correo);
            $statement->bindParam(':direccion', $this->direccion);

            return $statement->execute();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error al registrar doctor: " . $e->getMessage();
            return false;
        }
    }

    // Método para consultar todos los pacientes
    public function consultarPacientes() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $statement = $this->conn->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar pacientes: " . $e->getMessage();
            return false;
        }
    }

    // Método para consultar un paciente por cédula
    public function consultarPacientePorCedula() {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE cedula = :cedula";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':cedula', $this->cedula);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar paciente: " . $e->getMessage();
            return false;
        }
    }

    // Método para actualizar un paciente
    public function actualizarPaciente() {
        try {
            $query = "UPDATE " . $this->table . " 
                      SET nombre = :nombre, apellido = :apellido, fechaNacimiento = :fechaNacimiento, 
                          telefono = :telefono, correo = :correo, direccion = :direccion 
                      WHERE cedula = :cedula";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':cedula', $this->cedula);
            $statement->bindParam(':nombre', $this->nombre);
            $statement->bindParam(':apellido', $this->apellido);
            $statement->bindParam(':fechaNacimiento', $this->fechaNacimiento);
            $statement->bindParam(':telefono', $this->telefono);
            $statement->bindParam(':correo', $this->correo);
            $statement->bindParam(':direccion', $this->direccion);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar paciente: " . $e->getMessage();
            return false;
        }
    }

    // Método para eliminar un paciente
    public function eliminarPaciente() {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE cedula = :cedula";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':cedula', $this->cedula);

            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar paciente: " . $e->getMessage();
            return false;
        }
    }
}

?>
