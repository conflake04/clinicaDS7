<?php

class Rol {

    private $conn;
    private $table = 'rol';

    public $nombre_rol;
    public $descripcion_rol;

    public function __construct($db) {
        $this->conn=$db;
    }

    public function registrar_rol() {
        try {
            $query = "INSERT INTO " . $this->table . " (name_rol, description) VALUES (:nombre_rol, :descripcion_rol)";
            $statement = $this->conn->prepare($query);
    
            $statement->bindParam(':nombre_rol', $this->nombre_rol);
            $statement->bindParam(':descripcion_rol', $this->descripcion_rol);
    
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
    

    public function consultar_roles() {
        try {
            // Consulta que excluye el rol de 'admin'
            $query = "SELECT name_rol, description FROM " . $this->table;
            $statement = $this->conn->prepare($query);
            $statement->execute();
    
            // Retorna todos los resultados en un arreglo asociativo
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar los roles: " . $e->getMessage();
            return [];
        }
    }

    public function consultar_roles_todos() {
        try {
            // Consulta que excluye el rol de 'admin'
            $query = "SELECT * FROM " . $this->table;
            $statement = $this->conn->prepare($query);
            $statement->execute();
    
            // Retorna todos los resultados en un arreglo asociativo
            return $statement;
        } catch (PDOException $e) {
            echo "Error al consultar los roles: " . $e->getMessage();
            return [];
        }
    }

    public function eliminar_rol($nombre_rol) {
        try {
            // Verificar que el rol no sea 'admin'
            if ($nombre_rol === 'admin') {
                echo "No se puede eliminar el rol de administrador.";
                return false;
            }
    
            // Preparar la consulta para eliminar el rol
            $query = "DELETE FROM " . $this->table . " WHERE name_rol = :nombre_rol";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':nombre_rol', $nombre_rol);
            
            // Ejecutar la consulta
            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al eliminar el rol: " . $e->getMessage();
            return false;
        }
    }

    
}

?>