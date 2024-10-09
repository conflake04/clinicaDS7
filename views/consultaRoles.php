<?php require 'templates/header.php'; ?>

<body>
    <h1>Lista de Roles</h1>
    <table>
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
    <button><a href="./createRoll">Volver al inicio</a></button>
</body>

<?php require 'templates/footer.php'; ?>