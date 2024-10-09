<?php require 'templates/header.php'; ?>

<body>
    <h1>Eliminar Rol</h1>

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
        <label for="nombre_rol">Escribe el nombre del rol a eliminar:</label>
        <input type="text" name="nombre_rol" id="nombre_rol" required>
        <button type="submit">Eliminar Rol</button>
    </form>
</body>

<?php require 'templates/footer.php'; ?>