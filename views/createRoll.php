<?php require 'templates/header.php'; ?>
<link    href="../css/createRoll.css" />

<a class="container-imaA" href="admin">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="admin-container">

    <h2>Gestion de Roles</h2>
    <button class="btnG"><a href="./crearRol">Crear Nuevo Rol</a></button>
    <button class="btnG"><a href="./consultarRoles">Consulta de Roles</a></button>
    <button class="btnG"><a href="./eliminarRol">Eliminar Rol</a></button>
    <button class="btnC"><a href="./logout">Cerrar Sesion</a></button>

</div>
<?php require 'templates/footer.php'; ?>