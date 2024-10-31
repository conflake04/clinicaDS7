<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">

<a class="container-imaA" href="./GestionMedicos">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="./admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="table-container">
    <span class="txtC"> Consultar Doctor</span>
    <table border="1">
        <thead>
            <tr>
                <th>ID Médico</th>
                <th>Numero de Licencia</th>
                <th>Año de Experiencia</th>
                <th>Turno</th>
                <th>ID Especialidad</th>
                <th>ID Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $doctores;
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>{$row['id_doctor']}</td>";
                    echo "<td>{$row['numero_licencia']}</td>";
                    echo "<td>{$row['año_esperiencia']}</td>";
                    echo "<td>{$row['turno']}</td>";
                    echo "<td>{$row['id_especialidad']}</td>";
                    echo "<td>{$row['id_usu']}</td>";
                    echo "</tr>";
                }
            } else {
                echo '<td colspan="6">No hay roles registrados.</td>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'templates/footer.php'; ?>