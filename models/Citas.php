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
    // Obtener el nombre de la especialidad usando el ID
    $query = "SELECT nombre_especialidad FROM especialidad WHERE id_especialidad = :especialidad";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':especialidad', $this->especialidad);
    $stmt->execute();

    // Verificar si se encontró el nombre de la especialidad
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nombreEspecialidad = $row['nombre_especialidad'];  // Guardar el nombre de la especialidad
    } else {
        echo "Especialidad no encontrada.";
        return false;
    }

    // Ahora que tenemos el nombre de la especialidad, realizamos la inserción
    $query = "INSERT INTO " . $this->table . " (cedulaPaciente, especialidad, doctorID, fechaHora, estado) 
              VALUES (:cedulaPaciente, :especialidad, :doctorID, :fechaHora, :estado)";
    
    $statement = $this->conn->prepare($query);

    // Limpiar los datos antes de insertarlos
    $this->limpiar();

    // Asignar los valores de los parámetros, usando el nombre de la especialidad
    $statement->bindParam(':cedulaPaciente', $this->cedulaPaciente);
    $statement->bindParam(':especialidad', $nombreEspecialidad);  // Aquí usamos el nombre
    $statement->bindParam(':doctorID', $this->doctorID);
    $statement->bindParam(':fechaHora', $this->fechaHora);
    $statement->bindParam(':estado', $this->estado);


    try {
        // Ejecutar la consulta
        if ($statement->execute()) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        // Si hay un error, lo mostramos
        echo "Error al registrar la cita: " . $e->getMessage();
        return false;
    }
}




   public function consultarCitasPaciente($cedulaPaciente) {
    try {  // Verifica si se ejecuta
        // Preparar la consulta SQL
        $query = "SELECT citaID, especialidad, fechaHora, estado 
                  FROM Citas 
                  WHERE cedulaPaciente = :cedulaPaciente AND estado = 'programada'";

        // Preparar la declaración
        $statement = $this->conn->prepare($query);

        // Vincular el parámetro de la cédula
        $statement->bindParam(':cedulaPaciente', $cedulaPaciente, PDO::PARAM_STR);

        // Ejecutar la consulta
        $executeResult = $statement->execute();

        // Verificar si la ejecución de la consulta fue exitosa
        if (!$executeResult) {
            throw new Exception("Error al ejecutar la consulta SQL.");
        }

        // Obtener todos los resultados
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Depuración: Verificar el resultado
        // Aquí es donde verás el resultado en la consola o página web

        // Retornar los resultados
        return $result;

    } catch (PDOException $e) {
        // Manejo de errores si la consulta falla
        echo "Error al consultar las citas: " . $e->getMessage();
        return [];
    } catch (Exception $e) {
        // Manejo de otros errores
        echo "Error: " . $e->getMessage();
        return [];
    }
}


    public function consultarCitasDoctor($cedulaDoctor, $estado)
    {
        try {
            $queryiddoctor = "SELECT d.id_doctor 
                  FROM doctores d INNER JOIN usuario u ON d.cedula = u.cedula
                  WHERE u.cedula = :cedulaDoctor";

            $statementid = $this->conn->prepare($queryiddoctor);
            $statementid->bindParam(':cedulaDoctor', $cedulaDoctor, PDO::PARAM_STR);
            $statementid->execute();
            $idDoctor = $statementid->fetch(PDO::FETCH_ASSOC)['id_doctor'];

            $query = "SELECT c.citaID, c.fechaHora, p.cedula, p.nombre, p.apellido, p.fechaNacimiento 
                  FROM citas c INNER JOIN paciente p ON c.cedulaPaciente = p.cedula
                  WHERE doctorID = :idDoctor AND estado = :estado";

            // Preparar la declaración
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':idDoctor', $idDoctor, PDO::PARAM_STR);
            $statement->bindParam(':estado', $estado, PDO::PARAM_STR);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores si la consulta falla
            echo "Error al consultar las citas: " . $e->getMessage();
            return [];
        } catch (Exception $e) {
            // Manejo de otros errores
            echo "Error: " . $e->getMessage();
            return [];
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

    public function obtenerCitasPorEstadoYPaciente($cedulaPaciente, $estado) {
    $query = "SELECT citaID, especialidad, fechaHora, estado 
              FROM citas 
              WHERE cedulaPaciente = :cedulaPaciente AND estado = :estado";

    $statement = $this->conn->prepare($query);
    $statement->bindParam(':cedulaPaciente', $cedulaPaciente, PDO::PARAM_STR);
    $statement->bindParam(':estado', $estado, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}



    private function limpiar() {
        // Sanitizar atributos
        $this->citaID = htmlspecialchars(strip_tags($this->citaID));
        $this->cedulaPaciente = htmlspecialchars(strip_tags($this->cedulaPaciente));
        $this->fechaHora = htmlspecialchars(strip_tags($this->fechaHora));
        $this->especialidad = htmlspecialchars(strip_tags($this->especialidad)); 
        $this->doctorID = htmlspecialchars(strip_tags($this->doctorID));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
    }


}
?>
