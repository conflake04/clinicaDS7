<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultaRoles.css">
<a class="container-imaA" href="pacienteDashBoard">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>
<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Hogar">
</a>
<span class="txtC"> Citas Pendientes del Paciente: 
    <?php
    
    // Verifica si la cédula está en la sesión
    if (isset($_SESSION['user_id'])) {
        $cedulaPaciente = $_SESSION['user_id'];
        $nombrePaciente = $_SESSION['nombre'];
        echo $nombrePaciente . " ; " . $cedulaPaciente;
    } else {
        echo "No se ha encontrado la cédula en la sesión.";
    }
    ?> 
</span>
<body> 
    <table border="1"> 
        <thead> 
            <tr> 
                <th>ID Cita</th> 
                <th>Especialidad</th>
                <th>Fecha</th> 
                <th>Hora</th> 
                <th>Estado</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php // Para depurar   
            // Asegúrate de que la variable $citas está disponible
            if (!empty($citas)) {
                foreach ($citas as $row) {
                    // Convierte el datetime en objetos separados de fecha y hora
                    $fechaHora = new DateTime($row['fechaHora']);
                    $fecha = $fechaHora->format('Y-m-d'); // Formato: Año-Mes-Día
                    $hora = $fechaHora->format('H:i');   // Formato: Hora:Minuto
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['citaID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['especialidad']) . "</td>";
                    echo "<td>" . htmlspecialchars($fecha) . "</td>";
                    echo "<td>" . htmlspecialchars($hora) . "</td>";
                    echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="5">No hay citas pendientes programadas.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>

<?php require 'templates/footer.php'; ?>