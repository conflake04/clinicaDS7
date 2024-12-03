<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/editarMedico.css">
<a class="container-imaA" href="GestionMedicos">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<span class="txtC"> Editar Médico</span>

<body>

    <table border="1">
        <thead>
            <tr>
                <th>ID Médico</th>
                <th>Años Experiencia</th>
                <th>Turno</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $doctores;
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>{$row['id_doctor']}</td>";
                    echo "<td>{$row['anio_esperiencia']}</td>";
                    echo "<td>{$row['turno']}</td>";
                    echo "</tr>";
                }
            } else {
                echo '<td colspan="3">No hay doctores registrados.</td>';
            }
            ?>
        </tbody>
    </table>

    <form method="POST" action="./editarDoctor">
        <label class="txtR" for="id_doctor">Ingrese el id del medico a editar:</label>
        <input class="inputB" type="text" name="id_doctor" id="id_doctor" required>

        <label class="txtR" for="nombre_especialidad">Ingrese los años de experiencia actualizado:</label>
        <input class="inputB" type="text" name="año_experiencia" id="año_experiencia" required>

        <label class="txtR" for="turno">Ingrese el nuevo turno del médico:</label>
        <input class="inputB" type="text" name="turno" id="turno" required>
        <button type="submit">Editar</button>
    </form>
</body>

<?php require 'templates/footer.php'; ?>