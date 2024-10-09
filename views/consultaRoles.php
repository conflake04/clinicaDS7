<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultaRoles.css">
<body>
    <div class="container">
        <h1>Lista de Roles</h1>

        <div class="table-container">
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
        </div>

        <div class="button-container">
            <button><a href="./createRoll">Volver al inicio</a></button>
        </div>
    </div>
</body>

<?php require 'templates/footer.php'; ?>