<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">
<a class="container-imaA" href="GestionUsuario">
    <img class="imaA" src="css/imagenes/atras.png" alt="Atras">
</a>

<a class="container-imaH" href="GestionUsuario">
    <img class="imaH" src="css/imagenes/hogar.png" alt="Atras">
</a>
<div class="table-container">
    <span class="txtC"> Consulta Usuario</span>
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