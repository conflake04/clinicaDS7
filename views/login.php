<?php require 'templates/header.php'; ?>

<!-- Formulario de inicio de sesión -->
<h2>Iniciar Sesión</h2>
<form method="POST" action="./login">
    <label for="username">Usuario:</label>
    <input type="text" name="username" required>
    
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    
    <button type="submit">Ingresar</button>
</form>

<?php require 'templates/footer.php'; ?>
