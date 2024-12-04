<?php require 'templates/header.php'; ?>

<a class="container-imaA" href="GestionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>
<div class=admin-container>
    <h2>Consulta de Usuarios</h2>

    <button class="btnG"><a href="./consultarUsuarioAdministrador">Consultar Usuario Administrador</a></button>
    <button class="btnG"><a href="./consultarDoctor">Consultar Usuario Médico</a></button>
    <button class="btnG"><a href="./verPacientes">Consultar Usuario Paciente</a></button>

    <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>

<?php require 'templates/footer.php'; ?>
