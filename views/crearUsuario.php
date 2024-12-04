<?php require 'templates/header.php'; ?>

<a class="container-imaA" href="GestionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>
<div class=admin-container>
    <h2>Creacion de Usuarios</h2>

    <button class="btnG"><a href="./crearUsuarioAdministrador">Crear Usuario Administrador</a></button>
    <button class="btnG"><a href="./crearUsuarioMedico">Crear Usuario Médico</a></button>
    <button class="btnG"><a href="./crearUsuarioPaciente">Crear Usuario Paciente</a></button>

    <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>

<?php require 'templates/footer.php'; ?>