<?php require 'templates/header.php'; ?>

<h2>Crear Usuario</h2>

<form class="crearUsu" action="./crearUsuario" method="POST">
    <label for="name">Nombre Completo:</label>
    <input type="text" id="name" name="name" required maxlength="50"><br><br>

    <label for="username">Nombre de Usuario:</label>
    <input type="text" id="username" name="username" required maxlength="20"><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required maxlength="255"><br><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required maxlength="50"><br><br>

    <label for="numberPhone">Número de Teléfono:</label>
    <input type="text" id="numberPhone" name="numberPhone" required maxlength="15"><br><br>

    <label for="direction">Dirección:</label>
    <input type="text" id="direction" name="direction" required maxlength="60"><br><br>

    <label for="idRol">Rol:</label>
    <select id="idRol" name="idRol" required>
        <option value="">Seleccione un rol</option>
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

    <button type="submit">Crear</button>

    
</form>

<p><a href="./logout">Cerrar Sesión</a></p>

<?php require 'templates/footer.php'; ?>