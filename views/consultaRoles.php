<?php require 'templates/header.php'; ?>

<link rel="stylesheet" href="./css/consultaRoles.css">



<span class="txtC"> Consulta Roles</span>
<div class="container">

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


<?php require 'templates/footer.php'; ?>