<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/agregarMedico.css">

<!-- Título en la parte superior -->
<div class="titulo-principal">
    <span class="txtG">Registrar Doctor</span>
</div>

<a class="container-imaA" href="GestionMedicos">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atrás">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Hogar">
</a>

<div class="container">
    <form id="form-registro" class="crearMedico" action="./agregarMedico" method="POST">
        <div class="form-group">
            <label for="numero_licencia">Número de Licencia:</label>
            <input type="text" id="numero_licencia" name="numero_licencia" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="ano_experiencia">Años de Experiencia:</label>
            <input type="number" id="ano_experiencia" name="ano_experiencia" required>
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

        <div class="form-group">
            <label for="id_usu">Usuario:</label>
            <select id="id_usu" name="id_usu" required>
                <option class="txtP" value="">Seleccione un usuario</option>
                <?php
                include '../models/User.php';

                $usuario = new User($db);
                $stmtUsuario = $usuario->consultarUsuarios();

                if ($stmtUsuario->rowCount() > 0) {
                    while ($row = $stmtUsuario->fetch(PDO::FETCH_ASSOC)) {
                        $idUsuario = $row['idUsuario'];
                        $nombreUsuario = $row['username'];
                        echo "<option value='{$idUsuario}'>{$nombreUsuario}</option>";
                    }
                } else {
                    echo "<option value=''>No hay usuarios disponibles</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit">Registrar</button>
    </form>
    <div id="mensajeExito" class="mensaje-exito">
    </div>
</div>

<?php require 'templates/footer.php'; ?>
