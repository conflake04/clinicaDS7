<?php require 'templates/header.php'; ?>
<link rel="stylesheet" href="../css/Admin.css" />
<!-- Página del panel de administración -->
<div class="admin-container">
  <h1>Bienvenido Dr. <?php echo $_SESSION['nombre']; ?></h1>
  <button class="btnG"><a href="./verCitasDoctorPendientes">Ver Citas Pendientes</a></button>
  <button class="btnG"><a href="./verCitasDoctorCompletadas">Ver Citas Completadas</a></button>
  <button class="btnG"><a href="">Cancelar Una Cita</a></button>
  <button class="btnG"><a href="">Enviar Correo al Paciente</a></button>
  <button class="btnC"><a href="./logout">Cerrar Sesión</a></button>
</div>
<?php require 'templates/footer.php'; ?>