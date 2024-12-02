<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearUsuario.css">

<a class="container-imaA" href="vistaPaciente">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<!-- ESTE ES EL FORMATO DEL FORMULARIO, OBVIO TIENEN QUE CAMBIAR COSAS DE LA BASE DE DATOS -->
<!-- LA PARTE DE ESCOGER LA ESPECIALIDAD Y EL DOCTOR SON LISTAS ENLASADAS OSEA QUE DEPENDIENDO DE LA ESPECIALIDAD ELEGIDA DEBEN DE SALIR LOS DOCTORES DE ESA ESPECIALIDAD -->

<div class="container">
    <spam class="txtG">Solicitud de cita</spam>
    <form id="form-registro" class="crearUsu" action="./crearUsuario" method="POST">
        <div class="form-group">
            <label for="username">Nombre del Paciente:</label>
            <input type="text" id="username" name="username" required maxlength="20">
        </div>

        <div class="form-group">
            <label for="password">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required maxlength="20"  pattern="^[0-9\-]+$" title="Solo se permiten números y guiones.">
        </div>

        <div class="form-group">
            <label for="password">Número de celular:</label>
            <input type="text" id="cedula" name="cedula" required maxlength="20">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="idRol">Especialidad:</label>
            <select id="idRol" name="idRol" required>
                <option class="txtP" value="">Seleccione una especialidad</option>
                <?php
                include '../config/database.php';
                include '../models/Rol.php';

                $database = new Database();
                $db = $database->getConnection();

                $rol = new Rol($db);

                $stmt = $rol->consultar_roles_todos();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $idRol = $row['idRol'];
                        $name_rol = $row['name_rol'];

                        echo "<option value='{$idRol}'>{$name_rol}</option>";
                    }
                } else {
                    echo "<option value=''>No hay roles disponibles</option>";
                }
                ?>
            </select>


        </div>
        <div class="form-group">
            <label for="idRol">Medico:</label>
            <select id="idRol" name="idRol" required>
                <option class="txtP" value="">Seleccione un doctor</option>
                <?php
                include '../config/database.php';
                include '../models/Rol.php';

                $database = new Database();
                $db = $database->getConnection();

                $rol = new Rol($db);

                $stmt = $rol->consultar_roles_todos();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $idRol = $row['idRol'];
                        $name_rol = $row['name_rol'];

                        echo "<option value='{$idRol}'>{$name_rol}</option>";
                    }
                } else {
                    echo "<option value=''>No hay roles disponibles</option>";
                }
                ?>
            </select>


        </div>
        <div class="form-group">
            <label for="idRol">preferencia de horario:</label>
            <select id="idRol" name="idRol" required>
                <option class="txtP" value="">Seleccione un horario</option>
                <option value="am">AM</option>
                <option value="pm">PM</option>
            </select>


        </div>
        <button type="submit">Solocitar cita</button>
    </form>



</div>


<?php require 'templates/footer.php'; ?>