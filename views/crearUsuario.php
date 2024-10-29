<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearUsuario.css">
<spam class="txtG">Crear usuario</spam>

<div id="mensajeExito" class="mensaje-exito">
    
</div>

<div class="container">

    <form id="form-registro" class="crearUsu" action="./crearUsuario" method="POST">
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required maxlength="20">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required maxlength="255">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="idRol">Rol:</label>
            <select id="idRol" name="idRol" required>
            <option class="txtP" value="">Seleccione un rol</option>
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

        <button type="submit">Crear</button>
    </form>

</div>

<?php require 'templates/footer.php'; ?>