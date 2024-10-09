<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultarUsuario.css">
<h1>Lista de Usuarios</h1>
<table>
    <thead>
        <tr>
            <th>id del usuario</th>
            <th>Nombre del empleado</th>
            <th>Nombre del Usuario</th>
            <th>Contraseña</th>
            <th>Correo Electrónico</th>
            <th>Dirección</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Iterar sobre los resultados de la consulta
        while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['idUsuario']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['direction']}</td>";
            echo "<td>{$row['idRol']}</td>"; // Asumiendo que idRol es un campo en tu tabla
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<button><a href="./createRoll">Volver al inicio</a></button>


<?php require 'templates/footer.php'; ?>