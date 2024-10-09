<?php require 'templates/header.php'; ?>

<!-- Formulario de inicio de sesión -->
<!-- <h2>Iniciar Sesión</h2> -->
 <div class="login-container">
    <div class="login-container__form">
    <h1>Bienvenidos a Clinica 7</h1>
        <form class="form-login" method="POST" action="./login">
            <div class="form-login-field">
                <input type="text" name="username" required placeholder="Usuario">
            </div>
        
            <div class="form-login-field">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
        
        <button type="submit">Ingresar</button>
        </form> 
    </div>
 </div>


<?php require 'templates/footer.php'; ?>
