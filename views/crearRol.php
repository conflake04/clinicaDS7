<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearRol.css">

<form method="POST" action="./registrarRol">
    <div class="form-group">
        <label for="nombre_rol">Nombre del Rol:</label>
        <input type="text" id="nombre_rol" name="nombre_rol">
    </div>
    
    <div class="form-group">
        <label for="descripcion_rol">Descripción del Rol:</label>
        <textarea id="descripcion_rol" name="descripcion_rol"></textarea>
    </div>
    
    <div class="form-group">
        <button type="submit">Registrar Nuevo Rol</button>
    </div>
</form>


<?php require 'templates/footer.php'; ?>