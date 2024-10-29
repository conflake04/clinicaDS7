<?php require 'templates/header.php'; ?>
<link rel="stylesheet" href="../css/Admin.css" />
<!-- Página del panel de administración -->
<div class="admin-container">
  <h1>Bienvenido al Panel de Administración</h1>
  <button class="btnG"><a href="./GestionUsuario">Gestion de Usuarios</a></button>
  <button class="btnG"><a href="./createRoll">Gestion de Roles</a></button>
  <button class="btnG"><a href="./GestionEspecialidad">Gestion de Especialidades</a></button>
  <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>
<?php require 'templates/footer.php'; ?>
    