<?php require 'templates/header.php'; ?>

<form method="POST" action="./registrarRol">
    <label for="nombre_rol">Nombre del Rol:</label>
    <input type="text" id="nombre_rol" name="nombre_rol">
    <label for="descripcion_rol">Descripcion del Rol:</label>
    <textarea id="descripcion_rol" name="descripcion_rol"></textarea>
    <button type="submit">Registrar Nuevo Rol</button>
</form>

<?php require 'templates/footer.php'; ?>