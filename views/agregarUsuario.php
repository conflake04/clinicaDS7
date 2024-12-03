<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearUsuario.css">

<a class="container-imaA" href="admin">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="container">
    <spam class="txtG">Agregar paciente</spam>
    <form id="form-registro" class="crearUsu" action="./crearUsuario" method="POST">

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
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>

        <div class="form-group">
            <label for="telefono">Telefono:</label>
            <input type="text" id="telefono" name="telefono" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required maxlength="50">
        </div>


        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required maxlength="255">
        </div>



        <button type="submit">Crear</button>

    </form>
    <div id="mensajeExito" class="mensaje-exito">

    </div>

</div>

<?php require 'templates/footer.php'; ?>