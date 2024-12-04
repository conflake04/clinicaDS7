<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">

<a class="container-imaA" href="GestionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="admin">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>

<div class="table-container">
    <span class="txtC">Consulta Usuario: Administrador</span>
    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre los resultados de la consulta
            while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['cedula']}</td>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['apellido']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['telefono']}</td>";
                echo "<td>{$row['direccion']}</td>";
                echo "<td>{$row['name_rol']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'templates/footer.php'; ?>
