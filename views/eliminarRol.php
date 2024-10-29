<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultaRoles.css">


<span class="txtC"> Eliminar Rol</span>

<body>

    <!-- Tabla para mostrar los roles -->
    <table border="1">
        <thead>
            <tr>
                <th>Nombre del Rol</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($roles)): ?>
            <?php foreach ($roles as $rol): ?>
            <tr>
                <td><?php echo htmlspecialchars($rol['name_rol']); ?></td>
                <td><?php echo htmlspecialchars($rol['description']); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="2">No hay roles registrados.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Formulario para eliminar un rol -->
    <form method="POST" action="">
        <label class="txtR" for="nombre_rol">Escribe el nombre del rol a eliminar:</label>

        <input class="inputB" type="text" name="nombre_rol" id="nombre_rol" required>
        <button type="submit">Eliminar Rol</button>

    </form>
</body>

<?php require 'templates/footer.php'; ?>