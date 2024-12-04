<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">

<a class="container-imaA" href="./medico">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<!-- CAMBIAR LA TABLA, LA QUE ESTA PUESTA SOLO ERA PARA REFERENCIA -->

<div class="table-container">
    <span class="txtC"> Citas</span>
    <table>
        <thead>
            <tr>
                <th>Id Cita</th>
                <th>Fecha de Cita</th>
                <th>Cedula del paciente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($citas as $row) { // Iterar sobre el arreglo $citas
                echo "<tr>";
                echo "<td>{$row['citaID']}</td>";
                echo "<td>{$row['fechaHora']}</td>";
                echo "<td>{$row['cedula']}</td>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['apellido']}</td>";
                echo "<td>{$row['fechaNacimiento']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'templates/footer.php'; ?>