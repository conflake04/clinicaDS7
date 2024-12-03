<?php require 'templates/header.php'; ?>

<!-- Formulario de inicio de sesión -->
<!-- <h2>Iniciar Sesión</h2> -->
<div class="login-container">
    <div class="login-container__form">
        <h1 class="txtB">Bienvenido</h1>
        <form class="form-login" method="POST" action="./login">

            <div class="form-login-field">
                <span class="txtU">Usuario</span>
                <input type="text" name="email" required>
            </div>

            <div class="form-login-field">
                <span class="txtU">Contraseña</span>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Ingresar</button>
        </form>
    </div>

</div>
<?php require 'templates/footer.php'; ?>