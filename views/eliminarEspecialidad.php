<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultaRoles.css">
<a class="container-imaA" href="GestionEspecialidad">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<span class="txtC"> Eliminar Especialidad</span>

<body>

    <table border="1">
        <thead>
            <tr>
                <th>ID Especialidad</th>
                <th>Nombre Especialidad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $especialidades;
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>{$row['id_especialidad']}</td>";
                    echo "<td>{$row['nombre_especialidad']}</td>";
                    echo "<td>{$row['descripcion']}</td>";
                    echo "</tr>";
                }
            } else {
                echo '<td colspan="3">No hay roles registrados.</td>';
            }
            ?>
        </tbody>
    </table>

    <form method="POST" action="./eliminarEspecialidad">
        <label class="txtR" for="nombre_especialidad">Escribe el nombre de la especialidad a eliminar:</label>

        <input class="inputB" type="text" name="nombre_especialidad" id="nombre_especialidad" required>
        <button type="submit">Eliminar</button>

    </form>
</body>

<?php require 'templates/footer.php'; ?>