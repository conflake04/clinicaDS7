<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearUsuario.css">

<a class="container-imaA" href="pacienteDashBoard">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<!-- ESTE ES EL FORMATO DEL FORMULARIO, OBVIO TIENEN QUE CAMBIAR COSAS DE LA BASE DE DATOS -->
<!-- LA PARTE DE ESCOGER LA ESPECIALIDAD Y EL DOCTOR SON LISTAS ENLASADAS OSEA QUE DEPENDIENDO DE LA ESPECIALIDAD ELEGIDA DEBEN DE SALIR LOS DOCTORES DE ESA ESPECIALIDAD -->

<div class="container">
    <span class="txtG">Solicitud de cita</span>
    <form id="form-registro" class="crearUsu" action="./solicitarCitaP" method="POST">

        <div class="form-group">
            <label for="cedulaPaciente">Cédula:</label>
            <input type="text" id="cedulaPaciente" name="cedulaPaciente" required maxlength="20">
        </div>

        <div class="form-group">
            <label for="especialidad">Servicio:</label>
            <select id="especialidad" name="especialidad" required>
                <option class="txtP" value="">Seleccione una especialidad</option>
                <?php
                include '../config/database.php';
                include '../models/Especialidad.php';

                $database = new Database();
                $db = $database->getConnection();

                $especialidad = new Especialidad($db);
                $stmtEspecialidad = $especialidad->consultarTodos();

                if ($stmtEspecialidad->rowCount() > 0) {
                    while ($row = $stmtEspecialidad->fetch(PDO::FETCH_ASSOC)) {
                        $idEspecialidad = $row['id_especialidad'];
                        $nombreEspecialidad = $row['nombre_especialidad'];
                        echo "<option value='{$idEspecialidad}'>{$nombreEspecialidad}</option>";
                    }
                } else {
                    echo "<option value=''>No hay especialidades disponibles</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="doctorID">Medico:</label>
            <select id="doctorID" name="doctorID" required>
                <?php
                include '../config/database.php';
                include '../models/Medicos.php';

                $database = new Database();
                $db = $database->getConnection();

                $doctores = new Doctor($db);
                $stmtdoctores = $doctores->consultarTodosDatos();

                if ($stmtdoctores->rowCount() > 0) {
                    while ($row = $stmtdoctores->fetch(PDO::FETCH_ASSOC)) {
                        $idDoctor = $row['id_doctor'];
                        $nombreDoctor = $row['nombre'];
                        $apellidoDoctor = $row['apellido'];
                        echo "<option value='{$idDoctor}'>{$nombreDoctor} {$apellidoDoctor}</option>";
                    }
                } else {
                    echo "<option value=''>No hay doctores disponibles</option>";
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="fechaCita">Fecha de la cita:</label>
            <input type="date" id="fechaCita" name="fechaCita" required>
        </div>

        <button type="submit">Solicitar cita</button>
    </form>
</div>
<?php require 'templates/footer.php'; ?>