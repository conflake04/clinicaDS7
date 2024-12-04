<?php

class Doctor {

    private $conn;
    private $table = 'doctores';

    public $numero_licencia;
    public $anio_esperiencia;
    public $turno;
    public $id_especialidad;
    public $cedula;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar doctor
   public function registrar_doctor() {
        try {
            // Verificar si la cédula existe en la tabla 'usuario'
            $query_check = "SELECT COUNT(*) FROM usuario WHERE cedula = :cedula";
            $statement_check = $this->conn->prepare($query_check);
            $statement_check->bindParam(':cedula', $this->cedula);
            $statement_check->execute();

            // Obtener el resultado
            $exists = $statement_check->fetchColumn();

            if ($exists > 0) {
                // Si la cédula existe, proceder a registrar los datos del doctor
                $query = "INSERT INTO " . $this->table . " (numero_licencia, anio_esperiencia, turno, id_especialidad, cedula) 
                        VALUES (:numero_licencia, :anio_esperiencia, :turno, :id_especialidad, :cedula)";
                $statement = $this->conn->prepare($query);

                $statement->bindParam(':numero_licencia', $this->numero_licencia);
                $statement->bindParam(':anio_esperiencia', $this->anio_esperiencia);
                $statement->bindParam(':turno', $this->turno);
                $statement->bindParam(':id_especialidad', $this->id_especialidad);
                $statement->bindParam(':cedula', $this->cedula);

                return $statement->execute();
            } else {
                // Si la cédula no existe, retornar un mensaje o falso
                $_SESSION['error_message'] = "La cédula no está registrada en el sistema.";
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error al registrar doctor: " . $e->getMessage();
            return false;
        }
    }


    // Consultar doctor por ID
    public function consultar_doctor() {
        try {
            $query = "SELECT d.id_doctor, d.numero_licencia, d.anio_esperiencia, d.turno, d.id_especialidad, d.cedula,u.nombre, u.apellido
                            FROM " . $this->table . " d INNER JOIN usuario u ON d.cedula = u.cedula";
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
            $query = "SELECT id_doctor, anio_esperiencia, turno FROM " . $this->table; 
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
        // Consulta para actualizar los datos del médico
        $query = "UPDATE " . $this->table . " 
                  SET anio_esperiencia = :anio_esperiencia, turno = :turno 
                  WHERE id_doctor = :id_doctor";
        $statement = $this->conn->prepare($query);

        // Vinculamos los parámetros
        $statement->bindParam(':anio_esperiencia', $this->anio_esperiencia);
        $statement->bindParam(':turno', $this->turno);
        $statement->bindParam(':id_doctor', $id_doctor);

        // Ejecutar la actualización
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

    public function consultarTodosDatos() {
        try {
            $query = "SELECT d.id_doctor, u.nombre, u.apellido 
                    FROM " . $this->table . " d 
                    INNER JOIN usuario u ON d.cedula = u.cedula";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error al consultar doctor por especialidad: " . $e->getMessage();
            return false;
        }
    }


    public function consultar_doctor_editar() {
         try {
            $query = "SELECT d.id_doctor, u.nombre,u.apellido, d.anio_esperiencia, d.turno
                            FROM " . $this->table . " d INNER JOIN usuario u ON d.cedula = u.cedula";
            $statement = $this->conn->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar doctor: " . $e->getMessage();
            return false;
        }
    }
}
?>
