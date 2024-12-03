<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">

<a class="container-imaA" href="vistaPaciente">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<!-- CAMBIAR LA TABLA, LA QUE ESTA PUESTA SOLO ERA PARA REFERENCIA -->

<div class="table-container">
    <span class="txtC"> Citas Pendientes</span>
    <table>
        <thead>
            <tr>
                <th>id del usuario</th>
                <th>Nombre del Usuario</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre los resultados de la consulta
            while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['idUsuario']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['name_rol']}</td>"; // Asumiendo que idRol es un campo en tu tabla
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'templates/footer.php'; ?>