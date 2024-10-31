<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/crearEspecialidad.css">

<a class="container-imaA" href="./GestionEspecialidad">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="./admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Hogar">
</a>


<form method="POST" action="./crearEspecialidad">

    <spam class="txtG">Crear Especialidad</spam>
    <div class="form-group">
        <label for="nombre_especialidad">Nombre de la Especialidad:</label>
        <input type="text" id="nombre_especialidad" name="nombre_especialidad">
    </div>
    
    <div id="mensajeExito" class="mensaje-exito">

    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
    </div>

    <div class="form-group">
        <button type="submit">Crear</button>
    </div>

</form>


<?php require 'templates/footer.php'; ?>