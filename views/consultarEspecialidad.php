<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">

<a class="container-imaA" href="./GestionEspecialidad">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="./admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="table-container">
    <span class="txtC"> Consulta Especialidad</span>
    <table>
        <thead>
            <tr>
                <th>Id Especialidad</th>
                <th>Nombre Especialidad</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $especialidades;
            if(!empty($rows)){
                foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>{$row['id_especialidad']}</td>";
                echo "<td>{$row['nombre_especialidad']}</td>";
                echo "<td>{$row['descripcion']}</td>";
                echo "</tr>";
                }
            }else{
                echo '<td colspan="3">No hay roles registrados.</td>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'templates/footer.php'; ?>