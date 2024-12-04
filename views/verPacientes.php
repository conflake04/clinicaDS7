<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">

<a class="container-imaA" href="./GestionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="./admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="table-container">
    <span class="txtC">Consultar Pacientes</span>
    <table border="1">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Telefono</th>
                <th>Correo Electrónico</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si hay pacientes
            if (!empty($pacientes)) {
                foreach ($pacientes as $paciente) {
                    echo "<tr>";
                    echo "<td>{$paciente['cedula']}</td>";
                    echo "<td>{$paciente['nombre']}</td>";
                    echo "<td>{$paciente['apellido']}</td>";
                    echo "<td>{$paciente['fechaNacimiento']}</td>";
                    echo "<td>{$paciente['telefono']}</td>";
                    echo "<td>{$paciente['correo']}</td>";
                    echo "<td>{$paciente['direccion']}</td>";
                    echo "</tr>";
                }
            } else {
                // Mensaje si no hay pacientes
                echo '<tr><td colspan="7">No hay pacientes registrados.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'templates/footer.php'; ?>
