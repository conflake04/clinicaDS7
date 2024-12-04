<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearUsuario.css">
<link rel="stylesheet" href="../css/createRoll.css" />

<a class="container-imaA" href="creacionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="container">
    <spam class="txtG">Crear Usuario: Administrador</spam>
    <form id="form-registro" class="crearUsu" action="./crearUsuarioAdministrador" method="POST">

        <div class="form-group">
            <label for="cedula">cedula:</label>
            <input type="text" id="cedula" name="cedula" required maxlength="20">
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
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required maxlength="255">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
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

                if (strtolower($name_rol) === 'administrador') { // Verifica si es "Administrador"
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


        <button type="submit">Crear</button>

    </form>
    <div id="mensajeExito" class="mensaje-exito">

    </div>

</div>

<?php require 'templates/footer.php'; ?>