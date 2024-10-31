<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/editarMedico.css">
<a class="container-imaA" href="GestionEspecialidad">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<span class="txtC"> Editar Especialidad</span>

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

    <form class="formE" method="POST" action="./editarEspecialidad">
        <label class="txtR" for="id_especialidad">Ingrese el id de la especialidad a editar:</label>
        <input class="inputB" type="text" name="id_especialidad" id="id_especialidad" required>

        <label class="txtR" for="nombre_especialidad">Ingrese el nuevo nombre de la especialidad:</label>
        <input class="inputB" type="text" name="nombre_especialidad" id="nombre_especialidad" required>

        <label class="txtR" for="descripcion">Ingrese la nueva descripcion de la especialidad</label>
        <input class="inputB" type="text" name="descripcion" id="descripcion" required>
        <button type="submit">Editar</button>
    </form>
</body>

<?php require 'templates/footer.php'; ?>