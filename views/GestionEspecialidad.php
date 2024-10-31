<?php require 'templates/header.php'; ?>
<link rel="stylesheet" href="../css/" />
<a class="container-imaA" href="./admin"">
    <img class=" imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="./admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Hogar">
</a>
<div class=admin-container>
    <h2>Gestion de Especialidades</h2>

    <button class="btnG"><a href="./crearEspecialidad">Crear Especialidad</a></button>
    <button class="btnG"><a href="./consultarEspecialidad">Consultar Especialidad</a></button>
    <button class="btnG"><a href="">Editar Especialidad</a></button>
    <button class="btnG"><a href="./eliminarEspecialidad">Borrar Especialidad</a></button>

    <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>
</div>
<?php require 'templates/footer.php'; ?>