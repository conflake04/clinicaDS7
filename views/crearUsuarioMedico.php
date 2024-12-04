<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/agregarMedico.css">

<!-- Título en la parte superior -->
<div class="titulo-principal">
    <span class="txtG">Crear Usuario: Médico</span>
</div>

<a class="container-imaA" href="GestionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atrás">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Hogar">
</a>

<div class="container">


    <form id="form-registro" class="crearMedico" action="./crearUsuarioMedico" method="POST">

        <div class="form-group">
            <label for="cedula">Cedula:</label>
            <input type="text" id="cedula" name="cedula" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required maxlength="20">
        </div>

        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required maxlength="20">
        </div>

        <div class="form-group">
            <label for="nombre">Contraseña:</label>
            <input type="password" id="password" name="password" required maxlength="255">
        </div>

        <div class="form-group">
            <label for="apellido">Correo Electronico:</label>
            <input type="email" id="email" name="email" required maxlength="50">
        </div>


        <div class="form-group">
            <label for="telefono">Telefono:</label>
            <input type="text" id="telefono" name="telefono" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required maxlength="255">
        </div>

        <div class="form-group">
        <label for="idRol">Rol:</label>
        <select id="idRol" name="idRol" required>
        <?php
        include '../config/database.php';
        include '../models/Rol.php';

        $database = new Database();
        $db = $database->getConnection();

        $rol = new Rol($db);

        // Consulta solo el rol de "Administrador"
        $stmt = $rol->consultar_roles_todos();

        if ($stmt->rowCount() > 0) {
            $adminFound = false; // Bandera para verificar si se encontró "Administrador"

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idRol = $row['idRol'];
                $name_rol = $row['name_rol'];

                if (strtolower($name_rol) === 'médico') { // Verifica si es "Administrador"
                    $adminFound = true;
                    echo "<option value='{$idRol}' selected>{$name_rol}</option>";
                }
            }

            // Si no se encuentra "Administrador", muestra un mensaje
            if (!$adminFound) {
                echo "<option value='' disabled>No hay roles de administrador disponibles</option>";
            }
        } else {
            echo "<option value='' disabled>No hay roles disponibles</option>";
        }
        ?>
        </select>
        </div>


        <div class="form-group">
            <label for="numero_licencia">Número de Licencia:</label>
            <input type="text" id="numero_licencia" name="numero_licencia" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="anio_esperiencia">Años de Experiencia:</label>
            <input type="number" id="anio_esperiencia" name="anio_esperiencia" required>
        </div>

        <div class="form-group">
            <label for="turno">Turno:</label>
            <input type="text" id="turno" name="turno" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="id_especialidad">Especialidad:</label>
            <select id="id_especialidad" name="id_especialidad" required>
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


        <button type="submit">Registrar</button>
    </form>
    <div id="mensajeExito" class="mensaje-exito"></div>

    <?php 
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']);
        }
    ?>
</div>

<?php require 'templates/footer.php'; ?>
