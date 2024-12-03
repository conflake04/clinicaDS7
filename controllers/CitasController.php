<?php

class CitasController {
    private $citas;

    public function __construct($db) {
        $this->citas = new Citas($db);
    }

    public function registrarCita($datos) {
        $this->citas->cedulaPaciente = $datos['cedulaPaciente'];
        $this->citas->fechaHora = $datos['fechaHora'];
        $this->citas->especialidad = $datos['especialidad'];
        $this->citas->doctorID = $datos['doctorID'];
        $this->citas->estado = $datos['estado'];

        return $this->citas->registrar_cita();
    }

    public function consultarCitas() {
        return $this->citas->consultar_citas();
    }

    public function consultarCitaPorId($citaID) {
        return $this->citas->consultar_cita_por_id($citaID);
    }

    public function editarCita($citaID, $datos) {
        $this->citas->fechaHora = $datos['fechaHora'];
        $this->citas->especialidad = $datos['especialidad'];
        $this->citas->doctorID = $datos['doctorID'];
        $this->citas->estado = $datos['estado'];

        return $this->citas->editar_cita($citaID);
    }

    public function eliminarCita($citaID) {
        return $this->citas->eliminar_cita($citaID);
    }
}
?>
