<?php require 'templates/header.php'; ?>
<link rel="stylesheet" href="../css/createRoll.css" />
<a class="container-imaA" href="admin">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>
<div class=admin-container>
    <h2>Gestion de Medicos</h2>

    <button class="btnG"><a href="./editarDoctor">Editar Datos del Médico</a></button>
    <button class="btnG"><a href="./eliminarDoctor">Borrar Médico</a></button>

    <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>
</div>
<?php require 'templates/footer.php'; ?>