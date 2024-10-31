<?php require 'templates/header.php'; ?>

    
<a class="container-imaA" href="admin">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>
<div class=admin-container>
    <h2>Gestion de usuarios</h2>

    <button class="btnG"><a href="./crearUsuario">Crear Usuario</a></button>
    <button class="btnG"><a href="./consultarUsuario">Consultar Usuarios</a></button>
    <button class="btnG"><a href="">Borrar Usuario</a></button>

    <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>

<?php require 'templates/footer.php'; ?>