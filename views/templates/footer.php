</div> <!-- Fin del container -->
<footer>
    <span>&copy; 2024 Sistema de Usuarios</span>
</footer>
<script>
    // JavaScript para mostrar el mensaje de éxito si "success=1" está en la URL
    window.addEventListener('load', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === '1') {
            const mensajeExito = document.getElementById("mensajeExito");
            mensajeExito.textContent = "¡¡Se ha creado el registro exitosamente!!.";
            mensajeExito.style.display = "block"; // Mostrar el mensaje

            // Opcional: Ocultar el mensaje después de unos segundos
            setTimeout(function() {
                document.getElementById("mensajeExito").style.display = "none";
            }, 6000);
        }
        else if(urlParams.get('error') === '1'){
            alert("¡Ocurrió un error inesperado!! Intentelo mas tarde");

            const currentPage = window.location.pathname;

            // Redirigir después de que el usuario cierre el alert
            setTimeout(function() {
                if (currentPage.includes('GestionUsuario')) {
                    window.location.href = './GestionUsuario';
                } else if (currentPage.includes('GestionEspecialidad')) {
                    window.location.href = './GestionEspecialidad';
                } else {
                    // Redirigir a una página por defecto si no se detecta ninguna específica
                    window.location.href = './admin';
                }
            }, 100); // Un retraso mínimo para que el alert se cierre
        }
        else{
            const mensajeExito = document.getElementById("mensajeExito");
            mensajeExito.style.display = "none";
        }
    });
</script>
</body>
</html>
