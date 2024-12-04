<?php require 'templates/header.php'; ?>

    <link rel="stylesheet" href="./css/consultarUsuario.css">

    <a class="container-imaA" href="./GestionUsuario">
        <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
    </a>

    <a class="container-imaH" href="./admin">
        <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
    </a>

    <div class="table-container">
        <span class="txtC">Consultar Usuario: Doctor</span>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Médico</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>Numero de Licencia</th>
                    <th>Año de Experiencia</th>
                    <th>Turno</th>
                    <th>ID Especialidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = $doctores;
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<td>{$row['id_doctor']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td>{$row['apellido']}</td>";
                        echo "<td>{$row['cedula']}</td>";
                        echo "<td>{$row['numero_licencia']}</td>";
                        echo "<td>{$row['anio_esperiencia']}</td>";
                        echo "<td>{$row['turno']}</td>";
                        echo "<td>{$row['id_especialidad']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="8">No hay doctores registrados.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php require 'templates/footer.php'; ?>