<?php

class Especialidad {

    private $conn;
    private $table = 'especialidad';

    public $id_especialidad;
    public $nombre_especialidad;
    public $descripcion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para agregar una nueva especialidad
    public function agregar() {
        try {
            $query = "INSERT INTO " . $this->table . " (nombre_especialidad, descripcion) VALUES (:nombre_especialidad, :descripcion)";
            $stmt = $this->conn->prepare($query);

            $this->nombre_especialidad = htmlspecialchars(strip_tags($this->nombre_especialidad));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

            $stmt->bindParam(':nombre_especialidad', $this->nombre_especialidad);
            $stmt->bindParam(':descripcion', $this->descripcion);

            if ($stmt->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo "Error al agregar especialidad: " . $e->getMessage();
            return false;
        }
    }

    // Método para eliminar una especialidad por ID
    public function eliminar() {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id_especialidad = :id_especialidad";
            $stmt = $this->conn->prepare($query);

            $this->id_especialidad = htmlspecialchars(strip_tags($this->id_especialidad));
            $stmt->bindParam(':id_especialidad', $this->id_especialidad);

            if ($stmt->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo "Error al eliminar especialidad: " . $e->getMessage();
            return false;
        }
    }

    // Método para consultar todos los registros
    public function consultarTodos() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Error al consultar especialidades: " . $e->getMessage();
            return [];
        }
    }

    // Método para editar una especialidad
    public function editar() {
        try {
            $query = "UPDATE " . $this->table . " SET nombre_especialidad = :nombre_especialidad, descripcion = :descripcion WHERE id_especialidad = :id_especialidad";
            $stmt = $this->conn->prepare($query);

            $this->id_especialidad = htmlspecialchars(strip_tags($this->id_especialidad));
            $this->nombre_especialidad = htmlspecialchars(strip_tags($this->nombre_especialidad));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

            $stmt->bindParam(':id_especialidad', $this->id_especialidad);
            $stmt->bindParam(':nombre_especialidad', $this->nombre_especialidad);
            $stmt->bindParam(':descripcion', $this->descripcion);

            if ($stmt->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo "Error al editar especialidad: " . $e->getMessage();
            return false;
        }
    }
}
